    <!-- Sidebar Bootstrap -->
<div class="sidebar">
<h4>Admin ASE</h4>
    <hr>

    <?php
    // die($_SESSION['role']);
    $query = "SELECT * FROM rbac a, menu b WHERE a.role_id = ".$_SESSION['role']." AND a.menu_id = b.id";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<a href="' . $row['url']. '"><i class="fas fa-user"></i> ' . $row['namaMenu'].' </a>';
    }
    ?>

    <div class="logout">
        <a href="../Auth/logout.php" class="logout-icon"><i class="fa fa-sign-out-alt"></i> LogOut</a>
    </div>
</div>