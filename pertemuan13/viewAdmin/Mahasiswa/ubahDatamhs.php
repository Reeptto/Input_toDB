<!doctype html>
<?php 
    include "../header.php";
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
        $id_kelas       = $_POST['id_kelas'];
        $nipd           = $_POST['nipd'];
        $tanggal_lahir  = $_POST['tanggal_lahir'];
        $alamat         = $_POST['alamat'];
        $photoProfile   = $row['photoProfile'];

        // Handle gambar
        if(!empty($_FILES["photoProfile"]["name"])) {
            $fileName = basename($_FILES["photoProfile"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $target_file = $target_dir. $nama. ".". $imageFileType;

            // Check if file is an actual image
            $check = getimagesize($_FILES["photoProfile"]["tmp_name"]);
            if ($check === false) {
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

                }else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }
    }else {
        
        $sql = "UPDATE mhs SET namaMhs='$nama', id_kelas='$id_kelas', NIPD='$nipd', tanggalLahir='$tanggal_lahir', photoProfile='$photoProfile', alamat='$alamat' $updateFoto WHERE id='$id'";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                                    Data berhasil Di ubah!
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                  </div>";
            $conn->close();
            header("Location: tampilDatamhs.php");
            exit();
        }else {
            $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                    Error: ".$sql." - " . $conn->error . "
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                  </div>";
            $conn->close();
            header("Location: tampilDatamhs.php");
            exit();
        }
    }
}

function buildOption($table, $idField, $nameField, $selectedId) {
    global $conn;
    $options = "";
    $query = "SELECT $idField, $nameField FROM $table";
    $res = $conn->query($query);
    while ($r = $res->fetch_assoc()) {
        $selected = ($r[$idField] == $selectedId) ? "selected" : "";
        $options .= "<option value='". $r[$idField]."' $selected>". $r[$nameField]. "</option>";
    }
    return $options;
}
?>
    <div class="header">
        <h4>Ubah Data Mahasiswa ASE10</h4>
    </div>

    <div class="content" style="margin-top: 70px;">
        <form method="POST" class="border p-4 rounded shadow" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="" class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $row['namaMhs']; ?>" required>
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
                <input type="text" name="nipd" class="form-control" maxlength="12" value="<?php echo $row['NIPD']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" class="form-control" value="<?php echo $row['tanggalLahir']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="" class="form-label">Foto Profil</label>
                <img src="../uploads/<?php echo $row['photoProfile']; ?>" alt="Profile Preview" style="width: 150px; height: 150px; object-fit: cover; display: block; margin-bottom: 10px;">
                <input type="file" name="photoProfile" col="3" class="form-control">
              </div>

            <div class="mb-3">
                <label for="" class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" required><?php echo $row['alamat']; ?></textarea>
            </div>

            <div class="row">
                <div class="col-8"></div>
                    <div class="col-4 text-end">
                        <button type="submit" name="update" class="btn btn-primary mb-3">Ubah Data</button>
                        <button type="button" class="btn btn-secondary mb-3" onclick="window.history.back()">Kembali</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

   <?php include "../footer.php"; ?>