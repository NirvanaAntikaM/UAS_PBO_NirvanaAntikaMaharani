<?php

require_once 'Karyawan.php';

class KaryawanTetap extends Karyawan {
    // Protected properties tambahan
    protected $tunjanganKesehatan;
    protected $opsiSahamId;

    // Constructor
    public function __construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari, $tunjanganKesehatan, $opsiSahamId) {
        parent::__construct($id_karyawan, $nama_karyawan, $departemen, $hariKerjaMasuk, $gajiDasarPerHari);
        $this->tunjanganKesehatan = $tunjanganKesehatan;
        $this->opsiSahamId = $opsiSahamId;
    }

    // Implementasi abstract method hitungGajiBersih()
    public function hitungGajiBersih() {
        // Gaji bersih = gaji dasar per hari * jumlah hari kerja + tunjangan kesehatan
        $hariKerjaBulan = 22;
        $gajiTetap = $this->gajiDasarPerHari * $hariKerjaBulan;
        
        // Tambahan tunjangan kesehatan
        $gajiDenganTunjangan = $gajiTetap + $this->tunjanganKesehatan;
        
        // Potongan pajak untuk karyawan tetap (misal 10%)
        $pajakTetap = $gajiDenganTunjangan * 0.10;
        
        $gajiBersih = $gajiDenganTunjangan - $pajakTetap;
        return $gajiBersih;
    }

    // Implementasi abstract method tampilkanProfilKaryawan()
    public function tampilkanProfilKaryawan() {
        echo "=== PROFIL KARYAWAN TETAP ===<br>";
        echo "ID Karyawan: " . $this->id_karyawan . "<br>";
        echo "Nama: " . $this->nama_karyawan . "<br>";
        echo "Departemen: " . $this->departemen . "<br>";
        echo "Hari Kerja Masuk: " . $this->hariKerjaMasuk . "<br>";
        echo "Gaji Dasar Per Hari: Rp" . number_format($this->gajiDasarPerHari, 0, ',', '.') . "<br>";
        echo "Tunjangan Kesehatan: Rp" . number_format($this->tunjanganKesehatan, 0, ',', '.') . "<br>";
        echo "Opsi Saham ID: " . $this->opsiSahamId . "<br>";
        echo "Gaji Bersih: Rp" . number_format($this->hitungGajiBersih(), 0, ',', '.') . "<br>";
        echo "==============================<br><br>";
    }

    // Getter methods untuk properti tambahan
    public function getTunjanganKesehatan() {
        return $this->tunjanganKesehatan;
    }

    public function getOpsiSahamId() {
        return $this->opsiSahamId;
    }
}

?>
