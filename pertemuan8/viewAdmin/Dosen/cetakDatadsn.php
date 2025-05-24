<?php 
session_start();
include "../koneksi.php";

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=dsn_data.csv");

$output = fopen("php://output", "w");

fputcsv($output, ["nama", "nid", "mataKuliah", "alamat"]);

$sql = "SELECT nama, nid, mataKuliah, alamat FROM dosen";
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