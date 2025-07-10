<!doctype html>
<?php 
    include "../koneksi.php";
    include "../header.php";

    // Ambil ID mahasiswa yang akan diubah
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM dosen WHERE id = '$id'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();

    if (!$row) {
        echo "<div class='alert alert-danger'>Data dosen dengan ID $id tidak ditemukan.</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-warning'>Parameter ID tidak dikirim.</div>";
    exit();
}

    if (isset($_POST['update'])) {
        $nama           = $_POST['namaDosen'];
        $nipd           = $_POST['NID'];
        $matkul         = $_POST['mataKuliah'];
        $alamat         = $_POST['alamat'];

        $sql = "UPDATE dosen SET namaDosen='$nama', NID='$nipd', id_matkul='$matkul', alamat='$alamat' WHERE id='$id'";

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
        <h4>Ubah Data Dosen ASE10</h4>
    </div>

    <div class="content" style="margin-top: 70px;">
        <form method="POST" class="border p-4 rounded shadow">
            <div class="mb-3">
                <label for="" class="form-label">Nama</label>
                <input type="text" name="namaDosen" class="form-control" value="<?php echo $row['namaDosen']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">NID</label>
                <input type="text" name="NID" class="form-control" maxlength="12" value="<?php echo $row['NID']; ?>" required>
            </div>
            <div class="mb-3">
            <label for="" class="form-label">Mata Kuliah :</label>
                <select name="mataKuliah" class="form-control" required>
                    <option value="#" >Pilih</option>
                    <?= buildOption("matkul", "id", "namaMatkul", $row['id_matkul']); ?>
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