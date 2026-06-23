<?php
require_once 'koneksi.php';
require_once 'Karyawan.php';
require_once 'KaryawanKontrak.php';
require_once 'KaryawanTetap.php';
require_once 'KaryawanMagang.php';

$id_karyawan = isset($_GET['id']) ? $_GET['id'] : null;
$tipe = isset($_GET['tipe']) ? $_GET['tipe'] : null;
$karyawan = null;

if ($id_karyawan && $tipe) {
    // Query berdasarkan tipe
    if ($tipe == 'kontrak') {
        $query = "SELECT * FROM karyawan WHERE id_karyawan = '$id_karyawan' AND status_ketenagakerjaan = 'Kontrak'";
        $result = $koneksi->query($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $karyawan = new KaryawanKontrak(
                $row['id_karyawan'],
                $row['nama_karyawan'],
                $row['departemen'],
                $row['hari_kerja_masuk'],
                $row['gaji_dasar_per_hari'],
                $row['durasi_kontrak_bulan'],
                $row['agensi_penyalur']
            );
        }
    } elseif ($tipe == 'tetap') {
        $query = "SELECT * FROM karyawan WHERE id_karyawan = '$id_karyawan' AND status_ketenagakerjaan = 'Tetap'";
        $result = $koneksi->query($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $karyawan = new KaryawanTetap(
                $row['id_karyawan'],
                $row['nama_karyawan'],
                $row['departemen'],
                $row['hari_kerja_masuk'],
                $row['gaji_dasar_per_hari'],
                $row['tunjangan_kesehatan'],
                $row['opsi_saham_id']
            );
        }
    } elseif ($tipe == 'magang') {
        $query = "SELECT * FROM karyawan WHERE id_karyawan = '$id_karyawan' AND status_ketenagakerjaan = 'Magang'";
        $result = $koneksi->query($query);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $karyawan = new KaryawanMagang(
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
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Karyawan</title>
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
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .header a {
            color: #667eea;
            text-decoration: none;
            font-size: 14px;
        }

        .header a:hover {
            text-decoration: underline;
        }

        .detail-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .detail-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            text-align: center;
        }

        .detail-header h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .detail-header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .detail-body {
            padding: 30px;
        }

        .info-group {
            margin-bottom: 25px;
        }

        .info-group h3 {
            color: #667eea;
            font-size: 16px;
            margin-bottom: 15px;
            border-bottom: 2px solid #667eea;
            padding-bottom: 10px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-weight: 600;
            color: #333;
            width: 40%;
        }

        .info-value {
            color: #666;
            width: 60%;
            text-align: right;
        }

        .rupiah {
            color: #28a745;
            font-weight: 600;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 30px;
            justify-content: center;
        }

        .btn {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn-back {
            background: #6c757d;
            color: white;
        }

        .btn-back:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .btn-print {
            background: #28a745;
            color: white;
        }

        .btn-print:hover {
            background: #218838;
            transform: translateY(-2px);
        }

        .badge {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            margin-top: 10px;
        }

        .badge-kontrak {
            background: #ffc107;
            color: #000;
        }

        .badge-tetap {
            background: #28a745;
            color: white;
        }

        .badge-magang {
            background: #17a2b8;
            color: white;
        }

        .error-message {
            background: #f8d7da;
            color: #721c24;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="index.php">← Kembali ke Daftar</a>
        </div>

        <?php if ($karyawan): ?>
            <div class="detail-card">
                <div class="detail-header">
                    <h1><?php echo $karyawan->getNamaKaryawan(); ?></h1>
                    <p><?php echo $karyawan->getDepartemen(); ?></p>
                    <?php if ($tipe == 'kontrak'): ?>
                        <span class="badge badge-kontrak">Karyawan Kontrak</span>
                    <?php elseif ($tipe == 'tetap'): ?>
                        <span class="badge badge-tetap">Karyawan Tetap</span>
                    <?php elseif ($tipe == 'magang'): ?>
                        <span class="badge badge-magang">Karyawan Magang</span>
                    <?php endif; ?>
                </div>

                <div class="detail-body">
                    <!-- Informasi Dasar -->
                    <div class="info-group">
                        <h3>📋 Informasi Dasar</h3>
                        <div class="info-row">
                            <span class="info-label">ID Karyawan</span>
                            <span class="info-value"><?php echo $karyawan->getIdKaryawan(); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Nama</span>
                            <span class="info-value"><?php echo $karyawan->getNamaKaryawan(); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Departemen</span>
                            <span class="info-value"><?php echo $karyawan->getDepartemen(); ?></span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Hari Kerja Masuk</span>
                            <span class="info-value"><?php echo $karyawan->getHariKerjaMasuk(); ?> hari</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Gaji Dasar Per Hari</span>
                            <span class="info-value rupiah">Rp<?php echo number_format($karyawan->getGajiDasarPerHari(), 0, ',', '.'); ?></span>
                        </div>
                    </div>

                    <!-- Informasi Spesifik berdasarkan Tipe Karyawan -->
                    <?php if ($tipe == 'kontrak'): ?>
                        <div class="info-group">
                            <h3>📝 Informasi Kontrak</h3>
                            <div class="info-row">
                                <span class="info-label">Durasi Kontrak</span>
                                <span class="info-value"><?php echo $karyawan->getDurasiKontrakBulan(); ?> bulan</span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Agensi Penyalur</span>
                                <span class="info-value"><?php echo $karyawan->getAgensiPenyalur(); ?></span>
                            </div>
                        </div>
                    <?php elseif ($tipe == 'tetap'): ?>
                        <div class="info-group">
                            <h3>💼 Informasi Karyawan Tetap</h3>
                            <div class="info-row">
                                <span class="info-label">Tunjangan Kesehatan</span>
                                <span class="info-value rupiah">Rp<?php echo number_format($karyawan->getTunjanganKesehatan(), 0, ',', '.'); ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Opsi Saham ID</span>
                                <span class="info-value"><?php echo $karyawan->getOpsiSahamId(); ?></span>
                            </div>
                        </div>
                    <?php elseif ($tipe == 'magang'): ?>
                        <div class="info-group">
                            <h3>🎓 Informasi Magang</h3>
                            <div class="info-row">
                                <span class="info-label">Uang Saku Bulanan</span>
                                <span class="info-value rupiah">Rp<?php echo number_format($karyawan->getUangSakuBulanan(), 0, ',', '.'); ?></span>
                            </div>
                            <div class="info-row">
                                <span class="info-label">Sertifikat Kampus Merdeka</span>
                                <span class="info-value"><?php echo $karyawan->getSertifikatKampusMerdeka(); ?></span>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Informasi Gaji -->
                    <div class="info-group">
                        <h3>💰 Informasi Gaji</h3>
                        <div class="info-row">
                            <span class="info-label">Gaji Bersih</span>
                            <span class="info-value rupiah">Rp<?php echo number_format($karyawan->hitungGajiBersih(), 0, ',', '.'); ?></span>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <a href="index.php" class="btn btn-back">Kembali</a>
                        <a href="print_slip_gaji.php?id=<?php echo $karyawan->getIdKaryawan(); ?>&tipe=<?php echo $tipe; ?>" class="btn btn-print" target="_blank">🖨️ Cetak Slip Gaji</a>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="error-message">
                ❌ Data karyawan tidak ditemukan atau ID tidak valid.
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
