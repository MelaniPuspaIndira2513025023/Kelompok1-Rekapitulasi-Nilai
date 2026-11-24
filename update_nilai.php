<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:login.php');
}
include "koneksi.php";

$id = $_GET['id'];
$ambil = mysqli_query($koneksi, "SELECT * FROM nilai WHERE id_nilai='$id'");
$data = mysqli_fetch_array($ambil);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Nilai</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.2/dist/css/bootstrap.min.css">
</head>
<body>
    <?php
    if (isset($_POST['update'])) {
        $nama = $_POST['nama'];
        $mapel = $_POST['mapel'];
        $tugas = $_POST['tugas'];
        $uts = $_POST['uts'];
        $uas = $_POST['uas'];
        $nilai_akhir = ($tugas * 0.3) + ($uts * 0.3) + ($uas * 0.4);

        $query = mysqli_query($koneksi, "UPDATE nilai SET nama='$nama', mapel='$mapel', tugas='$tugas', uts='$uts', uas='$uas', nilai_akhir='$nilai_akhir' WHERE id_nilai='$id'");

        if ($query) {
            echo '<script>alert("Data nilai berhasil diupdate."); location.href="index.php";</script>';
        } else {
            echo '<script>alert("Data nilai gagal diupdate.");</script>';
        }
    }
    ?>
    <form method="post">
        <table align="center">
            <tr>
                <td colspan="2" align="center">
                    <h3>Update Nilai</h3>
                </td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><input type="text" name="nama" value="<?php echo $data['nama']; ?>" required></td>
            </tr>
            <tr>
                <td>Mapel</td>
                <td><input type="text" name="mapel" value="<?php echo $data['mapel']; ?>" required></td>
            </tr>
            <tr>
                <td>Tugas</td>
                <td><input type="number" name="tugas" value="<?php echo $data['tugas']; ?>" required></td>
            </tr>
            <tr>
                <td>UTS</td>
                <td><input type="number" name="uts" value="<?php echo $data['uts']; ?>" required></td>
            </tr>
            <tr>
                <td>UAS</td>
                <td><input type="number" name="uas" value="<?php echo $data['uas']; ?>" required></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit" name="update">Update</button>
                    <a href="index.php">Kembali</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
