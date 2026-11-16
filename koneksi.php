<?php
$host = "localhost";
$user = "root";      // default XAMPP/Laragon
$pass = "";          // default kosong
$db   = "db_login";

$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
mysqli_set_charset($conn, "utf8mb4");
