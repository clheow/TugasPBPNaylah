<?php
$conn = new mysqli("localhost", "root", "", "tugas345");
if ($conn->connect_error) die("Koneksi gagal: " . $conn->connect_error);

$result = $conn->query("SELECT * FROM bunga ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kebun Bunga</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #fff0f5; color: #5a2d4a; margin: 0; padding: 20px; }
        h2 { text-align: center; color: #c2185b; }
        table { width: 100%; border-collapse: collapse; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); }
        th { background: #f48fb1; color: white; padding: 12px; }
        td { padding: 10px; text-align: center; border-bottom: 1px solid #fce4ec; }
        tr:last-child td { border-bottom: none; }
        a { display: block; text-align: center; margin-top: 16px; color: #c2185b; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>
    <h2>🌸 Daftar Bunga Saya</h2>
    <table>
        <tr><th>No</th><th>Nama Bunga</th><th>Tanggal Tanam</th></tr>
        <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($row['nama_bunga']) ?></td>
            <td><?= $row['tanggal_tanam'] ?? '-' ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="../cli_create_user.php">+ Tambah Bunga</a>
</body>
</html>
<?php $conn->close(); ?>