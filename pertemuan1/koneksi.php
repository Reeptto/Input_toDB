<?php
# File koneksi
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mahasiswa";

# Koneksi DB
$conn = new mysqli($servername, $username, $password, $dbname );

# Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi Gagal: ". $conn->connect_error);
}