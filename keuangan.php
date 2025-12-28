<?php
include "config/database.php";

if (isset($_POST['simpan'])) {
    $ket = $_POST['keterangan'];
    $jml = $_POST['jumlah'];
    $tipe = $_POST['tipe'];
    mysqli_query($conn, "INSERT INTO keuangan (keterangan, jumlah, tipe) VALUES ('$ket', '$jml', '$tipe')");
    header("Location: keuangan.php");
}

$data = mysqli_query($conn, "SELECT * FROM keuangan ORDER BY tanggal DESC");
$total_masuk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) as total FROM keuangan WHERE tipe='masuk'"))['total'] ?? 0;
$total_keluar = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(jumlah) as total FROM keuangan WHERE tipe='keluar'"))['total'] ?? 0;
$saldo_akhir = $total_masuk - $total_keluar;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Catatan Keuangan</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<nav>
    <a href="index.php">🏠 Beranda</a>
    <a href="keuangan.php">💰 Catatan Keuangan</a>
    <a href="admin.php">➕ Tambah Proyek</a>
</nav>

<div class="container">
    <h1>Catatan Keuangan Pribadi</h1>
    
    <div class="card" style="display: inline-block;">
        <h3>Total Saldo</h3>
        <p style="font-size: 24px; color: #007bff; font-weight: bold;">Rp <?php echo number_format($saldo_akhir); ?></p>
    </div>

    <div class="card">
        <form action="" method="POST">
            <input type="text" name="keterangan" placeholder="Keterangan" required style="padding: 8px;">
            <input type="number" name="jumlah" placeholder="Jumlah" required style="padding: 8px;">
            <select name="tipe" style="padding: 8px;">
                <option value="masuk">Uang Masuk</option>
                <option value="keluar">Uang Keluar</option>
            </select>
            <button type="submit" name="simpan" style="padding: 8px 15px; background: #333; color: white; border: none; border-radius: 4px; cursor: pointer;">Tambah</button>
        </form>
    </div>

    <table style="width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <tr style="background: #333; color: white;">
            <th style="padding: 12px;">Keterangan</th>
            <th>Jumlah</th>
            <th>Tipe</th>
            <th>Aksi</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($data)): ?>
        <tr style="border-bottom: 1px solid #eee;">
            <td style="padding: 12px;"><?php echo $row['keterangan']; ?></td>
            <td>Rp <?php echo number_format($row['jumlah']); ?></td>
            <td style="color: <?php echo ($row['tipe'] == 'masuk' ? 'green' : 'red'); ?>; font-weight: bold;">
                <?php echo strtoupper($row['tipe']); ?>
            </td>
            <td>
                <a href="hapus.php?id=<?php echo $row['id']; ?>&type=keuangan" 
                   onclick="return confirm('Yakin ingin menghapus data ini?')" 
                   style="color: white; background: #dc3545; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 12px;">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

</body>
</html>