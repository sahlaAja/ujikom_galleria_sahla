<?php
include "connection.php";
$id = $_SESSION['id'];
$data = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_id` = $id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Album</title>
    <link rel="stylesheet" href="asset.css">
    <link href="Asset/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="Asset/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        td {
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="album.php"><img src="Asset/img/left.svg" class="left"></a>
        <img src="Asset/img/logo.png" class="logo">
    </div>
    <center>
        <div class="form">
            <form method="post" enctype="multipart/form-data">
                <table width="100%">
                    <tr>
                        <td>
                            <h1 style="text-align : center;">Tambah Album</h1>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="nama_album" required class="input" placeholder=" Masukkan Nama Album"></td>
                    </tr>
                    <tr>
                        <td><textarea name="deskripsi" cols="50" rows="3" class="input" placeholder="Masukkan Deskripsi Album"></textarea></td>
                    </tr>
                    <tr>
                        <td><input type="date" name="tanggal" required class="input" required></td>
                    </tr>


                    <tr>
                        <td><button type="submit" name="submit" class="btn btn-primary" style="margin-left : 90%">Upload</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </center>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $judul = $_POST['nama_album'];
    $desk = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];

    $query = mysqli_query($conn, "INSERT INTO `album` (nama_album, deskripsi, tanggal_buat, user_id)
        VALUES ('$judul', '$desk', '$tanggal','$id')");

    if ($query) {
        echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Album berhasil dibuat!',
                        text: 'Mengalihkan ke Master Album',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href='./album.php';
                    });
                </script>
                ";
    } else {
        echo "
                <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Album gagal dibuat!',
                });
                </script>
                ";
    }
}
?>