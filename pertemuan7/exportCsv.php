<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "mahasiswa";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

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