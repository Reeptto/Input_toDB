<?php 
    include "../koneksi.php";
    include "../header.php";

    if (isset($_POST['submit'])) {
        $matkul = $_POST['namaMatkul'];
        $deskripsi = $_POST['deskripsi'];

        $sql = "INSERT into matkul (namaMatkul, deskripsi) VALUES ('$matkul', '$deskripsi')";
    
        if ($conn->query($sql) === TRUE) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Ditambahkan!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>";
        }else {
            echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Error: '. $sql. '<br>'. $conn->error. <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
        </div>";
        }
    $conn->close();
    header("Location: tampilDatamatkul.php");
    exit();
    
    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Mata Kuliah</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
    <?php
        if (isset($_SESSION['alert'])) {
            echo $_SESSION['alert'];
            unset($_SESSION['alert']);
        }
        ?>
    <div class="header">
        <h4>Tambah Data Mata Kuliah ASE10</h4>
    </div>
            <div class="content" style="margin-top: 70px;">
                <form action="" method="POST" class="border border-success p-4 rounded shadow">
                    <div class="mb-3">
                        <label for="nama" class="mb-3">Nama Mata Kuliah : </label>
                        <input type="text" name="namaMatkul" id="" class="form-control" required>
                    </div>
        
                    <div class="mb-3">
                        <label for="Deskripsi" class="mb-3">Deskripsi : </label>
                        <input type="text" name="deskripsi" id="" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary mb-3" name="submit">Tambah Data</button>
                        <a href="/viewAdmin/MataKuliah/tampilDataMatkul.php">
                            <button type="button" class="btn btn-secondary mb-3">Kembali</button>
                        </a>    

                </form>
            </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>