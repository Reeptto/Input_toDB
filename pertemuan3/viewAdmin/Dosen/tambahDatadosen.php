<?php
include "../header.php";
include "../koneksi.php";

if (isset($_POST['submit'])) {

    $nama = $_POST['nama'];
    $nid = $_POST['nid'];
    $matkul = $_POST['mataKuliah'];
    $alamat = $_POST['alamat'];
    
    $sql = "INSERT into dosen (nama, nid, mataKuliah, alamat) VALUES ('$nama', '$nid', '$matkul', '$alamat')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Ditambahkan!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
    </div>";
    }else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Error: '. $sql. '<br>'. $conn->error. <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
        </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Dosen</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

    <h1 class="text-center text text-warning">Tambah Data Dosen LP3I</h1>

    <div class="container">
    <div class="row">
        <div class="col">
            <form action="" method="post" class="border border-success p-4 rounded shadow">
                <div class="mb-3">
                    <label for="" class="form-label">Nama :</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">NID :</label>
                    <input type="tel" name="nid" class="form-control" required maxlength="12">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Mata Kuliah :</label>
                    <select name="mataKuliah" id="" class="form-control">
                        <option value="Database">Pilih</option>
                        <option value="Database">Database</option>
                        <option value="Web Programming 1">Web Programming 1</option>
                        <option value="Design Graphic">Design Graphic</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Alamat :</label>
                    <textarea name="alamat" id="" class="form-control"></textarea required><br>
                </div>
                <div class="row">
                <div class="col-8"></div> 
                <div class="col-4 text-end"> 
                    <button type="submit" class="btn btn-primary mb-3" name="submit">Tambah Data</button>
                    <a href="/viewAdmin/Dosen/tampilDosen.php">
                    <button type="button" class="btn btn-secondary mb-3">Kembali</button>
                    </a>
                </div>
              </div>
                </form>
            </div>
    </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>