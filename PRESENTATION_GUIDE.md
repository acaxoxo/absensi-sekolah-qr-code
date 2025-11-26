# 🎤 Panduan Presentasi - Sistem Absensi QR Code

Panduan lengkap untuk presentasi proyek Sistem Absensi Sekolah Berbasis QR Code di depan kelas.

[← Kembali ke README](./README.md)

---

## 📋 Struktur Presentasi (15-20 menit)

### 1. Pembukaan (2 menit)
**Slide 1: Judul & Identitas**
```
SISTEM ABSENSI SEKOLAH BERBASIS QR CODE
Nama: Cantika
Mata Kuliah: Sistem Informasi Manajemen
Semester: 5
```

**Slide 2: Latar Belakang**
- **Masalah:** Proses absensi manual memakan waktu, rawan manipulasi, dan sulit dipantau
- **Solusi:** Sistem digital berbasis QR Code untuk automatisasi absensi
- **Manfaat:** Efisien, real-time, terintegrasi notifikasi WhatsApp

---

### 2. Tinjauan Sistem (3 menit)

**Slide 3: Fitur Utama**

**Untuk Siswa & Guru:**
- ✅ Scan QR Code untuk absen masuk/pulang
- ✅ Notifikasi WhatsApp otomatis
- ✅ QR Code personal unik

**Untuk Admin/Petugas:**
- ✅ Dashboard monitoring real-time
- ✅ Kelola data master (Siswa, Guru, Kelas)
- ✅ Generate QR Code otomatis
- ✅ Ubah status kehadiran
- ✅ Cetak laporan PDF/DOC
- ✅ Import data siswa via CSV

**Slide 4: Teknologi yang Digunakan**
```
Backend:        CodeIgniter 4 (PHP 8.1+) + MySQL
Authentication: Myth Auth Library
Frontend:       Material Dashboard Bootstrap 4
QR Technology:  Endroid (Generator) + ZXing JS (Scanner)
Integration:    Fonnte WhatsApp API
```

---

### 3. Demo Aplikasi (8-10 menit)

#### A. Demo QR Code Scanner (2 menit)
**Persiapan:**
- Buka browser ke `http://localhost:8080/scan`
- Siapkan QR Code siswa/guru yang sudah di-generate

**Yang ditunjukkan:**
1. Halaman scanner dengan live camera preview
2. Scan QR Code siswa → Tampilkan "Absen Masuk Berhasil"
3. Scan QR Code yang sama lagi → "Absen Pulang Berhasil"
4. Tunjukkan notifikasi WhatsApp (jika aktif)

**Script:**
```
"Ini adalah halaman scanner publik yang bisa diakses tanpa login.
Ketika siswa scan QR Code-nya, sistem otomatis:
1. Validasi QR Code
2. Cek apakah sudah absen hari ini
3. Catat jam masuk (pertama kali) atau jam pulang (kedua kali)
4. Kirim notifikasi WhatsApp ke nomor siswa"
```

#### B. Demo Dashboard Admin (3 menit)
**Login sebagai Superadmin:**
```
Username: superadmin
Password: superadmin
```

**Yang ditunjukkan:**
1. **Dashboard Utama** (`/admin/dashboard`)
   - Statistik kehadiran hari ini
   - Grafik/ringkasan data

2. **Data Siswa** (`/admin/siswa`)
   - List siswa per kelas
   - Tunjukkan fitur search & filter
   - Klik "Edit" salah satu siswa

3. **Data Absensi** (`/admin/absen-siswa`)
   - Pilih kelas & tanggal
   - Tampilkan tabel presensi
   - Demo ubah status: "Tanpa Keterangan" → "Sakit"

**Script:**
```
"Sebagai admin, kita punya kontrol penuh untuk:
- Mengelola semua data master
- Melihat rekap absensi per kelas dan tanggal
- Mengubah status kehadiran jika ada siswa yang izin/sakit
  tapi lupa scan QR Code"
```

#### C. Demo Generate QR Code (2 menit)
**Navigasi:** `/admin/generate`

**Yang ditunjukkan:**
1. Pilih "Generate QR Siswa Per Kelas" → Pilih kelas
2. Klik "Generate" → Tunjukkan QR Code muncul
3. Klik "Download" → Download ZIP file
4. Extract ZIP → Tunjukkan file PNG QR Code

**Script:**
```
"Sistem otomatis generate QR Code unik untuk setiap siswa.
QR Code ini berisi unique_code yang di-hash dari data siswa.
Admin bisa download individual atau batch (ZIP) untuk
dicetak dan dibagikan ke siswa."
```

#### D. Demo Generate Laporan (2 menit)
**Navigasi:** `/admin/laporan`

**Yang ditunjukkan:**
1. Pilih kelas & bulan
2. Klik "Generate Laporan Siswa (PDF)"
3. Tunjukkan laporan terbuka di tab baru
4. Tunjukkan detail: nama sekolah, tahun ajaran, tabel kehadiran

**Script:**
```
"Laporan bisa di-generate dalam format PDF atau DOC.
Berisi rekap kehadiran seluruh siswa dalam 1 bulan,
lengkap dengan status: Hadir (H), Sakit (S), Izin (I), Alpha (A).
Bisa langsung dicetak untuk arsip atau dilaporkan ke kepala sekolah."
```

---

### 4. Penjelasan Teknis (3 menit)

**Slide 5: Arsitektur Sistem**

```
┌─────────────┐
│   Browser   │ ← User Interface (HTML/CSS/JS)
└──────┬──────┘
       │ HTTP Request
       ▼
┌─────────────┐
│  CodeIgniter │ ← MVC Framework (Router, Controller, Model)
│      4       │
└──────┬──────┘
       │ Query
       ▼
┌─────────────┐
│   MySQL     │ ← Database (Data Persistence)
└─────────────┘
```

**Slide 6: Database Schema (ERD Sederhana)**

```
Jurusan (1) ──► (N) Kelas (1) ──► (N) Siswa (1) ──► (N) Presensi Siswa
                                                              │
                                                              ▼ (N)
Guru (1) ──► (N) Presensi Guru ◄────────────────────── (1) Kehadiran
```

**Key Tables:**
- `tb_siswa` - Master data siswa + unique_code untuk QR
- `tb_presensi_siswa` - Transaksi absensi harian
- `tb_kehadiran` - Reference: Hadir, Sakit, Izin, Alpha
- `users` - Akun admin/petugas

**Slide 7: Alur Scan QR Code**

```
1. User scan QR Code
   ↓
2. ZXing JS decode → dapat unique_code
   ↓
3. AJAX POST ke /scan/cek
   ↓
4. Controller cari di database WHERE unique_code = ?
   ↓
5. Validasi: sudah absen hari ini?
   - BELUM → INSERT (jam_masuk)
   - SUDAH → UPDATE (jam_keluar)
   ↓
6. Kirim notifikasi WhatsApp (jika aktif)
   ↓
7. Return response → Tampilkan alert success
```

---

### 5. Kode Penting (2-3 menit)

**Slide 8: Controller - Scan QR Code**

Tunjukkan file: `app/Controllers/Scan.php`

```php
public function cekKode()
{
    $uniqueCode = $this->request->getVar('unique_code');
    
    // Cek di tabel siswa
    $siswa = $this->siswaModel->cekSiswa($uniqueCode);
    
    if ($siswa) {
        // Cek sudah absen hari ini?
        $cek = $this->presensiSiswa->cekAbsen($siswa['id_siswa'], date('Y-m-d'));
        
        if (!$cek) {
            // Absen masuk
            $this->presensiSiswa->absenMasuk(...);
            $this->sendWhatsAppNotification(...);
            return $this->response->setJSON(['status' => 'masuk']);
        } else {
            // Absen pulang
            $this->presensiSiswa->absenPulang(...);
            return $this->response->setJSON(['status' => 'pulang']);
        }
    }
    
    return $this->response->setJSON(['status' => 'error']);
}
```

**Slide 9: Model - Generate QR Code**

Tunjukkan file: `app/Models/SiswaModel.php`

```php
public function createSiswa($nis, $nama, $idKelas, $jenisKelamin, $noHp)
{
    // Generate unique code untuk QR
    $uniqueCode = sha1($nama . md5($nis . $nama . $noHp)) 
                  . substr(sha1($nis . rand(0, 100)), 0, 24);
    
    return $this->save([
        'nis' => $nis,
        'nama_siswa' => $nama,
        'id_kelas' => $idKelas,
        'jenis_kelamin' => $jenisKelamin,
        'no_hp' => $noHp,
        'unique_code' => $uniqueCode // Disimpan di database
    ]);
}
```

**Penjelasan:**
- `unique_code` di-generate saat siswa pertama kali ditambahkan
- Kombinasi SHA1 + MD5 + random untuk keunikan
- Disimpan di database, lalu digunakan untuk generate QR image

**Slide 10: View - QR Scanner (JavaScript)**

Tunjukkan file: `app/Views/scan/index.php`

```javascript
// Inisialisasi ZXing scanner
const codeReader = new ZXing.BrowserQRCodeReader();

codeReader.decodeFromVideoDevice(null, 'video', (result, err) => {
    if (result) {
        const uniqueCode = result.text;
        
        // Kirim ke server via AJAX
        $.ajax({
            url: baseURL + 'scan/cek',
            method: 'POST',
            data: { unique_code: uniqueCode },
            success: function(response) {
                if (response.status === 'masuk') {
                    swal("Berhasil!", "Absen masuk tercatat", "success");
                }
            }
        });
    }
});
```

---

### 6. Tantangan & Solusi (1-2 menit)

**Slide 11: Challenges & Solutions**

| Tantangan | Solusi |
|-----------|--------|
| **QR Code harus unik** | Generate unique_code dengan kombinasi hash (SHA1 + MD5) + timestamp |
| **Validasi scan ganda** | Cek constraint UNIQUE (id_siswa, tanggal) di database |
| **Notifikasi real-time** | Integrasi Fonnte WhatsApp API dengan queue system |
| **Akses kamera browser** | Request permission + fallback error handling |
| **Performance laporan** | Denormalisasi kolom `id_kelas` di `tb_presensi_siswa` |

---

### 7. Penutup & Q&A (2 menit)

**Slide 12: Kesimpulan**

**Pencapaian:**
- ✅ Sistem absensi otomatis berbasis QR Code
- ✅ Dashboard admin untuk monitoring & laporan
- ✅ Notifikasi WhatsApp terintegrasi
- ✅ Import data siswa via CSV
- ✅ Generate laporan PDF/DOC

**Future Development:**
- 📱 Mobile app untuk Android/iOS
- 👨‍🏫 Portal guru untuk lihat absensi kelas sendiri
- 📊 Analytics & insights (grafik tren kehadiran)
- 🔔 Notifikasi push untuk admin jika ada siswa terlambat
- 🏫 Multi-tenant: satu sistem untuk banyak sekolah

**Slide 13: Thank You**
```
Terima kasih!

Siap menjawab pertanyaan 🙋

Repository: github.com/acaxoxo/absensi-sekolah-qr-code
Developer: Cantika
```

---

## 🎯 Tips Presentasi

### Persiapan Sebelum Presentasi

**1. Teknis:**
- ✅ Test aplikasi 30 menit sebelum presentasi
- ✅ Pastikan XAMPP/server sudah jalan
- ✅ Database sudah terisi data dummy (minimal 5 siswa, 2 kelas)
- ✅ Generate QR Code untuk demo (print atau tampilkan di HP)
- ✅ Test kamera laptop/eksternal berfungsi
- ✅ Siapkan backup: screenshot/video demo jika ada masalah teknis

**2. Slide & Material:**
- ✅ PowerPoint/Google Slides sudah siap
- ✅ Code editor (VS Code) siap dengan file yang akan ditunjukkan
- ✅ Browser tab: localhost, phpMyAdmin, Fonnte dashboard
- ✅ Backup USB/cloud dengan source code & slides

**3. Mental:**
- ✅ Latihan presentasi 2-3 kali
- ✅ Hafalkan poin-poin penting
- ✅ Siapkan jawaban untuk pertanyaan umum (lihat bagian FAQ)

---

### Saat Presentasi

**DO ✅**
- Bicara jelas dan tidak terlalu cepat
- Tunjukkan antusiasme pada project
- Jelaskan "kenapa" selain "apa" dan "bagaimana"
- Interaksi dengan audiens (tanya: "Apakah ada yang pernah pakai sistem absensi manual?")
- Zoom in saat tunjukkan code
- Pause setelah demo untuk kasih waktu audiens memahami

**DON'T ❌**
- Membaca slide verbatim
- Terlalu banyak jargon teknis tanpa penjelasan
- Scroll code terlalu cepat
- Panic jika ada bug/error (explain calmly)
- Lewati pertanyaan sulit (acknowledge & note for follow-up)

---

## 💬 FAQ - Antisipasi Pertanyaan

### Pertanyaan Teknis

**Q1: Kenapa pakai QR Code, bukan RFID atau fingerprint?**

**A:** QR Code dipilih karena:
- ✅ **Cost-effective**: Tidak perlu hardware khusus, cukup kamera
- ✅ **Scalable**: Mudah di-generate & distribute (bisa print atau kirim digital)
- ✅ **User-friendly**: Siswa/guru familiar dengan scan QR (seperti scan QRIS)
- ✅ **Hygiene**: Non-contact (penting era post-COVID)

**Q2: Bagaimana mencegah siswa tukar-tukar QR Code?**

**A:** 
- QR Code dicetak dengan foto & nama siswa (physical copy)
- Admin bisa lihat log presensi dengan kamera snapshot (future feature)
- Notifikasi ke HP siswa → jika bukan dia yang scan, bisa lapor
- Sanksi sekolah untuk kasus manipulasi

**Q3: Bagaimana jika siswa lupa bawa QR Code?**

**A:**
- Admin bisa manual input presensi via dashboard (`/admin/absen-siswa`)
- Atau: QR Code digital di HP (simpan image/PDF)
- Future: Mobile app dengan QR Code terintegrasi

**Q4: Apakah bisa hack unique_code untuk generate QR palsu?**

**A:**
- Unique code pakai kombinasi SHA1 + MD5 + random → sulit ditebak
- Tersimpan di database, hanya admin yang bisa akses
- Validasi di server-side (bukan client-side) → tidak bisa bypass
- Future: tambah timestamp expiry atau encryption

**Q5: Kenapa pakai CodeIgniter 4, bukan Laravel?**

**A:**
- CodeIgniter 4 lebih ringan & cepat (cocok untuk sekolah dengan server terbatas)
- Learning curve lebih landai (sesuai scope mata kuliah)
- Dokumentasi lengkap & komunitas besar
- Performance bagus untuk aplikasi skala kecil-menengah

---

### Pertanyaan Fungsional

**Q6: Bisa tidak sistem ini untuk absensi mata pelajaran (per jam)?**

**A:** 
Saat ini sistem untuk absensi harian (masuk-pulang sekolah).
Untuk per mata pelajaran perlu development tambahan:
- Tabel baru: `jadwal_pelajaran`, `presensi_per_pelajaran`
- QR Code per guru/kelas/jam
- Flow berbeda: scan QR guru di awal kelas

**Q7: Bagaimana laporan bisa dicetak otomatis setiap akhir bulan?**

**A:**
- Saat ini: generate manual via `/admin/laporan`
- Future: tambah cron job/scheduled task untuk auto-generate
- Email/WA blast laporan ke wali kelas setiap tanggal 1

**Q8: Apakah bisa integrasi dengan sistem lain (misal: LMS sekolah)?**

**A:**
Ya, melalui:
- **API**: Buat REST API endpoint untuk data absensi
- **Webhook**: Kirim data real-time ke sistem lain
- **Export**: CSV/JSON untuk import ke sistem lain
- **SSO**: Single Sign-On jika sekolah punya central auth

---

### Pertanyaan Pengembangan

**Q9: Berapa lama development project ini?**

**A:**
- Planning & ERD: 1 minggu
- Coding backend: 2 minggu
- Frontend & integrasi: 1 minggu
- Testing & bug fixing: 1 minggu
- **Total: ~5 minggu**

**Q10: Apa yang paling challenging dalam project ini?**

**A:**
- **QR Code scanner**: Handling berbagai device & browser compatibility
- **Real-time validation**: Prevent double-scan dalam waktu singkat
- **WhatsApp integration**: API rate limiting & error handling
- **Database optimization**: Denormalisasi untuk query laporan cepat

---

## 📱 Bonus: Demo Preparation Checklist

### Data Dummy yang Perlu Disiapkan

```sql
-- Jurusan
INSERT INTO tb_jurusan VALUES 
(1, 'TKJ'), 
(2, 'RPL');

-- Kelas
INSERT INTO tb_kelas VALUES 
(1, 'XII', 1),
(2, 'XII', 2);

-- Siswa (generate QR untuk mereka)
INSERT INTO tb_siswa (nis, nama_siswa, id_kelas, jenis_kelamin, no_hp, unique_code) VALUES
('001', 'Andi Pratama', 1, 'Laki-laki', '081234567890', '[unique_code_1]'),
('002', 'Budi Santoso', 1, 'Laki-laki', '081234567891', '[unique_code_2]'),
('003', 'Citra Dewi', 2, 'Perempuan', '081234567892', '[unique_code_3]');

-- Guru
INSERT INTO tb_guru (nuptk, nama_guru, jenis_kelamin, alamat, no_hp, unique_code) VALUES
('12345678', 'Pak Joko', 'Laki-laki', 'Jakarta', '081234567893', '[unique_code_guru]');

-- Presensi untuk demo ubah status
INSERT INTO tb_presensi_siswa (id_siswa, id_kelas, tanggal, jam_masuk, id_kehadiran, keterangan) VALUES
(1, 1, CURDATE(), '07:30:00', 4, ''); -- Status: Tanpa Keterangan
```

### Browser Tabs yang Harus Dibuka

1. **Tab 1**: `http://localhost:8080/scan` (Scanner)
2. **Tab 2**: `http://localhost:8080/login` (Login page)
3. **Tab 3**: `http://localhost:8080/admin/dashboard` (Dashboard - logged in)
4. **Tab 4**: VS Code dengan file yang akan ditunjukkan
5. **Tab 5**: phpMyAdmin (untuk tunjukkan database jika ada pertanyaan)

---

## 🎬 Script Pembukaan & Penutup

### Pembukaan (30 detik)

```
"Selamat pagi/siang Bapak/Ibu dan teman-teman.

Perkenalkan, saya Cantika. Hari ini saya akan mempresentasikan 
project akhir mata kuliah Sistem Informasi Manajemen, yaitu 
'Sistem Absensi Sekolah Berbasis QR Code'.

Project ini bertujuan untuk mengotomatisasi proses absensi 
di sekolah yang selama ini masih manual dan memakan waktu.

Mari kita mulai dengan latar belakang masalah..."
```

### Penutup (1 menit)

```
"Jadi, kesimpulannya, sistem ini berhasil mengotomatisasi 
absensi sekolah dengan teknologi QR Code. 

Kelebihan utamanya:
1. Efisien - scan QR hanya butuh 2-3 detik
2. Real-time - data langsung masuk database
3. Terintegrasi - notifikasi WhatsApp otomatis
4. User-friendly - admin bisa kelola semua dari dashboard

Tentu saja masih ada ruang improvement, seperti mobile app 
dan analytics yang lebih advanced.

Sekian presentasi dari saya. Terima kasih atas perhatiannya.
Saya siap menjawab pertanyaan."

[Pause - tunggu pertanyaan - senyum]
```

---

**Good luck! 🍀**

Ingat: Confidence is key. Kalau ada bug saat demo, tetap tenang 
dan explain apa yang seharusnya terjadi. Audiens lebih appreciate 
penjelasan yang jelas daripada demo yang sempurna.
