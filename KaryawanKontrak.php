<?php

require_once 'Karyawan.php';

class KaryawanKontrak extends Karyawan {
    // Protected properties tambahan
    protected $durasiKontrakBulan;
    protected $agensiPenyalur;

    // Constructor
    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari, $durasiKontrakBulan, $agensiPenyalur) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari);
        $this->durasiKontrakBulan = $durasiKontrakBulan;
        $this->agensiPenyalur = $agensiPenyalur;
    }

    // Implementasi abstract method hitungGajiBersih()
    public function hitungGajiBersih() {
        // Gaji bersih = gaji dasar per hari * jumlah hari kerja (contoh: 22 hari kerja per bulan)
        $hariKerjaBulan = 22;
        $gajiKontrak = $this->gajiDasarPerHari * $hariKerjaBulan;
        
        // Potongan pajak untuk karyawan kontrak (misal 5%)
        $pajakKontrak = $gajiKontrak * 0.05;
        
        $gajiBersih = $gajiKontrak - $pajakKontrak;
        return $gajiBersih;
    }

    // Implementasi abstract method tampilkanProfilKaryawan()
    public function tampilkanProfilKaryawan() {
        echo "=== PROFIL KARYAWAN KONTRAK ===<br>";
        echo "ID Karyawan: " . $this->id_karyawan . "<br>";
        echo "Nama: " . $this->nama_karyawan . "<br>";
        echo "Departemen: " . $this->departemen . "<br>";
        echo "Hari Kerja Masuk: " . $this->hariKerjaMasuk . "<br>";
        echo "Gaji Dasar Per Hari: Rp" . number_format($this->gajiDasarPerHari, 0, ',', '.') . "<br>";
        echo "Durasi Kontrak: " . $this->durasiKontrakBulan . " Bulan<br>";
        echo "Agensi Penyalur: " . $this->agensiPenyalur . "<br>";
        echo "Gaji Bersih: Rp" . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br>";
        echo "================================<br><br>";
    }

    // Getter methods untuk properti tambahan
    public function getDurasiKontrakBulan() {
        return $this->durasiKontrakBulan;
    }

    public function getAgensiPenyalur() {
        return $this->agensiPenyalur;
    }
}

?>
