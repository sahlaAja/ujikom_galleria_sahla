<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Galleria</title>
    <link rel="stylesheet" href="asset.css">
    <link href="Asset/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="Asset/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .inputan {
            width: 90%;
            height: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="Asset/img/logo.png" class="logo">
    </div>
    <center>
        <div class="login">
            <div class="login2">
                <center>
                    <h2>LOGIN</h2>
                </center>
                <hr>
                <form method="post">
                    <input type="text" name="username" class="form-control inputan" placeholder="Masukkan username" required>
                    <br>
                    <input type="password" name="password" class="form-control inputan" placeholder="Masukkan password" required>
                    <br>
                    <button class="btn btn-primary" type="submit" name="submit" style="margin-left: 60%">Submit</button><br><br>
                    Belum punya akun? <a href="register.php">Daftar Disini</a>
            </div>
        </div>
    </center>
    </form>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $password = md5($pass);

    $query = mysqli_query($conn, "SELECT * FROM `user`
    INNER JOIN `role` ON `user`.`role_id` = `role`.`role_id`  WHERE `username`= '$user' AND `password`= '$password'");
    $data = mysqli_fetch_array($query);
    if ($data) {
        if (($user == $data['username'] && $password == $data['password'] && $data['verifikasi'] == 1)) {
            $_SESSION['user'] = $data['username'];
            $_SESSION['role'] = $data['name_role'];
            $_SESSION['id'] = $data['user_id'];
            $_SESSION['role_id'] = $data['role_id'];
            echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Login Berhasil!',
                    text: 'Mengalihkan ke Dashboard',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href='dashboard.php';
                });
            </script>";
        } else {
            echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Akun Anda Belum Terferivikasi!',
            });
            </script>";
        }
    } else {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: 'Username / Pasword Salah',
            });
            </script>";
    }
}
?>