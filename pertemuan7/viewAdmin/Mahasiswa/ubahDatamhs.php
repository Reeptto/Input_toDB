<!doctype html>
<?php 
    session_start();
    include "../koneksi.php";
    $target_dir = "../uploads/";

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

        // Handle gambar
      $fileName = basename($_FILES["photoProfile"]["name"]);
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
      $target_file = $target_dir. $nama. ".". $imageFileType;

      // Check if file is an actual image
      $check = getimagesize($_FILES["photoProfile"]["tmp_name"]);
      if ($check !== false) {
          $uploadOk = 1;
      }else {
          echo "File is not an image.";
          $uploadOk = 0;
      }

      # Check file size
      if ($_FILES["photoProfile"]["size"] > 500000) {
        echo "Maaf, file terlalu besar";
        $uploadOk = 0;
      }

      # Allow certain file formats
      if (!in_array($imageFileType, ["jpg", "png", "jpeg", "gif"])) {
      echo "Maaf Hanya JPG, JPEG, PNG, & GIF format yang diperbolehkan";
      $uploadOk = 0;
      }

    # Process Upload
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["photoProfile"]["tmp_name"], $target_file)) {
          $photoProfile = $nama. ".". $imageFileType;
          $sql = "UPDATE mhs SET nama_mhs='$nama', nipd='$nipd', tgl_lahir='$tanggal_lahir', photoProfile='$photoProfile', alamat='$alamat' WHERE id='$id'";
        }else {
              echo "Sorry, there was an error uploading your file.";
          }
    }

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
        <form method="POST" class="border p-4 rounded shadow" enctype="multipart/form-data">
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
                <label for="" class="form-label">Foto Profil</label>
                <img src="../uploads/<?php echo $row['photoProfile']; ?>" alt="Profile Preview" style="width: 150px; height: 150px; object-fit: cover; display: block; margin-bottom: 10px;">
                <input type="file" name="photoProfile" col="3" class="form-control" required>
              </div>

            <div class="mb-3">
                <label for="" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required><?php echo $row['alamat']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-warning" name="update">Update Data</button>
        </form>
    </div>

   <?php include "../footer.php"; ?>