<?php
include "../header.php";
// include "../koneksi.php";

$id = $_GET['id'];
$menu  = $conn->query("SELECT * FROM menu WHERE id = '$id'");

if (isset($_POST['update'])) {
    $nama = $_POST['namaMenu'];
    $url  = $_POST['url'];
    $parent = $_POST['parent_id'] ?: "NULL";

    $sql = "UPDATE menu SET namaMenu = '$nama', url = '$url', parent_id = '$parent'";
    if ($conn->query($sql)) {
        $_SESSION['alert'] = "<div class='alert alert-success'>Menu Berhasil Diubah!</div>";
    }else {
        $_SESSION['alert'] = "<div class='alert alert-danger'>Gagal: ". $conn->error. "</div>";
    }

    header("Location: tampilMenu.php");
    exit();
}
?>

<div class="header">
    <h4>Ubah Menu</h4>
</div>

<div class="content" style="margin-top: 70px">
    <form action="" method="POST">
        <div class="mb-3">
            <label for="nama">Nama Menu</label>
            <input type="text" name="namaMenu" class="form-control" id="" value="<?= $menu['namaMenu'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="nama">Url</label>
            <input type="text" class="form-control" name="url" value="<?= $menu['url']?>" id="">
        </div>
        <div class="mb-3">
            <label for="">Parent Menu</label>
            <select name="parent_id" class="form-control" id="">
                <option value="">- Tidak ada -</option>
                <?php
                    $parentMenu = $conn->query("SELECT id, namaMenu FROM menu WHERE parent_id IS NULL");
                    while ($pm = $parentMenu->fetch_assoc()) {
                        $selected = $pm['id'] == $menu['parent_id'] ? "selected" : "";
                        echo "<option value='{$pm['id']}'>{$pm['namaMenu']}</option>";
                    }
                ?>
            </select>
        </div>
        <button name="Update" class="btn btn-primary">Simpan</button>
        <a href="tampilMenu.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

<?php include "../footer.php"; ?>