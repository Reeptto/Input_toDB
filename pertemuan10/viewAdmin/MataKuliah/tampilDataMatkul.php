<?php 
    include "../header.php"; 
    ?>
    <!-- Header dengan Logout -->
    <div class="header">
        <h4>Data Mata Kuliah ASE10</h4>
    </div>

    <!-- Body Content -->
    <div class="content" style="margin-top: 70px;">
        <!-- <h1 class='text-center'>Data Mahasiswa ASE10</h1> -->
    <form action="cetakDataMatkul.php" method="POST">
        <button type="submit" class="btn btn-success float-end"><i class="fa fa-print"></i> Export Data</button>
    </form>
        <?php
        if (isset($_SESSION['alert'])) {
            echo $_SESSION['alert'];
            unset($_SESSION['alert']);
        }
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mata Kuliah</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include "../koneksi.php";
                    $sql = "SELECT id, namaMatkul, deskripsi  FROM matkul";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>".$i++."</th>"; 
                            echo "<td>".$row['namaMatkul']."</td>";
                            echo "<td>".$row['deskripsi']."</td>";
                            echo "<td>
                                    <a href='ubahDatamatkul.php?id=".$row['id']."'>
                                        <button class='btn-primary'>Ubah</button></a> | 
                                    <a href='prosesHapus.php?id=".$row['id']."'>
                                        <button class='btn-danger'>Hapus</button></a>
                                </td>";
                            echo "</tr>";
                        }
                    }    
                ?>
            </tbody>
        </table>
        <a href="tambahDataMatkul.php"><button type="button" class="form-control btn btn-success mb-3" name="submit">Tambah Data</button></a>
    </div>

<?php include "../footer.php"; ?>