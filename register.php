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
    <style>
        .inputan {
            width: 100%;
            height: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="login.php"><img src="Asset/img/left.svg" class="left"></a>
        <img src="Asset/img/logo.png" class="logo">
    </div>
    <center>
        <div class="register">
            <div class="register2">
                <center>
                    <h2>Register</h2>
                </center>
                <hr>
                <form method="post" enctype="multipart/form-data">
                    <table style="width : 90%">
                        <tr>
                            <td>
                                <input type="text" name="username" class="form-control inputan" placeholder="Masukkan username" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="password" class="form-control inputan" placeholder="Masukkan password" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="email" name="email" class="form-control inputan" placeholder="Masukkan email" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="name" class="form-control inputan" placeholder="Masukkan Nama Lengkap" required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <textarea name="alamat" cols="43" rows="2" placeholder="Masukkan Alamat"></textarea required>
            </td>
        </tr>
        <tr>
            <td>
                <input type="file" name="file" required>
            </td>
        </tr>
        <tr>
            <td>
            <button class="btn btn-primary" type="submit" name="submit" style="margin-left: 80%">Daftar</button>
            </td>
        </tr>
    </table>
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