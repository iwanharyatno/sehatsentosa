# 🏥 SehatSentosa - Sistem Pendaftaran & Booking Dokter

Ini adalah proyek sederhana Sistem Informasi Booking Dokter berbasis web yang dibangun menggunakan **HTML**, **CSS**, **JavaScript**, **PHP Native**, **MySQL**, dan **Bootstrap**.  
Proyek ini cocok digunakan untuk pembelajaran pemrograman web tingkat pemula hingga menengah.

## 📁 Cabang (Branch)

- **`main`**  
  Branch ini berisi starter template. Cocok untuk peserta bootcamp atau kamu yang ingin memulai dari nol dan mengikuti proses live coding.

- **`finished`**  
  Branch ini berisi seluruh kode proyek yang sudah jadi dan siap digunakan atau dijadikan referensi belajar.

## 📚 Fitur Utama

### 👤 Pasien
- Registrasi & Login
- Melakukan booking
- Melihat histori booking
- Membatalkan booking

### 🩺 Dokter
- Login
- Melihat daftar booking dari pasien
- Mengonfirmasi atau membatalkan booking

## 💻 Teknologi yang Digunakan

- **Frontend**
  - HTML, CSS (native untuk landing & auth)
  - Bootstrap (untuk dashboard)
  - JavaScript

- **Backend**
  - PHP Native
  - MySQL

- **Tools**
  - XAMPP / Laragon (local server)
  - VS Code / Text editor lainnya

## 🚀 Cara Menjalankan Proyek

1. Clone repositori ini:
   ```bash
   git clone https://github.com/iwanharyatno/sehatsentosa.git
   cd sehatsentosa
   ```

2. Checkout ke branch yang diinginkan:
   - Untuk mulai dari awal:
     ```bash
     git checkout main
     ```
   - Untuk melihat versi final:
     ```bash
     git checkout finished
     ```

3. Pindahkan folder ini ke dalam direktori `htdocs` (jika menggunakan XAMPP)

4. Buat database MySQL baru denggan nama `db_sehatsentosa`, dan import file `db_sehatsentosa.sql`

5. Jalankan server lokal, lalu akses melalui browser:
   ```
   http://localhost/sehatsentosa/
   ```