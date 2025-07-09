<?php
include "../header.php";
include "../koneksi.php";

// Proses Insert
if (isset($_POST['submit'])) {
    $id_kelas       = $_POST['id_kelas'];
    $id_matkul      = $_POST['id_matkul'];
    $id_dosen       = $_POST['id_dosen'];
    $id_hari        = $_POST['id_hari'];
    $id_jam_kuliah  = $_POST['id_jam_kuliah'];
    $id_ruangan     = $_POST['id_ruangan'];
    $semester       = $_POST['semester'];
    $tahun_ajaran   = $_POST['tahun_ajaran'];

    $sql = "INSERT INTO jadwal_kuliah
            (id_kelas, id_matkul, id_dosen, id_hari, id_jam_kuliah, id_ruangan, semester, tahun_ajaran)
            VALUES
            ('$id_kelas', '$id_matkul', '$id_dosen', '$id_hari', '$id_jam_kuliah', '$id_ruangan', '$semester', '$tahun_ajaran')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Jadwal berhasil ditambahkan!
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

// Fungsi bantu untuk dropdown
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

<div class="header">
    <h4>Tambah Jadwal Kuliah</h4>
</div>

<div class="content">
    <form action="" method="POST" class="border p-4 rounded shadow">
        <div class="mb-3">
            <label for="" class="form-label">Kelas</label>
            <select name="id_kelas" class="form-control" id="">
                <option value="">-- Pilih Kelas --</option>
                <?= buildOption("kelas", "id", "nama_kelas") ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Mata Kuliah</label>
            <select name="id_matkul" class="form-control" id="">
                <option value="">-- Pilih Mata Kuliah --</option>
                <?= buildOption("matkul", "id", "namaMatkul") ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Dosen</label>
            <select name="id_dosen" class="form-control" id="">
                <option value="">-- Pilih Dosen --</option>
                <?= buildOption("dosen", "id", "namaDosen") ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Hari</label>
            <select name="id_hari" class="form-control" id="">
                <option value="">-- Pilih Hari --</option>
                <?= buildOption("hari", "id", "nama_hari") ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Jam Kuliah</label>
            <select name="id_jam_kuliah" class="form-control" id="">
                <option value="">-- Pilih Jam --</option>
                <?php 
                    $jam_result = $conn->query("SELECT id, CONCAT(jam_mulai, ' - ', jam_selesai) AS jam FROM jam_kuliah");

                    while ($jam = $jam_result->fetch_assoc()) {
                        echo "<option value='".$jam['id']."'>".$jam['jam']. "</option>";
                    }
                ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Ruangan</label>
            <select name="id_ruangan" class="form-control" id="">
                <option value="">-- Pilih Ruangan --</option>
                <?= buildOption("ruangan", "id", "nama_ruangan") ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Semester</label>
            <input type="text" name="semester" class="form-control" id="" required>
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Tahun Ajaran</label>
            <input type="text" name="tahun_ajaran" class="form-control" id="" required>
        </div>

        <div class="row">
            <div class="col-8"></div>
            <div class="col-4 text-end">
                <button type="submit" name="submit" class="btn btn-primary mb-3">Tambah Jadwal</button>
                <button type="button" class="btn btn-secondary mb-3" onclick="window.history.back()">Kembali</button>
            </div>
        </div>

    </form>
</div>

<?php include "../footer.php"?>;