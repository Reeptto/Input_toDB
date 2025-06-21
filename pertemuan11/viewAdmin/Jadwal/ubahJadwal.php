<?php 
include "../header.php";
// include "../koneksi.php";
// Ambil ID jadwal yang akan diubah
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM jadwal_kuliah WHERE id ='$id'";
    $result = $conn->query($query);
    $row = $result->fetch_assoc();
}

// Proses update
if (isset($_POST['update'])) {
    $id_kelas       = $_POST['id_kelas'];
    $id_matkul      = $_POST['id_matkul'];
    $id_dosen       = $_POST['id_dosen'];
    $id_hari        = $_POST['id_hari'];
    $id_jam_kuliah  = $_POST['id_jam_kuliah'];
    $id_ruangan     = $_POST['id_ruangan'];
    $semester       = $_POST['semester'];
    $tahun_ajaran   = $_POST['tahun_ajaran'];

    $sql = "UPDATE jadwal_kuliah SET id_kelas='$id_kelas', id_matkul='$id_matkul', id_dosen='$id_dosen', id_hari='$id_hari', id_jam_kuliah='$id_jam_kuliah', semester='$semester', tahun_ajaran='$tahun_ajaran' WHERE id ='$id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Jadwal berhasil diubah!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
        $conn->close();
        header("Location: jadwal.php");
        exit();
    }else {
        $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Error : ". $sql." - ". $conn->error . "
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                        $conn->close();
                        header("Location: jadwal.php");
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
    <h4>Tambah Jadwal Kuliah</h4>
</div>

<div class="content">
    <form action="" method="POST" class="border p-4 rounded shadow">
        <div class="mb-3">
            <label for="" class="form-label">Kelas</label>
            <select name="id_kelas" class="form-control" id="">
                <option value="">-- Pilih Kelas --</option>
                <?= buildOption("kelas", "id", "nama_kelas", $row['id_kelas']); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Mata Kuliah</label>
            <select name="id_matkul" class="form-control" id="">
                <option value="">-- Pilih Mata Kuliah --</option>
                <?= buildOption("matkul", "id", "namaMatkul", $row['id_matkul']); ?>
            </select>
        </div>


        <div class="mb-3">
            <label for="" class="form-label">Dosen</label>
            <select name="id_dosen" class="form-control" id="">
                <option value="">-- Pilih Dosen --</option>
                <?= buildOption("dosen", "id", "namaDosen", $row['id_dosen']); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Hari</label>
            <select name="id_hari" class="form-control" id="">
                <option value="">-- Pilih Hari --</option>
                <?= buildOption("hari", "id", "nama_hari", $row['id_hari']); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Jam Kuliah</label>
            <select name="id_jam_kuliah" class="form-control" id="">
                <option value="">-- Pilih Jam --</option>
                <?php 
                    $jam_query = "SELECT id, CONCAT(jam_mulai, ' - ', jam_selesai) AS waktu FROM jam_kuliah";
                    $jam_result = $conn->query($jam_query);
                    while ($jam = $jam_result->fetch_assoc()) {
                        $selected = ($jam['id'] == $row['id_jam_kuliah']) ? "selected" : "";
                        echo "<option value='".$jam['id']."' $selected>".$jam['waktu']. "</option>";
                    }   
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Ruangan</label>
            <select name="id_ruangan" class="form-control" id="">
                <option value="">-- Pilih Ruangan --</option>
                <?= buildOption("ruangan", "id", "nama_ruangan", $row['id_ruangan']); ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Semester</label>
            <input type="text" name="semester" class="form-control" value="<?= $row['semester'];?>" id="" required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Tahun Ajaran</label>
            <input type="text" name="tahun_ajaran" value="<?= $row['tahun_ajaran']; ?>" class="form-control" id="" required>
        </div>

        <div class="row">
            <div class="col-8"></div>
            <div class="col-4 text-end">
                <button type="submit" name="update" class="btn btn-primary mb-3">Ubah Jadwal</button>
                <button type="button" class="btn btn-secondary mb-3" onclick="window.history.back()">Kembali</button>
            </div>
        </div>

    </form>
</div>

<?php include "../footer.php"?>;