# news_app_kelompok5_mongoDB

1. Judul Tugas
   Pembuatan Aplikasi Web Berita dengan Fitur Pencarian dan Manajemen Berita
   Menggunakan PHP dan MongoDB
2. Latar Belakang
   Dalam era digital saat ini, akses informasi yang cepat dan akurat menjadi sangat penting.
   Aplikasi web berita memungkinkan pengguna untuk mendapatkan informasi terbaru dan
   memudahkan admin dalam mengelola konten berita. Melalui tugas ini, mahasiswa
   diharapkan dapat mengembangkan aplikasi berita fungsional dengan berbagai fitur yang
   berguna bagi pengguna umum dan admin.
3. Tujuan
   • Mengimplementasikan pemrograman web menggunakan PHP.
   • Menggunakan MongoDB sebagai basis data NoSQL untuk penyimpanan berita.
   • Menerapkan fungsi pencarian dan manajemen berita (CRUD) dengan cara yang
   terstruktur.
   • Mendorong kreativitas dan inovasi dalam desain antarmuka pengguna.
4. Spesifikasi Aplikasi
   Aplikasi web berita yang akan dibuat harus memiliki fitur sebagai berikut:
   4.1. Fitur untuk Pengguna Umum (anonymous tanpa login)
5. Pencarian Berita
   o Pengguna dapat mencari berita berdasarkan judul atau kata kunci tertentu.
   o Hasil pencarian ditampilkan secara dinamis dan mencakup judul, ringkasan,
   dan tautan ke berita lengkap.
6. Baca Berita
   o Menampilkan daftar berita dengan informasi seperti judul, ringkasan, dan
   tanggal publikasi.
   o Pengguna dapat mengeklik judul untuk membuka halaman detail berita yang
   berisi konten lengkap.
   4.2. Fitur untuk Pengguna Admin
7. Input Berita
   o Formulir untuk admin untuk menambah berita baru, mencakup judul, konten,
   ringkasan, kategori, dan penulis.
   o Berita yang ditambahkan akan disimpan ke dalam database MongoDB.
8. Hapus Berita
   o Fitur untuk menghapus berita dari daftar. Admin harus mengonfirmasi
   tindakan sebelum berita dihapus secara permanen dari database.
9. Edit Berita
   o Halaman yang memungkinkan admin untuk mengedit berita yang sudah ada,
   dengan pre-filled data pada formulir.
   o Admin dapat menyimpan perubahan yang dilakukan ke dalam database.
10. Ketegorisasi Berita
    o Admin dapat menentukan kategori untuk setiap berita (misalnya, olahraga,
    teknologi, politik, dsb).
    o Fitur untuk menampilkan berita berdasarkan kategori tertentu.
11. Teknologi yang Digunakan
    • Bahasa Pemrograman: PHP
    • Database: MongoDB
    • Frontend: HTML, CSS, atau JavaScript (Bootstrap atau framework lainnya
    diperbolehkan)
    • Server: Apache, XAMPP, Nginx, atau lainnya
12. Struktur Database
    • Koleksi: news
    o Field:
    ▪ \_id: Identifikasi unik berita (auto-generated oleh MongoDB)
    ▪ title: Judul berita (String)
    ▪ content: Konten berita (String)
    ▪ summary: Ringkasan berita (String)
    ▪ author: Penulis berita (String)
    ▪ category: Kategori berita (String)
    ▪ created_at: Tanggal dan waktu berita dibuat (Timestamp)
    ▪ updated_at: Tanggal dan waktu berita diperbarui (Timestamp)
13. Ketentuan Kelompok
    • Tugas ini harus dikerjakan dalam kelompok maksimal 5 orang.
    • Setiap kelompok diharapkan untuk membagi tugas secara merata, mencakup
    pengembangan backend, frontend, dan pengujian.
    • Desain antarmuka web harus unik dan mencerminkan kreativitas masing-masing
    kelompok.
14. Penilaian
    • Penilaian akan didasarkan pada:
    o Kesesuaian aplikasi dengan spesifikasi yang ditetapkan (40%).
    o Kejelasan pembagian tugas tiap anggota kelompok (30%).
    o Desain antarmuka pengguna yang responsif dan menarik (20%).
    o Dokumentasi yang jelas dan komprehensif (10%).
15. Batas Waktu
    • Tugas ini harus diselesaikan dan diserahkan dalam waktu 1 minggu setelah
    penugasan.
16. Penyerahan
    • Kode sumber lengkap aplikasi.
    • Panduan instalasi dan penggunaan aplikasi.
    • Dokumentasi proyek yang menjelaskan fungsi, arsitektur, dan cara kerja aplikasi.
