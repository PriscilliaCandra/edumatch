<?php

namespace App\Http\Controllers;

use App\Models\ChatHistory; 
use App\Models\UserResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Log;

class ChatBotController extends Controller
{
    public function ask(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            Log::error("ChatBotController@ask: Unauthorized access - User not authenticated.");
            return response()->json(['error' => 'Unauthorized: User not authenticated.'], 401);
        }

        $request->validate([
            'message' => 'required|string',
        ]);

        $msg = $request->input('message');
        $userId = $user->id;

        ChatHistory::create([
            'user_id' => $userId,
            'sender' => 'user',
            'message' => $msg,
        ]);

        $userResult = UserResult::where('user_id', $userId)->first();

        if (!$userResult) {
            $reply = "Anda belum melakukan tes kepribadian RIASEC";
            
            ChatHistory::create([
                'user_id' => $userId,
                'sender' => 'bot',
                'message' => $reply,
            ]);

            return response()->json([
                'reply' => $reply,
                'needs_personality_test' => true
            ]);
        }

        $personalityTypesWithScores = $this->getDominantPersonalityTypesWithScores($userResult);
        $personalityContext = $this->formatPersonalityTypesForPrompt($personalityTypesWithScores);
        $personalityCharacteristics = $this->getPersonalityCharacteristics($personalityTypesWithScores);
        
        $prompt = "Anda adalah asisten chatbot yang membantu memberikan informasi dan saran tentang jurusan perkuliahan dan karir berdasarkan tes minat bakat RIASEC.
                  User memiliki tipe kepribadian dominan: {$personalityContext}.
                  
                  KARAKTERISTIK UTAMA TIPE KEPRIBADIAN USER:
                  {$personalityCharacteristics}

                  INSTRUKSI UMUM:
                  1. SELALU gunakan Bahasa Indonesia yang baik dan benar, sopan, dan ramah.
                  2. Gunakan bahasa yang mudah dipahami, hindari istilah asing yang tidak umum.
                  3. Berikan jawaban yang JELAS, SINGKAT, dan LANGSUNG ke inti pertanyaan.
                  4. Sesuaikan saran dan informasi dengan tipe kepribadian dominan user. Berikan contoh yang relevan dengan kepribadian tersebut.
                  5. Fokus pada informasi yang berguna dan praktis terkait pendidikan dan karir.
                  6. Jika user bertanya tentang sesuatu yang tidak terkait dengan minat bakat, jurusan, atau karir, tolak dengan sopan.
                  7. Jika user menanyakan tentang dirinya sendiri secara umum, kaitkan dengan tipe kepribadian dominannya (misal: 'Sebagai individu tipe Realistis, Anda cenderung...').
                  8. Maksimal 3-4 paragraf.
                  9. JANGAN memberikan jawaban yang bertele-tele atau tidak relevan.
                  10. JANGAN memberikan informasi palsu atau menyesatkan.
                  
                  PERTANYAAN USER: {$msg}
                  
                  JAWABAN ANDA HARUS:
                  1. Langsung menjawab pertanyaan user dalam Bahasa Indonesia.
                  2. Mengaitkan jawaban dengan tipe kepribadian dominan user.
                  3. Memberikan contoh konkret atau tips praktis terkait perkuliahan/karir.
                  4. Menjaga format ringkas dan informatif.";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, 'http://localhost:11434/api/generate'); 
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 120); 
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10); 

        $postData = json_encode([
            'model' => 'zephyr:7b-beta',
            'prompt' => $prompt,
            'stream' => false, 
            'options' => [ 
                'temperature' => 0.7,
                'num_predict' => 1000 
            ]
        ]);

        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

        Log::info('ChatBotController@ask: Sending request to Ollama API', [
            'prompt_length' => strlen($prompt),
            'postData_size' => strlen($postData),
            'user_id' => $userId
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            $error = curl_error($ch);
            $errno = curl_errno($ch);
            curl_close($ch);
            
            Log::error('ChatBotController@ask: Curl Error calling Ollama', [
                'error' => $error,
                'errno' => $errno,
                'url' => 'http://localhost:11434/api/generate',
                'user_id' => $userId
            ]);
            
            return response()->json([
                'reply' => 'Maaf, saya mengalami kesulitan dalam memproses pertanyaan Anda. Terjadi kesalahan koneksi ke asisten AI lokal. (' . $error . ')',
                'error_details' => 'Curl Error: ' . $error . ' (Error code: ' . $errno . ')',
                'llm_error' => true
            ], 500);
        }

        curl_close($ch);

        $ollamaResponse = json_decode($response, true);
        $fullResponse = '';

        if (isset($ollamaResponse['response'])) {
            $fullResponse = $ollamaResponse['response'];
            Log::info('ChatBotController@ask: Successful response from Ollama', ['response_length' => strlen($fullResponse), 'user_id' => $userId]);
        } else if (isset($ollamaResponse['error'])) {
            $fullResponse = "Maaf, asisten AI lokal mengalami error: " . $ollamaResponse['error'];
            Log::error('ChatBotController@ask: Ollama API returned an error', ['ollama_error' => $ollamaResponse['error'], 'user_id' => $userId]);
        } else {
            Log::warning('ChatBotController@ask: Empty or unexpected response from Ollama API', ['raw_response' => $response, 'user_id' => $userId]);
            $fullResponse = "Maaf, saya mengalami kesulitan dalam memproses pertanyaan Anda. Silakan coba tanyakan kembali dengan cara yang berbeda.";
        }

        ChatHistory::create([
            'user_id' => $userId,
            'sender' => 'bot',
            'message' => $fullResponse,
        ]);

        return response()->json([
            'reply' => $fullResponse
        ]);
    }

    private function getDominantPersonalityTypesWithScores($userResult)
    {
        $scores = [
            'R' => $userResult->score_realistic,
            'I' => $userResult->score_investigative,
            'A' => $userResult->score_artistic,
            'S' => $userResult->score_social,
            'E' => $userResult->score_enterprising,
            'C' => $userResult->score_conventional,
        ];

        arsort($scores);

        $dominantTypes = array_filter(array_slice($scores, 0, 2, true), function($score) {
            return $score > 0;
        });

        if (empty($dominantTypes) && $userResult->personality_type) {
             // Ambil karakter pertama dari personality_type yang sudah tersimpan
            $firstChar = $userResult->personality_type[0];
            if (isset($scores[$firstChar])) {
                return [$firstChar => $scores[$firstChar]];
            }
        }

        return $dominantTypes;
    }

    private function formatPersonalityTypesForPrompt($dominantTypesWithScores)
    {
        if (empty($dominantTypesWithScores)) {
            return "belum teridentifikasi secara jelas";
        }
        $types = [];
        foreach (array_keys($dominantTypesWithScores) as $char) {
            $types[] = $this->getRiasecLabel($char); 
        }

        if (count($types) == 1) {
            return $types[0];
        }
        $last = array_pop($types);
        return implode(', ', $types) . ' dan ' . $last;
    }

    private function getPersonalityCharacteristics($dominantTypesWithScores)
    {
        $characteristics = [
            'R' => "- Realistis (R): Praktis, suka bekerja dengan alat/mesin/alam, fokus pada hasil konkret. Belajar efektif melalui: praktik langsung, eksperimen, proyek fisik. Cocok dengan: Teknik, Pertanian, Kehutanan, Olahraga.",
            'I' => "- Investigatif (I): Analitis, rasional, suka memecahkan masalah, meneliti. Belajar efektif melalui: riset, analisis data, studi kasus, debat. Cocok dengan: Sains, Kedokteran, Riset, IT.",
            'A' => "- Artistik (A): Kreatif, ekspresif, orisinal, suka seni dan ide baru. Belajar efektif melalui: proyek kreatif, diskusi terbuka, eksplorasi ide. Cocok dengan: Seni, Desain, Sastra, Musik, Film.",
            'S' => "- Sosial (S): Suka membantu, ramah, persuasif, fokus pada interaksi manusia. Belajar efektif melalui: kerja kelompok, diskusi, bimbingan, mengajar orang lain. Cocok dengan: Pendidikan, Psikologi, Hukum, Kesehatan, Komunikasi.",
            'E' => "- Enterprising (E): Ambisius, persuasif, suka memimpin, berorientasi pada tujuan. Belajar efektif melalui: presentasi, proyek kepemimpinan, simulasi bisnis. Cocok dengan: Bisnis, Manajemen, Marketing, Politik.",
            'C' => "- Konvensional (C): Terstruktur, rapi, teliti, suka data dan sistem terorganisir. Belajar efektif melalui: metode teratur, hafalan, analisis detail, sistematisasi. Cocok dengan: Akuntansi, Administrasi, Perbankan, Perpustakaan, Statistik."
        ];

        $output = [];
        foreach (array_keys($dominantTypesWithScores) as $typeChar) {
            if (isset($characteristics[$typeChar])) {
                $output[] = $characteristics[$typeChar];
            }
        }
        return implode("\n", $output);
    }

    private function getRiasecLabel($char)
    {
        $labels = [
            'R' => 'Realistis',
            'I' => 'Investigatif',
            'A' => 'Artistik',
            'S' => 'Sosial',
            'E' => 'Enterprising',
            'C' => 'Konvensional',
        ];
        return $labels[$char] ?? $char;
    }

    public function history()
    {
        $user = Auth::user();
        if (!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $history = ChatHistory::where('user_id', $user->id)
            ->orderBy('created_at', 'asc') 
            ->get(['sender', 'message', 'created_at']);

        return response()->json($history);
    }
}
