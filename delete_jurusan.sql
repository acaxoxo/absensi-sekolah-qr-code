-- Replace ID_JURUSAN with the actual jurusan ID you want to delete
BEGIN;

-- First delete all attendance records for students in classes of this jurusan
DELETE ps FROM tb_presensi_siswa ps
INNER JOIN tb_siswa s ON ps.id_siswa = s.id_siswa
INNER JOIN tb_kelas k ON s.id_kelas = k.id_kelas
WHERE k.id_jurusan = 4;

-- Then delete all students in classes of this jurusan
DELETE s FROM tb_siswa s
INNER JOIN tb_kelas k ON s.id_kelas = k.id_kelas
WHERE k.id_jurusan = 4;

-- Delete all classes of this jurusan
DELETE FROM tb_kelas WHERE id_jurusan = 4;

-- Finally delete the jurusan itself
DELETE FROM tb_jurusan WHERE id = 4;

COMMIT;
