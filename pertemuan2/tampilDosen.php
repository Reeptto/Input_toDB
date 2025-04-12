<?php
include "koneksi.php";

$sql = "SELECT nama_dosen, nid, alamat, matkul FROM dosen";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koneksi Database</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
<center>
<div class="output-data"></div>
<h3>Data Mahasiswa ASE10</h3>
    <table border="1">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NID</th>
        <th>Alamat</th>
        <th>Mata Kuliah</th>
    </tr>
    <?php 
    if ($result->num_rows> 0) {
        $i = 1;
        while($row = $result->fetch_assoc() ) {
         echo "<tr>";
         echo "<td>". $i++ ."</td>";
         echo "<td>". $row['nama_dosen']."</td>";
         echo "<td>". $row['nid']."</td>";
         echo "<td>". $row['alamat']."</td>";
         echo "<td>". $row['matkul']."</td>";
         echo "</tr>";  
        }
    }else {
        echo "<tr><td colspan='5'>Belum ada data.</td></tr>";
    }
    ?>
    </table>
</center>
</body>
</html>