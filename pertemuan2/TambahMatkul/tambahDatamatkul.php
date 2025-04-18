<?php 
    include "koneksi.php";

    if (!empty($_POST)) {
        $matkul = $_POST['matkul'];
        $deskripsi = $_POST['deskripsi'];

        $sql = "INSERT into matkul (nama, deskripsi) VALUES ('$matkul', '$deskripsi')";
    
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
    <title>Tambah Data Mata Kuliah</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>
<body>
<h1 class="text-center text text-success">Tambah Data Matkul</h1>
    <div class="container">
        <div class="row">
            <div class="col">
                <form action="" method="POST" class="border border-success p-4 rounded shadow">
                    <div class="mt-3">
                        <label for="nama" class="mb-3">Nama Mata Kuliah : </label>
                        <select name="matkul" id="" class="form-control" required>
                            <option value="">None</option>
                            <option value="Database Administration">Database Administration</option>
                            <option value="Web Programming 1">Web Programming 1</option>
                            <option value="Computer For Networking 1">Computer For Networking 1</option>
                            <option value="Design Graphic">Design Graphic</option>
                        </select><br><br>
                    </div>
        
                    <div class="mb-3">
                        <label for="Deskripsi" class="mb-3">Deskripsi : </label>
                        <input type="text" name="deskripsi" id="" class="form-control" required>
                    </div>

                    <div>
                        <button type="submit" name="submit" class="btn btn-danger">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>
</html>