<?php
/**
 * Halaman Setup Sistem
 * File ini menjelaskan langkah-langkah setup dan testing sistem
 */
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setup Sistem Manajemen Slip Gaji</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .header h1 {
            font-size: 32px;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 16px;
            opacity: 0.9;
        }

        .content {
            padding: 40px;
        }

        .section {
            margin-bottom: 40px;
        }

        .section h2 {
            color: #667eea;
            font-size: 22px;
            margin-bottom: 15px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }

        .step {
            background: #f8f9fa;
            padding: 20px;
            margin-bottom: 15px;
            border-left: 4px solid #667eea;
            border-radius: 5px;
        }

        .step h3 {
            color: #333;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .step p {
            color: #666;
            line-height: 1.6;
        }

        .code {
            background: #2d2d2d;
            color: #f8f8f2;
            padding: 15px;
            border-radius: 5px;
            margin: 10px 0;
            font-family: 'Courier New', monospace;
            font-size: 13px;
            overflow-x: auto;
        }

        .button-group {
            display: flex;
            gap: 15px;
            margin-top: 30px;
            flex-wrap: wrap;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            text-align: center;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-success:hover {
            background: #218838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.4);
        }

        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 15px;
            margin: 15px 0;
            border-radius: 5px;
        }

        .info-box p {
            color: #1565c0;
            font-size: 14px;
            line-height: 1.6;
        }

        .feature-list {
            list-style: none;
            padding: 0;
        }

        .feature-list li {
            padding: 10px 0;
            border-bottom: 1px solid #eee;
            color: #666;
        }

        .feature-list li:before {
            content: "✅ ";
            color: #28a745;
            font-weight: bold;
            margin-right: 8px;
        }

        .file-structure {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 15px 0;
        }

        .file-structure code {
            display: block;
            color: #666;
            font-family: 'Courier New', monospace;
            line-height: 1.8;
            font-size: 13px;
        }

        .status-badge {
            display: inline-block;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
            margin-left: 10px;
        }

        .status-ready {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎯 Sistem Manajemen Slip Gaji Karyawan</h1>
            <p>Setup dan Panduan Penggunaan</p>
        </div>

        <div class="content">
            <!-- Deskripsi Sistem -->
            <div class="section">
                <h2>📋 Deskripsi Sistem</h2>
                <p style="color: #666; line-height: 1.8;">
                    Sistem Manajemen Slip Gaji Karyawan adalah aplikasi berbasis PHP yang dirancang untuk mengelola data karyawan 
                    dengan tiga kategori status ketenagakerjaan: Kontrak, Tetap, dan Magang. Sistem ini memanfaatkan konsep 
                    pemrograman berorientasi objek (OOP) seperti inheritance, polymorphism, dan abstract class untuk mengelola 
                    perbedaan perhitungan gaji antar kategori karyawan.
                </p>
            </div>

            <!-- Fitur Utama -->
            <div class="section">
                <h2>✨ Fitur Utama</h2>
                <ul class="feature-list">
                    <li>Pengelolaan data karyawan berdasarkan status ketenagakerjaan</li>
                    <li>Perhitungan gaji bersih secara otomatis menggunakan polimorfisme</li>
                    <li>Tampilan data terkelompok per kategori karyawan</li>
                    <li>Slip gaji yang dapat dicetak (print-friendly)</li>
                    <li>Detail informasi karyawan sesuai kategorinya</li>
                    <li>Antarmuka yang responsif dan modern</li>
                    <li>Database terstruktur dengan koneksi MySQLi</li>
                </ul>
            </div>

            <!-- Struktur File -->
            <div class="section">
                <h2>📁 Struktur File Sistem</h2>
                <div class="file-structure">
                    <code>
                        koneksi.php ........................... File koneksi database<br>
                        Karyawan.php .......................... Abstract class induk<br>
                        KaryawanKontrak.php ................... Subclass Karyawan Kontrak<br>
                        KaryawanTetap.php ..................... Subclass Karyawan Tetap<br>
                        KaryawanMagang.php .................... Subclass Karyawan Magang<br>
                        <br>
                        index.php ............................. Halaman utama (daftar karyawan per kategori)<br>
                        detail_karyawan.php ................... Halaman detail karyawan<br>
                        print_slip_gaji.php ................... Halaman cetak slip gaji<br>
                        setup_database.php .................... Setup dan data sample<br>
                        setup.php ............................. Panduan setup (halaman ini)<br>
                    </code>
                </div>
            </div>

            <!-- Langkah Setup -->
            <div class="section">
                <h2>🚀 Langkah-Langkah Setup</h2>

                <div class="step">
                    <h3>Step 1: Persiapan Database</h3>
                    <p>Pastikan MySQL/MariaDB sudah berjalan di server lokal Anda.</p>
                    <div class="info-box">
                        <p>Default: localhost, user: root, password: (kosong)</p>
                        <p>Jika berbeda, edit file koneksi.php</p>
                    </div>
                </div>

                <div class="step">
                    <h3>Step 2: Buat Database</h3>
                    <p>Di phpMyAdmin atau MySQL CLI, buat database dengan perintah:</p>
                    <div class="code">
                        CREATE DATABASE IF NOT EXISTS db_uas_pbo_trpl1b_nirvanaantikamaharani;<br>
                        USE db_uas_pbo_trpl1b_nirvanaantikamaharani;
                    </div>
                </div>

                <div class="step">
                    <h3>Step 3: Setup Tabel dan Data Sample</h3>
                    <p>Jalankan file setup_database.php untuk membuat tabel dan memasukkan data sample:</p>
                    <div class="button-group">
                        <a href="setup_database.php" class="btn btn-success" target="_blank">▶️ Jalankan Setup Database</a>
                    </div>
                </div>

                <div class="step">
                    <h3>Step 4: Akses Sistem</h3>
                    <p>Setelah setup selesai, akses halaman utama sistem:</p>
                    <div class="button-group">
                        <a href="index.php" class="btn btn-primary">📊 Buka Dashboard</a>
                    </div>
                </div>
            </div>

            <!-- Panduan Penggunaan -->
            <div class="section">
                <h2>📖 Panduan Penggunaan</h2>

                <div class="step">
                    <h3>Dashboard Utama (index.php)</h3>
                    <p>
                        Halaman ini menampilkan daftar semua karyawan yang terkelompok berdasarkan kategori:
                    </p>
                    <ul style="margin-left: 20px; margin-top: 10px; color: #666;">
                        <li>📋 <strong>Karyawan Kontrak</strong> - Menampilkan data dengan durasi kontrak dan agensi penyalur</li>
                        <li>💼 <strong>Karyawan Tetap</strong> - Menampilkan data dengan tunjangan kesehatan dan opsi saham</li>
                        <li>🎓 <strong>Karyawan Magang</strong> - Menampilkan data dengan uang saku dan sertifikat kampus</li>
                    </ul>
                    <p style="margin-top: 10px; color: #666;">
                        Setiap kategori menampilkan gaji bersih yang dihitung secara otomatis menggunakan method polymorphic 
                        <code>hitungGajiBersih()</code>.
                    </p>
                </div>

                <div class="step">
                    <h3>Melihat Detail Karyawan</h3>
                    <p>Klik tombol "Detail" pada baris karyawan untuk melihat informasi lengkap termasuk atribut spesifik kategorinya.</p>
                </div>

                <div class="step">
                    <h3>Cetak Slip Gaji</h3>
                    <p>Klik tombol "Cetak" untuk membuka slip gaji dalam format print-friendly yang dapat langsung dicetak ke printer.</p>
                </div>
            </div>

            <!-- Penjelasan OOP -->
            <div class="section">
                <h2>🔧 Penjelasan Konsep OOP yang Digunakan</h2>

                <div class="step">
                    <h3>1. Abstract Class (Karyawan.php)</h3>
                    <p>
                        Mendefinisikan struktur dasar dengan properti protected dan method abstract:
                    </p>
                    <ul style="margin-left: 20px; margin-top: 10px; color: #666;">
                        <li><strong>Protected Properties:</strong> id_karyawan, nama_karyawan, departemen, hariKerjaMasuk, gajiDasarPerHari</li>
                        <li><strong>Abstract Methods:</strong> hitungGajiBersih(), tampilkanProfilKaryawan()</li>
                    </ul>
                </div>

                <div class="step">
                    <h3>2. Inheritance (Pewarisan)</h3>
                    <p>
                        Ketiga subclass (KaryawanKontrak, KaryawanTetap, KaryawanMagang) mewarisi dari abstract class Karyawan 
                        dan menambahkan properti spesifik mereka sendiri.
                    </p>
                </div>

                <div class="step">
                    <h3>3. Polymorphism (Polimorfisme)</h3>
                    <p>
                        Method overriding pada hitungGajiBersih() dengan logika bisnis yang berbeda untuk setiap kategori:
                    </p>
                    <div class="code">
                        KaryawanKontrak: gaji = hariKerjaMasuk × gajiDasarPerHari<br>
                        KaryawanTetap: gaji = (hariKerjaMasuk × gajiDasarPerHari) + tunjanganKesehatan<br>
                        KaryawanMagang: gaji = (hariKerjaMasuk × gajiDasarPerHari) × 0.80
                    </div>
                </div>

                <div class="step">
                    <h3>4. Encapsulation (Enkapsulasi)</h3>
                    <p>
                        Properti dilindungi sebagai protected dan diakses melalui public getter methods untuk menjaga integritas data.
                    </p>
                </div>
            </div>

            <!-- Struktur Database -->
            <div class="section">
                <h2>🗄️ Struktur Database</h2>
                <p style="color: #666; margin-bottom: 15px;">
                    Tabel <code>karyawan</code> memiliki field-field berikut:
                </p>
                <div class="code">
                    id_karyawan (VARCHAR, Primary Key)<br>
                    nama_karyawan (VARCHAR)<br>
                    departemen (VARCHAR)<br>
                    hari_kerja_masuk (INT)<br>
                    gaji_dasar_per_hari (DECIMAL)<br>
                    status_ketenagakerjaan (VARCHAR) - Kontrak/Tetap/Magang<br>
                    <br>
                    -- Khusus Kontrak<br>
                    durasi_kontrak_bulan (INT)<br>
                    agensi_penyalur (VARCHAR)<br>
                    <br>
                    -- Khusus Tetap<br>
                    tunjangan_kesehatan (DECIMAL)<br>
                    opsi_saham_id (VARCHAR)<br>
                    <br>
                    -- Khusus Magang<br>
                    uang_saku_bulanan (DECIMAL)<br>
                    sertifikat_kampus_merdeka (VARCHAR)
                </div>
            </div>

            <!-- Tombol Navigasi -->
            <div class="section" style="text-align: center;">
                <div class="button-group" style="justify-content: center;">
                    <a href="index.php" class="btn btn-primary">📊 Buka Dashboard</a>
                    <a href="setup_database.php" class="btn btn-success">🔧 Setup Database</a>
                </div>
            </div>

            <!-- Footer -->
            <div style="text-align: center; margin-top: 40px; padding-top: 20px; border-top: 2px solid #eee; color: #999; font-size: 14px;">
                <p>Sistem Manajemen Slip Gaji Karyawan v1.0</p>
                <p>PT. Maju Jaya Indonesia</p>
            </div>
        </div>
    </div>
</body>
</html>
