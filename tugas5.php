
// ==========================
// AMBIL DATA DARI DB
// ==========================
$bunga_db = $pdo->query("SELECT * FROM bunga ORDER BY created_at DESC")->fetchAll();
$total    = count($bunga_db);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>🌸 Kebun Bungaku</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --pink:       #f9c6d0;
            --pink-dark:  #e8a0b0;
            --lilac:      #dcc6f0;
            --mint:       #c6ecd9;
            --peach:      #fddcb5;
            --cream:      #fdf6f0;
            --text:       #5a4455;
            --text-light: #9b7e90;
            --white:      #ffffff;
            --shadow:     rgba(200, 150, 170, 0.18);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'DM Sans', sans-serif;
            background-color: var(--cream);
            background-image:
                radial-gradient(circle at 10% 20%, #fde8f0 0%, transparent 40%),
                radial-gradient(circle at 90% 80%, #e8d8f8 0%, transparent 40%),
                radial-gradient(circle at 50% 50%, #d8f0e8 0%, transparent 60%);
            min-height: 100vh;
            color: var(--text);
            padding: 2rem 1rem 4rem;
        }

        /* ---- HEADER ---- */
        .header {
            text-align: center;
            margin-bottom: 2.5rem;
        }
        .header .emoji-row {
            font-size: 2rem;
            letter-spacing: 0.4rem;
            margin-bottom: 0.5rem;
            animation: float 3s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50%       { transform: translateY(-6px); }
        }
        .header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.4rem;
            color: var(--text);
            letter-spacing: 0.02em;
        }
        .header p {
            color: var(--text-light);
            font-size: 0.95rem;
            margin-top: 0.3rem;
        }
        .badge {
            display: inline-block;
            background: var(--lilac);
            color: var(--text);
            border-radius: 999px;
            padding: 0.25rem 1rem;
            font-size: 0.82rem;
            font-weight: 500;
            margin-top: 0.6rem;
        }

        /* ---- CARD CONTAINER ---- */
        .container {
            max-width: 720px;
            margin: 0 auto;
        }

        .card {
            background: rgba(255,255,255,0.75);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 1.8rem 2rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 4px 24px var(--shadow);
            border: 1px solid rgba(255,255,255,0.9);
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            margin-bottom: 1.2rem;
            color: var(--text);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* ---- BUTTONS ---- */
        .btn-group {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .btn {
            padding: 0.6rem 1.4rem;
            border: none;
            border-radius: 999px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.88rem;
            font-weight: 500;
            cursor: pointer;
            transition: transform 0.15s, box-shadow 0.15s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
        }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 6px 18px var(--shadow); }
        .btn:active { transform: translateY(0); }

        .btn-pink   { background: var(--pink);   color: var(--text); }
        .btn-lilac  { background: var(--lilac);  color: var(--text); }
        .btn-mint   { background: var(--mint);   color: var(--text); }
        .btn-peach  { background: var(--peach);  color: var(--text); }

        /* ---- FORM ---- */
        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: flex-end;
        }
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.35rem;
            flex: 1;
            min-width: 140px;
        }
        label {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--text-light);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        input[type="text"] {
            padding: 0.6rem 1rem;
            border: 1.5px solid var(--pink);
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.92rem;
            background: var(--white);
            color: var(--text);
            outline: none;
            transition: border-color 0.2s;
        }
        input[type="text"]:focus { border-color: var(--pink-dark); }

        /* ---- ALERT ---- */
        .alert {
            border-radius: 12px;
            padding: 0.9rem 1.2rem;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }
        .alert.success { background: var(--mint);  color: #2d6a4f; }
        .alert.error   { background: #fde8e8;      color: #b94a48; }

        /* ---- TABLE ---- */
        .table-wrap { overflow-x: auto; }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 0.9rem;
        }
        thead th {
            background: var(--pink);
            color: var(--text);
            padding: 0.75rem 1rem;
            text-align: left;
            font-weight: 600;
        }
        thead th:first-child { border-radius: 12px 0 0 0; }
        thead th:last-child  { border-radius: 0 12px 0 0; }
        tbody tr { transition: background 0.15s; }
        tbody tr:hover { background: rgba(249,198,208,0.18); }
        tbody td {
            padding: 0.7rem 1rem;
            border-bottom: 1px solid rgba(220,198,240,0.3);
            color: var(--text);
        }

        .pill {
            display: inline-block;
            padding: 0.2rem 0.75rem;
            border-radius: 999px;
            font-size: 0.78rem;
            background: var(--lilac);
            color: var(--text);
        }

        .empty-state {
            text-align: center;
            padding: 2rem;
            color: var(--text-light);
        }
        .empty-state span { font-size: 2.5rem; display: block; margin-bottom: 0.5rem; }

        /* ---- FOOTER ---- */
        .footer {
            text-align: center;
            color: var(--text-light);
            font-size: 0.8rem;
            margin-top: 2rem;
        }
    </style>
</head>
<body>

<div class="container">

    <!-- HEADER -->
    <div class="header">
        <div class="emoji-row">🌸 🌷 🌼 🌺 🌻</div>
        <h1>Kebun Bungaku</h1>
        <p>Catat dan kelola bunga yang kamu tanam</p>
        <span class="badge">🌿 <?= $total ?> bunga tersimpan</span>
    </div>

    <!-- ALERT -->
    <?php if ($result_msg): ?>
        <div class="alert <?= $result_type ?>">
            <?= htmlspecialchars($result_msg) ?>
        </div>
    <?php endif; ?>

    <!-- AKSI CEPAT -->
    <div class="card">
        <div class="card-title">🪴 Aksi Cepat</div>
        <div class="btn-group">
            <form method="POST" style="display:inline;">
                <button class="btn btn-pink" type="submit" name="action" value="seed">
                    🌸 Seed Bunga Default
                </button>
            </form>
            <a href="/" class="btn btn-mint">🔄 Refresh</a>
        </div>
        <p style="font-size:0.8rem; color:var(--text-light); margin-top:0.8rem;">
            * Seed akan memasukkan <?= count($arrBunga) ?> bunga dari array default ke database.
        </p>
    </div>

    <!-- FORM TAMBAH BUNGA -->
    <div class="card">
        <div class="card-title">✏️ Tambah Bunga Baru</div>
        <form method="POST">
            <input type="hidden" name="action" value="tambah">
            <div class="form-row">
                <div class="form-group">
                    <label>Nama Bunga</label>
                    <input type="text" name="nama" placeholder="cth: Kamelia" required>
                </div>
                <div class="form-group">
                    <label>Warna</label>
                    <input type="text" name="warna" placeholder="cth: Merah Muda">
                </div>
                <button class="btn btn-peach" type="submit" style="margin-bottom:0.05rem;">
                    🌷 Tambahkan
                </button>
            </div>
        </form>
    </div>

    <!-- TABEL DATA -->
    <div class="card">
        <div class="card-title">🌺 Daftar Bunga di Database</div>
        <div class="table-wrap">
            <?php if (empty($bunga_db)): ?>
                <div class="empty-state">
                    <span>🌱</span>
                    Belum ada bunga. Yuk mulai tanam!
                </div>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Bunga</th>
                            <th>Warna</th>
                            <th>Ditanam</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($bunga_db as $i => $b): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><strong><?= htmlspecialchars($b['nama']) ?></strong></td>
                                <td><span class="pill"><?= htmlspecialchars($b['warna'] ?: '-') ?></span></td>
                                <td style="color:var(--text-light); font-size:0.82rem;">
                                    <?= date('d M Y, H:i', strtotime($b['created_at'])) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer">made with 🌸 &nbsp;·&nbsp; Kebun Bungaku &copy; <?= date('Y') ?></div>

</div>
</body>
</html>