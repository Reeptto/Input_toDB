<?php
include "koneksi.php";

$sql = "SELECT nama, deskripsi FROM matkul";
$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Matkul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

</head>
<body class="text-center"   >
<h1 class="mt-3">Data Mata Kuliah ASE10</h1>
    <table class="table">
    <tr>
        <th scope="col">No </th>
        <th scope="col">Mata Kuliah</th>
        <th scope="col">Deskripsi</th>
    </tr>
    <?php 
    if ($result->num_rows > 0) {
        $i = 1;
        while ($row = $result->fetch_assoc() ) {
            echo "<tr>";
            echo "<td>". $i++ ."</td>";
            echo "<td>". $row['nama']. "</td>";
            echo "<td>". $row['deskripsi']. "</td>";
            echo "</tr>";
        }
    }else {
        echo "<tr><td colspan='5'>Belum ada data.</td></tr>";
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

</body>
</html>