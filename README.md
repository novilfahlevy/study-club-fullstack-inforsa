# Pertemuan 2: Layouting Lanjutan & Interaktivitas Visual (CSS3)

## Objektif Pembelajaran
Setelah mengikuti sesi ini, peserta diharapkan mampu mencapai target berikut:

### 1. Implementasi Flexbox (Layouting Modern)
* Memahami konsep **Flex Container** dan **Flex Items**.
* Menggunakan `display: flex` untuk mengatur elemen agar berjejer secara fleksibel.
* Menggunakan `flex-direction: row` dan `flex-direction: column` untuk membuat item sejajar secara horizontal maupun vertikal.
* Mengatur perataan elemen secara horizontal (`justify-content`) dan vertikal (`align-items`) agar konten mading selalu rapi dan presisi di tengah layar.

### 2. Implementasi Position: Relative, Absolute, Sticky
* **Relative & Absolute:** Mempelajari hubungan "Induk dan Anak" untuk meletakkan elemen dekoratif (seperti Badge "Terbaru") tepat di pojok kartu pengumuman.
* **Sticky:** Membuat Header website tetap menempel di bagian atas layar meskipun pengguna melakukan *scrolling* ke bawah, sehingga navigasi tetap mudah diakses.

### 3. Implementasi CSS3 (Animasi & Efek)
* **Transition:** Memberikan efek perubahan yang halus (tidak kaku) saat elemen berubah warna atau bentuk.
* **Transform:** Menambahkan efek interaktif seperti `scale` (memperbesar) atau `translate` (mengangkat) kartu pengumuman saat diarahkan kursor (hover).
* **Box Shadow:** Memberikan efek kedalaman (shadow) agar kartu pengumuman terlihat lebih menonjol dan elegan.

## Struktur File Proyek
- `index.html` (Menambahkan elemen Badge dan kontainer pembungkus)
- `style.css` (Menambahkan logika Flexbox, Position, dan Animasi)

## Ringkasan Kode Baru
Beberapa properti kunci yang akan dipelajari:
* `display: flex;`
* `flex-direction: row|column;`
* `justify-content: center;`
* `align-items: center;`
* `position: absolute;`
* `position: sticky;`
* `transition: all 0.3s ease;`
* `transform: translateY(-5px);`