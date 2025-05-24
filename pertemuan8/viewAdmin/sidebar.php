    <!-- Sidebar Bootstrap -->
    <div class="sidebar">
    
        <h4>Admin ASE</h4>
        <hr>
        <!-- <a href="../Mahasiswa/tampilDatamhs.php"><i class="fas fa-user"></i> Data Mahasiswa</a>
        <a href="../Dosen/tampilDosen.php"><i class="fas fa-user"></i> Data Dosen</a>
        <a href="../Matakuliah/tampilDatamatkul.php"><i class="fas fa-cogs"></i> Data Matakuliah</a> -->

        <?php
        $query = "SELECT * FROM menu";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            echo '<a href="' . $row['url']. '"><i class="fas fa-user"></i> ' . $row['namaMenu'].' </a>';
        }
        
        ?>

        

        <div class="logout">
        <a href="../Auth/logout.php" class="logout-icon"><i class="fa fa-sign-out-alt"></i> logout</a>
        </div>
    </div>