<?php
echo "<h1>Helloww, server ini udah bisa dijalankan</h1>";
$host = "localhost";
$user = "root";
$pass = "";
$db   = "tugas345";
try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM users");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Users</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f4f4;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            max-width: 500px;
            margin: auto;
        }
        h2 {
            text-align: center;
        }
        .user {
            padding: 10px;
            margin: 5px 0;
            background: #eaeaea;
            border-radius: 5px;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Daftar Users</h2>
    <?php foreach ($users as $user): ?>
        <div class="user">
            ID: <?= $user['id']; ?> <br>
            Nama: <?= $user['nama']; ?>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
