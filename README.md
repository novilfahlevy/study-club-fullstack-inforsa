# Pertemuan 2: Layouting Lanjutan & Interaktivitas Visual (CSS3)

## Deskripsi Kegiatan
Pada pertemuan kedua ini, kita akan meningkatkan kualitas **Mading Digital Kampus** yang telah kita buat sebelumnya. Jika pada pertemuan pertama kita hanya fokus pada struktur dasar, kali ini kita akan belajar bagaimana mengatur tata letak elemen secara profesional menggunakan **Flexbox**, mengontrol posisi elemen yang kompleks dengan **Position**, serta memberikan sentuhan interaksi modern menggunakan fitur **CSS3**.

Tujuannya adalah agar mading digital kita tidak hanya informatif, tetapi juga memiliki pengalaman pengguna (User Experience) yang halus dan menarik.

---

## Objektif Pembelajaran
Setelah mengikuti sesi ini, peserta diharapkan mampu mencapai target berikut:

### 1. Implementasi Flexbox (Layouting Modern)
* Memahami konsep **Flex Container** dan **Flex Items**.
* Menggunakan `display: flex` untuk mengatur elemen agar berjejer secara fleksibel.
* Mengatur perataan elemen secara horizontal (`justify-content`) dan vertikal (`align-items`) agar konten mading selalu rapi dan presisi di tengah layar.

### 2. Implementasi Position: Relative, Absolute, Sticky
* **Relative & Absolute:** Mempelajari hubungan "Induk dan Anak" untuk meletakkan elemen dekoratif (seperti Badge "Terbaru") tepat di pojok kartu pengumuman.
* **Sticky:** Membuat Header website tetap menempel di bagian atas layar meskipun pengguna melakukan *scrolling* ke bawah, sehingga navigasi tetap mudah diakses.

### 3. Implementasi CSS3 (Animasi & Efek)
* **Transition:** Memberikan efek perubahan yang halus (tidak kaku) saat elemen berubah warna atau bentuk.
* **Transform:** Menambahkan efek interaktif seperti `scale` (memperbesar) atau `translate` (mengangkat) kartu pengumuman saat diarahkan kursor (hover).
* **Box Shadow:** Memberikan efek kedalaman (shadow) agar kartu pengumuman terlihat lebih menonjol dan elegan.

---

## Struktur File Proyek
Peserta akan melanjutkan file dari pertemuan sebelumnya dengan struktur:
- `index.html` (Menambahkan elemen Badge dan kontainer pembungkus)
- `style.css` (Menambahkan logika Flexbox, Position, dan Animasi)

---

## Ringkasan Kode Baru
Beberapa properti kunci yang akan dipelajari:
* `display: flex;`
* `position: absolute;` (untuk Badge)
* `position: sticky;` (untuk Header)
* `transition: all 0.3s ease;`
* `transform: translateY(-5px);`

> **Catatan:** Kemampuan menguasai tata letak (layouting) adalah kunci utama bagi seorang Frontend Developer sebelum kita masuk ke tahap interaktivitas JavaScript di pertemuan mendatang.