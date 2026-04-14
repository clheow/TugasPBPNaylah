<?php

// ==========================
// KONFIGURASI DATABASE
// ==========================
$host = 'localhost';
$db   = 'dbBunga';
$user = 'root';
$pass = '';
$dsn  = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    // Buat tabel jika belum ada
    $pdo->exec("CREATE TABLE IF NOT EXISTS bunga (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(100) NOT NULL,
        warna VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");

} catch (PDOException $e) {
    die("Koneksi DB gagal: " . $e->getMessage());
}

// ==========================
// DATA BUNGA (array default)
// ==========================
$arrBunga = [
    ['nama' => 'Mawar',     'warna' => 'Merah Muda'],
    ['nama' => 'Melati',    'warna' => 'Putih'],
    ['nama' => 'Tulip',     'warna' => 'Ungu'],
    ['nama' => 'Anggrek',   'warna' => 'Lavender'],
    ['nama' => 'Matahari',  'warna' => 'Kuning'],
    ['nama' => 'Lavender',  'warna' => 'Ungu Muda'],
    ['nama' => 'Dahlia',    'warna' => 'Peach'],
];

// ==========================
// HANDLE POST REQUEST
// ==========================
$result_msg  = null;
$result_type = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Seed semua bunga dari array
    if (isset($_POST['action']) && $_POST['action'] === 'seed') {
        try {
            $stmt = $pdo->prepare("INSERT INTO bunga (nama, warna) VALUES (:nama, :warna)");
            foreach ($arrBunga as $b) {
                $stmt->execute([':nama' => $b['nama'], ':warna' => $b['warna']]);
            }
            $result_msg  = '🌸 Semua bunga berhasil ditanam ke database!';
            $result_type = 'success';
        } catch (Exception $e) {
            $result_msg  = 'Gagal: ' . $e->getMessage();
            $result_type = 'error';
        }
    }

    // Tambah bunga baru (1 bunga)
    if (isset($_POST['action']) && $_POST['action'] === 'tambah') {
        $nama  = trim($_POST['nama']  ?? '');
        $warna = trim($_POST['warna'] ?? '');
        if ($nama !== '') {
            try {
                $stmt = $pdo->prepare("INSERT INTO bunga (nama, warna) VALUES (:nama, :warna)");
                $stmt->execute([':nama' => $nama, ':warna' => $warna]);
                $result_msg  = "🌷 Bunga \"$nama\" berhasil ditambahkan!";
                $result_type = 'success';
            } catch (Exception $e) {
                $result_msg  = 'Gagal: ' . $e->getMessage();
                $result_type = 'error';
            }
        } else {
            $result_msg  = 'Nama bunga tidak boleh kosong.';
            $result_type = 'error';
        }
    }
}
