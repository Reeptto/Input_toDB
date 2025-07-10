<!doctype html>
<?php 
    include "../header.php";
    $target_dir = "../uploads/";

    if (isset($_POST['submit'])) {
      $nama           = $_POST['nama'];
      $nipd           = $_POST['nipd'];
      $id_kelas       = $_POST['id_kelas'];
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
          $sql = "INSERT INTO mhs (namaMhs, NIPD, id_kelas, tanggalLahir, alamat ,photoProfile) VALUES('$nama','$nipd', '$id_kelas', '$tanggal_lahir','$alamat', '$photoProfile')";
        }else {
              echo "Sorry, there was an error uploading your file.";
          }
    }

      if ($conn->query($sql) === TRUE) {
          $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                  Data berhasil di Tambah!
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

function buildOption($table, $idField, $nameField) {
    global $conn;   
    $options = "";
    $query = "SELECT $idField, $nameField FROM $table";
    $res = $conn->query($query);
    while ($r = $res->fetch_assoc()) {
        $options .= "<option value ='". $r[$idField]."'>". $r[$nameField]."</option>";
    }
    return $options;
}
?>

      <!-- Header dengan Logout -->
      <div class="header">
        <h4>Tambah Data Mahasiswa ASE10</h4>
      </div>

        <div class="content" style="margin-top: 70px;">
            <form action="" method="POST" class="border p-4 rounded shadow" enctype="multipart/form-data">
              <div class="mb-3">
                <label for="" class="form-label">Nama</label>
                <input type="text" for="" name="nama" class="form-control" required>
              </div>

               <div class="mb-3">
                <label for="" class="form-label">Kelas</label>
                <select name="id_kelas" class="form-control" id="">
                    <option value="">-- Pilih Kelas --</option>
                    <?= buildOption("kelas", "id", "nama_kelas", $row['id_kelas']); ?>
                </select>
            </div>

              <div class="mb-3">
                <label for="" class="form-label">NIPD</label>
                <input type="text" for="" name="nipd" class="form-control" maxlength="12" required>
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Tanggal Lahir</label>
                <input type="date" for="" name="tanggal_lahir" class="form-control" max="2006-12-31" required>
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Foto Profil</label>
                <input type="file" name="photoProfile" col="3" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="" class="form-label">Alamat</label>
                <textarea name="alamat" id="" col="3" class="form-control" required></textarea>
              </div>

              <div class="row">
                <div class="col-8"></div>
                <div class="col-4 text-end">
                    <button type="submit" class="btn btn-primary mb-3" name="submit">Tambah Data</button>
                    <button type="button" class="btn btn-secondary mb-3" onclick="window.history.back()">Kembali</button>
                </div>
              </div>
            </form>
        </div>

    <?php include "../footer.php"; ?>