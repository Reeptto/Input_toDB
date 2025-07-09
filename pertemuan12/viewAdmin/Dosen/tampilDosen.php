<?php 
    include "../header.php"; 
    ?>
    <!-- Header dengan Logout -->
    <div class="header">
        <h4>Data Dosen ASE10</h4>
    </div>

    <!-- Body Content -->
    <div class="content" style="margin-top: 70px;">
        <!-- <h1 class='text-center'>Data Mahasiswa ASE10</h1> -->
    <form action="cetakDatadsn.php" method="POST">
        <button type="submit" class="btn btn-success float-end"><i class="fa fa-print"></i> Export Data</button>
    </form>
        <?php
        if (isset($_SESSION['alert'])) {
            echo $_SESSION['alert']; // Display the alert message
            unset($_SESSION['alert']); // Remove message after displaying
        }
        ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIPD</th>
                    <th>Mata Kuliah</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    include "../koneksi.php";
                    $sql = "SELECT id, namaDosen, NID, mataKuliah, alamat FROM dosen";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $i = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<th scope='row'>".$i++."</th>"; 
                            echo "<td>".$row['namaDosen']."</td>";
                            echo "<td>".$row['NID']."</td>";
                            echo "<td>".$row['mataKuliah']."</td>";
                            echo "<td>".$row['alamat']."</td>";
                            echo "<td>
                                    <a href='ubahDatadosen.php?id=".$row['id']."'>
                                        <button class='btn btn-warning'>Ubah</button></a> | 
                                    <a href='/viewAdmin/Dosen/prosesHapus.php?id=".$row['id']."'>
                                        <button class='btn btn-danger'>Hapus</button></a>
                                </td>";
                            echo "</tr>";
                        }
                    }    
                ?>
            </tbody>
        </table>
        <a href="tambahDatadosen.php"><button type="button" class="form-control btn btn-success mb-3" name="submit">Tambah Data</button></a>
    </div>

<?php include "../footer.php"; ?>