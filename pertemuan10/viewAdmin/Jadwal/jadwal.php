    <?php 
    include "../header.php"; 
    ?>

    <!-- Header dengan Logout -->
    <div class="header">
        <h4>Data Jadwal</h4>
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
                    <th>Mata Kuliah</th>
                    <th>Dosen</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Ruangan</th>
                    <th>Semester</th>
                    <th>Tahun Ajaran</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include "../koneksi.php";
                    $sql = "SELECT * FROM jadwal_kuliah";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>".$i++."</th>"; 
                            echo "<td>".$row['id_kelas']."</td>";
                            echo "<td>".$row['id_matkul']."</td>";
                            echo "<td>".$row['id_dosen']."</td>";
                            echo "<td>".$row['id_hari']."</td>";
                            echo "<td>".$row['id_jam_kuliah']."</td>";
                            echo "<td>".$row['semester']."</td>";
                            echo "<td>".$row['tahun_ajaran']."</td>";
                            echo "<td>
                                    <a href='#?id=".$row['id']."'>
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
        
        <a href="#"><button type="button" class="form-control btn btn-success mb-3" name="submit">Tambah Data</button></a>
    </div>
<?php include "../footer.php"; ?>