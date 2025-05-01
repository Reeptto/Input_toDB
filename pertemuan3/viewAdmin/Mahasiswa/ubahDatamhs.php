<!doctype html>
<?php 
    session_start();
    include "../koneksi.php";

    // Ambil ID mahasiswa yang akan diubah
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM mhs WHERE id = '$id'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
    }

    if (isset($_POST['update'])) {
        $nama           = $_POST['nama'];
        $nipd           = $_POST['nipd'];
        $tanggal_lahir  = $_POST['tanggal_lahir'];
        $alamat         = $_POST['alamat'];

        $sql = "UPDATE mhs SET nama_mhs='$nama', nipd='$nipd', tgl_lahir='$tanggal_lahir', alamat='$alamat' WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    Data berhasil Di ubah!
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                  </div>";
            $conn->close();
            header("Location: tampilDatamhs.php");
            exit();
        } else {
            $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    Error: ".$sql." - " . $conn->error . "
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                  </div>";
            $conn->close();
            header("Location: tampilDatamhs.php");
            exit();
        }
    }

?>
   <?php include "../header.php"; ?>

    <div class="header">
        <h4>Ubah Data Mahasiswa ASE10</h4>
    </div>

    <div class="content" style="margin-top: 70px;">
        <form method="POST" class="border p-4 rounded shadow">
            <div class="mb-3">
                <label for="" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $row['nama_mhs']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">NIPD</label>
                <input type="text" name="nipd" class="form-control" maxlength="12" value="<?php echo $row['nipd']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $row['tgl_lahir']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required><?php echo $row['alamat']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-warning" name="update">Update Data</button>
        </form>
    </div>

   <?php include "../footer.php"; ?>