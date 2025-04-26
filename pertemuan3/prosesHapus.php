<?php
session_start();
include "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM mhs WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        setAlert("success", "Data Berhasil Dihapus!");
    } else {
        setAlert("danger", "Error: " . $conn->error);
    }
} else {
    setAlert("warning", "MAHASISWA TIDAK DITEMUKAN");
}

$conn->close();
header("Location: tampilMhs.php");
exit();

function setAlert($type, $message) {
    $_SESSION['alert'] = "<div class='alert alert-$type alert-dismissible fade show' role='alert'>$message
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
    </div>";
}
?>