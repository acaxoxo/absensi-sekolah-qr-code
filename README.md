# Aplikasi Web Sistem Absensi Sekolah Berbasis QR Code

![Preview](./screenshots/hero.png)

Sistem absensi digital berbasis QR Code yang mengotomatisasi pencatatan kehadiran siswa dan guru menggunakan teknologi pemindaian QR Code. Dibangun dengan CodeIgniter 4 untuk efisiensi dan kemudahan pengelolaan data absensi sekolah.

> **📚 Quick Links:**
> - [Instalasi & Cara Penggunaan](#instalasi-dan-penggunaan)
> - [📊 Dokumentasi Database (ERD)](#dokumentasi-entity-relationship-diagram-erd)
> - [🎤 Panduan Presentasi](./PRESENTATION_GUIDE.md)

## Fitur Utama

### Untuk Siswa & Guru
- ✅ **Scan QR Code** untuk absensi masuk dan pulang
- ✅ **Notifikasi WhatsApp** otomatis setelah presensi berhasil
- ✅ QR Code unik untuk setiap siswa dan guru

### Untuk Admin/Petugas
- ✅ **Dashboard** monitoring kehadiran real-time
- ✅ **CRUD Data Master** (Siswa, Guru, Kelas, Jurusan)
- ✅ **Generate QR Code** otomatis dan download (individual/batch)
- ✅ **Kelola Absensi** - ubah status kehadiran (Hadir, Sakit, Izin, Alpha)
- ✅ **Generate Laporan** dalam format PDF/DOC
- ✅ **Import Data Siswa** melalui file CSV
- ✅ **Manajemen Petugas** (khusus Superadmin)
- ✅ **Pengaturan Aplikasi** (nama sekolah, tahun ajaran, logo)

> **📖 Dokumentasi Lengkap:**  
> Lihat [ERD & Alur Sistem](#dokumentasi-entity-relationship-diagram-erd) | [Panduan Presentasi](./PRESENTATION_GUIDE.md)

## Tech Stack

**Backend & Framework:**
- [CodeIgniter 4](https://github.com/codeigniter4/CodeIgniter4) - PHP Framework
- [Myth Auth](https://github.com/lonnieezell/myth-auth) - Authentication Library
- PHP 8.1+ & MySQL/MariaDB

**Frontend & UI:**
- [Material Dashboard Bootstrap 4](https://www.creative-tim.com/product/material-dashboard-bs4)
- Bootstrap 4 & jQuery

**QR Code Technology:**
- [Endroid QR Code](https://github.com/endroid/qr-code) - QR Code Generator
- [ZXing JS](https://github.com/zxing-js/library) - QR Code Scanner

**Integration:**
- [Fonnte WhatsApp API](https://fonnte.com/) - Notifikasi WhatsApp

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

## Instalasi dan Penggunaan

### Persyaratan Sistem

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

### Langkah Instalasi

**1. Clone Repository**
```bash
git clone https://github.com/acaxoxo/absensi-sekolah-qr-code.git
cd absensi-sekolah-qr-code
```

**2. Install Dependencies**
```bash
composer install
```

**3. Konfigurasi Environment**
```bash
cp .env.example .env
```

Edit file `.env`:
```env
app.baseURL = 'http://localhost:8080/'

database.default.hostname = localhost
database.default.database = db_absensi
database.default.username = root
database.default.password = 
```

**4. Setup Database**
```bash
# Buat database di MySQL/MariaDB
mysql -u root -p -e "CREATE DATABASE db_absensi"

# Jalankan migrasi
php spark migrate --all
```

**5. Jalankan Aplikasi**
```bash
php spark serve
```

Akses: `http://localhost:8080`

**6. Login Awal**
```
Username: superadmin
Password: superadmin
```

> ⚠️ **Penting:** Ubah password default setelah login pertama!

### Konfigurasi Lanjutan

#### Notifikasi WhatsApp (Opsional)

1. Daftar di [Fonnte.com](https://fonnte.com/)
2. Dapatkan API Token
3. Edit `.env`:
```env
WA_NOTIFICATION=true
WHATSAPP_PROVIDER=Fonnte
WHATSAPP_TOKEN=your_fonnte_token_here
```

#### Pengaturan Sekolah

Akses: `/admin/general-settings` (login sebagai Superadmin)
- Nama Sekolah
- Tahun Ajaran
- Logo Sekolah (format: PNG/JPG, ukuran: 100x100px)
- Copyright Footer

#### Ubah Kredensial Superadmin

Edit file: `app/Database/Migrations/2023-08-18-000004_AddSuperadmin.php`
```php
$email = 'your_email@example.com';
$username = 'your_username';
$password = 'your_secure_password';
```
Jalankan ulang migrasi: `php spark migrate:rollback` lalu `php spark migrate --all`

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

Sistem absensi berbasis QR Code ini menyediakan solusi efisien untuk automatisasi pencatatan kehadiran di lingkungan sekolah. Dengan antarmuka yang user-friendly dan fitur notifikasi real-time, sistem ini memudahkan pengelolaan dan monitoring absensi siswa maupun guru.

**Developed by:** Cantika  
**Project Type:** Sistem Informasi Manajemen - Semester 5

---

## Lisensi & Kontribusi

Proyek ini merupakan adaptasi dari [absensi-sekolah-qr-code](https://github.com/ikhsan3adi/absensi-sekolah-qr-code) oleh [@ikhsan3adi](https://www.github.com/ikhsan3adi) dan kontributor lainnya.

### Kontributor Asli
- [@ikhsan3adi](https://www.github.com/ikhsan3adi)
- [@reactmore](https://www.github.com/reactmore)
- [@janglapuk](https://www.github.com/janglapuk)
- [@nanda443](https://www.github.com/nanda443)
- [@kevindoni](https://www.github.com/kevindoni)
- [@pandigresik](https://github.com/pandigresik)
