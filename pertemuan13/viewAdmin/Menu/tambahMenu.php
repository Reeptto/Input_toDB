<?php
include "../header.php";

if (isset($_POST['submit'])) {
    $nama   = $_POST['namaMenu'];
    $url    = $_POST['url'];
    $parent = $_POST['parent_id'];

    $sql = "INSERT INTO menu (namaMenu, url, parent_id) VALUES ('$nama', '$url', '$parent')";
    if ($conn->query($sql)) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Menu Berhasil Ditambahkan</div>";
    }else {
        $_SESSION['alert'] = "<div class='alert alert-danger'>Error: ". $conn->error. "</div>";
    }

    header("Location: tampilMenu.php");
    exit();
}
?>

<div class="header">
    <h4>Tambah Menu</h4>
</div>

<div class="content" style="margin-top: 70px">
    <form action="" method="POST">
        <div class="mb-3">
            <label for="nama">Nama Menu</label>
            <input type="text" name="namaMenu" class="form-control" id="" required>
        </div>
        <div class="mb-3">
            <label for="nama">Url</label>
            <input type="text" class="form-control" name="url" id="">
        </div>
        <div class="mb-3">
            <label for="">Parent Menu</label>
            <select name="parent_id" class="form-control" id="">
                <option value="">- Tidak ada -</option>
                <?php
                    $parentMenu = $conn->query("SELECT id, namaMenu FROM menu WHERE parent_id IS NULL");
                    while ($pm = $parentMenu->fetch_assoc()) {
                        echo "<option value='{$pm['id']}'>{$pm['namaMenu']}</option>";
                    }
                ?>
            </select>
        </div>
        <button name="submit" class="btn btn-primary">Simpan</button>
        <a href="tampilMenu.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include "../footer.php"; ?>