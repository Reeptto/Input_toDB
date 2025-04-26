<?php 
include "koneksi.php";
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM mhs WHERE id='$id'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $nipd = $_POST['nipd'];
    $tgl = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];

    $sql = "UPDATE mhs SET nama_mhs='$nama', nipd='$nipd', tgl_lahir='$tgl
    ', alamat='$alamat' WHERE id='$id'";

    if ($conn->query($sql) === true) {
        $_SESSION['alert'] = "<div class='alert alert-success alert-dismissable fade show' role='alert'> Data berhasil diperbarui!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
        </div>";
        $conn->close();
        header ("Location: tampilMhs.php");
        exit();
    }else {
        $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissable fade show' role='alert'> Data gagal diperbarui!
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
        </div>";
        $conn->close();
        header ("Location: tampilMhs.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    <h1 class="text-center">Ubah Data Mahasiswa ASE10</h1>
<div class="container">
    <div class="row">
        <div class="col">
            <form action="" method="post" class="border border-success p-4 rounded shadow">
            <input type="hidden" name="id" value="<?php echo $row['id'] ;?>">
                <div class="mb-3">
                    <label for="" class="form-label">Nama :</label>
                    <input type="text" name="nama" class="form-control" value="<?php echo $row['nama_mhs'];?>" required>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">NIPD :</label>
                    <input type="tel" name="nipd" class="form-control" required maxlength="12" value="<?php echo $row['nipd'];?>">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Tanggal Lahir :</label>
                    <input type="date" name="tgl_lahir" id="" class="form-control" required value="<?php echo $row['tgl_lahir'];?>" max="2006-12-31">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Alamat :</label>
                    <textarea name="alamat" id="" class="form-control" required><?php echo $row['alamat'];?></textarea><br>
                </div>

                <div>
                    <button type="submit" class="btn btn-warning" name="update">Update data</button>
                </div>
                <br>
                
                </form>
            </div>
    </div>
    </div>







<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>