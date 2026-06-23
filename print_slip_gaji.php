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

// Mendapatkan tanggal saat ini
$tanggal = date('d F Y');
$bulan = date('F Y');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slip Gaji - <?php echo $karyawan ? $karyawan->getNamaKaryawan() : 'Karyawan'; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: white;
            padding: 20px;
        }

        .slip-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border: 2px solid #333;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .header-slip {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }

        .header-slip h1 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
        }

        .header-slip p {
            font-size: 12px;
            color: #666;
        }

        .slip-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 20px;
            color: #333;
        }

        .period {
            text-align: center;
            font-size: 14px;
            margin-bottom: 20px;
            color: #666;
        }

        .row {
            display: flex;
            margin-bottom: 15px;
        }

        .col-left {
            width: 50%;
            padding-right: 20px;
        }

        .col-right {
            width: 50%;
            padding-left: 20px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dotted #999;
            font-size: 13px;
        }

        .info-label {
            font-weight: bold;
            color: #333;
        }

        .info-value {
            text-align: right;
            color: #333;
        }

        .section-title {
            font-weight: bold;
            color: #fff;
            background: #333;
            padding: 8px 10px;
            margin-top: 20px;
            margin-bottom: 10px;
            font-size: 13px;
        }

        .earnings-section {
            margin-top: 20px;
        }

        .deductions-section {
            margin-top: 20px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-top: 2px solid #333;
            border-bottom: 2px solid #333;
            font-weight: bold;
            font-size: 14px;
            margin-top: 20px;
        }

        .total-label {
            color: #333;
        }

        .total-value {
            text-align: right;
            color: #333;
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            margin-top: 50px;
            font-size: 12px;
        }

        .signature-item {
            width: 30%;
            text-align: center;
        }

        .signature-line {
            border-top: 1px solid #333;
            margin-top: 40px;
            padding-top: 5px;
        }

        .rupiah {
            font-weight: bold;
        }

        @media print {
            body {
                margin: 0;
                padding: 0;
                background: white;
            }

            .slip-container {
                box-shadow: none;
                border: 1px solid #333;
            }

            .no-print {
                display: none;
            }
        }

        .no-print {
            text-align: center;
            margin-top: 20px;
        }

        .btn-print {
            background: #667eea;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-print:hover {
            background: #5568d3;
        }

        .error-message {
            text-align: center;
            color: #721c24;
            background: #f8d7da;
            padding: 20px;
            border-radius: 5px;
        }

        .badge-status {
            display: inline-block;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: bold;
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
    </style>
</head>
<body>
    <?php if ($karyawan): ?>
        <div class="slip-container">
            <!-- Header -->
            <div class="header-slip">
                <h1>PT. MAJU JAYA INDONESIA</h1>
                <p>Jl. Merdeka No. 123 Jakarta Pusat - Telp: (021) 1234-5678</p>
                <p>Email: info@majujaya.com</p>
            </div>

            <!-- Judul Slip Gaji -->
            <div class="slip-title">
                SLIP GAJI
                <?php if ($tipe == 'kontrak'): ?>
                    <span class="badge-status badge-kontrak">KARYAWAN KONTRAK</span>
                <?php elseif ($tipe == 'tetap'): ?>
                    <span class="badge-status badge-tetap">KARYAWAN TETAP</span>
                <?php elseif ($tipe == 'magang'): ?>
                    <span class="badge-status badge-magang">KARYAWAN MAGANG</span>
                <?php endif; ?>
            </div>

            <div class="period">
                Periode: <?php echo $bulan; ?>
            </div>

            <!-- Informasi Karyawan -->
            <div class="row">
                <div class="col-left">
                    <div class="info-row">
                        <span class="info-label">ID Karyawan</span>
                        <span class="info-value"><?php echo $karyawan->getIdKaryawan(); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Nama</span>
                        <span class="info-value"><?php echo $karyawan->getNamaKaryawan(); ?></span>
                    </div>
                </div>
                <div class="col-right">
                    <div class="info-row">
                        <span class="info-label">Departemen</span>
                        <span class="info-value"><?php echo $karyawan->getDepartemen(); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Hari Kerja</span>
                        <span class="info-value"><?php echo $karyawan->getHariKerjaMasuk(); ?> hari</span>
                    </div>
                </div>
            </div>

            <!-- Rincian Gaji -->
            <div class="earnings-section">
                <div class="section-title">RINCIAN PENGHASILAN</div>
                
                <div class="info-row">
                    <span class="info-label">Gaji Pokok (Per Hari)</span>
                    <span class="info-value rupiah">Rp<?php echo number_format($karyawan->getGajiDasarPerHari(), 0, ',', '.'); ?></span>
                </div>

                <div class="info-row">
                    <span class="info-label">Hari Kerja Masuk</span>
                    <span class="info-value"><?php echo $karyawan->getHariKerjaMasuk(); ?> hari</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Gaji Kotor Bulan Ini</span>
                    <span class="info-value rupiah">Rp<?php echo number_format($karyawan->getHariKerjaMasuk() * $karyawan->getGajiDasarPerHari(), 0, ',', '.'); ?></span>
                </div>

                <?php if ($tipe == 'kontrak'): ?>
                    <div class="info-row">
                        <span class="info-label">Durasi Kontrak</span>
                        <span class="info-value"><?php echo $karyawan->getDurasiKontrakBulan(); ?> bulan</span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Agensi Penyalur</span>
                        <span class="info-value"><?php echo $karyawan->getAgensiPenyalur(); ?></span>
                    </div>
                <?php elseif ($tipe == 'tetap'): ?>
                    <div class="info-row">
                        <span class="info-label">Tunjangan Kesehatan</span>
                        <span class="info-value rupiah">Rp<?php echo number_format($karyawan->getTunjanganKesehatan(), 0, ',', '.'); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Opsi Saham ID</span>
                        <span class="info-value"><?php echo $karyawan->getOpsiSahamId(); ?></span>
                    </div>
                <?php elseif ($tipe == 'magang'): ?>
                    <div class="info-row">
                        <span class="info-label">Uang Saku Bulanan</span>
                        <span class="info-value rupiah">Rp<?php echo number_format($karyawan->getUangSakuBulanan(), 0, ',', '.'); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Sertifikat Kampus Merdeka</span>
                        <span class="info-value"><?php echo $karyawan->getSertifikatKampusMerdeka(); ?></span>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Gaji Bersih -->
            <div class="total-row">
                <span class="total-label">GAJI BERSIH YANG DITERIMA</span>
                <span class="total-value rupiah">Rp<?php echo number_format($karyawan->hitungGajiBersih(), 0, ',', '.'); ?></span>
            </div>

            <!-- Tanda Tangan -->
            <div class="signature-section">
                <div class="signature-item">
                    <div>Karyawan</div>
                    <div class="signature-line"></div>
                </div>
                <div class="signature-item">
                    <div>Manager HR</div>
                    <div class="signature-line"></div>
                </div>
                <div class="signature-item">
                    <div>Direktur</div>
                    <div class="signature-line"></div>
                </div>
            </div>

            <div style="text-align: center; margin-top: 30px; font-size: 12px; color: #666;">
                <p>Dokumen ini dicetak pada: <?php echo $tanggal; ?></p>
                <p>Sistem Manajemen Slip Gaji Terintegrasi</p>
            </div>
        </div>

        <div class="no-print">
            <button class="btn-print" onclick="window.print()">🖨️ Cetak Slip Gaji</button>
            <button class="btn-print" onclick="window.history.back()" style="background: #6c757d; margin-left: 10px;">← Kembali</button>
        </div>
    <?php else: ?>
        <div class="error-message">
            ❌ Data karyawan tidak ditemukan atau ID tidak valid.
        </div>
    <?php endif; ?>
</body>
</html>
