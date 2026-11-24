<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
}
include "koneksi.php";

$id = $_GET['id'];
$query = mysqli_query($koneksi, "DELETE FROM nilai WHERE id_nilai='$id'");

if ($query) {
    echo '<script>alert("Data nilai berhasil dihapus."); location.href="index.php";</script>';
} else {
    echo '<script>alert("Data nilai gagal dihapus."); location.href="index.php";</script>';
}
