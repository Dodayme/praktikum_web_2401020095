USE praktikum_web_2401020095;

-- Mengisi data program studi
INSERT INTO program_studi (nama_prodi) VALUES
('Informatika'),
('Sistem Informasi');

-- Mengisi data mahasiswa
INSERT INTO mahasiswa
    (nim, nama, email, usia, program_studi_id)
VALUES
    ('2401020095', 'Dodi Bastian', 'dodi@example.com', 20, 1),
    ('2401020096', 'Andi Saputra', 'andi@example.com', 21, 1),
    ('2401020097', 'Siti Amelia', 'siti@example.com', 19, 2),
    ('2401020098', 'Rizky Pratama', 'rizky@example.com', 22, 2);

-- Menampilkan data mahasiswa
SELECT * FROM mahasiswa;

-- Menampilkan data program studi
SELECT * FROM program_studi;