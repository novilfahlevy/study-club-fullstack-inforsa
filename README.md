# Pertemuan 3: Interaktivitas Dinamis dengan JavaScript

## Objektif Pembelajaran

### 1. Manipulasi DOM
* Memahami konsep Document Object Model (DOM) dan cara mengakses elemen HTML menggunakan JavaScript.
* Menggunakan metode seperti `getElementById`, `querySelector`, dan `querySelectorAll` untuk memilih elemen.
* Mengubah konten dan atribut elemen secara dinamis menggunakan JavaScript.

### 2. Event Handling
* Menambahkan interaktivitas dengan mendengarkan event seperti `click`, `input`, dan `submit`.
* Menggunakan fungsi callback untuk menangani event.
* Mempelajari konsep event bubbling dan event delegation.

### 3. Penyimpanan Data di Browser
* Memahami cara kerja `localStorage` dan `sessionStorage`.
* Menyimpan dan mengambil data dari `localStorage` untuk membuat fitur seperti daftar pengumuman tersimpan.
* Menghapus data dari penyimpanan browser.

## Struktur File Proyek
```
index.html                    — Halaman utama, daftar pengumuman
pengumuman-tersimpan.html     — Halaman untuk melihat pengumuman yang disimpan
assets/
    css/
        style.css             — Gaya halaman utama
    js/
        main.js               — Logika interaktivitas utama
        storage.js            — Fitur penyimpanan data di browser
```

## Ringkasan Kode Baru
Beberapa konsep kunci yang dipelajari:
* `document.getElementById` dan `document.querySelector`
* Event listener (`addEventListener`)
* `localStorage.setItem` dan `localStorage.getItem`
* Manipulasi elemen DOM (`innerHTML`, `classList`)
