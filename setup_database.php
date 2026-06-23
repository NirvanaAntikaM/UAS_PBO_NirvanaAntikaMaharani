<?php
/**
 * File untuk membuat struktur database
 * Jalankan script ini di phpMyAdmin atau MySQL CLI untuk membuat tabel
 */

require_once 'koneksi.php';

// Buat tabel karyawan
$sql = "CREATE TABLE IF NOT EXISTS karyawan (
    id_karyawan VARCHAR(10) PRIMARY KEY,
    nama_karyawan VARCHAR(100) NOT NULL,
    departemen VARCHAR(50) NOT NULL,
    hari_kerja_masuk INT NOT NULL,
    gaji_dasar_per_hari DECIMAL(12, 2) NOT NULL,
    status_ketenagakerjaan VARCHAR(20) NOT NULL,
    
    -- Khusus Karyawan Kontrak
    durasi_kontrak_bulan INT,
    agensi_penyalur VARCHAR(100),
    
    -- Khusus Karyawan Tetap
    tunjangan_kesehatan DECIMAL(12, 2),
    opsi_saham_id VARCHAR(50),
    
    -- Khusus Karyawan Magang
    uang_saku_bulanan DECIMAL(12, 2),
    sertifikat_kampus_merdeka VARCHAR(100),
    
    tanggal_input TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    tanggal_update TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

if ($koneksi->query($sql) === TRUE) {
    echo "✅ Tabel karyawan berhasil dibuat atau sudah ada.<br>";
} else {
    echo "❌ Error membuat tabel: " . $koneksi->error . "<br>";
}

// Data sample untuk testing
$sampleData = [
    // Karyawan Kontrak
    [
        'id' => 'K001',
        'nama' => 'Budi Santoso',
        'dept' => 'IT',
        'hari' => 22,
        'gaji' => 100000,
        'status' => 'Kontrak',
        'durasi' => 12,
        'agensi' => 'PT Kontak Kerja',
        'tunjangan' => NULL,
        'opsi' => NULL,
        'saku' => NULL,
        'sertif' => NULL
    ],
    [
        'id' => 'K002',
        'nama' => 'Siti Nurhaliza',
        'dept' => 'Marketing',
        'hari' => 20,
        'gaji' => 80000,
        'status' => 'Kontrak',
        'durasi' => 6,
        'agensi' => 'PT Manpower',
        'tunjangan' => NULL,
        'opsi' => NULL,
        'saku' => NULL,
        'sertif' => NULL
    ],
    
    // Karyawan Tetap
    [
        'id' => 'T001',
        'nama' => 'Ahmad Wijaya',
        'dept' => 'IT',
        'hari' => 22,
        'gaji' => 150000,
        'status' => 'Tetap',
        'durasi' => NULL,
        'agensi' => NULL,
        'tunjangan' => 300000,
        'opsi' => 'OPT001',
        'saku' => NULL,
        'sertif' => NULL
    ],
    [
        'id' => 'T002',
        'nama' => 'Rini Handayani',
        'dept' => 'HR',
        'hari' => 22,
        'gaji' => 120000,
        'status' => 'Tetap',
        'durasi' => NULL,
        'agensi' => NULL,
        'tunjangan' => 250000,
        'opsi' => 'OPT002',
        'saku' => NULL,
        'sertif' => NULL
    ],
    
    // Karyawan Magang
    [
        'id' => 'M001',
        'nama' => 'Andi Pratama',
        'dept' => 'IT',
        'hari' => 20,
        'gaji' => 50000,
        'status' => 'Magang',
        'durasi' => NULL,
        'agensi' => NULL,
        'tunjangan' => NULL,
        'opsi' => NULL,
        'saku' => 1000000,
        'sertif' => 'Kampus Merdeka - Periode 2024'
    ],
    [
        'id' => 'M002',
        'nama' => 'Dewi Kusuma',
        'dept' => 'Marketing',
        'hari' => 18,
        'gaji' => 40000,
        'status' => 'Magang',
        'durasi' => NULL,
        'agensi' => NULL,
        'tunjangan' => NULL,
        'opsi' => NULL,
        'saku' => 800000,
        'sertif' => 'Kampus Merdeka - Periode 2024'
    ]
];

// Insert sample data
$inserted = 0;
foreach ($sampleData as $data) {
    $sql = "INSERT IGNORE INTO karyawan 
            (id_karyawan, nama_karyawan, departemen, hari_kerja_masuk, gaji_dasar_per_hari, 
             status_ketenagakerjaan, durasi_kontrak_bulan, agensi_penyalur, tunjangan_kesehatan, 
             opsi_saham_id, uang_saku_bulanan, sertifikat_kampus_merdeka) 
            VALUES 
            ('{$data['id']}', '{$data['nama']}', '{$data['dept']}', {$data['hari']}, {$data['gaji']}, 
             '{$data['status']}', {$data['durasi']}, " . 
            ($data['agensi'] ? "'{$data['agensi']}'" : "NULL") . ", " .
            ($data['tunjangan'] ? "{$data['tunjangan']}" : "NULL") . ", " .
            ($data['opsi'] ? "'{$data['opsi']}'" : "NULL") . ", " .
            ($data['saku'] ? "{$data['saku']}" : "NULL") . ", " .
            ($data['sertif'] ? "'{$data['sertif']}'" : "NULL") . ")";
    
    if ($koneksi->query($sql) === TRUE) {
        $inserted++;
    } else {
        if (strpos($koneksi->error, 'Duplicate') === false) {
            echo "⚠️ Warning: " . $koneksi->error . "<br>";
        }
    }
}

if ($inserted > 0) {
    echo "✅ $inserted data sample berhasil dimasukkan.<br>";
} else {
    echo "ℹ️ Data sudah ada atau tidak ada data baru yang dimasukkan.<br>";
}

echo "<br>";
echo "✅ Setupup database selesai!<br>";
echo "📋 Silakan akses index.php untuk melihat daftar karyawan<br>";

$koneksi->close();
?>
