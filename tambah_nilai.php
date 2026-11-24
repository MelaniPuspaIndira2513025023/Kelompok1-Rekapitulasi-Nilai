<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
}
include "koneksi.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Nilai</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.2/dist/css/bootstrap.min.css">
</head>
<body>
    <?php
    if (isset($_POST['simpan'])) {
        $nama = $_POST['nama'];
        $mapel = $_POST['mapel'];
        $tugas = $_POST['tugas'];
        $uts = $_POST['uts'];
        $uas = $_POST['uas'];
        $nilai_akhir = ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);

        $query = mysqli_query($koneksi, "INSERT INTO nilai(nama, mapel, tugas, uts, uas, nilai_akhir) VALUES('$nama', '$mapel', '$tugas', '$uts', '$uas', '$nilai_akhir')");

        if ($query) {
            echo '<script>alert("Data nilai berhasil disimpan."); location.href="index.php";</script>';
        } else {
            echo '<script>alert("Data nilai gagal disimpan.");</script>';
        }
    }
    ?>
    <form method="post">
        <table align="center">
            <tr>
                <td colspan="2" align="center">
                    <h3>Tambah Nilai</h3>
                </td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" required></td>
            </tr>
            <tr>
                <td>Mapel</td>
                <td><input type="text" name="mapel" required></td>
            </tr>
            <tr>
                <td>Tugas</td>
                <td><input type="number" name="tugas" required></td>
            </tr>
            <tr>
                <td>UTS</td>
                <td><input type="number" name="uts" required></td>
            </tr>
            <tr>
                <td>UAS</td>
                <td><input type="number" name="uas" required></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="simpan">Simpan</button>
                    <a href="index.php">Kembali</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
