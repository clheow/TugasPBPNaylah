<?php
$conn = new mysqli("localhost", "root", "", "tugas345");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

$pesan = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $stmt = $conn->prepare("DELETE FROM bunga WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        $pesan = "✅ Bunga berhasil dihapus!";
    } else {
        $pesan = "❌ Gagal menghapus.";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Bunga</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fff0f5; color: #5a2d4a; display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; }
        .card { background: white; padding: 32px 40px; border-radius: 16px; box-shadow: 0 4px 16px rgba(0,0,0,0.1); width: 320px; }
        h2 { text-align: center; color: #c2185b; }
        label { display: block; margin-bottom: 6px; font-size: 14px; }
        input { width: 100%; padding: 10px; border: 1px solid #f48fb1; border-radius: 8px; margin-bottom: 16px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #e53935; color: white; border: none; border-radius: 8px; cursor: pointer; font-size: 15px; font-weight: bold; }
        button:hover { background: #b71c1c; }
        .pesan { text-align: center; margin-bottom: 12px; font-size: 14px; }
        a { display: block; text-align: center; margin-top: 14px; color: #c2185b; text-decoration: none; font-size: 13px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>🗑️ Hapus Bunga</h2>
        <?php if ($pesan): ?><p class="pesan"><?= $pesan ?></p><?php endif; ?>
        <form method="POST">
            <label>ID Bunga</label>
            <input type="number" name="id" placeholder="Masukkan ID bunga" required>
            <button type="submit">Hapus</button>
        </form>
        <a href="../database/webview/index.php">← Kembali ke daftar</a>
    </div>
</body>
</html>
<?php $conn->close(); ?>