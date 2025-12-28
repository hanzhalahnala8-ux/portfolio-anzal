<?php
include "config/database.php";

// Cek apakah ada ID dan TIPE yang dikirim lewat URL
if (isset($_GET['id']) && isset($_GET['type'])) {
    $id = $_GET['id'];
    $type = $_GET['type'];

    if ($type == 'project') {
        // Hapus dari tabel projects
        mysqli_query($conn, "DELETE FROM projects WHERE id = $id");
        header("Location: index.php");
    } elseif ($type == 'keuangan') {
        // Hapus dari tabel keuangan
        mysqli_query($conn, "DELETE FROM keuangan WHERE id = $id");
        header("Location: keuangan.php");
    }
}
?>