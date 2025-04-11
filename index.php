<?php
include "koneksi.php";

$sql = "SELECT nama_mhs, nipd, tgl_lahir, alamat FROM mhs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koneksi Database</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

</head>
<body>
<style>
</style>
<?php

if (!empty($_POST)) {
    $nama = $_POST['nama'];
    $nipd = $_POST['nipd'];
    $tgl = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];
    
    $sql = "INSERT INTO mhs (nama_mhs, nipd, tgl_lahir, alamat, created_app)
            VALUES ('$nama', '$nipd', '$tgl', '$alamat', NOW())";
    
    if($conn->query($sql) === TRUE) {
       header("Location:index.php");
      //  exit();
    }else {
        echo "error : ". $sql. "<br>". $conn->error;
    }
}
?>
<div class="input-data">
<form action="index.php" method="POST" class="form-container">
    <h2>Input Data Mahasiswa</h2><br>
  <div class="form-group">
    <label for="nama">Nama :</label>
    <input type="text" name="nama" id="nama" required>
  </div>
  <div class="form-group">
    <label for="nipd">NIPD :</label>
    <input type="text" name="nipd" id="nipd" required>
  </div>
  <div class="form-group">
    <label for="tgl_lahir">Tanggal Lahir :</label>
    <input type="date" name="tgl_lahir" id="tgl_lahir" required>
  </div>
  <div class="form-group">
    <label for="alamat">Alamat :</label>
    <input type="text" name="alamat" id="alamat" required>
  </div>
  <button type="submit">Simpan</button>
</form>
</div>

<center>
<hr>

<div class="output-data"></div>
<h3>Data Mahasiswa ASE10</h3>
    <table border="1">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIPD</th>
        <th>Tanggal Lahir</th>
        <th>Alamat</th>
    </tr>
    <?php 
    if ($result->num_rows> 0) {
        $i = 1;
        while($row = $result->fetch_assoc() ) {
         echo "<tr>";
         echo "<td>". $i++ ."</td>";
         echo "<td>". $row['nama_mhs']."</td>";
         echo "<td>". $row['nipd']."</td>";
         echo "<td>". $row['tgl_lahir']."</td>";
         echo "<td>". $row['alamat']."</td>";
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