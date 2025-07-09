<!doctype html>
<?php 
    include "../koneksi.php";
    include "../header.php";
    
    // Ambil ID mahasiswa yang akan diubah
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM matkul WHERE id = '$id'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
    }

    if (isset($_POST['update'])) {
        $nama           = $_POST['namaMatkul'];
        $desc           = $_POST['deskripsi'];

        $sql = "UPDATE matkul SET namaMatkul='$nama', deskripsi='$desc' WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    Data berhasil Di ubah!
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                  </div>";
            $conn->close();
            header("Location: tampilDataMatkul.php");
            exit();
        } else {
            $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    Error: ".$sql." - " . $conn->error . "
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                  </div>";
            $conn->close();
            header("Location: tampilDataMatkul.php");
            exit();
        }
    }

?>


    <div class="header">
        <h4>Ubah Data Mahasiswa ASE10</h4>
    </div>

    <div class="content" style="margin-top: 70px;">
        <form method="POST" class="border p-4 rounded shadow">
        <div class="mb-3">
            <label for="nama" class="mb-3">Nama Mata Kuliah : </label>
            <input type="text" name="namaMatkul" id="" value="<?php echo $row['namaMatkul']; ?>" class="form-control" required>
        </div>
            <div class="mb-3">
                <label for="" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required><?php echo $row['deskripsi']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-warning" name="update">Update Data</button>
            <a href="tampilDatamatkul.php"><button type="button" class="btn btn-secondary">Kembali</button></a>
        </form>
    </div>

   <?php include "../footer.php"; ?>