<!doctype html>
<?php 
    session_start();
    include "../koneksi.php";

    // Ambil ID mahasiswa yang akan diubah
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM matkul WHERE id = '$id'";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
    }

    if (isset($_POST['update'])) {
        $nama           = $_POST['nama'];
        $desc           = $_POST['deskripsi'];

        $sql = "UPDATE matkul SET nama='$nama', deskripsi='$desc' WHERE id='$id'";

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
   <?php include "../header.php"; ?>

    <div class="header">
        <h4>Ubah Data Mahasiswa ASE10</h4>
    </div>

    <div class="content" style="margin-top: 70px;">
        <form method="POST" class="border p-4 rounded shadow">
        <label for="nama" class="mb-3">Nama Mata Kuliah : </label>
                        <select name="nama" id="" class="form-control" required value="<?php echo $row['nama']; ?>">
                            <option value="">None</option>
                            <option value="Database Administration">Database Administration</option>
                            <option value="Web Programming 1">Web Programming 1</option>
                            <option value="Computer For Networking 1">Computer For Networking 1</option>
                            <option value="Design Graphic">Design Graphic</option>
                        </select>
            <div class="mb-3">
                <label for="" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" required><?php echo $row['deskripsi']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-warning" name="update">Update Data</button>
        </form>
    </div>

   <?php include "../footer.php"; ?>