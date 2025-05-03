<!DOCTYPE html>
<?php 
session_start();
include "../koneksi.php";

    if (isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        if ($password != $confirmPassword) {
            $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            Registrasi Gagal ! Password tidak sesuai!
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
          $conn->close();
          header("Location: registrasi.php");
          exit();
        }else {
            // cek apakah username sudah terdaftar
            $check_sql = "SELECT * FROM auth WHERE username = ?";
            $stmt = $conn->prepare($check_sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Registrasi Gagal ! Username sudah terdaftar. Silahkan gunakan username lain. !
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>";
                $conn->close();
                header("Location: registrasi.php");
                exit();
            }else {
                // Hash password menggunakan bcrypt
                $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
                $role = "administrator";

                     // Query untuk menyimpan data ke database
                    $insert_sql = "INSERT INTO auth (username, password, role) VALUES (?,?,?)";
                    $stmt = $conn->prepare($insert_sql);
                    $stmt->bind_param("sss", $username, $hashedPassword, $role);

                    if ($stmt->execute()) {
                        $_SESSION['alert'] = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        Registrasi Berhasil ! silahkan login disini !
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                        $conn->close();
                        header("Location: login.php");
                        exit();
                    }else {
                        $_SESSION['alert'] = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        Registrasi Gagal!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                        $conn->close();
                        header("Location: registrasi.php");
                        exit();
                    }
            }
        }
        // $stmt->close();
}

$conn->close();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Admin ASE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: azure;
        }
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 0 10px azure;
        }
        .sidebar {
            background-color: #333;
            color: azure;
            padding: 1rem;
            border-top-left-radius: 1rem;
            border-bottom-left-radius: 1rem;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container login-container">
    <div class="card w-75 d-flex flex-row">
        <div class="col-md-5 sidebar d-flex flex-column justify-content-center align-items-center">
            <h2 class="mb-4">Admin ASE</h2>
            <p>Silahkan registrasi untuk membuat akun</p>
        </div>
        <div class="col-md-7 p-5">
            <h3 class="mb-4">Registrasi</h3>
            <?php 
                if (isset($_SESSION['alert'])) {
                    echo $_SESSION['alert'];
                    unset($_SESSION['alert']);
                }
            ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Confirm Password</label>
                    <input type="password" name="confirmPassword" id="" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" value="submit" name="submit">Daftar</button>
                <div class="mt-3">
                    <a href="login.php">sudah punya akun? login disini</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>