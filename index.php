<?php
require_once 'koneksi.php';
require_once 'Karyawan.php';
require_once 'KaryawanKontrak.php';
require_once 'KaryawanTetap.php';
require_once 'KaryawanMagang.php';

// Array untuk menyimpan objek karyawan berdasarkan kategori
$karyawanKontrak = [];
$karyawanTetap = [];
$karyawanMagang = [];

// Query untuk Karyawan Kontrak
$queryKontrak = "SELECT * FROM karyawan WHERE status_ketenagakerjaan = 'Kontrak'";
$resultKontrak = $koneksi->query($queryKontrak);

if ($resultKontrak && $resultKontrak->num_rows > 0) {
    while ($row = $resultKontrak->fetch_assoc()) {
        $karyawanKontrak[] = new KaryawanKontrak(
            $row['id_karyawan'],
            $row['nama_karyawan'],
            $row['departemen'],
            $row['hari_kerja_masuk'],
            $row['gaji_dasar_per_hari'],
            $row['durasi_kontrak_bulan'],
            $row['agensi_penyalur']
        );
    }
}

// Query untuk Karyawan Tetap
$queryTetap = "SELECT * FROM karyawan WHERE status_ketenagakerjaan = 'Tetap'";
$resultTetap = $koneksi->query($queryTetap);

if ($resultTetap && $resultTetap->num_rows > 0) {
    while ($row = $resultTetap->fetch_assoc()) {
        $karyawanTetap[] = new KaryawanTetap(
            $row['id_karyawan'],
            $row['nama_karyawan'],
            $row['departemen'],
            $row['hari_kerja_masuk'],
            $row['gaji_dasar_per_hari'],
            $row['tunjangan_kesehatan'],
            $row['opsi_saham_id']
        );
    }
}

// Query untuk Karyawan Magang
$queryMagang = "SELECT * FROM karyawan WHERE status_ketenagakerjaan = 'Magang'";
$resultMagang = $koneksi->query($queryMagang);

if ($resultMagang && $resultMagang->num_rows > 0) {
    while ($row = $resultMagang->fetch_assoc()) {
        $karyawanMagang[] = new KaryawanMagang(
            $row['id_karyawan'],
            $row['nama_karyawan'],
            $row['departemen'],
            $row['hari_kerja_masuk'],
            $row['gaji_dasar_per_hari'],
            $row['uang_saku_bulanan'],
            $row['sertifikat_kampus_merdeka']
        );
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Slip Gaji Karyawan</title>
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
            max-width: 1400px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #333;
            margin-bottom: 10px;
            font-size: 28px;
        }

        .header p {
            color: #666;
            font-size: 14px;
        }

        .section {
            background: white;
            margin-bottom: 30px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 20px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .badge {
            background: rgba(255, 255, 255, 0.3);
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: normal;
        }

        .content {
            padding: 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table thead {
            background: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
        }

        .table th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        .table td {
            padding: 15px;
            border-bottom: 1px solid #dee2e6;
            font-size: 14px;
        }

        .table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
        }

        .btn {
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 12px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: #667eea;
            color: white;
        }

        .btn-primary:hover {
            background: #5568d3;
            transform: translateY(-2px);
        }

        .btn-success {
            background: #28a745;
            color: white;
        }

        .btn-success:hover {
            background: #218838;
            transform: translateY(-2px);
        }

        .btn-info {
            background: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background: #138496;
            transform: translateY(-2px);
        }

        .empty-message {
            text-align: center;
            padding: 40px 20px;
            color: #999;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
        }

        .stat-card h3 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .stat-card p {
            font-size: 12px;
            opacity: 0.9;
        }

        .rupiah {
            font-weight: 600;
            color: #28a745;
        }

        @media print {
            body {
                background: white;
            }
            .btn, .header {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>📊 Sistem Manajemen Slip Gaji Karyawan</h1>
            <p>PT. Maju Jaya Indonesia - Manajemen Data Karyawan Dinamis</p>
        </div>

        <!-- KARYAWAN KONTRAK -->
        <div class="section">
            <div class="section-title">
                📋 Karyawan Kontrak
                <span class="badge"><?php echo count($karyawanKontrak); ?> Karyawan</span>
            </div>
            <div class="content">
                <?php if (count($karyawanKontrak) > 0): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Karyawan</th>
                                <th>Nama</th>
                                <th>Departemen</th>
                                <th>Hari Kerja</th>
                                <th>Gaji/Hari</th>
                                <th>Durasi Kontrak</th>
                                <th>Agensi Penyalur</th>
                                <th>Gaji Bersih</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($karyawanKontrak as $k): ?>
                                <tr>
                                    <td><?php echo $k->getIdKaryawan(); ?></td>
                                    <td><?php echo $k->getNamaKaryawan(); ?></td>
                                    <td><?php echo $k->getDepartemen(); ?></td>
                                    <td><?php echo $k->getHariKerjaMasuk(); ?> hari</td>
                                    <td class="rupiah">Rp<?php echo number_format($k->getGajiDasarPerHari(), 0, ',', '.'); ?></td>
                                    <td><?php echo $k->getDurasiKontrakBulan(); ?> bulan</td>
                                    <td><?php echo $k->getAgensiPenyalur(); ?></td>
                                    <td class="rupiah">Rp<?php echo number_format($k->hitungGajiBersih(), 0, ',', '.'); ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="detail_karyawan.php?id=<?php echo $k->getIdKaryawan(); ?>&tipe=kontrak" class="btn btn-info">Detail</a>
                                            <a href="print_slip_gaji.php?id=<?php echo $k->getIdKaryawan(); ?>&tipe=kontrak" class="btn btn-success" target="_blank">Cetak</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-message">
                        ℹ️ Tidak ada data Karyawan Kontrak
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- KARYAWAN TETAP -->
        <div class="section">
            <div class="section-title">
                💼 Karyawan Tetap
                <span class="badge"><?php echo count($karyawanTetap); ?> Karyawan</span>
            </div>
            <div class="content">
                <?php if (count($karyawanTetap) > 0): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Karyawan</th>
                                <th>Nama</th>
                                <th>Departemen</th>
                                <th>Hari Kerja</th>
                                <th>Gaji/Hari</th>
                                <th>Tunjangan Kesehatan</th>
                                <th>Opsi Saham ID</th>
                                <th>Gaji Bersih</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($karyawanTetap as $k): ?>
                                <tr>
                                    <td><?php echo $k->getIdKaryawan(); ?></td>
                                    <td><?php echo $k->getNamaKaryawan(); ?></td>
                                    <td><?php echo $k->getDepartemen(); ?></td>
                                    <td><?php echo $k->getHariKerjaMasuk(); ?> hari</td>
                                    <td class="rupiah">Rp<?php echo number_format($k->getGajiDasarPerHari(), 0, ',', '.'); ?></td>
                                    <td class="rupiah">Rp<?php echo number_format($k->getTunjanganKesehatan(), 0, ',', '.'); ?></td>
                                    <td><?php echo $k->getOpsiSahamId(); ?></td>
                                    <td class="rupiah">Rp<?php echo number_format($k->hitungGajiBersih(), 0, ',', '.'); ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="detail_karyawan.php?id=<?php echo $k->getIdKaryawan(); ?>&tipe=tetap" class="btn btn-info">Detail</a>
                                            <a href="print_slip_gaji.php?id=<?php echo $k->getIdKaryawan(); ?>&tipe=tetap" class="btn btn-success" target="_blank">Cetak</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-message">
                        ℹ️ Tidak ada data Karyawan Tetap
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- KARYAWAN MAGANG -->
        <div class="section">
            <div class="section-title">
                🎓 Karyawan Magang
                <span class="badge"><?php echo count($karyawanMagang); ?> Karyawan</span>
            </div>
            <div class="content">
                <?php if (count($karyawanMagang) > 0): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID Karyawan</th>
                                <th>Nama</th>
                                <th>Departemen</th>
                                <th>Hari Kerja</th>
                                <th>Gaji/Hari</th>
                                <th>Uang Saku Bulanan</th>
                                <th>Sertifikat Kampus Merdeka</th>
                                <th>Gaji Bersih</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($karyawanMagang as $k): ?>
                                <tr>
                                    <td><?php echo $k->getIdKaryawan(); ?></td>
                                    <td><?php echo $k->getNamaKaryawan(); ?></td>
                                    <td><?php echo $k->getDepartemen(); ?></td>
                                    <td><?php echo $k->getHariKerjaMasuk(); ?> hari</td>
                                    <td class="rupiah">Rp<?php echo number_format($k->getGajiDasarPerHari(), 0, ',', '.'); ?></td>
                                    <td class="rupiah">Rp<?php echo number_format($k->getUangSakuBulanan(), 0, ',', '.'); ?></td>
                                    <td><?php echo $k->getSertifikatKampusMerdeka(); ?></td>
                                    <td class="rupiah">Rp<?php echo number_format($k->hitungGajiBersih(), 0, ',', '.'); ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="detail_karyawan.php?id=<?php echo $k->getIdKaryawan(); ?>&tipe=magang" class="btn btn-info">Detail</a>
                                            <a href="print_slip_gaji.php?id=<?php echo $k->getIdKaryawan(); ?>&tipe=magang" class="btn btn-success" target="_blank">Cetak</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="empty-message">
                        ℹ️ Tidak ada data Karyawan Magang
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>
