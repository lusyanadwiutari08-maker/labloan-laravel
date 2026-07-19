# 📘 Materi Belajar Project LabLoans
### Sistem Informasi Peminjaman Alat Laboratorium Berbasis QR Code

> **Untuk siapa dokumen ini?**
> Untuk kamu yang akan mempresentasikan project ini, tapi **belum pernah belajar coding**.
> Dokumen ini akan menjelaskan dari **NOL** — mulai dari "apa itu aplikasi web",
> sampai bisa memahami isi project sendiri. Tidak perlu jadi programmer,
> cukup **paham konsepnya** supaya bisa menjawab saat presentasi.
>
> Baca pelan-pelan dari atas ke bawah. Setiap istilah dijelaskan pakai
> **perumpamaan sehari-hari** supaya gampang dibayangkan. 🙂

---

# 🧩 BAGIAN 1 — Konsep Dasar (Pondasi)

Sebelum membahas project-nya, kita pahami dulu istilah-istilah dasarnya.
Anggap ini seperti belajar "apa itu mesin, roda, dan setir" sebelum belajar menyetir mobil.

---

## 1.1 Apa itu Aplikasi Web?

**Aplikasi web** adalah program yang dijalankan lewat **browser** (Chrome, Firefox, dll),
bukan diinstall seperti aplikasi HP biasa.

Contoh aplikasi web yang sering kamu pakai: **Gmail, YouTube, Instagram versi web,
SIAKAD kampus**.

> 🏪 **Perumpamaan:**
> Aplikasi web itu seperti **restoran**. Kamu (pengunjung/browser) datang,
> memesan sesuatu, lalu dapur menyiapkan dan menyajikannya. Kamu tidak perlu
> tahu cara memasaknya — kamu cukup pesan dan terima hasilnya.

Dalam aplikasi web ada **2 sisi:**

| Sisi | Istilah | Penjelasan | Perumpamaan |
|---|---|---|---|
| Yang dilihat pengguna | **Frontend** | Tampilan: tombol, warna, teks, form | Ruang makan & menu restoran |
| Yang bekerja di belakang | **Backend** | Logika: cek password, simpan data | Dapur & gudang restoran |

Project LabLoans ini punya **keduanya** — tampilan yang dilihat mahasiswa,
dan "dapur" yang memproses peminjaman.

---

## 1.2 Apa itu PHP?

**PHP** adalah **bahasa pemrograman** — yaitu bahasa yang dimengerti oleh komputer server
untuk menjalankan logika aplikasi.

> 🗣️ **Perumpamaan:**
> Sama seperti manusia berkomunikasi pakai Bahasa Indonesia atau Inggris,
> komputer butuh "bahasa" untuk diberi perintah. PHP adalah salah satu bahasa itu,
> dan sangat populer untuk membuat aplikasi web.

Project ini ditulis menggunakan bahasa **PHP**.

---

## 1.3 Apa itu Framework? Apa itu Laravel?

Bayangkan kamu mau membangun rumah. Ada 2 cara:

1. **Dari nol total** — bikin sendiri batu bata, kusen, genteng, semua dari awal. Lama & susah.
2. **Pakai bahan jadi** — sudah ada rangka, pintu, jendela siap pasang. Tinggal rakit. Cepat & rapi.

**Framework** adalah cara ke-2. Dia menyediakan **kerangka & alat-alat siap pakai**
supaya pembuatan aplikasi jadi lebih cepat, rapi, dan aman.

**Laravel** adalah **framework untuk bahasa PHP** yang paling populer di dunia.

> 🏗️ **Perumpamaan:**
> Laravel itu seperti **kit rumah prefabrikasi**. Dindingnya, atapnya, instalasi
> listriknya sudah disiapkan dengan standar yang baik. Pembuat aplikasi tinggal
> menyusun sesuai kebutuhan, tidak perlu mikir hal-hal rumit dari nol.

**Kenapa pakai Laravel?**
- Lebih cepat dibuat
- Sudah ada sistem keamanan bawaan (anti hack)
- Kode jadi rapi & mudah dirawat
- Banyak komunitas & dokumentasi

📌 **Kalimat untuk presentasi:**
*"Project ini dibangun menggunakan framework Laravel berbasis bahasa PHP, karena Laravel
menyediakan struktur yang rapi dan fitur keamanan bawaan sehingga pengembangan lebih efisien."*

---

## 1.4 Apa itu MVC? (INI YANG PALING PENTING ⭐)

**MVC** adalah cara mengatur kode supaya rapi dan tidak campur aduk.
MVC singkatan dari **Model – View – Controller**. Ini adalah **konsep inti Laravel**,
dan kemungkinan besar **akan ditanya saat presentasi**.

Mari pahami pakai perumpamaan **restoran** 🍽️:

```
        PELANGGAN (kamu/browser)
              │
              │  1. "Saya mau pesan nasi goreng"
              ▼
        ┌─────────────┐
        │ CONTROLLER  │  ← PELAYAN
        │ (Pelayan)   │     Menerima pesanan, mengatur semuanya
        └─────────────┘
           │        │
   2. ambil bahan   │  4. antar hasil
      ke gudang     │     ke pelanggan
           ▼        ▼
   ┌──────────┐   ┌──────────┐
   │  MODEL   │   │   VIEW   │
   │ (Gudang) │   │ (Piring) │
   └──────────┘   └──────────┘
   Tempat data    Tampilan yang
   disimpan       disajikan ke
                  pelanggan
```

| Komponen | Tugasnya | Perumpamaan | Di project ini |
|---|---|---|---|
| **Model** | Mengurus **data** (ambil/simpan ke database) | **Gudang bahan** restoran | Folder `app/Models/` |
| **View** | Mengurus **tampilan** yang dilihat pengguna | **Piring saji** yang cantik | Folder `resources/views/` |
| **Controller** | **Mengatur alur** — menerima permintaan, ambil data, pilih tampilan | **Pelayan** restoran | Folder `app/Http/Controllers/` |

**Cerita lengkapnya:**
1. Pelanggan (pengguna) memesan → "Saya mau lihat daftar alat lab"
2. **Controller** (pelayan) menerima permintaan itu
3. Controller minta data ke **Model** (gudang) → "Ambilkan semua data alat"
4. Model mengambil data dari database, lalu memberikannya ke Controller
5. Controller menyerahkan data ke **View** (piring) untuk ditampilkan dengan cantik
6. Pengguna melihat hasilnya di layar

> 💡 **Kenapa harus dipisah begini?**
> Bayangkan kalau pelayan, gudang, dan dapur jadi satu orang yang sama —
> pasti kacau! Dengan dipisah, kalau ada masalah di tampilan, kita cukup
> perbaiki bagian View tanpa mengganggu data. Kode jadi **rapi dan mudah diperbaiki.**

📌 **Kalimat untuk presentasi:**
*"Aplikasi ini menggunakan pola arsitektur MVC — Model untuk mengelola data,
View untuk menampilkan antarmuka, dan Controller untuk mengatur logika dan
menghubungkan keduanya. Pemisahan ini membuat kode lebih terstruktur dan mudah dikembangkan."*

---

## 1.5 Apa itu Database?

**Database** adalah tempat **menyimpan semua data** aplikasi secara permanen.

> 🗄️ **Perumpamaan:**
> Database itu seperti **lemari arsip raksasa** atau **file Excel yang sangat besar**.
> Di dalamnya ada banyak **tabel** (seperti sheet di Excel), dan tiap tabel
> punya **baris** (data) dan **kolom** (jenis informasi).

Contoh tabel `users` (pengguna):

| id | nama | username | role |
|----|------|----------|------|
| 1 | Budi Admin | adminlab | admin |
| 2 | Siti Mahasiswa | mahasiswa01 | user |

Project ini menggunakan database bernama **MySQL** (atau MariaDB, kembarannya).

---

## 1.6 Istilah Penting Lainnya

Beberapa istilah lagi yang sering muncul. Tidak perlu hafal, cukup paham gambarannya.

### 🛣️ Route (Rute / Alamat)
Daftar **alamat URL** aplikasi dan ke mana harus diarahkan.

> 🛎️ **Perumpamaan:** Seperti **resepsionis hotel**. Saat kamu bilang "saya mau ke kamar 201",
> resepsionis mengarahkanmu ke tempat yang benar. Saat browser membuka `/login`,
> route mengarahkannya ke bagian yang mengurus login.

Semua route ada di file `routes/web.php`.

### 🎨 Blade
**Alat bawaan Laravel untuk membuat halaman (View)**. File-nya berakhiran `.blade.php`.
Blade memungkinkan menampilkan data dinamis, contoh: menampilkan nama user yang sedang login.

> 📄 **Perumpamaan:** Seperti **template sertifikat**. Desainnya sudah jadi,
> tinggal nama-nya saja yang berubah-ubah sesuai orangnya.

### 💅 Tailwind CSS
**Alat untuk mempercantik tampilan** (warna, jarak, ukuran, dll) dengan cepat.

> 👕 **Perumpamaan:** Seperti **lemari penuh aksesoris siap pakai**. Daripada menjahit
> dari kain, tinggal ambil aksesoris yang sudah jadi dan pasang.

### 🏗️ Migration (Migrasi)
**Cetak biru / blueprint** untuk membuat tabel di database. Berisi instruksi
"buat tabel `items` dengan kolom nama, kode, status, dst".

> 📐 **Perumpamaan:** Seperti **gambar arsitek** sebelum membangun gedung.
> Menentukan ada berapa ruangan dan ukurannya.

### 🌱 Seeder
**Pengisi data awal** ke database. Misalnya membuat akun admin pertama secara otomatis.

> 🌾 **Perumpamaan:** Seperti **menabur benih awal** di kebun yang masih kosong.

### 🧱 Middleware
**Penjaga / satpam** yang mengecek sesuatu sebelum mengizinkan akses.

> 💂 **Perumpamaan:** Seperti **satpam di pintu masuk**. Sebelum masuk ruangan admin,
> satpam mengecek: "Apakah kamu benar-benar admin?" Kalau bukan, ditolak.

### 📷 QR Code
**Kode kotak-kotak** yang bisa dipindai kamera. Saat dipindai, dia berisi sebuah
**alamat website** yang langsung membuka halaman peminjaman alat tersebut.

> 🎫 **Perumpamaan:** Seperti **tiket dengan barcode**. Saat di-scan, langsung tahu
> "ini tiket untuk acara apa". Di sini, saat QR di-scan, langsung tahu "ini alat yang mana".

---

# 🔬 BAGIAN 2 — Mengenal Project LabLoans

Sekarang setelah paham konsep dasar, kita masuk ke project-nya.

---

## 2.1 Apa itu LabLoans?

**LabLoans** adalah aplikasi web untuk **meminjam alat laboratorium dengan praktis
menggunakan QR Code**.

**Masalah yang diselesaikan:**
- Peminjaman alat lab biasanya pakai **buku/formulir kertas** → ribet, mudah hilang, susah direkap
- Dengan LabLoans: cukup **scan QR Code** di alat → konfirmasi → selesai. Semua tercatat otomatis.

📌 **Kalimat untuk presentasi:**
*"LabLoans adalah sistem informasi peminjaman alat laboratorium berbasis QR Code yang
menggantikan proses manual berbasis kertas, sehingga peminjaman menjadi lebih cepat,
tercatat secara digital, dan mudah dipantau."*

---

## 2.2 Siapa Penggunanya?

Ada **2 jenis pengguna** (role):

| Peran | Siapa | Bisa apa saja? |
|---|---|---|
| 👨‍🔬 **Admin** | Petugas / laboran | Kelola alat, lihat semua laporan, kelola pengguna, lihat log aktivitas |
| 🎓 **Mahasiswa** (user) | Peminjam | Scan QR & pinjam alat, lihat riwayat pinjaman sendiri |

Sistem otomatis membedakan: kalau yang login admin, dia melihat menu admin.
Kalau mahasiswa, dia melihat menu mahasiswa. (Inilah tugas si **Middleware/satpam** tadi.)

---

## 2.3 Teknologi yang Dipakai (untuk slide presentasi)

| Komponen | Teknologi | Fungsinya |
|---|---|---|
| Bahasa pemrograman | **PHP 8** | Bahasa utama di server |
| Framework | **Laravel 11** | Kerangka kerja aplikasi |
| Pola arsitektur | **MVC** | Mengatur struktur kode |
| Database | **MySQL / MariaDB** | Menyimpan semua data |
| Tampilan | **Blade + Tailwind CSS** | Membuat & mempercantik halaman |
| Pemindai QR | **html5-qrcode** | Mengakses kamera untuk scan |
| Pembuat QR | **Simple QrCode** | Membuat gambar QR tiap alat |
| Tabel interaktif | **DataTables** | Fitur cari, urutkan, export |
| Akses HTTPS demo | **ngrok** | Agar kamera HP bisa dipakai |

---

## 2.4 Struktur Folder Project

Sekarang setelah paham MVC, struktur folder akan jauh lebih masuk akal.
Folder-folder penting ditandai. Yang tidak ditandai boleh diabaikan dulu.

```
labloan-laravel/                  ← Folder utama project
│
├── 📁 app/                       ← ⭐ "OTAK" aplikasi
│   ├── 📁 Http/
│   │   ├── 📁 Controllers/       ← ⭐ CONTROLLER (pelayan) — mengatur alur
│   │   └── 📁 Middleware/        ← Satpam (cek login & role admin/user)
│   ├── 📁 Models/                ← ⭐ MODEL (gudang) — mewakili data
│   └── 📁 Console/Commands/      ← Perintah khusus (cth: buat ulang QR)
│
├── 📁 database/
│   ├── 📁 migrations/            ← Cetak biru tabel database
│   └── 📁 seeders/               ← Pengisi data awal (akun admin & mahasiswa)
│
├── 📁 resources/
│   ├── 📁 views/                 ← ⭐ VIEW (tampilan) — halaman yang dilihat
│   │   ├── 📁 auth/              ← Halaman login & daftar
│   │   ├── 📁 dashboard/         ← Semua halaman setelah login
│   │   ├── 📁 layouts/           ← Template dasar halaman
│   │   └── 📁 partials/          ← Komponen kecil (sidebar, header)
│   └── 📁 css/                   ← File warna/gaya tampilan
│
├── 📁 routes/
│   └── web.php                   ← ⭐ Daftar semua alamat URL (resepsionis)
│
├── 📁 public/                    ← File yang diakses langsung browser
│   └── 📁 storage/               ← Gambar QR Code tersimpan di sini
│
├── 📁 storage/                   ← File internal (log, cache)
│
├── .env                          ← Pengaturan rahasia (database, URL, dll)
├── PANDUAN-NGROK.md              ← Cara menjalankan dengan ngrok
└── PANDUAN-PROJECT.md            ← File ini
```

> 🧠 **Cara mengingat yang mudah:**
> - Mau lihat **logika/alur**? → buka `app/Http/Controllers/`
> - Mau lihat **tampilan halaman**? → buka `resources/views/`
> - Mau lihat **struktur data**? → buka `app/Models/`
> - Mau lihat **daftar halaman**? → buka `routes/web.php`

---

## 2.5 Fitur-Fitur & Letaknya

Berikut semua fitur aplikasi. Tiap fitur dijelaskan: **fungsinya**, **file tampilannya (View)**,
dan **file logikanya (Controller)**.

### 1️⃣ Login & Daftar Akun 🔐
**Fungsi:** Pintu masuk. Mahasiswa bisa daftar sendiri; admin sudah disiapkan.

| Bagian | File |
|---|---|
| Tampilan login (View) | `resources/views/auth/login.blade.php` |
| Tampilan daftar (View) | `resources/views/auth/register.blade.php` |
| Logika (Controller) | `app/Http/Controllers/AuthController.php` |

🔒 **Keamanan:** Maksimal 5x salah login per menit (mencegah peretasan tebak-tebakan password).

---

### 2️⃣ Dashboard / Beranda 🏠
**Fungsi:** Halaman pertama setelah login. Tampil berbeda untuk admin & mahasiswa.

| Bagian | File |
|---|---|
| Tampilan (View) | `resources/views/index.blade.php` |
| Logika (Controller) | `app/Http/Controllers/DashboardController.php` |

**Admin melihat:** grafik peminjaman 7 hari terakhir, total alat, total pengguna, peminjaman aktif.
**Mahasiswa melihat:** jumlah alat yang sedang dipinjam, riwayat singkat.

---

### 3️⃣ Manajemen Inventaris Alat (Admin) 📦
**Fungsi:** Admin menambah/mengubah/menghapus alat. Tiap alat **otomatis dapat QR Code**.

| Bagian | File |
|---|---|
| Daftar alat (View) | `resources/views/dashboard/inventaris_admin/index.blade.php` |
| Form tambah (View) | `resources/views/dashboard/inventaris_admin/create.blade.php` |
| Form edit (View) | `resources/views/dashboard/inventaris_admin/edit.blade.php` |
| Logika (Controller) | `app/Http/Controllers/ItemController.php` |

**Alur tambah alat:** Admin isi data → sistem otomatis buat QR Code → QR bisa diunduh & dicetak untuk ditempel di alat.

**Status alat:** `available` (tersedia), `borrowed` (dipinjam), `maintenance` (diperbaiki).

---

### 4️⃣ Scan QR & Pinjam Alat 📱 (FITUR UTAMA)
**Fungsi:** Meminjam alat dengan memindai QR pakai kamera HP.

| Bagian | File |
|---|---|
| Halaman kamera scan (View) | `resources/views/dashboard/laporan_user/scanner.blade.php` |
| Form konfirmasi pinjam (View) | `resources/views/dashboard/peminjaman_user/index.blade.php` |
| Halaman berhasil (View) | `resources/views/dashboard/peminjaman_user/success.blade.php` |
| Halaman gagal (View) | `resources/views/dashboard/peminjaman_user/error.blade.php` |
| Logika (Controller) | `app/Http/Controllers/LoanController.php` |

**Ada 3 cara meminjam:**
```
Cara 1 — Scan QR tanpa login dulu:
   Scan QR → diminta login → setelah login otomatis diproses → berhasil/gagal
   (Demi keamanan, sesi otomatis keluar setelah pinjam — aman untuk HP bersama)

Cara 2 — Scan QR setelah login:
   Sudah login → buka menu scan → arahkan kamera → otomatis diproses

Cara 3 — Pinjam manual dari katalog:
   Login → menu "Pinjam Alat" → pilih dari daftar → konfirmasi
```

---

### 5️⃣ Katalog Alat (Mahasiswa) 📋
**Fungsi:** Mahasiswa melihat daftar alat tersedia & pinjam tanpa scan.

| Bagian | File |
|---|---|
| Tampilan katalog (View) | `resources/views/dashboard/peminjaman_user/borrow_list.blade.php` |
| Logika (Controller) | `app/Http/Controllers/LoanController.php` |

---

### 6️⃣ Laporan Peminjaman (Admin) 📊
**Fungsi:** Admin melihat semua riwayat peminjaman, filter, & export data.

| Bagian | File |
|---|---|
| Tampilan laporan (View) | `resources/views/dashboard/laporan_admin/index.blade.php` |
| Logika (Controller) | `app/Http/Controllers/AdminReportController.php` |

**Fitur:** filter status (Dipinjam/Dikembalikan), tombol "Tandai Dikembalikan", export ke CSV/Excel/cetak.

---

### 7️⃣ Riwayat Peminjaman (Mahasiswa) 📝
**Fungsi:** Mahasiswa melihat riwayat pinjaman miliknya sendiri.

| Bagian | File |
|---|---|
| Tampilan (View) | `resources/views/dashboard/laporan_user/index.blade.php` |
| Logika (Controller) | `app/Http/Controllers/UserHistoryController.php` |

---

### 8️⃣ Manajemen Pengguna (Admin) 👥
**Fungsi:** Admin mengelola akun pengguna (lihat/tambah/edit/hapus).

| Bagian | File |
|---|---|
| Daftar pengguna (View) | `resources/views/dashboard/users/index.blade.php` |
| Form tambah/edit (View) | `resources/views/dashboard/users/create.blade.php` & `edit.blade.php` |
| Logika (Controller) | `app/Http/Controllers/UserController.php` |

---

### 9️⃣ Log Aktivitas (Admin) 📜
**Fungsi:** Mencatat semua kegiatan penting (siapa login, siapa pinjam, dll) — seperti CCTV digital.

| Bagian | File |
|---|---|
| Tampilan log (View) | `resources/views/dashboard/activity_logs/index.blade.php` |
| Logika (Controller) | `app/Http/Controllers/ActivityLogController.php` |
| Data (Model) | `app/Models/ActivityLog.php` |

**Yang dicatat:** login, logout, daftar, tambah/edit/hapus alat, pinjam & kembalikan alat.

---

## 2.6 Database: Tabel-Tabel yang Ada

| Tabel | Isi | Diibaratkan |
|---|---|---|
| `users` | Data akun (nama, username, role) | Daftar anggota |
| `items` | Data alat lab (nama, kode, status, lokasi QR) | Daftar barang gudang |
| `loans` | Data peminjaman (siapa pinjam apa, kapan) | Buku catatan pinjam |
| `activity_logs` | Catatan semua aktivitas | Buku CCTV/jurnal |

**Hubungan antar tabel** (penting & sering ditanya):
```
Satu USER  bisa punya banyak  LOANS  (satu mahasiswa bisa pinjam banyak kali)
Satu ITEM  bisa ada di banyak LOANS  (satu alat bisa dipinjam berkali-kali)

Jadi tabel LOANS menghubungkan: siapa (user) meminjam apa (item)
```

> 🔗 **Perumpamaan:** Tabel `loans` itu seperti **buku tamu peminjaman**.
> Tiap baris mencatat: "Mahasiswa A meminjam Mikroskop B pada tanggal C".

---

# 🎬 BAGIAN 3 — Perjalanan Satu Permintaan (Biar MVC Makin Paham)

Ini bagian yang membuat semua konsep tadi "klik". Mari kita ikuti **apa yang terjadi
di balik layar** saat seseorang menggunakan aplikasi.

## Contoh: Mahasiswa membuka halaman "Riwayat Peminjaman Saya"

```
1. 🧑 Mahasiswa klik menu "Riwayat" → browser membuka alamat /my-loans

2. 🛎️ ROUTE (routes/web.php) menerima alamat /my-loans
       → "Oh, ini harus ditangani oleh UserHistoryController"

3. 💂 MIDDLEWARE (satpam) cek dulu: "Apakah orang ini sudah login?"
       → Sudah ✓ → boleh lanjut

4. 🧑‍🍳 CONTROLLER (UserHistoryController) bekerja:
       → "Tolong ambilkan data pinjaman milik mahasiswa ini"

5. 🗄️ MODEL (Loan) mengambil data dari DATABASE
       → Mengembalikan daftar pinjaman milik mahasiswa tsb

6. 🍽️ CONTROLLER menyerahkan data itu ke VIEW
       → View: laporan_user/index.blade.php

7. 🎨 VIEW menyusun tampilan cantik (tabel berisi riwayat) + Tailwind

8. 📱 Hasilnya dikirim balik ke browser → mahasiswa melihat tabel riwayatnya
```

📌 **Kalimat untuk presentasi (powerful!):**
*"Ketika pengguna membuka sebuah halaman, permintaan diterima oleh Route, lalu diteruskan
ke Controller. Controller mengambil data melalui Model dari database, kemudian
menyerahkannya ke View untuk ditampilkan. Inilah penerapan pola MVC dalam aplikasi ini."*

---

## Contoh 2: Scan QR Code untuk meminjam alat 📷

```
1. 🧑 Mahasiswa scan QR di alat pakai kamera HP
2. 📷 QR berisi alamat, contoh: https://.../scan/LAB-AB12CD
3. 🛎️ Route mengarahkan ke LoanController bagian "scan"
4. 🧑‍🍳 Controller cek ke Model: "Alat LAB-AB12CD ada? Statusnya tersedia?"
5a. ✅ Kalau tersedia → tampilkan form konfirmasi → simpan ke tabel loans → halaman BERHASIL
5b. ❌ Kalau sedang dipinjam/rusak → tampilkan halaman GAGAL dengan pesan jelas
6. 📝 Aktivitas ini juga dicatat ke activity_logs (CCTV digital)
```

---

# 🔑 BAGIAN 4 — Hal Praktis

## 4.1 Akun untuk Demo

| Peran | Username | Password |
|---|---|---|
| Admin | `adminlab` | `password123` |
| Mahasiswa | `mahasiswa01` | `password123` |

## 4.2 Pengaturan Penting (file `.env`)

File `.env` berisi pengaturan rahasia. **Jangan disebarkan ke publik!**

```
APP_URL=https://...     ← alamat aplikasi (alamat ngrok saat demo)
DB_DATABASE=db_loan     ← nama database
DB_USERNAME=root        ← username database
DB_PASSWORD=            ← password database (kosong di Laragon)
```

## 4.3 Cara Menjalankan untuk Demo

Lihat panduan lengkap & ramah-pemula di **[PANDUAN-NGROK.md](PANDUAN-NGROK.md)**.

Ringkasan: nyalakan Laragon → `php artisan serve` → jalankan `ngrok` → buka di HP. Selesai.

---

# 🎤 BAGIAN 5 — Tips & Persiapan Presentasi

Bagian ini khusus membantumu **tampil percaya diri** saat presentasi.

## 5.1 Alur Cerita Presentasi yang Disarankan

```
1. Latar belakang masalah  → "Peminjaman alat lab masih manual pakai kertas, ribet & rawan hilang"
2. Solusi                  → "Maka dibuat LabLoans, sistem digital berbasis QR Code"
3. Teknologi               → "Dibangun dengan Laravel (PHP) menggunakan pola MVC"
4. Demo langsung           → tunjukkan: login → scan QR → pinjam → lihat laporan
5. Penutup                 → manfaat & kemungkinan pengembangan ke depan
```

## 5.2 Kemungkinan Pertanyaan Dosen & Jawabannya

> **❓ "Apa itu Laravel?"**
> 💬 *"Laravel adalah framework PHP, yaitu kerangka kerja siap pakai yang mempercepat
> dan merapikan pembuatan aplikasi web, sekaligus menyediakan fitur keamanan bawaan."*

> **❓ "Apa itu MVC dan kenapa dipakai?"**
> 💬 *"MVC adalah pola pemisahan kode menjadi tiga bagian: Model untuk data, View untuk
> tampilan, dan Controller untuk logika. Tujuannya agar kode terstruktur, rapi, dan
> mudah dikembangkan karena tiap bagian punya tugas yang jelas."*

> **❓ "Bagaimana cara kerja QR Code di aplikasi ini?"**
> 💬 *"Setiap alat memiliki QR Code unik yang berisi alamat menuju halaman peminjaman alat
> tersebut. Saat mahasiswa memindai QR, sistem langsung mengenali alat itu dan menampilkan
> form peminjaman, lalu mencatatnya ke database."*

> **❓ "Bagaimana sistem membedakan admin dan mahasiswa?"**
> 💬 *"Setiap akun punya 'role'. Saat login, sistem mengecek role melalui Middleware —
> jika admin diberi akses menu pengelolaan, jika mahasiswa hanya menu peminjaman."*

> **❓ "Datanya disimpan di mana?"**
> 💬 *"Semua data disimpan dalam database MySQL, terbagi dalam beberapa tabel seperti
> users, items, dan loans yang saling berelasi."*

> **❓ "Kenapa butuh HTTPS / ngrok?"**
> 💬 *"Browser hanya mengizinkan akses kamera jika situs menggunakan HTTPS (koneksi aman).
> Karena fitur utama aplikasi ini adalah scan QR lewat kamera, kami menggunakan ngrok
> untuk menyediakan akses HTTPS saat demo."*

> **❓ "Apa kelebihan sistem ini dibanding cara manual?"**
> 💬 *"Lebih cepat, data tercatat otomatis dan tidak mudah hilang, mudah dipantau melalui
> laporan, serta ada log aktivitas untuk transparansi."*

> **❓ "Apa rencana pengembangan ke depan?"**
> 💬 *"Bisa ditambahkan notifikasi pengingat pengembalian, fitur lupa password, denda
> keterlambatan, serta deploy ke hosting permanen agar bisa diakses kapan saja."*

## 5.3 Istilah Kunci yang Wajib Dihafal

Cukup hafalkan **6 kata kunci** ini beserta arti singkatnya:

| Istilah | Arti Singkat (1 kalimat) |
|---|---|
| **Laravel** | Framework PHP siap pakai untuk bikin aplikasi web |
| **Framework** | Kerangka kerja siap pakai agar pembuatan lebih cepat & rapi |
| **MVC** | Pemisahan kode jadi Model (data), View (tampilan), Controller (logika) |
| **Database** | Tempat menyimpan semua data, terdiri dari tabel-tabel |
| **Route** | Daftar alamat URL & ke mana harus diarahkan |
| **QR Code** | Kode pindai berisi alamat ke halaman peminjaman alat |

## 5.4 Saran Sebelum Hari-H

- ✅ **Coba sendiri** semua fitur minimal 3x sampai lancar (login, scan, pinjam, laporan)
- ✅ **Siapkan HP** yang sudah dites kameranya untuk demo scan QR
- ✅ **Cetak beberapa QR Code** alat untuk diperagakan langsung
- ✅ **Hafalkan alur cerita** (Bagian 5.1), bukan menghafal kode
- ✅ **Siapkan jawaban** dari Bagian 5.2 — baca berulang sampai paham, jangan dihafal kaku
- ✅ **Tenang** — kamu tidak perlu jadi programmer, cukup paham konsep & alurnya 😊

---

*Semoga sukses presentasinya! 🎓*
*LabLoans — Sistem Informasi Peminjaman Alat Laboratorium © 2026*
