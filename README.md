# Pertemuan 4: Backend Dinamis dengan PHP & MySQL

## Objektif Pembelajaran

### 1. Koneksi Database MySQL dengan PHP (MySQLi)
* Membuat koneksi ke database `mading_ft_unmul` menggunakan `mysqli`.
* Memisahkan konfigurasi koneksi ke file `database/koneksi.php` agar dapat di-*require* dari seluruh halaman.

### 2. Pengambilan Data Dinamis dari Database
* Mengambil seluruh daftar pengumuman dengan `getPengumuman()` menggunakan query `SELECT * FROM pengumuman ORDER BY tanggal DESC`.
* Memfilter pengumuman berdasarkan kategori (`akademik`, `organisasi`, `event`) menggunakan `getPengumumanByKategori()` dengan *prepared statement* untuk mencegah SQL Injection.
* Mengambil detail satu pengumuman berdasarkan `slug` menggunakan `getPengumumanBySlug()` dengan *prepared statement*.

### 3. Routing & Halaman Detail Pengumuman
* Halaman `index.php` menerima parameter `?kategori=` dari URL (`$_GET`) untuk menampilkan pengumuman yang sudah difilter.
* Halaman `pengumuman.php` menerima parameter `?slug=` untuk menampilkan detail satu pengumuman; redirect ke `index.php` jika slug tidak ditemukan.

### 4. Sistem Admin (Autentikasi Sesi)
* Halaman login (`admin/login.php`) memvalidasi username dan password menggunakan `$_POST` dan fungsi `login()`.
* Autentikasi berbasis **PHP Session** (`$_SESSION`) di `admin/auth.php`: menyimpan status login dan melindungi halaman admin.
* Halaman `admin/index.php` dilindungi oleh pengecekan `apakahUserSudahLogin()`; jika belum login, pengguna di-redirect ke halaman login.
* Fungsi `logout()` menghapus session dan me-redirect ke halaman login.

### 5. Fitur Interaktif dengan JavaScript & localStorage
* **Pencarian Real-time** (`pencarian.js`): memfilter kartu pengumuman yang tampil di DOM berdasarkan input teks pengguna tanpa reload halaman.
* **Simpan Pengumuman** (`simpan-pengumuman.js`): menyimpan data pengumuman ke `localStorage` dan mencegah duplikasi. Halaman `pengumuman-tersimpan.php` membaca data dari `localStorage` dan merendernya secara dinamis.
* **Dark Mode** (`darkmode.js`): toggle tema gelap/terang dengan persistensi menggunakan `localStorage`.

## Struktur File Proyek
```
index.php                    — Halaman utama, daftar pengumuman + filter kategori
pengumuman.php               — Halaman detail pengumuman (by slug)
pengumuman-tersimpan.php     — Halaman arsip pengumuman tersimpan (localStorage)
layouts/
    header.php               — Template header, yang dapat digunakan berulang kali
    footer.php               — Template footer, yang dapat digunakan berulang kali
database/
    koneksi.php              — Konfigurasi & koneksi MySQLi
    main.php                 — Fungsi query untuk halaman publik
    admin.php                — Fungsi query untuk halaman admin
admin/
    auth.php                 — Logika autentikasi & manajemen sesi
    login.php                — Form login admin
    logout.php               — Proses logout
    index.php                — Dashboard admin (tabel pengumuman)
    layouts/
        header.php           — Template header, yang dapat digunakan berulang kali
        footer.php           — Template footer, yang dapat digunakan berulang kali
assets/
    css/
        style.css            — Gaya halaman publik
        darkmode.css         — Gaya tema dark mode
        admin.css            — Gaya halaman admin
    js/
        darkmode.js          — Toggle & persistensi dark mode
        pencarian.js         — Pencarian real-time di sisi klien
        simpan-pengumuman.js — Simpan & arsip pengumuman via localStorage
```

## Konsep Kunci yang Dipelajari
* `mysqli` — koneksi dan query ke database MySQL
* *Prepared Statement* (`prepare`, `bind_param`, `execute`) — mencegah SQL Injection
* `$_GET`, `$_POST` — mengambil data dari URL dan form
* `$_SESSION` — manajemen sesi untuk autentikasi
* `header('Location: ...')` — redirect antar halaman PHP
* `htmlspecialchars()` — mencegah XSS saat menampilkan data ke HTML
