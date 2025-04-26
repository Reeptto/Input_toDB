<?php
session_start();
if (isset($_SESSION['alert'])) {
    echo $_SESSION['alert'];
    unset($_SESSION['alert']);
}
include "koneksi.php";
include "header.php";
include "sidebar.php";

$sql = "SELECT id, nama_mhs, nipd, tgl_lahir, alamat FROM mhs";
$result = $conn->query($sql);
?>

<h3 class="text-center">Data Mahasiswa ASE10</h3><br>
<table class="table table-success">
<thead class="thead-dark">
<tr>
    <th scope="col">No</th>
    <th scope="col">Nama</th>
    <th scope="col">NIPD</th>
    <th scope="col">Tanggal Lahir</th>
    <th scope="col">Alamat</th>
    <th scope="col">Aksi</th>
</tr>
</thead>
<?php 
if ($result->num_rows > 0) {
    $i = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<th scope='row'>" . $i++ . "</th>";
        echo "<td>" . $row['nama_mhs'] . "</td>";
        echo "<td>" . $row['nipd'] . "</td>";
        echo "<td>" . $row['tgl_lahir'] . "</td>";
        echo "<td>" . $row['alamat'] . "</td>";
        echo "<td>
        <a href='prosesUbah.php?id=" . $row['id'] . "'>
        <button class='btn btn-primary'>Ubah</button>
        </a> | <a href='prosesHapus.php?id=" . $row['id'] . "'>
        <button class='btn btn-danger'>Hapus</button></a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>Belum ada data.</td></tr>";
}
?>
</table>
<a href="tambahDatamhs.php" class="form-control"><button type="button" class="form-control btn btn-success mb-3" name="submit">Tambah Data</button></a>

<?php include "footer.php"; ?>