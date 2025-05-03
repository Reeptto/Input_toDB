    <?php 
    include "../header.php"; 
    session_start();
    ?>

    <!-- Header dengan Logout -->
    <div class="header">
        <h4>Data Mahasiswa ASE10</h4>
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
        <button type="submit" class="btn btn-success float-end"><i class="fa fa-print"></i> Export Data</button>
    </form>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIPD</th>
                    <th>Tanggal Lahir</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                    <th>Foto Profil</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include "../koneksi.php";
                    $sql = "SELECT id, nama_mhs, nipd, tgl_lahir, alamat, photoProfile FROM mhs";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>".$i++."</th>"; 
                            echo "<td>".$row['nama_mhs']."</td>";
                            echo "<td>".$row['nipd']."</td>";
                            echo "<td>".$row['tgl_lahir']."</td>";
                            echo "<td>".$row['alamat']."</td>";
                            echo "<td>
                                    <a href='ubahDataMhs.php?id=".$row['id']."'>
                                        <button class='btn-secondary rounded'>Ubah</button></a> | 
                                    <a href='prosesHapus.php?id=".$row['id']."'>
                                        <button class='btn-danger rounded'>Hapus</button></a>
                                </td>";
                            echo "<td><img src='../uploads/". htmlspecialchars($row['photoProfile']) . "' alt='Profile Preview' style='width: 80px; height: 80px; object-fit: cover; display: block; margin-bottom: 10px;'></td>";
                            echo "</tr>";
                            
                        }
                    }
                ?>
            </tbody>
        </table>
        
        <a href="tambahDatamhs.php"><button type="button" class="form-control btn btn-primary mb-3" name="submit">Tambah Data</button></a>
    </div>
<?php include "../footer.php"; ?>