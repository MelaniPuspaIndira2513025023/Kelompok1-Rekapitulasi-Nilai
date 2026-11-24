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
    <title>Rekapitulasi Nilai - Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@6.0.0-alpha.2/dist/css/bootstrap.min.css">
</head>
<body style="text-align:center;">
    <h1>Halaman Admin - Rekapitulasi Nilai</h1>
    <a href="index.php">Data Nilai</a> |
    <a href="tambah_nilai.php">Tambah Nilai</a> |
    <a href="logout.php">Logout</a>
    <hr>
    <h3>Selamat datang, <?php echo $_SESSION['user']['nama']; ?></h3>

    <table border="1" cellpadding="8" cellspacing="0" align="center">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Mapel / Matkul</th>
            <th>Tugas</th>
            <th>UTS</th>
            <th>UAS</th>
            <th>Nilai Akhir</th>
            <th>Aksi</th>
        </tr>
        <?php
        $no = 1;
        $query = mysqli_query($koneksi, "SELECT * FROM nilai");
        while ($data = mysqli_fetch_array($query)) {
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $data['nama']; ?></td>
            <td><?php echo $data['mapel']; ?></td>
            <td><?php echo $data['tugas']; ?></td>
            <td><?php echo $data['uts']; ?></td>
            <td><?php echo $data['uas']; ?></td>
            <td><?php echo $data['nilai_akhir']; ?></td>
            <td>
                <a href="update_nilai.php?id=<?php echo $data['id_nilai']; ?>">Update</a> |
                <a href="hapus_nilai.php?id=<?php echo $data['id_nilai']; ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
