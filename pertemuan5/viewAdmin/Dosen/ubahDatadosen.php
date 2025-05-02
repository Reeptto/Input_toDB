<!doctype html>
<?php 
    session_start();
    include "../koneksi.php";

    // Ambil ID mahasiswa yang akan diubah
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM dosen WHERE id = '$id'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
    }

    if (isset($_POST['update'])) {
        $nama           = $_POST['nama'];
        $nipd           = $_POST['nid'];
        $matkul         = $_POST['mataKuliah'];
        $alamat         = $_POST['alamat'];

        $sql = "UPDATE dosen SET nama='$nama', nid='$nipd', mataKuliah='$matkul', alamat='$alamat' WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    Data berhasil Di ubah!
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                  </div>";
            $conn->close();
            header("Location: tampilDosen.php");
            exit();
        } else {
            $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    Error: ".$sql." - " . $conn->error . "
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                  </div>";
            $conn->close();
            header("Location: tampilDosen.php");
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
                <input type="text" name="nama" class="form-control" value="<?php echo $row['nama']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">NID</label>
                <input type="text" name="nid" class="form-control" maxlength="12" value="<?php echo $row['nid']; ?>" required>
            </div>
            <div class="mb-3">
            <label for="" class="form-label">Mata Kuliah :</label>
                    <select name="mataKuliah" id="" class="form-control" value="<?php echo $row['mataKuliah']; ?>">
                        <option value="Database">Pilih</option>
                        <option value="Database">Database</option>
                        <option value="Web Programming 1">Web Programming 1</option>
                        <option value="Design Graphic">Design Graphic</option>
                    </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required><?php echo $row['alamat']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-warning" name="update">Update Data</button>
        </form>
    </div>

   <?php include "../footer.php"; ?>