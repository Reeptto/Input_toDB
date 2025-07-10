<?php include "../header.php"; ?>

    <!-- Header dengan Logout -->
    <div class="header">
        <h4>Daftar Menu</h4>
    </div>

    <!-- Body Content -->
    <div class="content" style="margin-top: 70px;">
        <!-- <h1 class='text-center'>Data Mahasiswa ASE10</h1> -->
        <?php
        if (isset($_SESSION['alert'])) {
            echo $_SESSION['alert'];
            unset($_SESSION['alert']);
        }
        ?>
        <form action="cetakDatamhs.php" method="POST">
            <button type="submit" class="btn btn-primary float-end"><i class="fa fa-print"></i> Export Data</button>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Menu</th>
                    <th>Url</th>
                    <th>Parent</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
                <?php
                    $sql    = "SELECT *  FROM menu";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>".$i++."</th>"; 
                            echo "<td>".$row['namaMenu']."</td>";
                            echo "<td>".$row['url']."</td>";
                            echo "<td>".$row['parent_id']."</td>";
                            echo "<td>
                                    <a href='prosesUbah.php?id=".$row['id']."'>
                                        <button class='btn btn-warning rounded'>Ubah</button></a> | 
                                    <a href='prosesHapus.php?id=".$row['id']."'>
                                        <button class='btn btn-danger rounded'>Hapus</button></a>
                                </td>";
                            echo "</tr>";
                            
                        }
                    }
                 ?>
                </tbody>
        </table>
            <a href="tambahMenu.php"><button type="button" class="form-control btn btn-primary mb-3" name="submit">Tambah Data</button></a>
        </div>