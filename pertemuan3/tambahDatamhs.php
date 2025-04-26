<?php
session_start();
include "koneksi.php";
include "header.php";

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $nipd = $_POST['nipd'];
    $tgl = $_POST['tgl_lahir'];
    $alamat = $_POST['alamat'];

    $sql = "INSERT INTO mhs (nama_mhs, nipd, tgl_lahir, alamat) VALUES ('$nama', '$nipd', '$tgl', '$alamat')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Data Berhasil Ditambahkan!<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button></div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>Error: $sql<br>$conn->error<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button></div>";
    }
}
?>

<h1 class="text-center text text-secondary">Tambah Data Mahasiswa LP3I</h1>
<div class="container">
    <div class="row">
        <div class="col">
            <form action="" method="post" class="border border-success p-4 rounded shadow">
                <div class="mb-3">
                    <label for="" class="form-label">Nama :</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">NIPD :</label>
                    <input type="tel" name="nipd" class="form-control" required maxlength="12">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Tanggal Lahir :</label>
                    <input type="date" name="tgl_lahir" id="" class="form-control" required max="2006-12-31">
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Alamat :</label>
                    <textarea name="alamat" id="" class="form-control" required></textarea><br>
                </div>

                <div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    <a href="tampilMhs.php" class="btn btn-success mb-3">Kembali</a>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>