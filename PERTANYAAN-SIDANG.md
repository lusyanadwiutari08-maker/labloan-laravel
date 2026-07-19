# 🎓 Bank Pertanyaan Sidang / Presentasi
### Project LabLoans — untuk Mahasiswa D3 Teknik Informatika

> **Cara pakai dokumen ini:**
> Setiap pertanyaan sudah dilengkapi **jawaban yang bisa langsung kamu pelajari**.
> Jangan dihafal kaku — **pahami maksudnya**, lalu jawab pakai bahasamu sendiri.
> Baca berulang sampai kamu nyaman.
>
> **Keterangan tanda prioritas:**
> - 🔥 = **Sangat sering ditanya** — wajib kuasai!
> - ⭐ = Kemungkinan ditanya — sebaiknya siap
> - 🔹 = Jarang / pertanyaan lanjutan — bonus kalau bisa

---

## 📑 Daftar Isi
- [A. Latar Belakang & Tujuan](#a-latar-belakang--tujuan)
- [B. Teknologi & Konsep Dasar](#b-teknologi--konsep-dasar)
- [C. Database](#c-database)
- [D. Cara Kerja Sistem (Alur Program)](#d-cara-kerja-sistem-alur-program)
- [E. Fitur-Fitur Aplikasi](#e-fitur-fitur-aplikasi)
- [F. Keamanan](#f-keamanan)
- [G. Pertanyaan Teknis / Coding](#g-pertanyaan-teknis--coding)
- [H. Pengujian (Testing)](#h-pengujian-testing)
- [I. Kelemahan & Pengembangan](#i-kelemahan--pengembangan)
- [J. Pertanyaan Kritis / "Jebakan"](#j-pertanyaan-kritis--jebakan)
- [K. Permintaan Demo Langsung](#k-permintaan-demo-langsung)

---

## A. Latar Belakang & Tujuan

**🔥 1. Coba jelaskan latar belakang / masalah dari project ini.**
> Peminjaman alat di laboratorium selama ini masih dilakukan secara manual menggunakan
> buku atau formulir kertas. Cara ini punya beberapa kelemahan: pencatatan mudah hilang
> atau rusak, sulit merekap data, dan proses peminjaman jadi lambat. Maka saya membuat
> LabLoans, sistem peminjaman alat lab berbasis QR Code yang mencatat semuanya secara digital.

**🔥 2. Apa tujuan dan manfaat dari aplikasi ini?**
> Tujuannya mempermudah dan mempercepat proses peminjaman alat lab. Manfaatnya: data
> tercatat otomatis dan tidak mudah hilang, peminjaman lebih cepat lewat scan QR,
> admin mudah memantau lewat laporan, dan ada log aktivitas untuk transparansi.

**⭐ 3. Siapa target pengguna aplikasi ini?**
> Ada dua: **admin** (petugas atau laboran) yang mengelola alat dan memantau peminjaman,
> serta **mahasiswa** yang meminjam alat.

**⭐ 4. Apa yang membedakan sistem ini dengan cara manual?**
> Cara manual pakai kertas, rawan hilang, dan lambat direkap. Sistem ini digital,
> otomatis tercatat ke database, bisa difilter dan diekspor, serta mencatat siapa
> meminjam apa dan kapan secara akurat.

**🔹 5. Kenapa memilih QR Code, bukan cara lain seperti barcode atau input manual?**
> QR Code bisa menyimpan informasi lebih banyak dari barcode biasa, mudah dibuat dan
> dicetak, serta bisa dipindai langsung pakai kamera HP tanpa alat khusus. Ini membuat
> proses peminjaman sangat praktis.

---

## B. Teknologi & Konsep Dasar

**🔥 6. Aplikasi ini dibuat pakai apa saja? (bahasa & teknologi)**
> Dibuat dengan bahasa **PHP** menggunakan framework **Laravel 11**, dengan pola
> arsitektur **MVC**. Database-nya **MySQL**. Tampilan memakai **Blade** dan
> **Tailwind CSS**. Untuk scan QR memakai library **html5-qrcode**, dan untuk
> membuat QR memakai **Simple QrCode**.

**🔥 7. Apa itu Laravel?**
> Laravel adalah **framework PHP**, yaitu kerangka kerja siap pakai untuk membangun
> aplikasi web. Laravel menyediakan struktur kode yang rapi dan fitur-fitur bawaan
> seperti keamanan, routing, dan koneksi database, sehingga pengembangan lebih cepat.

**🔥 8. Apa itu framework? Kenapa pakai framework, tidak PHP murni saja?**
> Framework adalah kerangka kerja siap pakai. Kalau pakai PHP murni, semua harus dibuat
> dari nol dan rawan tidak rapi. Dengan framework seperti Laravel, banyak hal sudah
> disediakan (keamanan, struktur, koneksi database), jadi lebih cepat, rapi, dan aman.

**🔥 9. Apa itu MVC? Jelaskan!** *(paling sering ditanya!)*
> MVC adalah pola pemisahan kode menjadi tiga bagian:
> - **Model** → mengurus data dan berhubungan dengan database
> - **View** → mengurus tampilan yang dilihat pengguna
> - **Controller** → mengatur logika dan menghubungkan Model dengan View
>
> Tujuannya supaya kode terstruktur dan mudah dikembangkan, karena setiap bagian
> punya tugas yang jelas dan terpisah.

**⭐ 10. Coba beri contoh penerapan MVC di project-mu.**
> Misalnya saat menampilkan daftar alat: **Controller** (`ItemController`) menerima
> permintaan, lalu meminta data ke **Model** (`Item`) yang mengambilnya dari database,
> kemudian data itu ditampilkan oleh **View** (`inventaris_admin/index.blade.php`).

**⭐ 11. Apa itu Blade?**
> Blade adalah template engine bawaan Laravel untuk membuat halaman (View). Dengan Blade
> kita bisa menampilkan data dinamis di HTML, misalnya menampilkan nama pengguna yang
> sedang login. File-nya berakhiran `.blade.php`.

**⭐ 12. Apa itu Tailwind CSS?**
> Tailwind adalah framework CSS untuk mempercantik tampilan dengan cepat, menggunakan
> kelas-kelas siap pakai untuk mengatur warna, ukuran, dan tata letak.

**🔹 13. Apa itu library? Sebutkan library yang kamu pakai.**
> Library adalah kumpulan kode siap pakai untuk fungsi tertentu. Di project ini saya
> pakai **html5-qrcode** untuk memindai QR lewat kamera, dan **Simple QrCode** untuk
> menghasilkan gambar QR setiap alat.

**🔹 14. Apa itu Composer?**
> Composer adalah alat untuk mengelola library/paket di project PHP. Lewat Composer kita
> bisa memasang Laravel dan library lain beserta semua kebutuhannya secara otomatis.

---

## C. Database

**🔥 15. Database-mu pakai apa? Ada berapa tabel?**
> Pakai **MySQL**. Tabel utamanya ada empat: `users` (pengguna), `items` (alat lab),
> `loans` (data peminjaman), dan `activity_logs` (catatan aktivitas).

**🔥 16. Coba jelaskan relasi antar tabelnya. (ERD)**
> - Satu **user** bisa memiliki banyak **loans** (satu mahasiswa bisa meminjam berkali-kali).
> - Satu **item** bisa muncul di banyak **loans** (satu alat bisa dipinjam berkali-kali).
> - Jadi tabel **loans** menjadi penghubung: ia menyimpan `user_id` (siapa yang meminjam)
>   dan `item_id` (alat yang dipinjam).
>
> Relasi ini disebut **one-to-many** (satu ke banyak).

**⭐ 17. Apa itu primary key dan foreign key?**
> - **Primary key** adalah penanda unik tiap baris data, contohnya kolom `id`. Tidak boleh
>   ada dua data dengan id yang sama.
> - **Foreign key** adalah kolom yang menghubungkan ke tabel lain. Contohnya `user_id`
>   di tabel `loans` menunjuk ke `id` di tabel `users`.

**⭐ 18. Apa itu migration di Laravel?**
> Migration adalah file berisi "cetak biru" struktur tabel database. Dengan migration,
> tabel bisa dibuat otomatis lewat perintah, jadi tidak perlu membuat tabel manual,
> dan strukturnya bisa dilacak versinya.

**⭐ 19. Apa itu seeder?**
> Seeder adalah file untuk mengisi data awal ke database secara otomatis. Di project ini,
> seeder dipakai untuk membuat akun admin dan mahasiswa default saat aplikasi pertama disiapkan.

**🔹 20. Apa itu Eloquent / ORM?**
> Eloquent adalah ORM (Object Relational Mapping) bawaan Laravel. Fungsinya memudahkan
> kita mengakses database tanpa menulis query SQL panjang — cukup memakai Model.
> Contohnya `Item::all()` untuk mengambil semua data alat.

**🔹 21. Kalau alat dihapus, data peminjamannya bagaimana?**
> Saat alat dihapus, gambar QR-nya juga ikut dihapus dari penyimpanan. Untuk data
> peminjaman lama, idealnya tetap tersimpan sebagai riwayat. *(Sebutkan apa adanya
> sesuai yang terjadi di aplikasimu saat didemokan.)*

---

## D. Cara Kerja Sistem (Alur Program)

**🔥 22. Coba jelaskan alur program / cara kerja aplikasinya secara umum.**
> Saat pengguna membuka sebuah halaman, permintaannya diterima oleh **Route** yang
> menentukan **Controller** mana yang menangani. Controller lalu mengambil data lewat
> **Model** dari database, kemudian menyerahkannya ke **View** untuk ditampilkan.
> Inilah penerapan pola MVC.

**🔥 23. Coba jelaskan alur peminjaman alat dari awal sampai akhir.**
> 1. Mahasiswa memindai QR Code pada alat menggunakan kamera.
> 2. QR berisi alamat yang mengarah ke halaman peminjaman alat tersebut.
> 3. Sistem mengecek apakah alat tersedia.
> 4. Jika tersedia, ditampilkan form konfirmasi, lalu data peminjaman disimpan ke database.
> 5. Jika tidak tersedia (sedang dipinjam/diperbaiki), ditampilkan halaman gagal dengan pesan.
> 6. Aktivitas peminjaman juga dicatat ke log aktivitas.

**⭐ 24. Apa itu Route / routing?**
> Routing adalah pengaturan alamat URL aplikasi. Route menentukan, ketika pengguna
> membuka alamat tertentu, fungsi atau Controller mana yang harus menanganinya.
> Semua route ada di file `routes/web.php`.

**⭐ 25. Bagaimana sistem tahu seseorang itu admin atau mahasiswa?**
> Setiap akun memiliki **role** (admin atau user). Saat mengakses halaman tertentu,
> ada **Middleware** yang mengecek role pengguna. Jika admin, ia bisa membuka menu
> pengelolaan; jika mahasiswa, hanya menu peminjaman.

**🔹 26. Apa itu Middleware?**
> Middleware adalah lapisan pengecekan yang berjalan sebelum permintaan diproses.
> Ibarat satpam, ia mengecek dulu — misalnya apakah pengguna sudah login dan apakah
> ia berhak mengakses halaman tersebut — sebelum mengizinkan masuk.

**🔹 27. Apa itu session?**
> Session adalah cara aplikasi mengingat pengguna yang sedang login, sehingga pengguna
> tidak perlu login ulang setiap berpindah halaman.

---

## E. Fitur-Fitur Aplikasi

**🔥 28. Sebutkan fitur-fitur utama aplikasimu.**
> Login & registrasi, dashboard, manajemen alat (inventaris) dengan QR otomatis,
> scan QR untuk meminjam, katalog peminjaman, laporan peminjaman untuk admin,
> riwayat peminjaman untuk mahasiswa, manajemen pengguna, dan log aktivitas.

**🔥 29. Apa itu CRUD? Di mana diterapkan?**
> CRUD adalah singkatan **Create, Read, Update, Delete** — yaitu operasi dasar
> mengelola data: tambah, lihat, ubah, hapus. Di project ini diterapkan pada
> manajemen alat (admin bisa menambah, melihat, mengubah, dan menghapus alat) dan
> manajemen pengguna.

**⭐ 30. Bagaimana QR Code dibuat dan disimpan?**
> Saat admin menambah alat baru, sistem otomatis membuat QR Code menggunakan library
> Simple QrCode. QR berisi alamat menuju halaman peminjaman alat tersebut. Gambar QR
> disimpan sebagai file di penyimpanan, dan bisa diunduh untuk dicetak lalu ditempel di alat.

**⭐ 31. Apa fungsi log aktivitas?**
> Log aktivitas mencatat semua kegiatan penting seperti login, peminjaman, dan
> perubahan data alat. Fungsinya untuk transparansi dan memudahkan admin memantau
> siapa melakukan apa dan kapan.

**🔹 32. Apa itu DataTables yang kamu pakai di tabel?**
> DataTables adalah library untuk membuat tabel menjadi interaktif — bisa mencari,
> mengurutkan, mengatur jumlah baris, dan mengekspor data ke Excel/CSV atau mencetak.

**🔹 33. Bisa dijelaskan tiga cara meminjam di aplikasimu?**
> Pertama, scan QR sebelum login lalu diminta login. Kedua, scan QR setelah login.
> Ketiga, pinjam manual dengan memilih alat dari katalog tanpa scan.

---

## F. Keamanan

**🔥 34. Bagaimana keamanan login di aplikasimu? Password disimpan bagaimana?**
> Password tidak disimpan apa adanya, melainkan di-**hash** (diacak) menggunakan
> enkripsi bawaan Laravel (bcrypt), sehingga tidak bisa dibaca walau database bocor.
> Selain itu ada pembatasan percobaan login — maksimal 5 kali gagal per menit untuk
> mencegah peretasan dengan tebak-tebakan password.

**⭐ 35. Apa itu hashing? Bedanya dengan enkripsi biasa?**
> Hashing adalah proses mengubah password menjadi kode acak yang **tidak bisa
> dikembalikan** ke bentuk asli. Saat login, password yang dimasukkan di-hash lagi
> lalu dibandingkan. Berbeda dengan enkripsi biasa yang masih bisa dibuka kembali.

**⭐ 36. Apakah aplikasimu aman dari serangan? Serangan apa yang diantisipasi?**
> Laravel sudah punya perlindungan bawaan terhadap serangan umum seperti CSRF
> (lewat token di setiap form), SQL Injection (lewat Eloquent ORM), dan XSS
> (lewat Blade yang otomatis menyaring output). Ditambah pembatasan percobaan login.

**🔹 37. Apa itu CSRF token?**
> CSRF token adalah kode unik yang disisipkan di setiap form untuk memastikan bahwa
> permintaan benar-benar berasal dari aplikasi kita, bukan dari pihak lain yang mencoba
> menipu. Laravel menyediakan ini secara otomatis.

**🔹 38. Kenapa pakai HTTPS saat demo?**
> Karena browser hanya mengizinkan akses kamera jika situs memakai HTTPS (koneksi aman).
> Karena fitur utamanya scan QR lewat kamera, saya pakai ngrok untuk menyediakan HTTPS saat demo.

---

## G. Pertanyaan Teknis / Coding

**🔥 39. Apa beda method GET dan POST?** *(klasik untuk TI!)*
> - **GET** dipakai untuk **mengambil/menampilkan** data, datanya terlihat di URL.
>   Contoh: membuka halaman daftar alat.
> - **POST** dipakai untuk **mengirim/menyimpan** data, datanya tidak terlihat di URL
>   dan lebih aman. Contoh: mengirim form login atau menambah alat.

**⭐ 40. Apa itu validasi? Beri contoh di aplikasimu.**
> Validasi adalah pengecekan data yang diinput sebelum diproses, agar data yang masuk
> benar dan lengkap. Contohnya saat menambah alat, nama wajib diisi; saat registrasi,
> username tidak boleh sama dengan yang sudah ada dan password minimal 6 karakter.

**⭐ 41. Apa itu API? Apakah aplikasimu pakai API?**
> API adalah jembatan komunikasi antar sistem. Aplikasi ini berbasis web biasa (Blade),
> jadi tidak membuat API khusus. Namun konsep routing-nya mirip — tiap alamat menangani
> permintaan tertentu. *(Jawab sesuai kondisi; jangan mengklaim ada API jika tidak ada.)*

**🔹 42. Apa bedanya frontend dan backend? Mana yang kamu kerjakan?**
> Frontend adalah bagian tampilan yang dilihat pengguna; backend adalah bagian logika
> dan data di server. Di project ini saya mengerjakan keduanya — tampilan dengan Blade
> & Tailwind, dan logika dengan Laravel.

**🔹 43. Apa itu artisan di Laravel?**
> Artisan adalah alat baris perintah (command line) bawaan Laravel untuk menjalankan
> tugas seperti membuat file, menjalankan migration, atau menyalakan server.
> Contoh: `php artisan migrate`.

**🔹 44. Coba tunjukkan dan jelaskan satu potongan kode buatanmu.**
> *(Siapkan satu Controller sederhana, misalnya `ItemController` bagian `index()`.
> Jelaskan: "Fungsi ini mengambil semua data alat lewat Model `Item`, lalu mengirimnya
> ke View untuk ditampilkan." Latih menjelaskan 1-2 fungsi saja dengan lancar.)*

---

## H. Pengujian (Testing)

**⭐ 45. Bagaimana cara kamu menguji aplikasi ini?**
> Saya menguji dengan metode **black box testing**, yaitu mencoba setiap fitur dari sisi
> pengguna dan memastikan hasilnya sesuai harapan — misalnya mencoba login dengan data
> benar dan salah, mencoba scan QR alat yang tersedia dan yang sedang dipinjam, lalu
> memeriksa apakah responsnya sudah benar.

**🔹 46. Apa itu black box testing?**
> Black box testing adalah pengujian yang berfokus pada fungsi aplikasi tanpa melihat
> kode di dalamnya. Penguji hanya memberi input dan memeriksa apakah output-nya sesuai.

**🔹 47. Apakah ada skenario pengujian yang gagal? Bagaimana penanganannya?**
> *(Jawab jujur. Contoh aman: "Awalnya saat scan QR di HP kameranya tidak menyala karena
> butuh HTTPS, lalu saya atasi dengan menjalankan aplikasi melalui HTTPS memakai ngrok.")*

---

## I. Kelemahan & Pengembangan

**🔥 48. Apa kekurangan atau batasan dari aplikasi ini?**
> Saat ini aplikasi masih untuk lingkup demo dan dijalankan secara lokal/tunnel.
> Beberapa fitur belum ada seperti notifikasi pengingat pengembalian, fitur lupa
> password, dan sistem denda keterlambatan. *(Jujur menyebut batasan justru menunjukkan
> kamu paham project-mu.)*

**🔥 49. Apa rencana pengembangan ke depan (saran pengembangan)?**
> Bisa ditambahkan: notifikasi/pengingat pengembalian otomatis, fitur lupa password,
> perhitungan denda keterlambatan, laporan dalam bentuk PDF, serta hosting permanen
> agar bisa diakses kapan saja tanpa harus dijalankan dari komputer.

**⭐ 50. Kenapa belum di-hosting permanen?**
> Karena tujuan utamanya untuk demo tugas akhir, saya memakai ngrok yang sudah cukup
> menyediakan akses HTTPS agar fitur kamera berfungsi. Untuk penggunaan nyata,
> langkah berikutnya adalah deploy ke hosting atau server permanen.

---

## J. Pertanyaan Kritis / "Jebakan"

**⭐ 51. Apakah aplikasi ini benar-benar buatanmu sendiri?**
> *(Tetap tenang dan jujur.)* Ya, saya yang merancang dan menyusunnya. Saya memanfaatkan
> framework Laravel dan beberapa library standar untuk mempercepat pengembangan, lalu
> menyesuaikan logika dan tampilannya dengan kebutuhan sistem peminjaman alat lab ini.

**⭐ 52. Bagian mana yang paling sulit saat membuat project ini?**
> *(Pilih satu yang kamu paham dan ceritakan jujur. Contoh:)* Bagian scan QR lewat kamera,
> karena kamera browser butuh HTTPS. Saya pelajari penyebabnya lalu mengatasinya dengan
> menjalankan aplikasi via HTTPS memakai ngrok.

**🔹 53. Kenapa memilih Laravel, bukan framework lain seperti CodeIgniter?**
> Karena Laravel lebih modern, dokumentasinya lengkap, fitur keamanannya kuat, dan
> strukturnya rapi dengan pola MVC, sehingga cocok dan memudahkan saya mengembangkan aplikasi.

**🔹 54. Kalau ada 100 pengguna mengakses bersamaan, apakah kuat?**
> Untuk skala demo dan lab kecil, aplikasi ini cukup. Untuk skala besar, perlu di-deploy
> ke server yang memadai dan dilakukan optimasi serta uji beban lebih lanjut.

**🔹 55. Apa yang terjadi kalau dua orang meminjam alat yang sama bersamaan?**
> Sistem mengecek status alat sebelum peminjaman. Setelah satu peminjaman berhasil,
> status alat berubah menjadi "dipinjam", sehingga orang kedua akan mendapat halaman
> gagal karena alat sudah tidak tersedia.

---

## K. Permintaan Demo Langsung

Penguji hampir pasti minta **demo**. Latih sampai lancar tanpa gugup:

**🔥 56. "Coba tunjukkan cara login sebagai admin."**
> → Buka halaman login → masukkan `adminlab` / `password123` → tunjukkan dashboard admin.

**🔥 57. "Coba demokan cara meminjam alat dengan QR."**
> → Buka menu Scan → arahkan kamera ke QR alat (siapkan QR yang sudah dicetak) →
> tunjukkan form muncul → konfirmasi → tampil halaman berhasil.

**🔥 58. "Tunjukkan cara menambah alat baru."**
> → Login admin → menu Inventaris → Tambah Alat → isi data → simpan →
> tunjukkan QR otomatis muncul dan bisa diunduh.

**⭐ 59. "Tunjukkan laporan peminjaman dan cara export-nya."**
> → Menu Laporan → tunjukkan tabel → pakai filter status → klik tombol export Excel/CSV.

**⭐ 60. "Tunjukkan bedanya tampilan admin dan mahasiswa."**
> → Login sebagai admin (tunjukkan menunya) → logout → login `mahasiswa01` →
> tunjukkan menu yang berbeda (lebih sedikit).

---

## ✅ Checklist Persiapan Sebelum Sidang

- [ ] Sudah mencoba **semua fitur minimal 3x** sampai lancar
- [ ] **HP sudah dites** kameranya untuk demo scan QR
- [ ] Sudah **mencetak beberapa QR Code** alat untuk diperagakan
- [ ] **ngrok & server sudah dites** jalan (lihat [PANDUAN-NGROK.md](PANDUAN-NGROK.md))
- [ ] Hafal **6 istilah kunci**: Laravel, Framework, MVC, Database, Route, QR Code
- [ ] Bisa menjelaskan **alur MVC** dan **alur peminjaman** dengan lancar
- [ ] Sudah membaca jawaban pertanyaan 🔥 berulang kali
- [ ] Menyiapkan **1 potongan kode** yang siap dijelaskan (untuk pertanyaan no. 44)
- [ ] Tahu **kelemahan & rencana pengembangan** project (jujur itu nilai plus)

---

## 💡 Tips Terakhir

1. **Tenang & percaya diri.** Kamu paling tahu project-mu sendiri.
2. **Jangan berbohong.** Kalau tidak tahu, jawab jujur: *"Untuk bagian itu saya belum
   sempat mendalami, tapi rencananya bisa dikembangkan dengan ..."* — lebih baik daripada
   mengarang dan ketahuan.
3. **Jawab singkat & jelas**, jangan bertele-tele. Kalau penguji mau lebih dalam,
   ia akan bertanya lagi.
4. **Kuasai yang bertanda 🔥 dulu** — itu yang paling sering muncul.
5. **Demo adalah kekuatanmu.** Aplikasi yang berjalan lancar lebih meyakinkan daripada
   sekadar teori.

---

*Semoga lancar dan sukses sidangnya! 🎓✨*
*LabLoans — Sistem Informasi Peminjaman Alat Laboratorium © 2026*
