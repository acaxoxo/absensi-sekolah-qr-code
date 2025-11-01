# Aplikasi Web Sistem Absensi Sekolah Berbasis QR Code

[![Continuous Integration](https://github.com/ikhsan3adi/absensi-sekolah-qr-code/actions/workflows/ci.yml/badge.svg)](https://github.com/ikhsan3adi/absensi-sekolah-qr-code/actions/workflows/ci.yml)
![GitHub Repo stars](https://img.shields.io/github/stars/ikhsan3adi/absensi-sekolah-qr-code?style=social)
![GitHub watchers](https://img.shields.io/github/watchers/ikhsan3adi/absensi-sekolah-qr-code?style=social)
![GitHub forks](https://img.shields.io/github/forks/ikhsan3adi/absensi-sekolah-qr-code?style=social)

![Preview](./screenshots/hero.png)

Aplikasi Web Sistem Absensi Sekolah Berbasis QR Code adalah sebuah proyek yang bertujuan untuk mengotomatisasi proses absensi di lingkungan sekolah menggunakan teknologi QR code. Aplikasi ini dikembangkan dengan menggunakan framework CodeIgniter 4 dan didesain untuk mempermudah pengelolaan dan pencatatan kehadiran siswa dan guru.

> **📚 Quick Links:**
> - [Instalasi & Cara Penggunaan](#cara-penggunaan)
> - [📊 Dokumentasi ERD - Entity Relationship Diagram](#dokumentasi-entity-relationship-diagram-erd) *(Lengkap dengan entitas, atribut, relasi, dan alur sistem)*

## Fitur Utama

- **QR Code scanner.** Setiap siswa/guru menunjukkan qr code kepada perangkat yang dilengkapi dengan kamera. Aplikasi akan memvalidasi QR code dan mencatat kehadiran siswa ke dalam database.
- **Notifikasi Presensi via WhatsApp**. Setelah berhasil scan dan presensi, pemberitahuan dikirim ke nomor hp siswa melalui whatsapp.
- **Login petugas.**
- **Dashboard petugas.** Petugas sekolah dapat dengan mudah memantau kehadiran siswa dalam periode waktu tertentu melalui tampilan yang disediakan.
- **QR Code generator & downloader.** Petugas yang sudah login akan men-generate dan/atau mendownload qr code setiap siswa/guru. Setiap siswa akan diberikan QR code unik yang terkait dengan identitas siswa. QR code ini akan digunakan saat proses absensi.
- **Ubah data absen siswa/guru.** Petugas dapat mengubah data absensi setiap siswa/guru. Misalnya mengubah data kehadiran dari `tanpa keterangan` menjadi `sakit` atau `izin`.
- **Tambah, Ubah, Hapus(CRUD) data siswa/guru.**
- **Tambah, Ubah, Hapus(CRUD) data kelas.**
- **Lihat, Tambah, Ubah, Hapus(CRUD) data petugas.** (khusus petugas yang login sebagai **`superadmin`**).
- **Generate Laporan.** Generate laporan dalam bentuk pdf.
- **Import Banyak Siswa.** Menggunakan CSV delimiter koma (,), Contoh: [CSV](https://github.com/ikhsan3adi/absensi-sekolah-qr-code/blob/141ef728f01b14b89b43aee2c0c38680b0b60528/public/assets/file/csv_siswa_example.csv).

> **📖 Butuh memahami struktur database & alur sistem?**  
> Lihat [Dokumentasi ERD Lengkap](#dokumentasi-entity-relationship-diagram-erd) yang mencakup semua entitas, atribut, relasi, dan flow diagram!

> [!NOTE]
>
> ## Framework dan Library Yang Digunakan
>
> - [CodeIgniter 4](https://github.com/codeigniter4/CodeIgniter4)
> - [Material Dashboard Bootstrap 4](https://www.creative-tim.com/product/material-dashboard-bs4)
> - [Myth Auth Library](https://github.com/lonnieezell/myth-auth)
> - [Endroid QR Code Generator](https://github.com/endroid/qr-code)
> - [ZXing JS QR Code Scanner](https://github.com/zxing-js/library)
>
> ---
>
> - [Fonnte](https://fonnte.com/) - WhatsApp API untuk mengirim pesan notifikasi

## Screenshots

### Tampilan Halaman QR Scanner

![QR Scanner view](./screenshots/qr-scanner.jpeg)

### Tampilan Absen Masuk dan Pulang

![QR Scanner absen](./screenshots/absen.jpg)

> #### Notifikasi via WhatsApp
>
> ![Notifikasi WA](./screenshots/notif-wa.png)

### Tampilan Login Petugas

![Login](./screenshots/login.jpeg)

### Tampilan Dashboard Petugas

![Dashboard](./screenshots/dashboard.png)

### Tampilan CRUD Data Absen

| Siswa (Dengan Data Kelas)                          |                       Guru                       |
| -------------------------------------------------- | :----------------------------------------------: |
| ![CRUD Absen Siswa](./screenshots/absen-siswa.png) | ![CRUD Absen Guru](./screenshots/absen-guru.png) |

### Tampilan Ubah Data Kehadiran

<p align="center">
  <img src="./screenshots/ubah-kehadiran.jpeg" height="320px" style="object-fit:cover" alt="Ubah Data Kehadiran" title="Ubah Data Kehadiran">
</p>

### Tampilan CRUD Data Siswa & Guru

| Siswa                                            |                      Guru                      |
| ------------------------------------------------ | :--------------------------------------------: |
| ![CRUD Data Siswa](./screenshots/data-siswa.png) | ![CRUD Data Guru](./screenshots/data-guru.png) |

### Tampilan CRUD Data Kelas & Jurusan

![CRUD Data Siswa](./screenshots/kelas-jurusan.png)

### Tampilan Generate QR Code dan Generate Laporan

| Generate QR                                   |                Generate Laporan                |
| --------------------------------------------- | :--------------------------------------------: |
| ![Generate QR](./screenshots/generate-qr.png) | ![Generate Laporan](./screenshots/laporan.png) |

## Cara Penggunaan

### Persyaratan (Apa saja yang harus di-install)

- Git (untuk clone/pull repo)
- [Composer](https://getcomposer.org/) (dependency manager PHP)
- PHP 8.1+ (disarankan 8.2) dan MySQL/MariaDB
  - Windows: direkomendasikan [XAMPP 8.1+](https://www.apachefriends.org/download.html) yang sudah menyertakan Apache + PHP + MySQL/MariaDB
- Ekstensi PHP yang perlu aktif:
  - `intl`, `gd`, `zip`
  - (Biasanya sudah aktif: `mbstring`, `openssl`, `json`)
- Perangkat kamera/webcam untuk scan QR (opsional bisa pakai HP via DroidCam)

Tips mengaktifkan ekstensi di XAMPP (Windows):
1. Buka file `C:\xampp\php\php.ini`
2. Pastikan baris berikut tidak diawali `;` (artinya aktif):
    - `extension=intl`
    - `extension=gd`
    - `extension=zip`
3. Simpan lalu Restart Apache dari XAMPP Control Panel

### Quick Start (Local) — Setelah Pull/Clone

1. Clone/Pull repository ini
2. Jalankan `composer install`
3. Salin `.env.example` menjadi `.env`
4. Edit `.env` minimal bagian berikut:
    - `app.baseURL = http://localhost:8080/`
    - `database.default.hostname`, `database.default.database`, `database.default.username`, `database.default.password`
5. Buat database (misal: `db_absensi`) di MySQL/MariaDB
6. Jalankan migrasi: `php spark migrate --all`
7. Jalankan server dev: `php spark serve`
8. Buka `http://localhost:8080`
9. Login awal (superadmin):
    - username: `superadmin`
    - password: `superadmin`
10. Izinkan akses kamera di browser saat scan QR

### Instalasi

- Clone/Download source code proyek ini.

- Install dependencies yang diperlukan dengan cara menjalankan perintah berikut di terminal:

  ```shell
  composer install
  ```

- Jika belum terdapat file `.env`, rename file `.env.example` menjadi `.env`

- Buat database `db_absensi`(sesuaikan dengan yang terdapat di `.env`) di phpMyAdmin / mysql

- Jalankan migrasi database untuk membuat struktur tabel yang diperlukan. Ketikkan perintah berikut di terminal:

  ```shell
  php spark migrate --all
  ```

- Jalankan web server (contoh Apache, XAMPP, etc)
- Atau gunakan `php spark serve` (atur baseURL di `.env` menjadi `http://localhost:8080/` terlebih dahulu).
- Lalu jalankan aplikasi di browser.
- Login menggunakan krendensial superadmin:

  ```txt
  username : superadmin
  password : superadmin
  ```

- Izinkan akses kamera.

### Konfigurasi

> [!IMPORTANT]
>
> - Konfigurasi file `.env` untuk mengatur base url(terutama jika melakukan hosting), koneksi database dan pengaturan lainnya sesuai dengan lingkungan pengembangan Anda.
>
> - Untuk mengaktifkan **notifikasi WhatsApp**, pertama-tama ubah variabel `.env` berikut dari `false` menjadi `true`.
>
>   ```sh
>   # .env
>   # WA_NOTIFICATION=false # sebelum
>   WA_NOTIFICATION=true
>   ```
>
>   Lalu masukkan token WhatsApp API.
>
>   ```sh
>   # .env
>   WA_NOTIFICATION=true
>   WHATSAPP_PROVIDER=Fonnte
>   WHATSAPP_TOKEN=XXXXXXXXXXXXXXXXX # ganti dengan token anda
>   ```
>
>   _**Untuk mendapatkan token, daftar di website [fonnte](https://md.fonnte.com/new/register.php) terlebih dahulu. Lalu daftarkan device anda dan [dapatkan token Fonnte Whatsapp API](https://docs.fonnte.com/token-api-key/)**_
>
> - Untuk mengubah konfigurasi nama sekolah, tahun ajaran logo sekolah dll sudah disediakan pengaturan (khusus untuk superadmin).
>
> - Logo Sekolah Rekomendasi 100x100px atau 1:1 dan berformat PNG/JPG.
>
> - Jika ingin mengubah email, username & password dari superadmin, buka file `app\Database\Migrations\2023-08-18-000004_AddSuperadmin.php` lalu ubah & sesuaikan kode berikut:
>
>   ```php
>   // INSERT INITIAL SUPERADMIN
>   $email = 'adminsuper@gmail.com';
>   $username = 'superadmin';
>   $password = 'superadmin';
>   ```

## Dokumentasi Entity Relationship Diagram (ERD)

### Daftar Entitas dan Atribut

Sistem ini terdiri dari beberapa entitas utama dengan atribut dan relasi sebagai berikut:

#### 1. **Jurusan** (`tb_jurusan`)
Master data jurusan/program studi di sekolah.

| Atribut | Tipe | Keterangan |
|---------|------|------------|
| `id` | INT (PK) | Primary Key |
| `jurusan` | VARCHAR | Nama jurusan (contoh: TKJ, RPL, MM) |

#### 2. **Kelas** (`tb_kelas`)
Master data kelas yang terkait dengan jurusan.

| Atribut | Tipe | Keterangan |
|---------|------|------------|
| `id_kelas` | INT (PK) | Primary Key |
| `kelas` | VARCHAR | Nama/tingkat kelas (contoh: X, XI, XII) |
| `id_jurusan` | INT (FK) | Foreign Key ke `tb_jurusan.id` |

#### 3. **Siswa** (`tb_siswa`)
Master data siswa yang terdaftar di sekolah.

| Atribut | Tipe | Keterangan |
|---------|------|------------|
| `id_siswa` | INT (PK) | Primary Key |
| `nis` | VARCHAR | Nomor Induk Siswa (UNIQUE) |
| `nama_siswa` | VARCHAR | Nama lengkap siswa |
| `id_kelas` | INT (FK) | Foreign Key ke `tb_kelas.id_kelas` |
| `jenis_kelamin` | ENUM | 'L' atau 'P' |
| `no_hp` | VARCHAR | Nomor HP untuk notifikasi WA |
| `unique_code` | VARCHAR (UNIQUE) | Token unik untuk generate QR Code |

#### 4. **Guru** (`tb_guru`)
Master data guru/pengajar.

| Atribut | Tipe | Keterangan |
|---------|------|------------|
| `id_guru` | INT (PK) | Primary Key |
| `nuptk` | VARCHAR | Nomor Unik Pendidik dan Tenaga Kependidikan (UNIQUE) |
| `nama_guru` | VARCHAR | Nama lengkap guru |
| `jenis_kelamin` | ENUM | 'L' atau 'P' |
| `alamat` | TEXT | Alamat lengkap |
| `no_hp` | VARCHAR | Nomor HP untuk notifikasi WA |
| `unique_code` | VARCHAR (UNIQUE) | Token unik untuk generate QR Code |

#### 5. **Kehadiran** (`tb_kehadiran`)
Reference/lookup table untuk status kehadiran.

| Atribut | Tipe | Keterangan |
|---------|------|------------|
| `id_kehadiran` | INT (PK) | Primary Key (1=Hadir, 2=Sakit, 3=Izin, 4=Alfa) |
| `nama_status` | VARCHAR | Nama status kehadiran |

#### 6. **Presensi Siswa** (`tb_presensi_siswa`)
Transaksi absensi harian siswa.

| Atribut | Tipe | Keterangan |
|---------|------|------------|
| `id_presensi` | INT (PK) | Primary Key |
| `id_siswa` | INT (FK) | Foreign Key ke `tb_siswa.id_siswa` |
| `id_kelas` | INT (FK) | Foreign Key ke `tb_kelas.id_kelas` (denormalisasi) |
| `tanggal` | DATE | Tanggal presensi |
| `jam_masuk` | TIME | Waktu scan masuk (nullable) |
| `jam_keluar` | TIME | Waktu scan pulang (nullable) |
| `id_kehadiran` | INT (FK) | Foreign Key ke `tb_kehadiran.id_kehadiran` |
| `keterangan` | TEXT | Keterangan tambahan (nullable) |

**Constraint**: UNIQUE (`id_siswa`, `tanggal`) - satu siswa hanya bisa presensi sekali per hari

#### 7. **Presensi Guru** (`tb_presensi_guru`)
Transaksi absensi harian guru.

| Atribut | Tipe | Keterangan |
|---------|------|------------|
| `id_presensi` | INT (PK) | Primary Key |
| `id_guru` | INT (FK) | Foreign Key ke `tb_guru.id_guru` |
| `tanggal` | DATE | Tanggal presensi |
| `jam_masuk` | TIME | Waktu scan masuk (nullable) |
| `jam_keluar` | TIME | Waktu scan pulang (nullable) |
| `id_kehadiran` | INT (FK) | Foreign Key ke `tb_kehadiran.id_kehadiran` |
| `keterangan` | TEXT | Keterangan tambahan (nullable) |

**Constraint**: UNIQUE (`id_guru`, `tanggal`) - satu guru hanya bisa presensi sekali per hari

#### 8. **Users/Petugas** (`users`)
Data akun petugas/admin sistem (dari Myth Auth).

| Atribut | Tipe | Keterangan |
|---------|------|------------|
| `id` | INT (PK) | Primary Key |
| `email` | VARCHAR (UNIQUE) | Email login |
| `username` | VARCHAR (UNIQUE) | Username login |
| `password_hash` | VARCHAR | Password terenkripsi |
| `is_superadmin` | BOOLEAN | Flag level akses (0=petugas, 1=superadmin) |

#### 9. **General Settings** (`general_settings`)
Pengaturan umum aplikasi.

| Atribut | Tipe | Keterangan |
|---------|------|------------|
| `id` | INT (PK) | Primary Key (selalu 1) |
| `school_name` | VARCHAR | Nama sekolah |
| `school_year` | VARCHAR | Tahun ajaran aktif |
| `logo` | VARCHAR | Path file logo sekolah |
| `copyright` | VARCHAR | Teks copyright footer |

### Relasi Antar Entitas

```
┌─────────────┐
│  Jurusan    │
│  (tb_jurusan)│
└──────┬──────┘
       │ 1
       │
       │ N
┌──────▼──────┐
│   Kelas     │
│ (tb_kelas)  │
└──────┬──────┘
       │ 1
       │
       │ N
┌──────▼──────┐         ┌────────────────┐
│   Siswa     │ N       │  Presensi Siswa│
│ (tb_siswa)  ├────────►│(tb_presensi_   │
└─────────────┘         │    siswa)      │
                        └────────┬───────┘
                                 │ N
                                 │
                                 │ 1
                        ┌────────▼───────┐
                        │   Kehadiran    │
┌─────────────┐         │ (tb_kehadiran) │
│    Guru     │         └────────▲───────┘
│  (tb_guru)  │ N                │ 1
└──────┬──────┘                  │
       │                         │ N
       │ 1              ┌────────┴───────┐
       │                │  Presensi Guru │
       └───────────────►│(tb_presensi_   │
                        │     guru)      │
                        └────────────────┘

┌─────────────┐         ┌─────────────────┐
│   Users     │         │ General Settings│
│  (users)    │         │(general_settings│
└─────────────┘         └─────────────────┘
(standalone)                 (standalone)
```

### Kardinalitas Relasi

1. **Jurusan → Kelas** : `1:N` (One-to-Many)
   - Satu jurusan memiliki banyak kelas
   - FK: `tb_kelas.id_jurusan` → `tb_jurusan.id`

2. **Kelas → Siswa** : `1:N` (One-to-Many)
   - Satu kelas memiliki banyak siswa
   - FK: `tb_siswa.id_kelas` → `tb_kelas.id_kelas`

3. **Siswa → Presensi Siswa** : `1:N` (One-to-Many)
   - Satu siswa memiliki banyak record presensi (setiap hari)
   - FK: `tb_presensi_siswa.id_siswa` → `tb_siswa.id_siswa`

4. **Kelas → Presensi Siswa** : `1:N` (One-to-Many - denormalisasi)
   - Satu kelas memiliki banyak record presensi
   - FK: `tb_presensi_siswa.id_kelas` → `tb_kelas.id_kelas`
   - *Kolom ini untuk mempercepat query laporan per kelas*

5. **Guru → Presensi Guru** : `1:N` (One-to-Many)
   - Satu guru memiliki banyak record presensi (setiap hari)
   - FK: `tb_presensi_guru.id_guru` → `tb_guru.id_guru`

6. **Kehadiran → Presensi Siswa** : `1:N` (One-to-Many)
   - Satu status kehadiran digunakan oleh banyak presensi siswa
   - FK: `tb_presensi_siswa.id_kehadiran` → `tb_kehadiran.id_kehadiran`

7. **Kehadiran → Presensi Guru** : `1:N` (One-to-Many)
   - Satu status kehadiran digunakan oleh banyak presensi guru
   - FK: `tb_presensi_guru.id_kehadiran` → `tb_kehadiran.id_kehadiran`

### Alur Skenario Sistem

#### **1. Setup Master Data**
```
Admin Login → Buat Jurusan → Buat Kelas (pilih jurusan) → Input Siswa (pilih kelas) & Guru
                                    ↓
                          Sistem generate unique_code otomatis
```

#### **2. Generate QR Code**
```
Admin masuk menu "Generate QR Code"
    ↓
Pilih: Semua Siswa / Per Kelas / Semua Guru
    ↓
Sistem membaca unique_code dari database
    ↓
Generate QR Code (PNG) → Simpan di uploads/qr-siswa atau uploads/qr-guru
    ↓
Download individual / ZIP batch
```

#### **3. Scan & Presensi (Flow Siswa)**
```
Siswa scan QR Code di halaman publik (kamera aktif)
    ↓
Sistem decode QR → dapat unique_code
    ↓
Cari di tb_siswa WHERE unique_code = ?
    ↓
├─ Jika TIDAK DITEMUKAN → tampilkan error "QR tidak valid"
└─ Jika DITEMUKAN:
    ↓
    Cek tb_presensi_siswa WHERE id_siswa = ? AND tanggal = TODAY
    ↓
    ├─ Jika BELUM ADA record:
    │   INSERT tb_presensi_siswa
    │   SET jam_masuk = NOW, id_kehadiran = 1 (Hadir)
    │   → Tampilkan "Absen Masuk Berhasil"
    │   → Kirim notifikasi WA (jika aktif)
    │
    └─ Jika SUDAH ADA record:
        UPDATE tb_presensi_siswa
        SET jam_keluar = NOW
        → Tampilkan "Absen Pulang Berhasil"
        → Kirim notifikasi WA (jika aktif)
```

#### **4. Scan & Presensi (Flow Guru)**
```
Guru scan QR Code di halaman publik
    ↓
Decode QR → dapat unique_code
    ↓
Cari di tb_guru WHERE unique_code = ?
    ↓
├─ Jika TIDAK DITEMUKAN → error "QR tidak valid"
└─ Jika DITEMUKAN:
    ↓
    Cek tb_presensi_guru WHERE id_guru = ? AND tanggal = TODAY
    ↓
    ├─ Jika BELUM ADA: INSERT (jam_masuk, Hadir)
    └─ Jika SUDAH ADA: UPDATE (jam_keluar)
```

#### **5. Edit Status Kehadiran (Admin)**
```
Admin buka menu "Absensi Siswa/Guru"
    ↓
Pilih tanggal & kelas (untuk siswa)
    ↓
Tampilkan tabel presensi:
    JOIN tb_siswa/guru + tb_presensi + tb_kehadiran
    ↓
Klik "Edit" pada row tertentu
    ↓
Ubah: id_kehadiran (Hadir/Sakit/Izin/Alfa), jam_masuk, jam_keluar, keterangan
    ↓
UPDATE tb_presensi_siswa/guru
```

#### **6. Laporan & Dashboard**
```
Admin masuk Dashboard/Laporan
    ↓
Pilih filter: tanggal, kelas, status kehadiran
    ↓
Query JOIN:
    tb_presensi_siswa
    LEFT JOIN tb_siswa ON ...
    LEFT JOIN tb_kelas ON ...
    LEFT JOIN tb_jurusan ON ...
    LEFT JOIN tb_kehadiran ON ...
    WHERE tanggal = ? AND id_kelas = ?
    ↓
Tampilkan tabel / grafik / export PDF
```

#### **7. Cascade Delete (Relasi Berantai)**
```
Hapus Jurusan:
    1. Hapus semua tb_presensi_siswa (WHERE id_siswa IN siswa di jurusan ini)
    2. Hapus semua tb_siswa (WHERE id_kelas IN kelas di jurusan ini)
    3. Hapus semua tb_kelas (WHERE id_jurusan = ?)
    4. Hapus tb_jurusan

Hapus Kelas:
    1. Hapus semua tb_presensi_siswa (WHERE id_kelas = ?)
    2. Hapus semua tb_siswa (WHERE id_kelas = ?)
    3. Hapus tb_kelas

Hapus Siswa:
    1. Hapus semua tb_presensi_siswa (WHERE id_siswa = ?)
    2. Hapus tb_siswa

Hapus Guru:
    1. Hapus semua tb_presensi_guru (WHERE id_guru = ?)
    2. Hapus tb_guru
```

### Rekomendasi Constraint Database

Untuk menjaga integritas data, disarankan menambahkan constraint berikut:

```sql
-- UNIQUE Constraints
ALTER TABLE tb_siswa ADD UNIQUE (nis);
ALTER TABLE tb_siswa ADD UNIQUE (unique_code);
ALTER TABLE tb_guru ADD UNIQUE (nuptk);
ALTER TABLE tb_guru ADD UNIQUE (unique_code);
ALTER TABLE tb_presensi_siswa ADD UNIQUE (id_siswa, tanggal);
ALTER TABLE tb_presensi_guru ADD UNIQUE (id_guru, tanggal);

-- Foreign Key Constraints dengan CASCADE
ALTER TABLE tb_kelas 
    ADD FOREIGN KEY (id_jurusan) REFERENCES tb_jurusan(id) 
    ON DELETE CASCADE;

ALTER TABLE tb_siswa 
    ADD FOREIGN KEY (id_kelas) REFERENCES tb_kelas(id_kelas) 
    ON DELETE CASCADE;

ALTER TABLE tb_presensi_siswa 
    ADD FOREIGN KEY (id_siswa) REFERENCES tb_siswa(id_siswa) 
    ON DELETE CASCADE,
    ADD FOREIGN KEY (id_kelas) REFERENCES tb_kelas(id_kelas) 
    ON DELETE SET NULL,
    ADD FOREIGN KEY (id_kehadiran) REFERENCES tb_kehadiran(id_kehadiran) 
    ON DELETE RESTRICT;

ALTER TABLE tb_presensi_guru 
    ADD FOREIGN KEY (id_guru) REFERENCES tb_guru(id_guru) 
    ON DELETE CASCADE,
    ADD FOREIGN KEY (id_kehadiran) REFERENCES tb_kehadiran(id_kehadiran) 
    ON DELETE RESTRICT;
```

### Tips Membuat ERD

1. **Entitas Utama** (kotak): Jurusan, Kelas, Siswa, Guru, Presensi Siswa, Presensi Guru, Kehadiran, Users, General Settings

2. **Relasi** (garis penghubung):
   - Crow's Foot Notation untuk kardinalitas
   - Solid line untuk identifying relationship
   - Dashed line untuk non-identifying relationship

3. **Tool ERD yang bisa digunakan**:
   - [draw.io](https://app.diagrams.net/)
   - [dbdiagram.io](https://dbdiagram.io/)
   - [Lucidchart](https://www.lucidchart.com/)
   - MySQL Workbench (auto-generate dari database)
   - Visual Paradigm

4. **Contoh Notasi**:
   ```
   Jurusan ||--o{ Kelas : "memiliki"
   Kelas ||--o{ Siswa : "berisi"
   Siswa ||--o{ PresensiSiswa : "mencatat"
   Kehadiran ||--o{ PresensiSiswa : "menentukan status"
   ```

---

## Kesimpulan

Dengan aplikasi web sistem absensi sekolah berbasis QR code ini, diharapkan proses absensi di sekolah menjadi lebih efisien dan terotomatisasi. Proyek ini dapat diadaptasi dan dikembangkan lebih lanjut sesuai dengan kebutuhan dan persyaratan sekolah Anda.

Jangan lupa beri star ya...⭐⭐⭐

## Contributing 🤝

Kami menerima kontribusi dari komunitas terbuka untuk meningkatkan aplikasi ini. Jika Anda menemukan masalah, bug, atau memiliki saran untuk peningkatan, silakan buat issue baru dalam repositori ini atau ajukan pull request.

## Donasi ❤

[![Donate saweria](https://img.shields.io/badge/Donate-Saweria-red?style=for-the-badge&link=https%3A%2F%2Fsaweria.co%2Fxiboxann)](https://saweria.co/xiboxann)

## Star History

<a href="https://www.star-history.com/#ikhsan3adi/absensi-sekolah-qr-code&Date">
 <picture>
   <source media="(prefers-color-scheme: dark)" srcset="https://api.star-history.com/svg?repos=ikhsan3adi/absensi-sekolah-qr-code&type=Date&theme=dark" />
   <source media="(prefers-color-scheme: light)" srcset="https://api.star-history.com/svg?repos=ikhsan3adi/absensi-sekolah-qr-code&type=Date" />
   <img alt="Star History Chart" src="https://api.star-history.com/svg?repos=ikhsan3adi/absensi-sekolah-qr-code&type=Date" />
 </picture>
</a>

## Kontributor 🛠️

- [@ikhsan3adi](https://www.github.com/ikhsan3adi)
- [@reactmore](https://www.github.com/reactmore)
- [@janglapuk](https://www.github.com/janglapuk)
- [@nanda443](https://www.github.com/nanda443)
- [@kevindoni](https://www.github.com/kevindoni)
- [@pandigresik](https://github.com/pandigresik)
