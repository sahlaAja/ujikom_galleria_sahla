<?php
include "connection.php";
$query = mysqli_query($conn, "SELECT * FROM `role` WHERE `role_id` = 1");
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
            margin-left: -10px;
            width: 420px;
            height: 30px;
        }
    </style>
</head>
<body style="background-color: beige;">
    <div style="margin-top: 20px; display:flex;align-items: center; margin-left:40%;">
    <a href="dashboard.php"><img src="Asset/img/left.svg" class="left"></a>
    <h1>Tambah Admin</h1>
    </div>
    
    <div class="wrapper" style="max-width: 500px; margin-top:20px;">
        <div class="logo">
        <img src="Asset/img/logo.png">
        </div>
        <form class="p-3 mt-3" method="post" enctype="multipart/form-data">
            <div class="form-field d-flex align-items-center">
                <i class="bi bi-person" style="font-size: 16px;"></i>
                <input type="text" name="username" id="userName" placeholder="Masukkan Username" required>
            </div>
            <div class="form-field d-flex align-items-center">
                <i class="bi bi-key" style="font-size: 16px;"></i>
                <input type="password" name="password" id="pwd" placeholder="Masukkan Password" required>
            </div>
            <div class="form-field d-flex align-items-center">
            <select name="role" class="inputan">
                                    <?php
                                    while ($row = mysqli_fetch_assoc($query)):
                                    ?>
                                        <option value="<?php echo $row['role_id'] ?>"><?php echo $row['name_role'] ?></option>
                                    <?php endwhile; ?>
                                </select>
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
            <button class="btn mt-3" type="submit" name="submit">Tambah</button>
        </form>
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
    $role = $_POST['role'];

    $query = mysqli_query($conn, "INSERT INTO `user` (role_id, username, password, email, name, alamat, foto_profil) 
    VALUES ('$role', '$user', '$password', '$email', '$name', '$alamat', '$file')");
    if ($query) {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'data admin berhasil tersimpan!',
                text: 'Mengalihkan ke Dashboard',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href='./dashboard.php';
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