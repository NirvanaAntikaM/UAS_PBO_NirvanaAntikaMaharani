<?php

require_once 'Karyawan.php';

class KaryawanMagang extends Karyawan {
    // Protected properties tambahan
    protected $uangSakuBulanan;
    protected $sertifikatKampusMerdeka;

    // Constructor
    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari, $uangSakuBulanan, $sertifikatKampusMerdeka) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari);
        $this->uangSakuBulanan = $uangSakuBulanan;
        $this->sertifikatKampusMerdeka = $sertifikatKampusMerdeka;
    }

    // Implementasi abstract method hitungGajiBersih()
    public function hitungGajiBersih() {
        // Gaji bersih = (hariKerjaMasuk * gajiDasarPerHari) * 0.80
        $gajiBersih = ($this->hariKerjaMasuk * $this->gajiDasarPerHari) * 0.80;
        return $gajiBersih;
    }

    // Implementasi abstract method tampilkanProfilKaryawan()
    public function tampilkanProfilKaryawan() {
        echo "=== PROFIL KARYAWAN MAGANG ===<br>";
        echo "ID Karyawan: " . $this->id_karyawan . "<br>";
        echo "Nama: " . $this->nama_karyawan . "<br>";
        echo "Departemen: " . $this->departemen . "<br>";
        echo "Hari Kerja Masuk: " . $this->hariKerjaMasuk . "<br>";
        echo "Gaji Dasar Per Hari: Rp" . number_format($this->gajiDasarPerHari, 0, ',', '.') . "<br>";
        echo "Uang Saku Bulanan: Rp" . number_format($this->uangSakuBulanan, 0, ',', '.') . "<br>";
        echo "Sertifikat Kampus Merdeka: " . $this->sertifikatKampusMerdeka . "<br>";
        echo "Gaji Bersih: Rp" . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br>";
        echo "===============================<br><br>";
    }

    // Getter methods untuk properti tambahan
    public function getUangSakuBulanan() {
        return $this->uangSakuBulanan;
    }

    public function getSertifikatKampusMerdeka() {
        return $this->sertifikatKampusMerdeka;
    }
}

?>
