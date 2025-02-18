<?php
include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Galleria</title>
    <link rel="stylesheet" href="asset.css">
    <link href="Asset/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="Asset/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <style>
        .inputan {
            width: 100%;
            height: 30px;
        }
        .form-field{
            padding: 0 0;
            margin: 0 0;
            height: 30px;
        }
    </style>
</head>
<body style="background-color: beige;">
    <div class="wrapper" style="max-width: 500px; margin-top:3px;">
        <div class="logo">
        <img src="Asset/img/logo.png">
        </div>
        <form class="p-3 mt-3" method="post" enctype="multipart/form-data">
            <div class="form-field d-flex align-items-center">
                <i class="bi bi-person" style="font-size: 16px;"></i>
                <input type="text" name="username" id="userName" placeholder="Username" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <i class="bi bi-key" style="font-size: 16px;"></i>
                <input type="password" name="password" id="pwd" placeholder="Password" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <i class="bi bi-envelope" style="font-size: 16px;"></i>
                <input type="text" name="email" placeholder="email" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <i class="bi bi-person-fill" style="font-size: 16px;"></i>
                <input type="text" name="name" placeholder="name" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <i class="bi bi-house-door" style="font-size: 16px;"></i>
                <input type="text" name="alamat" placeholder="Address" required>
            </div>
            <div class="form-field d-flex align-items-center" style="height: 40px;">
                <i class="bi bi-file-image" style="font-size: 16px;"></i>
                <input type="file" name="file" required>
            </div>
            <button class="btn mt-3" type="submit" name="submit">Register</button>
        </form>
        <div class="text-center fs-6">
        Sudah punya akun? <a href="login.php">Login</a>
        </div>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    $password = md5($pass);
    $email = $_POST['email'];
    $name = $_POST['name'];
    $alamat = $_POST['alamat'];
    $file = $_FILES['file']['name'];
    $role = 2;

    $query = mysqli_query($conn, "INSERT INTO `user` (role_id, username, password, email, name, alamat, foto_profil) 
    VALUES ('$role', '$user', '$password', '$email', '$name', '$alamat', '$file')");
    if ($query) {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Registrasi berhasil, data sudah tersimpan!',
                text: 'Mengalihkan ke Login',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href='./login.php';
            });
        </script>
        ";
    } else {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'Registrasi gagal, data tidak tersimpan!',
            text: 'Silahkan registrasi ulang'
        });
        </script>
        ";
    }
}
?>