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
    <link rel="stylesheet" href="Asset/bootstrap/dist/css/bootstrap.min.css">
    <script src="Asset/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .inputan {
            width: 90%;
            height: 30px;
        }
    </style>
</head>
<body style="background-color: beige;">
    <div class="wrapper">
        <div class="logo">
        <img src="Asset/img/logo.png">
        </div>
        <form class="p-3 mt-3" method="post">
            <div class="form-field d-flex align-items-center">
                <i class="bi bi-person" style="font-size: 24px;"></i>
                <input type="text" name="username" id="userName" placeholder="Username" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <i class="bi bi-key" style="font-size: 24px;"></i>
                <input type="password" name="password" id="pwd" placeholder="Password" required>
            </div>
            <button class="btn mt-3" type="submit" name="submit">Login</button>
        </form>
        <div class="text-center fs-6">
        Belum punya akun? <a href="register.php">Daftar Disini</a>
        </div>
    </div>
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