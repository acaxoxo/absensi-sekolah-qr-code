-- Replace ID_KELAS with the actual class ID
BEGIN;
DELETE FROM tb_presensi_siswa WHERE id_kelas = ID_KELAS;
DELETE FROM tb_siswa WHERE id_kelas = ID_KELAS;
DELETE FROM tb_kelas WHERE id_kelas = ID_KELAS;
COMMIT;
