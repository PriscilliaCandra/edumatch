<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\UserAnswer;
use App\Models\UserResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; 
use Tymon\JWTAuth\Facades\JWTAuth; 

class RiasecTestController extends Controller
{
        public function index()
    {
        return view('riasec.test');
    }

    // public function getQuestionByOrderJson(Request $request, $order = null)
    // {
    //     $user = Auth::user();
    //     $totalQuestions = Question::count();
    //     $questionsPerLevel = 12;

    //     $answeredQuestionsCount = UserAnswer::where('user_id', $user->id)->count();
    //     $currentLevel = floor($answeredQuestionsCount / $questionsPerLevel) + 1;

    //     if ($currentLevel > 3) {
    //         $this->calculateAndSaveResult($user); // Pastikan hasil dihitung
    //         return response()->json(['message' => 'Tes sudah selesai!', 'test_completed' => true, 'redirect' => route('riasec.result')], 200);
    //     }

    //     $question = null;

    //     if (is_null($order)) {
    //         // Logika untuk menemukan pertanyaan pertama yang belum dijawab di level saat ini atau level berikutnya
    //         $answeredQuestionIds = UserAnswer::where('user_id', $user->id)->pluck('question_id')->toArray();

    //         // Coba ambil pertanyaan pertama yang belum dijawab di level saat ini
    //         $question = Question::where('level', $currentLevel)
    //                             ->whereNotIn('id', $answeredQuestionIds)
    //                             ->orderBy('question_order')
    //                             ->first();

    //         // Jika semua pertanyaan di level saat ini sudah dijawab,
    //         // dan user belum menyelesaikan seluruh tes,
    //         // dan ada level berikutnya, maka otomatis pindah ke level berikutnya.
    //         if (!$question && $answeredQuestionsCount < $totalQuestions && $currentLevel < 3) {
    //             $currentLevel++; // Pindah level secara internal di server
    //             $question = Question::where('level', $currentLevel)
    //                                 ->whereNotIn('id', $answeredQuestionIds) // Pastikan belum dijawab di level baru
    //                                 ->orderBy('question_order')
    //                                 ->first();
    //         }

    //         // Jika masih tidak ada pertanyaan (misal: semua level sudah selesai, atau masalah data)
    //         if (!$question && $answeredQuestionsCount == $totalQuestions) {
    //             $this->calculateAndSaveResult($user); // Hitung hasil jika tes selesai
    //             return response()->json(['message' => 'Tes sudah selesai!', 'test_completed' => true, 'redirect' => route('riasec.result')], 200);
    //         }
    //          // Fallback jika masih null setelah semua pengecekan, ambil saja pertanyaan pertama dari currentLevel (yang mungkin baru dinaikkan)
    //          if (!$question) {
    //              $question = Question::where('level', $currentLevel)->orderBy('question_order')->first();
    //              if (!$question) {
    //                  return response()->json(['message' => 'Tidak ada pertanyaan yang ditemukan untuk level ini.', 'test_completed' => true], 404);
    //              }
    //          }

    //     } else {
    //         // Jika order spesifik diminta, ambil pertanyaan berdasarkan order tersebut
    //         $question = Question::where('question_order', $order)->first();

    //         if (!$question) {
    //             return response()->json(['message' => 'Pertanyaan tidak ditemukan.', 'test_completed' => true], 404);
    //         }

    //         // Validasi: Pastikan user tidak melompati level
    //         // Dapatkan currentLevel user berdasarkan jumlah jawaban yang sudah tersimpan
    //         $levelBasedOnAnswers = floor($answeredQuestionsCount / $questionsPerLevel) + 1;
    //         if ($question->level > $levelBasedOnAnswers) { // Bandingkan dengan level berdasarkan jawaban aktual
    //             return response()->json(['error' => 'Anda harus menyelesaikan Level ' . ($levelBasedOnAnswers) . ' terlebih dahulu.'], 403);
    //         }
    //     }

    //     // Ambil jawaban pengguna untuk pertanyaan ini (jika sudah ada)
    //     $userAnswer = UserAnswer::where('user_id', $user->id)
    //                             ->where('question_id', $question->id)
    //                             ->first();

    //     // Recalculate currentLevel for response based on the question being sent
    //     $currentLevelForResponse = $question->level;

    //     return response()->json([
    //         'question' => $question,
    //         'user_answer_choice' => $userAnswer ? $userAnswer->answer_choice : null,
    //         'current_question_order' => $question->question_order,
    //         'answered_count' => $answeredQuestionsCount,
    //         'total_questions' => $totalQuestions,
    //         'test_completed' => false,
    //         'current_level' => $currentLevelForResponse, // Kirim level pertanyaan yang dikirim
    //         'questions_per_level' => $questionsPerLevel,
    //     ], 200);
    // }

    // public function getQuestionByLevelAndOrderJson(Request $request, $level_param = null, $question_order_in_level_param = null)
    // {
    //     $user = Auth::user();
    //     $totalQuestionsGlobal = Question::count(); // Total semua pertanyaan (misal 36)
    //     $questionsPerLevel = 12; // Asumsi tetap 12 pertanyaan per level

    //     // Hitung level saat ini yang seharusnya diakses user berdasarkan jawaban global
    //     $answeredQuestionsCountGlobal = UserAnswer::where('user_id', $user->id)->count();
    //     $currentLevelExpected = floor($answeredQuestionsCountGlobal / $questionsPerLevel) + 1;

    //     if ($currentLevelExpected > 3) { // Jika sudah melebihi level 3, berarti tes selesai
    //         $this->calculateAndSaveResult($user);
    //         return response()->json(['message' => 'Tes sudah selesai!', 'test_completed' => true, 'redirect' => route('riasec.result')], 200);
    //     }

    //     $question = null;
    //     $requestedLevel = $level_param;
    //     $requestedOrderInLevel = $question_order_in_level_param;

    //     // --- Logika Penentuan Pertanyaan yang Akan Dikirim ---
    //     if (is_null($requestedLevel) || is_null($requestedOrderInLevel)) {
    //         // Ini adalah pemanggilan awal (misal dari loadQuestion() tanpa parameter)
    //         // Cari pertanyaan pertama yang belum dijawab di level yang diharapkan
    //         $answeredQuestionIds = UserAnswer::where('user_id', $user->id)->pluck('question_id')->toArray();

    //         $question = Question::where('level', $currentLevelExpected)
    //                             ->whereNotIn('id', $answeredQuestionIds)
    //                             ->orderBy('question_order') // Order global untuk memastikan urutan
    //                             ->first();

    //         // Jika semua pertanyaan di level saat ini (expected) sudah dijawab,
    //         // dan belum menyelesaikan seluruh tes, dan ada level berikutnya
    //         if (!$question && $answeredQuestionsCountGlobal < $totalQuestionsGlobal && $currentLevelExpected < 3) {
    //             // Otomatis maju ke level berikutnya di server
    //             $currentLevelExpected++;
    //             $question = Question::where('level', $currentLevelExpected)
    //                                 ->whereNotIn('id', $answeredQuestionIds)
    //                                 ->orderBy('question_order')
    //                                 ->first();
    //         }

    //         // Fallback jika masih tidak ada pertanyaan (misal semua sudah dijawab atau masalah data)
    //         if (!$question) {
    //             // Jika semua sudah dijawab global
    //             if ($answeredQuestionsCountGlobal == $totalQuestionsGlobal) {
    //                 $this->calculateAndSaveResult($user);
    //                 return response()->json(['message' => 'Tes sudah selesai!', 'test_completed' => true, 'redirect' => route('riasec.result')], 200);
    //             }
    //             // Jika masih ada pertanyaan global tapi tidak ditemukan di level expected
    //             // Coba ambil pertanyaan pertama dari level expected saat ini (sebagai safety net)
    //             $question = Question::where('level', $currentLevelExpected)->orderBy('question_order')->first();
    //             if (!$question) {
    //                 return response()->json(['message' => 'Tidak ada pertanyaan yang ditemukan untuk level ini.', 'test_completed' => true], 404);
    //             }
    //         }
    //     } else {
    //         // Ini adalah pemanggilan spesifik dengan level dan order_in_level (dari tombol Prev/Next)
    //         $question = Question::where('level', $requestedLevel)
    //                             ->where('question_order_in_level', $requestedOrderInLevel) // Assuming new column or logic for order_in_level
    //                             ->first();

    //         if (!$question) {
    //             return response()->json(['message' => 'Pertanyaan tidak ditemukan untuk level dan order ini.', 'test_completed' => false], 404);
    //         }

    //         // Validasi: Pastikan user tidak melompati level
    //         if ($requestedLevel > $currentLevelExpected) {
    //             return response()->json(['error' => 'Anda harus menyelesaikan Level ' . ($currentLevelExpected) . ' terlebih dahulu.'], 403);
    //         }
    //     }

    //     // --- Ambil Jawaban Pengguna untuk Pertanyaan yang Ditemukan ---
    //     $userAnswer = UserAnswer::where('user_id', $user->id)
    //                             ->where('question_id', $question->id)
    //                             ->first();

    //     // --- Siapkan Respons ---
    //     // Kita akan mengembalikan question_order global sebagai current_question_order
    //     // Tetapi juga question_order_in_level untuk referensi frontend
    //     return response()->json([
    //         'question' => $question,
    //         'user_answer_choice' => $userAnswer ? $userAnswer->answer_choice : null,
    //         'current_question_order' => $question->question_order, // Ini adalah order GLOBAL
    //         'current_question_order_in_level' => $question->question_order_in_level, // Order dalam level
    //         'answered_count' => $answeredQuestionsCountGlobal,
    //         'total_questions' => $totalQuestionsGlobal,
    //         'test_completed' => false,
    //         'current_level' => $question->level, // Level pertanyaan yang dikirim
    //         'questions_per_level' => $questionsPerLevel,
    //     ], 200);
    // }

    // public function submitAnswer(Request $request) 
    // {
    //     $user = Auth::user();
    //     $validatedData = $request->validate([
    //         'question_id' => 'required|exists:questions,id',
    //         'level' => 'required|integer',
    //         'question_order' => 'required|integer',
    //         'answer_choice' => 'required|string|in:R,I,A,S,E,C',
    //     ]);

    //     try {
    //         DB::beginTransaction();

    //         $existingAnswer = UserAnswer::where('user_id', $user->id)
    //                                     ->where('question_id', $validatedData['question_id'])
    //                                     ->first();

    //         if ($existingAnswer) {
    //             $existingAnswer->update([
    //                 'answer_choice' => $validatedData['answer_choice'],
    //                 'level' => $validatedData['level'],
    //                 'question_order' => $validatedData['question_order'],
    //             ]);
    //         } else {
    //             UserAnswer::create([
    //                 'user_id' => $user->id,
    //                 'question_id' => $validatedData['question_id'],
    //                 'level' => $validatedData['level'],
    //                 'question_order' => $validatedData['question_order'],
    //                 'answer_choice' => $validatedData['answer_choice'],
    //             ]);
    //         }

    //         DB::commit();

    //         $answeredQuestionsCount = UserAnswer::where('user_id', $user->id)->count();
    //         $totalQuestions = Question::count();
    //         $questionsPerLevel = 12;

    //         $isLevelCompleted = false;
    //         $nextLevel = null;

    //         $answeredInCurrentLevel = UserAnswer::where('user_id', $user->id)
    //                                             ->whereHas('question', function ($q) use ($validatedData) {
    //                                                 $q->where('level', $validatedData['level']);
    //                                             })->count();

    //         if ($answeredInCurrentLevel == $questionsPerLevel && $validatedData['level'] < 3) {
    //             $isLevelCompleted = true;
    //             $nextLevel = $validatedData['level'] + 1;
    //         }

    //         return response()->json([
    //             'message' => 'Jawaban berhasil disimpan.',
    //             'answered_count' => $answeredQuestionsCount,
    //             'total_questions' => $totalQuestions,
    //             'test_completed' => ($answeredQuestionsCount == $totalQuestions),
    //             'level_completed' => $isLevelCompleted,
    //             'next_level' => $nextLevel,
    //         ], 200);

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         \Log::error('Gagal menyimpan jawaban RIASEC: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());
    //         return response()->json(['message' => 'Terjadi kesalahan pada server saat menyimpan jawaban. Silakan coba lagi.', 'error' => $e->getMessage()], 500);
    //     }
    // }

    public function getQuestionByLevelAndOrderJson(Request $request, $level_param = null, $question_order_in_level_param = null)
    {
        $user = Auth::user();
        $totalQuestionsGlobal = Question::count();
        $questionsPerLevel = 12;

        $answeredQuestionsCountGlobal = UserAnswer::where('user_id', $user->id)->count();
        $currentLevelExpected = floor($answeredQuestionsCountGlobal / $questionsPerLevel) + 1;

        if ($currentLevelExpected > 3) {
            $this->calculateAndSaveResult($user);
            return response()->json(['message' => 'Tes sudah selesai!', 'test_completed' => true, 'redirect' => route('riasec.result')], 200);
        }

        $question = null;

        if (is_null($level_param) || is_null($question_order_in_level_param)) {
            // Logika untuk menemukan pertanyaan pertama yang belum dijawab di level yang diharapkan
            $answeredQuestionIds = UserAnswer::where('user_id', $user->id)->pluck('question_id')->toArray();

            $question = Question::where('level', $currentLevelExpected)
                                ->whereNotIn('id', $answeredQuestionIds)
                                ->orderBy('question_order')
                                ->first();

            if (!$question && $answeredQuestionsCountGlobal < $totalQuestionsGlobal && $currentLevelExpected < 3) {
                $currentLevelExpected++;
                $question = Question::where('level', $currentLevelExpected)
                                    ->whereNotIn('id', $answeredQuestionIds)
                                    ->orderBy('question_order')
                                    ->first();
            }

            if (!$question) {
                if ($answeredQuestionsCountGlobal == $totalQuestionsGlobal) {
                    $this->calculateAndSaveResult($user);
                    return response()->json(['message' => 'Tes sudah selesai!', 'test_completed' => true, 'redirect' => route('riasec.result')], 200);
                }
                $question = Question::where('level', $currentLevelExpected)->orderBy('question_order')->first();
                if (!$question) {
                    return response()->json(['message' => 'Tidak ada pertanyaan yang ditemukan untuk level ini.', 'test_completed' => true], 404);
                }
            }

        } else {
            // Ini adalah pemanggilan spesifik dengan level dan order_in_level (dari tombol Prev/Next)
            // HITUNG question_order GLOBAL dari level dan order_in_level yang diminta
            // $globalQuestionOrderToFind = ($level_param - 1) * $questionsPerLevel + $question_order_in_level_param;

            $question = Question::where('level', $level_param)
                                ->where('question_order', $question_order_in_level_param) 
                                ->first();

            if (!$question) {
                return response()->json(['message' => 'Pertanyaan tidak ditemukan untuk level dan order ini.', 'test_completed' => false], 404);
            }

            // Validasi: Pastikan user tidak melompati level
            if ($level_param > $currentLevelExpected) {
                return response()->json(['error' => 'Anda harus menyelesaikan Level ' . ($currentLevelExpected) . ' terlebih dahulu.'], 403);
            }
        }

        // Ambil jawaban pengguna untuk pertanyaan ini (jika sudah ada)
        $userAnswer = UserAnswer::where('user_id', $user->id)
                                ->where('question_id', $question->id)
                                ->first();

        // Hitung question_order_in_level dari question_order global yang ditemukan
        $currentQuestionGlobalOrderCalculated = ($question->level - 1) * $questionsPerLevel + $question->question_order;

        return response()->json([
            'question' => $question,
            'user_answer_choice' => $userAnswer ? $userAnswer->answer_choice : null,
            'current_question_order' => $currentQuestionGlobalOrderCalculated, // Ini adalah order GLOBAL
            'current_question_order_in_level' => $question->question_order, // Order dalam level (dihitung)
            'answered_count' => $answeredQuestionsCountGlobal,
            'total_questions' => $totalQuestionsGlobal,
            'test_completed' => false,
            'current_level' => $question->level, // Level pertanyaan yang dikirim
            'questions_per_level' => $questionsPerLevel,
        ], 200);
    }

    // submitAnswer tetap sama. Tidak perlu perubahan karena dia sudah menerima question_order global.
    public function submitAnswer(Request $request)
    {
        $user = Auth::user();
        $validatedData = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'level' => 'required|integer',
            'question_order' => 'required|integer', // Ini adalah order GLOBAL dari frontend
            'answer_choice' => 'required|string|in:R,I,A,S,E,C',
        ]);

        try {
            DB::beginTransaction();

            $existingAnswer = UserAnswer::where('user_id', $user->id)
                                        ->where('question_id', $validatedData['question_id'])
                                        ->first();

            if ($existingAnswer) {
                $existingAnswer->update([
                    'answer_choice' => $validatedData['answer_choice'],
                    'level' => $validatedData['level'],
                    'question_order' => $validatedData['question_order'],
                ]);
            } else {
                UserAnswer::create([
                    'user_id' => $user->id,
                    'question_id' => $validatedData['question_id'],
                    'level' => $validatedData['level'],
                    'question_order' => $validatedData['question_order'],
                    'answer_choice' => $validatedData['answer_choice'],
                ]);
            }

            DB::commit();

            $answeredQuestionsCount = UserAnswer::where('user_id', $user->id)->count();
            $totalQuestions = Question::count();
            $questionsPerLevel = 12;

            $isLevelCompleted = false;
            $nextLevel = null;

            $answeredInCurrentLevel = UserAnswer::where('user_id', $user->id)
                                                ->whereHas('question', function ($q) use ($validatedData) {
                                                    $q->where('level', $validatedData['level']);
                                                })->count();

            if ($answeredInCurrentLevel == $questionsPerLevel && $validatedData['level'] < 3) {
                $isLevelCompleted = true;
                $nextLevel = $validatedData['level'] + 1;
            }

            return response()->json([
                'message' => 'Jawaban berhasil disimpan.',
                'answered_count' => $answeredQuestionsCount,
                'total_questions' => $totalQuestions,
                'test_completed' => ($answeredQuestionsCount == $totalQuestions),
                'level_completed' => $isLevelCompleted,
                'next_level' => $nextLevel,
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Gagal menyimpan jawaban RIASEC: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());
            return response()->json(['message' => 'Terjadi kesalahan pada server saat menyimpan jawaban. Silakan coba lagi.', 'error' => $e->getMessage()], 500);
        }
    }

    private function calculateAndSaveResult($user)
    {
        $userAnswers = UserAnswer::where('user_id', $user->id)->get();

        $scores = [
            'R' => 0, 'I' => 0, 'A' => 0, 'S' => 0, 'E' => 0, 'C' => 0
        ];

        foreach ($userAnswers as $answer) {
            $choice = $answer->answer_choice;
            if (isset($scores[$choice])) {
                $scores[$choice]++;
            }
        }

        arsort($scores); 
        $personalityType = implode('', array_slice(array_keys($scores), 0, 2)); 

        $recommendedMajors = $this->getRecommendedMajors($personalityType);

        UserResult::updateOrCreate(
            ['user_id' => $user->id],
            [
                'score_realistic' => $scores['R'],
                'score_investigative' => $scores['I'],
                'score_artistic' => $scores['A'],
                'score_social' => $scores['S'],
                'score_enterprising' => $scores['E'],
                'score_conventional' => $scores['C'],
                'personality_type' => $personalityType,
                'recommended_majors' => $recommendedMajors,
            ]
        );
    }

    private function getRecommendedMajors($personalityType)
    {
        $majors = [
            'RI' => 'Teknik Elektro, Teknik Mesin, Arsitektur',
            'RA' => 'Desain Produk, Seni Rupa, Arsitektur',
            'RS' => 'Ilmu Olahraga, Pendidikan Jasmani, Kehutanan',
            'RE' => 'Manajemen Konstruksi, Kewirausahaan Teknologi',
            'RC' => 'Akuntansi, Teknik Sipil, Logistik',
            'IR' => 'Fisika, Kimia, Biologi, Kedokteran',
            'IA' => 'Penelitian Seni, Kurator Museum, Desain Grafis',
            'IS' => 'Psikologi, Sosiologi, Kedokteran',
            'IE' => 'Penelitian Pasar, Statistik, Ilmu Komputer',
            'IC' => 'Ilmu Perpustakaan, Analisis Data, Aktuaria',
            'AR' => 'Desain Interior, Desain Komunikasi Visual, Kriya',
            'AI' => 'Arkeologi, Sejarah Seni, Filsafat',
            'AS' => 'Musik, Teater, Tari, Pendidikan Seni',
            'AE' => 'Industri Kreatif, Public Relations, Periklanan',
            'AC' => 'Arsiparis, Pengelolaan Dokumen, Penulisan Kreatif',
            'SR' => 'Perawat, Terapis Fisik, Guru SD',
            'SI' => 'Konseling, Pekerja Sosial, Psikolog Klinis',
            'SA' => 'Seniman Komunitas, Terapi Seni, Pengembang Program Edukasi',
            'SE' => 'Manajemen Sumber Daya Manusia, Public Relations, Marketing',
            'SC' => 'Administrasi Publik, Sekretaris, Tata Usaha',
            'ER' => 'Teknik Industri, Manajemen Operasi, Logistik',
            'EI' => 'Ekonomi, Keuangan, Analisis Bisnis',
            'EA' => 'Manajemen Seni, Perdagangan Seni, Event Organizer',
            'ES' => 'Manajemen Bisnis, Kewirausahaan, Penjualan',
            'EC' => 'Manajemen Perkantoran, Keuangan, Bisnis Internasional',
            'CR' => 'Akuntansi, Manajemen Keuangan, Sistem Informasi',
            'CI' => 'Analisis Data, Ilmu Komputer, Statistika',
            'CA' => 'Perpustakaan, Dokumentasi, Kearsipan',
            'CS' => 'Administrasi Perkantoran, Guru TK, Pekerja Sosial',
            'CE' => 'Administrasi Bisnis, Sekretaris Eksekutif, Manajemen Proyek',
        ];

        return $majors[$personalityType] ?? 'Tidak ada rekomendasi spesifik. Jelajahi berbagai bidang!';
    }

    public function showResult()
    {
        $user = Auth::user();
        $userResult = UserResult::where('user_id', $user->id)->first();

        if (!$userResult) {
            return redirect()->route('riasec.test')->with('error', 'Anda belum menyelesaikan tes RIASEC.');
        }

        return view('riasec.result', compact('userResult'));
    }
}