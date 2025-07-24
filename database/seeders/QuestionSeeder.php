<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    public function run()
    {
        $questions = [
            // Level 1: Dunia Minat
            [
                'level' => '1',
                'question_text' => 'Jika kamu punya satu hari bebas di dunia ini, kamu akan…',
                'option_r' => 'Membangun sesuatu yang berfungsi, seperti rumah pohon atau robot kecil', // Realistic - hands-on, practical
                'option_i' => 'Menyusun teka-teki besar di kuil logika', // Investigative - analytical, problem-solving
                'option_a' => 'Melukis mural langit di Kuil Seni', // Artistic - creative, expressive
                'option_s' => 'Membantu anak-anak belajar di Hutan Cerita', // Social - helping, nurturing
                'option_e' => 'Menjual ide bisnis ke Raja Dagang', // Enterprising - leading, persuading
                'option_c' => 'Mengatur ulang perpustakaan kerajaan agar lebih efisien', // Conventional - organized, detail-oriented
                'question_order' => 1
            ],
            [
                'level' => '1',
                'question_text' => 'Kamu mendapatkan tongkat ajaib. Saat kamu goyangkan, dia menampilkan profesi masa depanmu:',
                'option_r' => 'Teknisi ahli yang memperbaiki segalanya', // Realistic - mechanical, practical
                'option_i' => 'Peneliti canggih', // Investigative - intellectual, scientific
                'option_a' => 'Arsitek imajinasi', // Artistic - innovative, aesthetic
                'option_s' => 'Penjaga jiwa', // Social - supportive, compassionate
                'option_e' => 'Investor kerajaan', // Enterprising - ambitious, influential
                'option_c' => 'Akuntan kerajaan yang memastikan keuangan rapi', // Conventional - systematic, accurate
                'question_order' => 2
            ],
            [
                'level' => '1',
                'question_text' => 'Di Perpustakaan Minat, kamu hanya bisa bawa satu buku. Kamu ambil...',
                'option_r' => 'Panduan lengkap membangun struktur baja', // Realistic - practical skills
                'option_i' => 'Rumus tersembunyi semesta', // Investigative - theoretical, abstract
                'option_a' => 'Seni membentuk realita', // Artistic - creative process
                'option_s' => 'Bahasa perasaan', // Social - interpersonal, emotional intelligence
                'option_e' => 'Rahasia menjadi pemimpin hebat', // Enterprising - leadership, influence
                'option_c' => 'Buku pedoman peraturan dan prosedur kerajaan', // Conventional - structured, orderly
                'question_order' => 3
            ],
            [
                'level' => '1',
                'question_text' => 'Seekor naga menawarkan skill spesial. Kamu pilih...',
                'option_r' => 'Bisa memperbaiki mesin apa pun dengan sentuhan', // Realistic - hands-on problem-solving
                'option_i' => 'Bisa memecahkan masalah kompleks', // Investigative - analytical thinking
                'option_a' => 'Bisa menciptakan hal indah dari apa pun', // Artistic - artistic creation
                'option_s' => 'Bisa menyembuhkan luka batin', // Social - empathy, healing
                'option_e' => 'Bisa membaca pola keuangan', // Enterprising - financial acumen, strategy
                'option_c' => 'Bisa mengatur informasi menjadi database yang sempurna', // Conventional - organizing data
                'question_order' => 4
            ],
            [
                'level' => '1',
                'question_text' => 'Di ruang ilusi, kamu ditampilkan sebagai karakter game. Kamu muncul sebagai...',
                'option_r' => 'Seorang pandai besi yang membuat senjata kuat', // Realistic - skilled craftsmanship
                'option_i' => 'Engineer berpikiran tajam', // Investigative - logical, technical
                'option_a' => 'Seniman dengan kuas sihir', // Artistic - imaginative, expressive
                'option_s' => 'Penyembuh yang dicintai', // Social - caring, supportive
                'option_e' => 'CEO muda dari kerajaan startup', // Enterprising - leadership, innovation
                'option_c' => 'Pencatat sejarah yang rapi dan akurat', // Conventional - precise, record-keeping
                'question_order' => 5
            ],
            [
                'level' => '1',
                'question_text' => 'Kamu menjelajahi Pasar Waktu, tiap toko menampilkan kegiatan idealmu seumur hidup. Kamu langsung masuk ke...',
                'option_r' => 'Bengkel Penemuan Alat Baru', // Realistic - practical innovation
                'option_i' => 'Toko Riset & Penemuan', // Investigative - scientific exploration
                'option_a' => 'Galeri Ilusi Visual', // Artistic - visual arts
                'option_s' => 'Ruang Baca Anak-Anak', // Social - teaching, helping
                'option_e' => 'Bursa Ide & Inovasi', // Enterprising - business, entrepreneurial
                'option_c' => 'Kantor Arsip & Klasifikasi', // Conventional - systematic organization
                'question_order' => 6
            ],
            [
                'level' => '1',
                'question_text' => 'Di Taman Pilihan, kamu duduk di bawah pohon yang berbisik. Ia berkata: “Impian terbesar kamu adalah...',
                'option_r' => 'Menciptakan teknologi yang berguna bagi banyak orang', // Realistic - tangible outcomes, utility
                'option_i' => 'Menemukan hukum alam baru', // Investigative - discovery, understanding
                'option_a' => 'Membuat karya tak terlupakan', // Artistic - creative legacy
                'option_s' => 'Membahagiakan orang-orang sekitarmu', // Social - well-being of others
                'option_e' => 'Membangun usaha yang berdampak', // Enterprising - impact, influence
                'option_c' => 'Membuat sistem yang membuat dunia berjalan lebih teratur', // Conventional - order, efficiency
                'question_order' => 7
            ],
            [
                'level' => '1',
                'question_text' => 'Sebuah kotak harta muncul di hadapanmu. Isinya...',
                'option_r' => 'Perangkat perkakas multiguna canggih', // Realistic - tools, practical items
                'option_i' => 'Blueprint mesin masa depan', // Investigative - designs, theoretical
                'option_a' => 'Kuas lukisan bercahaya', // Artistic - creative instruments
                'option_s' => 'Surat terima kasih dari anak-anak', // Social - appreciation from helping
                'option_e' => 'Kartu emas bisnis global', // Enterprising - financial power, influence
                'option_c' => 'Daftar kode rahasia dan password kuno', // Conventional - data, security
                'question_order' => 8
            ],
            [
                'level' => '1',
                'question_text' => 'Di Kuil Diri, kamu diminta menggambarkan momen paling menyenangkan hidupmu...',
                'option_r' => 'Saat berhasil merakit sesuatu yang rumit', // Realistic - hands-on achievement
                'option_i' => 'Saat berhasil menyelesaikan tantangan logika', // Investigative - intellectual achievement
                'option_a' => 'Saat membuat sesuatu yang menginspirasi', // Artistic - creative impact
                'option_s' => 'Saat ada yang tersenyum karena uluranmu', // Social - helping others
                'option_e' => 'Saat idemu diapresiasi banyak orang', // Enterprising - recognition, influence
                'option_c' => 'Saat berhasil mengelola sebuah proyek dengan sempurna', // Conventional - organized achievement
                'question_order' => 9
            ],
            [
                'level' => '1',
                'question_text' => 'Di Pintu Tiga Jalan, kamu hanya bisa pilih satu portal...',
                'option_r' => 'Bengkel Kerajinan Kayu Ajaib', // Realistic - practical, craft-oriented
                'option_i' => 'Lab Sains Ajaib', // Investigative - scientific inquiry
                'option_a' => 'Studio Impian Virtual', // Artistic - imaginative creation
                'option_s' => 'Taman Damai Jiwa', // Social - care, tranquility
                'option_e' => 'Menara Strategi Dagang', // Enterprising - business, strategy
                'option_c' => 'Pusat Data & Dokumen Kuno', // Conventional - information management
                'question_order' => 10
            ],
            [
                'level' => '1',
                'question_text' => 'Dewa Minat menantangmu dengan satu pertanyaan terakhir: “Jika dunia ini membutuhkan peranmu, kamu ingin dikenal sebagai...',
                'option_r' => 'Pembangun', // Realistic - builder, creator of tangible things
                'option_i' => 'Pemikir tajam', // Investigative - intellectual, analytical
                'option_a' => 'Pencipta keindahan', // Artistic - creative, aesthetic
                'option_s' => 'Penguat hati', // Social - supportive, empathetic
                'option_e' => 'Pengubah sistem', // Enterprising - leader, innovator
                'option_c' => 'Pengatur', // Conventional - organizer, systematizer
                'question_order' => 11
            ],
            [
                'level' => '1',
                'question_text' => 'Terakhir, kamu menulis pesan di Batu Takdir: “Aku ingin masa depanku diisi dengan...',
                'option_r' => 'Penyelesaian masalah praktis dan membangun hal konkret', // Realistic - tangible problem-solving
                'option_i' => 'Tantangan intelektual', // Investigative - mental challenge, learning
                'option_a' => 'Ekspresi & estetika', // Artistic - creative expression
                'option_s' => 'Kehangatan dan makna antar manusia', // Social - interpersonal connection
                'option_e' => 'Keberanian membangun hal baru', // Enterprising - entrepreneurial drive
                'option_c' => 'Ketertiban dan sistem yang sempurna', // Conventional - order, structure
                'question_order' => 12
            ],

            // Level 2: Arena Bakat
            [
                'level' => '2',
                'question_text' => 'Kamu berada di Labirin Logika. Untuk keluar, kamu harus...',
                'option_r' => 'Membuat alat yang bisa menembus dinding labirin', // Realistic - practical solution
                'option_i' => 'Hitung rute tercepat dengan rumus', // Investigative - analytical problem-solving
                'option_a' => 'Gambar peta jalan dari simbol', // Artistic - visual, intuitive
                'option_s' => 'Dengarkan suara hati tiap jalur', // Social - intuition, empathy
                'option_e' => 'Organisir tim pecah jadi 3 jalur', // Enterprising - leadership, delegation
                'option_c' => 'Mencatat setiap belokan dan membuat daftar kemungkinan', // Conventional - systematic record-keeping
                'question_order' => 1
            ],
            [
                'level' => '2',
                'question_text' => 'Raja meminta kamu mendesain festival. Kamu bertugas...',
                'option_r' => 'Bangun sistem pencahayaan efisien', // Realistic - practical, technical
                'option_i' => 'Mengembangkan teori akustik terbaik untuk panggung', // Investigative - scientific, theoretical
                'option_a' => 'Buat dekorasi panggung megah', // Artistic - creative, visual
                'option_s' => 'Menjaga pengunjung dengan tenang', // Social - caring, supportive
                'option_e' => 'Atur jadwal & anggaran', // Enterprising - management, organization
                'option_c' => 'Membuat daftar rinci semua vendor dan kontak mereka', // Conventional - detailed record-keeping
                'question_order' => 2
            ],
            [
                'level' => '2',
                'question_text' => 'Kamu dapat teka-teki: “Jika 5 penyihir membuat 5 ramuan dalam 5 jam, berapa waktu untuk 100 ramuan?”',
                'option_r' => 'Membuat eksperimen untuk melihat kecepatan ramuan dibuat', // Realistic - empirical, hands-on testing
                'option_i' => '5 jam (jika semua penyihir bekerja paralel)', // Investigative - logical, analytical (the correct answer to the riddle)
                'option_a' => 'Hah? Aku buat visualnya aja', // Artistic - creative, less focused on numbers
                'option_s' => 'Memastikan semua penyihir bekerja dengan nyaman', // Social - focus on people's well-being
                'option_e' => 'Menghitung potensi keuntungan dari 100 ramuan', // Enterprising - business-oriented
                'option_c' => 'Membuat tabel waktu dan produksi untuk setiap penyihir', // Conventional - structured, organized data
                'question_order' => 3
            ],
            [
                'level' => '2',
                'question_text' => 'Dalam Tantangan Menara Pasir, kamu harus menyusun rencana membangun menara tinggi di tepi pantai. Strategimu adalah...',
                'option_r' => 'Hitung struktur dan tekanan material', // Realistic - practical engineering
                'option_i' => 'Menganalisis jenis pasir terbaik secara ilmiah', // Investigative - scientific analysis
                'option_a' => 'Rancang bentuk indah & unik', // Artistic - aesthetic design
                'option_s' => 'Pastikan semua nyaman & aman saat membangun', // Social - safety, well-being
                'option_e' => 'Atur tim & bahan supaya efisien', // Enterprising - management, efficiency
                'option_c' => 'Membuat daftar bahan yang diperlukan dan langkah-langkah konstruksi yang berurutan', // Conventional - detailed planning, sequence
                'question_order' => 4
            ],
            [
                'level' => '2',
                'question_text' => 'Pasukanmu bingung saat menyerang kastil musuh. Kamu...',
                'option_r' => 'Merancang alat pengepungan baru yang efektif', // Realistic - practical, mechanical solution
                'option_i' => 'Buat skema strategi terperinci', // Investigative - analytical strategy
                'option_a' => 'Ciptakan alat penyamaran visual', // Artistic - creative solution
                'option_s' => 'Cek kondisi emosional pasukan dulu', // Social - empathy, team morale
                'option_e' => 'Tunjuk peran tim sesuai kemampuan', // Enterprising - leadership, delegation
                'option_c' => 'Membuat daftar prioritas target dan laporan kemajuan', // Conventional - systematic, reporting
                'question_order' => 5
            ],
            [
                'level' => '2',
                'question_text' => 'Kamu diajak masuk “Simulasi Bisnis Talenthia”. Kamu diminta buat produk. Ide pertamamu adalah...',
                'option_r' => 'Robot pembersih lingkungan otomatis', // Realistic - practical, technological
                'option_i' => 'Aplikasi analisis data cuaca', // Investigative - data analysis, scientific
                'option_a' => 'Perhiasan dari cahaya bulan', // Artistic - imaginative, aesthetic
                'option_s' => 'Jurnal pribadi berbasis emosi', // Social - personal development, well-being
                'option_e' => 'Platform kursus kerajaan online', // Enterprising - educational business
                'option_c' => 'Sistem pencatat inventaris barang kerajaan', // Conventional - organized data management
                'question_order' => 6
            ],
            [
                'level' => '2',
                'question_text' => 'Kamu ikut lomba menciptakan peta dunia baru. Kamu unggul karena...',
                'option_r' => 'Peta kamu sangat akurat dan berbasis perhitungan geografis', // Realistic - precise, technical accuracy
                'option_i' => 'Peta kamu berisi data demografi dan statistik yang mendalam', // Investigative - data-driven, analytical
                'option_a' => 'Visualisasimu luar biasa indah', // Artistic - aesthetic appeal
                'option_s' => 'Kamu tambahkan lokasi-lokasi aman & tenang', // Social - well-being, community focus
                'option_e' => 'Kamu mempresentasikan peta dengan kuat', // Enterprising - persuasive presentation
                'option_c' => 'Kamu membuat legenda dan indeks yang paling rapi dan mudah dibaca', // Conventional - organized, clear presentation
                'question_order' => 7
            ],
            [
                'level' => '2',
                'question_text' => 'Raja meminta pidato kebangsaan. Kamu jadi tim kreatif. Bagianmu adalah...',
                'option_r' => 'Memastikan sistem suara dan panggung berfungsi sempurna', // Realistic - technical, practical
                'option_i' => 'Buat data & fakta pendukung pidato', // Investigative - research, factual
                'option_a' => 'Desain visual latar belakang & musik', // Artistic - aesthetic, atmospheric
                'option_s' => 'Jaga suasana agar audiens merasa dihargai', // Social - audience comfort, respect
                'option_e' => 'Tulis naskah pidato utama', // Enterprising - influential communication
                'option_c' => 'Buat jadwal dan susunan acara yang detail', // Conventional - organized, sequential
                'question_order' => 8
            ],
            [
                'level' => '2',
                'question_text' => 'Di Balapan Intelektual, kamu harus menolong tim memecahkan masalah. Kamu jadi...',
                'option_r' => 'Pembangun prototipe solusi cepat', // Realistic - practical, hands-on
                'option_i' => 'Ahli logika & rumus', // Investigative - analytical, theoretical
                'option_a' => 'Kreator alat bantu visual', // Artistic - creative, visual aids
                'option_s' => 'Pendengar masalah rekan tim', // Social - supportive, empathetic
                'option_e' => 'Koordinator waktu dan tugas', // Enterprising - management, delegation
                'option_c' => 'Pencatat setiap kemajuan dan kendala', // Conventional - detailed record-keeping
                'question_order' => 9
            ],
            [
                'level' => '2',
                'question_text' => 'Festival Seni Talenthia butuh kamu membuat karya. Kamu memilih...',
                'option_r' => 'Patung bergerak menggunakan mekanisme rumit', // Realistic - mechanical, tangible art
                'option_i' => 'Animasi edukasi fisika', // Investigative - intellectual, scientific art
                'option_a' => 'Lukisan raksasa interaktif', // Artistic - immersive, expressive art
                'option_s' => 'Instalasi tentang emosi dan trauma', // Social - empathetic, psychological art
                'option_e' => 'Pameran bisnis anak muda', // Enterprising - promoting, showcasing
                'option_c' => 'Dokumentasi fotografi festival yang terorganisir rapi', // Conventional - systematic, detailed documentation
                'question_order' => 10
            ],
            [
                'level' => '2',
                'question_text' => 'Dalam misi diplomatik ke negeri lain, kamu ditugaskan...',
                'option_r' => 'Menyiapkan alat komunikasi canggih antarnegara', // Realistic - technical, practical tools
                'option_i' => 'Menyiapkan argumen dan data kuat', // Investigative - factual, logical argumentation
                'option_a' => 'Membuat simbol-simbol budaya', // Artistic - cultural, creative representation
                'option_s' => 'Menangani konflik emosional selama misi', // Social - mediation, empathy
                'option_e' => 'Jadi juru bicara utama', // Enterprising - public speaking, influence
                'option_c' => 'Mengatur semua dokumen dan logistik perjalanan', // Conventional - systematic organization, logistics
                'question_order' => 11
            ],
            [
                'level' => '2',
                'question_text' => 'Di akhir arena, kamu menghadapi “Tes Dirimu”. Kamu disuruh memilih kekuatan utama tim impianmu. Kamu pilih...',
                'option_r' => 'Kemampuan praktis membangun dan memperbaiki', // Realistic - practical skills
                'option_i' => 'Otak jenius dan hitungan cepat', // Investigative - analytical, intellectual
                'option_a' => 'Imajinasi & daya cipta', // Artistic - creativity, innovation
                'option_s' => 'Empati dan penyembuhan', // Social - emotional intelligence, support
                'option_e' => 'Manajemen dan eksekusi', // Enterprising - leadership, implementation
                'option_c' => 'Ketelitian dan kemampuan mengelola data', // Conventional - accuracy, data management
                'question_order' => 12
            ],

            // Level 3: Cermin Dirimu
            [
                'level' => '3',
                'question_text' => 'Di tengah malam, kamu sendiri. Tiba-tiba cermin bertanya: “Hal paling membuatmu puas adalah…”',
                'option_r' => 'Melihat sesuatu yang saya buat berfungsi sempurna', // Realistic - tangible outcome
                'option_i' => 'Temukan pola tersembunyi', // Investigative - discovery, understanding
                'option_a' => 'Ciptakan keindahan yang belum pernah ada', // Artistic - creative expression
                'option_s' => 'Saat orang merasa pulih karena kamu', // Social - helping others, emotional support
                'option_e' => 'Lihat ide kamu jadi nyata', // Enterprising - implementation, impact
                'option_c' => 'Saat semua data dan catatan tersusun rapi', // Conventional - order, accuracy
                'question_order' => 1,
            ],
            [
                'level' => '3',
                'question_text' => 'Di Cermin Waktu, kamu melihat dirimu di masa depan...',
                'option_r' => 'Arsitek yang merancang kota cerdas', // Realistic - practical design, building
                'option_i' => 'Penemu AI kesehatan', // Investigative - scientific, technological innovation
                'option_a' => 'Ilustrator buku anak-anak terkenal', // Artistic - creative, visual arts
                'option_s' => 'Konselor sekolah internasional', // Social - helping, advising
                'option_e' => 'Founder startup pendidikan', // Enterprising - entrepreneurial, leadership
                'option_c' => 'Manajer arsip nasional yang legendaris', // Conventional - organization, data management
                'question_order' => 2,
            ],
            [
                'level' => '3',
                'question_text' => 'Kamu menemukan kunci emas. Tapi hanya bisa dipakai jika kamu tahu nilai hidupmu. Kamu pilih:',
                'option_r' => 'Karya nyata', // Realistic - tangible results
                'option_i' => 'Logika', // Investigative - reasoning, analysis
                'option_a' => 'Imajinasi', // Artistic - creativity, expression
                'option_s' => 'Kepedulian', // Social - empathy, caring
                'option_e' => 'Strategi', // Enterprising - planning, influence
                'option_c' => 'Ketelitian', // Conventional - precision, order
                'question_order' => 3,
            ],
            [
                'level' => '3',
                'question_text' => 'Suara hati dalam cermin berkata: “Ketika kamu terluka, kamu cenderung…”',
                'option_r' => 'Fokus pada aktivitas fisik untuk mengalihkan pikiran', // Realistic - physical coping
                'option_i' => 'Menganalisis kenapa itu terjadi', // Investigative - intellectual analysis
                'option_a' => 'Mengalihkan rasa lewat karya', // Artistic - creative expression
                'option_s' => 'Diam dan mendengarkan hati sendiri', // Social - introspection, emotional processing
                'option_e' => 'Menyusun rencana pemulihan', // Enterprising - proactive, strategic
                'option_c' => 'Mencatat detail perasaan dan kejadiannya', // Conventional - systematic record of experience
                'question_order' => 4,
            ],
            [
                'level' => '3',
                'question_text' => 'Dalam cermin jiwa, kamu melihat masa kecilmu. Hal yang paling kamu sukai saat itu adalah…',
                'option_r' => 'Membongkar dan merakit mainan', // Realistic - hands-on, mechanical
                'option_i' => 'Bermain teka-teki dan eksperimen kecil', // Investigative - intellectual curiosity
                'option_a' => 'Menggambar dan mendongeng', // Artistic - creative storytelling
                'option_s' => 'Membantu teman yang sedih', // Social - helping, empathy
                'option_e' => 'Jualan mainan buatan sendiri', // Enterprising - entrepreneurial, sales
                'option_c' => 'Mengatur koleksi kelereng atau perangko', // Conventional - organizing collections
                'question_order' => 5,
            ],
            [
                'level' => '3',
                'question_text' => 'Kamu diminta memberi nasihat ke dirimu 5 tahun lalu. Kamu akan bilang:',
                'option_r' => '“Terus bangun dan ciptakan hal-hal yang nyata.”', // Realistic - practical creation
                'option_i' => '“Terus cari pola dan jangan berhenti penasaran.”', // Investigative - intellectual curiosity
                'option_a' => '“Dunia butuh sentuhan keunikanmu.”', // Artistic - self-expression
                'option_s' => '“Jaga hatimu, kamu juga pantas bahagia.”', // Social - self-care, empathy
                'option_e' => '“Ambil risiko, dan buat langkahmu sendiri.”', // Enterprising - boldness, initiative
                'option_c' => '“Buat daftar prioritas dan ikuti aturan dengan baik.”', // Conventional - systematic, rule-following
                'question_order' => 6,
            ],
            [
                'level' => '3',
                'question_text' => 'Kamu membuka surat dari masa depan, isinya satu pujian yang kamu inginkan.',
                'option_r' => '“Kamu hebat dalam membuat segala sesuatu berfungsi.”', // Realistic - functional, practical skill
                'option_i' => '“Kamu jenius dan solutif.”', // Investigative - intellectual, problem-solving
                'option_a' => '“Karyamu menginspirasi dunia.”', // Artistic - creative impact
                'option_s' => '“Kamu menyelamatkan banyak jiwa.”', // Social - helping, profound impact
                'option_e' => '“Kamu mengubah sistem pendidikan.”', // Enterprising - large-scale influence
                'option_c' => '“Kamu membuat dunia lebih teratur dan efisien.”', // Conventional - order, efficiency
                'question_order' => 7,
            ],
            [
                'level' => '3',
                'question_text' => 'Di ruang perenungan, kamu ditanya: Jika kamu tidak pernah dinilai siapa pun, kamu akan…',
                'option_r' => 'Membangun sebuah alat atau mesin yang kompleks', // Realistic - hands-on creation
                'option_i' => 'Menulis teori-teori baru', // Investigative - intellectual pursuit
                'option_a' => 'Menciptakan dunia visual dan cerita', // Artistic - imaginative creation
                'option_s' => 'Berkeliling membantu orang secara sukarela', // Social - altruism, helping
                'option_e' => 'Menjalankan proyek ambisius', // Enterprising - big projects, leadership
                'option_c' => 'Membuat sistem klasifikasi untuk semua pengetahuan dunia', // Conventional - organizing information
                'question_order' => 8,
            ],
            [
                'level' => '3',
                'question_text' => 'Kamu bertemu dirimu yang paling “otentik”. Dia bilang:',
                'option_r' => '“Aku hidup untuk membangun dan memperbaiki.”', // Realistic - tangible contribution
                'option_i' => '“Aku hidup untuk menemukan kebenaran.”', // Investigative - intellectual discovery
                'option_a' => '“Aku hidup untuk mencipta dan menginspirasi.”', // Artistic - creative purpose
                'option_s' => '“Aku hidup untuk menyembuhkan.”', // Social - helping, healing
                'option_e' => '“Aku hidup untuk mengubah sistem.”', // Enterprising - leadership, systemic change
                'option_c' => '“Aku hidup untuk membuat segala sesuatu teratur.”', // Conventional - order, structure
                'question_order' => 9,
            ],
            [
                'level' => '3',
                'question_text' => 'Dalam ritual terakhir, kamu menulis satu kata yang ingin dunia ingat darimu:',
                'option_r' => 'Terampil', // Realistic - skilled, competent
                'option_i' => 'Cerdas', // Investigative - intellectual
                'option_a' => 'Unik', // Artistic - original, creative
                'option_s' => 'Tulus', // Social - sincere, caring
                'option_e' => 'Visioner', // Enterprising - forward-thinking, leader
                'option_c' => 'Teratur', // Conventional - organized, systematic
                'question_order' => 10,
            ],
            [
                'level' => '3',
                'question_text' => 'Jiwa kamu dipantulkan ke lima warna cahaya. Kamu tertarik dengan…',
                'option_r' => 'Cokelat solid penuh kekuatan praktis', // Realistic - earthy, practical strength
                'option_i' => 'Biru dingin penuh perhitungan', // Investigative - logical, analytical
                'option_a' => 'Ungu terang penuh imajinasi', // Artistic - creative, imaginative
                'option_s' => 'Hijau lembut penuh ketenangan', // Social - calming, nurturing
                'option_e' => 'Emas bersinar penuh rencana', // Enterprising - bold, ambitious
                'option_c' => 'Abu-abu metalik penuh ketelitian', // Conventional - precise, structured
                'question_order' => 11,
            ],
            [
                'level' => '3',
                'question_text' => 'Saat kamu akhirnya keluar dari Cermin Shavira, kamu membawa satu benda jiwa:',
                'option_r' => 'Alat Multifungsi', // Realistic - practical tool
                'option_i' => 'Kompas logika', // Investigative - guide for reasoning
                'option_a' => 'Kuas ciptaan', // Artistic - instrument of creation
                'option_s' => 'Kristal perasaan', // Social - emotional understanding
                'option_e' => 'Blueprint strategi', // Enterprising - plan, vision
                'option_c' => 'Jurnal catatan harian', // Conventional - organized records
                'question_order' => 12,
            ]
        ];

        foreach ($questions as $question) {
            Question::create($question);
        }
    }
}