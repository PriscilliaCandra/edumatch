# EduMatch

**EduMatch** adalah platform web interaktif yang membantu pengguna mengidentifikasi tipe kepribadian mereka berdasarkan model RIASEC (Realistic, Investigative, Artistic, Social, Enterprising, Conventional). Aplikasi ini dilengkapi dengan chatbot AI personal yang memberikan rekomendasi jurusan perkuliahan dan karier sesuai profil minat dan bakat pengguna.

---

## Fitur Utama

- **Autentikasi Pengguna**
  - Registrasi dan login aman menggunakan JSON Web Tokens (JWT).
  
- **Tes Minat & Bakat RIASEC Berjenjang**
  - Terdiri dari **3 level**, masing-masing 12 pertanyaan.
  - Navigasi antar pertanyaan dalam level yang sama.
  - Halaman intro informatif: *"Dunia Minat"*, *"Dunia Bakat"*, *"Cerminkan Dirimu"*.
  - Visual progress bar untuk melacak kemajuan.

- **Personalisasi Hasil Tes**
  - Menghitung skor untuk setiap dimensi RIASEC.
  - Menentukan tipe kepribadian dominan.
  - Menampilkan rekomendasi jurusan dan karier berdasarkan hasil tes.

- **Chatbot AI Personal**
  - Chatbot cerdas berbasis **LLM zephyr:7b-beta** via **Ollama**.
  - Menjawab pertanyaan seputar kuliah & karier berdasarkan profil RIASEC.
  - Menyimpan riwayat percakapan untuk referensi pengguna.

- **🖥UI Responsif**
  - Desain modern, ramah pengguna, dan mendukung perangkat seluler.
  - Transisi halaman yang mulus dan interaktif.

---

## Teknologi yang Digunakan

### Backend
- PHP 8.1.10
- Laravel (versi terbaru)
- JWT Auth (via `tymon/jwt-auth`)
- MySQL
- cURL (komunikasi dengan Ollama)

### Frontend
- HTML5
- CSS3 + Bootstrap 5.3
- JavaScript (Vanilla JS, Fetch API)

### AI / LLM
- Ollama (Menjalankan LLM secara lokal)
- Model: `zephyr:7b-beta`

### Manajemen Proyek
- Composer (PHP)
- NPM + Laravel Mix (Frontend asset compilation)

---

## 🖥Persyaratan Sistem

- PHP >= 8.1
- Composer
- Node.js & NPM
- MySQL
- Ollama (dengan model `zephyr:7b-beta`)
- Browser modern (Chrome/Firefox/Edge)

---

## Instalasi Lokal

### 1. Clone Repositori
```bash
git clone https://github.com/PriscilliaCandra/edumatch
cd nama-folder-proyek```

### 2. Instalasi Dependensi PHP (Backend)
```bash
composer install```

### 3. Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate```

### 4. Setup JWT
```bash
php artisan jwt:secret```

### 5. Migrasi dan Seeder Database
```bash
php artisan migrate
php artisan db:seed --class=QuestionSeeder```

### 6. Jalankan Ollama & Model LLM
```bash
ollama pull zephyr:7b-beta
ollama serve```

### 7. Jalankan aplikasi
```bash
php artisan serve```
