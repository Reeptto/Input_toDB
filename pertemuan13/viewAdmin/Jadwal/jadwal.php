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
                    <th>Kelas</th>
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
                    $sql = "SELECT a.id, b.namaMatkul, c.namaDosen, d.nama_hari, e.jam_mulai, e.jam_selesai, f.nama_ruangan, g.nama_kelas,  semester, tahun_ajaran FROM `jadwal_kuliah` a 
                    LEFT JOIN matkul b ON a.id_matkul = b.id
                    LEFT JOIN dosen c ON a.id_dosen = c.id
                    LEFT JOIN hari d ON a.id_hari = d.id
                    LEFT JOIN jam_kuliah e ON a.id_jam_kuliah = e.id
                    LEFT JOIN ruangan f ON a.id_ruangan = f.id
                    LEFT JOIN kelas g ON a.id_kelas = g.id";

                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>".$i++."</th>"; 
                            echo "<td>".$row['nama_kelas']."</td>";
                            echo "<td>".$row['namaMatkul']."</td>";
                            echo "<td>".$row['namaDosen']."</td>";
                            echo "<td>".$row['nama_hari']."</td>";
                            echo "<td>".$row['jam_mulai']." - ". $row['jam_selesai']. "</td>";
                            echo "<td>".$row['nama_ruangan']."</td>";
                            echo "<td>".$row['semester']."</td>";
                            echo "<td>".$row['tahun_ajaran']."</td>";
                            echo "<td>
                                    <a href='ubahJadwal.php?id=".$row['id']."'>
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
        
        <a href="tambahJadwal.php"><button type="button" class="form-control btn btn-success mb-3" name="submit">Tambah Data</button></a>
    </div>
<?php include "../footer.php"; ?>