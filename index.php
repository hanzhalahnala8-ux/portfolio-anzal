<?php
include "config/database.php";
$query = mysqli_query($conn, "SELECT * FROM projects ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Anzal Portfolio</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav>
    <a href="index.php">🏠 Beranda</a>
    <a href="keuangan.php">💰 Catatan Keuangan</a>
    <a href="admin.php">➕ Tambah Proyek</a>
</nav>

<div class="container">
    <div class="card">
        <h1>Halo, Saya Anzal</h1>
        <p>Junior Web Developer | Sedang Belajar PHP & MySQL</p>
    </div>

    <h2>Daftar Proyek Saya</h2>
    <div style="display: flex; justify-content: center; gap: 20px; flex-wrap: wrap;">
        <?php while ($row = mysqli_fetch_assoc($query)) : ?>
            <div class="card" style="width: 250px; text-align: left;">
                <h3><?php echo $row['title']; ?></h3>
                <p><?php echo $row['description']; ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</div>

</body>
</html>