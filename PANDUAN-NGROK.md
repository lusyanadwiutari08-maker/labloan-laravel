# 📱 Panduan Menjalankan LabLoans dengan ngrok (untuk Demo)

Panduan ini membuat aplikasi **LabLoans** bisa dibuka dari **HP lewat internet** dengan
alamat **HTTPS**, supaya **fitur kamera (scan QR) berfungsi**.

> ❓ **Kenapa harus ngrok?**
> Kamera di browser HP **hanya mau menyala kalau alamatnya HTTPS** (ada gembok 🔒).
> Aplikasi di komputer biasanya `http://localhost` (tanpa gembok), jadi kamera ditolak.
> **ngrok** memberi alamat HTTPS gratis yang menyambung ke komputer kamu.

---

## 🗺️ Gambaran Singkat

```
   HP (browser)  ─────►  Internet  ─────►  ngrok  ─────►  Komputer kamu (Laragon)
   buka link https              alamat HTTPS gratis        aplikasi LabLoans
```

Ada **2 bagian**:
- **BAGIAN A — Sekali saja** (daftar ngrok, pasang, ambil alamat tetap). Cukup dilakukan 1x.
- **BAGIAN B — Tiap mau demo** (3 langkah cepat menyalakan aplikasi).

---

# 🅰️ BAGIAN A — Persiapan (Cukup Sekali Saja)

### Langkah 1 — Daftar akun ngrok (gratis)

1. Buka **https://ngrok.com** → klik **Sign up**.
2. Daftar pakai email / akun Google (gratis, tidak perlu kartu kredit).

### Langkah 2 — Pasang ngrok di komputer (Windows)

Cara paling mudah lewat **PowerShell**:

1. Buka menu Start → ketik **PowerShell** → buka.
2. Salin–tempel perintah ini lalu tekan Enter:

   ```powershell
   winget install ngrok.ngrok
   ```

   > Kalau `winget` tidak ada, unduh manual di **https://ngrok.com/download**,
   > lalu ekstrak `ngrok.exe` ke sebuah folder (misal `C:\ngrok`).

3. Tes apakah berhasil — ketik:

   ```powershell
   ngrok version
   ```

   Kalau muncul tulisan versi (contoh `ngrok version 3.x.x`), berarti sudah terpasang. ✅

### Langkah 3 — Sambungkan akun (authtoken)

1. Buka halaman ini (harus sudah login): **https://dashboard.ngrok.com/get-started/your-authtoken**
2. Salin token yang panjang itu.
3. Di PowerShell, jalankan (ganti `TOKEN_KAMU` dengan token tadi):

   ```powershell
   ngrok config add-authtoken TOKEN_KAMU
   ```

### Langkah 4 — Ambil **Alamat Tetap** (Static Domain) — PENTING ⭐

Akun gratis ngrok dapat **1 alamat tetap gratis**. Ini penting supaya alamatnya
**tidak berubah-ubah** tiap kali demo (kalau berubah, semua QR code harus dibuat ulang).

1. Buka: **https://dashboard.ngrok.com/domains**
2. Klik **+ New Domain** (atau **Create Domain**).
3. Kamu akan dapat alamat gratis, contohnya:

   ```
   labloan-demo.ngrok-free.app
   ```

4. **Catat alamat ini.** Kita pakai terus. (Punyamu akan beda, sesuaikan saja.)

> 📌 Mulai sekarang, setiap kali panduan ini menulis `labloan-demo.ngrok-free.app`,
> **ganti dengan alamat milikmu sendiri.**

---

# 🅱️ BAGIAN B — Menjalankan Aplikasi (Tiap Mau Demo)

> Lakukan **sekali di awal** Langkah 1–4 di bawah. Setelah itu, untuk demo berikutnya
> cukup ulangi **Langkah 5 dan 6** saja.

### Langkah 1 — Nyalakan Laragon

Buka **Laragon** → klik **Start All** (supaya database MySQL menyala).

### Langkah 2 — Atur alamat aplikasi (file `.env`)

1. Buka file `.env` di folder project (`C:\laragon\www\neutradc\labloan-laravel\.env`).
2. Cari baris `APP_URL` lalu **ubah** menjadi alamat ngrok kamu (pakai `https://`):

   ```env
   APP_URL=https://labloan-demo.ngrok-free.app
   ```

3. Simpan file.

### Langkah 3 — Bersihkan cache & buat ulang QR code

Buka **PowerShell** di folder project. Cara cepat: di Laragon klik kanan → **Terminal**,
atau buka folder project lalu ketik `cmd` di address bar. Lalu jalankan satu per satu:

```powershell
php artisan config:clear
php artisan migrate --force
php artisan db:seed --class=UserSeeder --force
php artisan storage:link
php artisan qr:regenerate
```

Penjelasan singkat:
- `config:clear` → menyegarkan pengaturan alamat baru.
- `migrate` + `db:seed` → menyiapkan tabel & akun login (lihat akun di bawah). *Cukup sekali.*
- `storage:link` → supaya gambar QR bisa tampil. *Cukup sekali.*
- `qr:regenerate` → **membuat ulang semua QR code** agar mengarah ke alamat ngrok.
  > ⭐ Jalankan ini **setiap kali alamat ngrok berubah** atau setelah menambah alat baru.
  > Kalau pakai alamat tetap (Langkah A4), cukup sekali saja.

### Langkah 4 — Nyalakan aplikasi Laravel

Di PowerShell yang sama, jalankan:

```powershell
php artisan serve
```

Biarkan jendela ini **tetap terbuka**. Akan muncul tulisan:
`Server running on [http://127.0.0.1:8000]`.

### Langkah 5 — Nyalakan ngrok ⭐

Buka **PowerShell BARU** (jangan tutup yang tadi), lalu jalankan
(ganti dengan alamat tetap milikmu):

```powershell
ngrok http --url=https://labloan-demo.ngrok-free.app 8000
```

Kalau berhasil, akan muncul tampilan seperti ini:

```
Forwarding   https://labloan-demo.ngrok-free.app -> http://localhost:8000
```

🎉 **Aplikasi sudah online!**

### Langkah 6 — Buka di HP

1. Di HP, buka browser (Chrome).
2. Ketik alamat: `https://labloan-demo.ngrok-free.app`
3. Kalau muncul halaman peringatan ngrok (*"You are about to visit..."*),
   klik tombol **Visit Site**. (Ini wajar di versi gratis, cukup sekali klik.)
4. Login, lalu coba menu **Scan Alat** → izinkan kamera → arahkan ke QR. ✅

---

## 🔑 Akun untuk Login

| Peran | Username | Password |
|-------|------------|--------------|
| Admin | `adminlab` | `password123` |
| Mahasiswa | `mahasiswa01` | `password123` |

---

## 🛑 Cara Menghentikan

- Tutup jendela **ngrok** (atau tekan `Ctrl + C` di jendela itu).
- Tutup jendela **`php artisan serve`** (atau `Ctrl + C`).

---

## ⚡ Ringkasan Cepat (untuk demo berikutnya)

Setelah BAGIAN A & B selesai sekali, demo berikutnya tinggal:

1. Buka **Laragon** → **Start All**.
2. PowerShell #1 di folder project:
   ```powershell
   php artisan serve
   ```
3. PowerShell #2:
   ```powershell
   ngrok http --url=https://labloan-demo.ngrok-free.app 8000
   ```
4. Buka alamat ngrok di HP. Selesai! 🚀

---

## 🆘 Kalau Ada Masalah (Troubleshooting)

**Kamera tidak menyala / minta izin terus**
- Pastikan alamat yang dibuka di HP **diawali `https://`** (ada gembok 🔒), bukan `http`.
- Saat browser bertanya izin kamera, pilih **Allow / Izinkan**.
- Coba browser **Chrome** (paling cocok untuk kamera).

**Scan QR malah error / membuka "localhost"**
- Berarti QR-nya masih alamat lama. Jalankan ulang:
  ```powershell
  php artisan config:clear
  php artisan qr:regenerate
  ```
- Pastikan `APP_URL` di `.env` sudah benar (alamat ngrok, pakai `https://`).

**Tampilan berantakan / tanpa warna**
- Jalankan `php artisan storage:link` sekali, lalu refresh halaman.

**Muncul halaman peringatan ngrok tiap buka**
- Itu normal di paket gratis. Klik **Visit Site** sekali saja per HP.

**`ngrok` bilang "address already in use" atau port bentrok**
- Pastikan `php artisan serve` jalan di port **8000**. Kalau servernya di port lain
  (lihat tulisan di jendelanya), sesuaikan angka di perintah ngrok.

**Halaman error "419 Page Expired" saat login**
- Jalankan `php artisan config:clear` lalu coba lagi. Pastikan jam komputer benar.

---

## ❓ Kenapa pakai "Alamat Tetap" itu penting?

QR code di aplikasi ini **menyimpan alamat lengkap** di dalam gambarnya.
Kalau alamat ngrok berubah-ubah (paket gratis tanpa alamat tetap berubah tiap nyala),
maka **semua QR lama jadi tidak bisa di-scan** dan harus dibuat ulang terus.

Dengan **Alamat Tetap** (BAGIAN A, Langkah 4), alamatnya **selalu sama**, jadi QR
cukup dibuat **sekali** dan selamanya bisa dipakai. Sangat disarankan. ⭐
