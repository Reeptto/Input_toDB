<?php 
session_start();
include "koneksi.php";

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=mhs_data.csv");

$output = fopen("php://output", "w");

fputcsv($output, ["nama_mhs", "nipd", "tgl_lahir", "alamat"]);

$sql = "SELECT nama_mhs, nipd, tgl_lahir, alamat FROM mhs";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
$conn->close();
exit;


?>