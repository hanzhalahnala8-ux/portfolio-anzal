<?php
include "config/database.php";

// Logika untuk menyimpan data saat tombol diklik
if (isset($_POST['tambah'])) {
    $judul = $_POST['title'];
    $deskripsi = $_POST['description'];

    $simpan = mysqli_query($conn, "INSERT INTO projects (title, description) VALUES ('$judul', '$deskripsi')");

    if ($simpan) {
        echo "<script>alert('Project Berhasil Ditambah!'); window.location='index.php';</script>";
    } else {
        echo "Gagal menyimpan: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin - Tambah Project</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        form { background: white; padding: 20px; border-radius: 10px; display: inline-block; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
        input, textarea { width: 90%; padding: 10px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; }
        button { padding: 10px 20px; background: #333; color: white; border: none; border-radius: 5px; cursor: pointer; }
        button:hover { background: #555; }
    </style>
</head>
<body>

    <h1>Tambah Project Baru</h1>
    <p><a href="index.php">⬅️ Kembali ke Beranda</a></p>

    <form action="" method="POST">
        <input type="text" name="title" placeholder="Judul Project" required>
        <br>
        <textarea name="description" placeholder="Deskripsi Project" rows="5" required></textarea>
        <br>
        <button type="submit" name="tambah">Simpan ke Portofolio</button>
    </form>

</body>
</html>