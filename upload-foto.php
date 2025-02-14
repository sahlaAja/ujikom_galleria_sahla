<?php
include "connection.php";
$id = $_SESSION['id'];
$data = mysqli_query($conn, "SELECT * FROM `album` INNER JOIN `user`
    ON `album`.`user_id` = `user`.`user_id`
    WHERE `album`.`user_id` = $id");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload foto</title>
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
        <a href="dashboard.php"><img src="Asset/img/left.svg" class="left"></a>
        <img src="Asset/img/logo.png" class="logo1">
    </div>
    <center>
        <div class="form">
            <form method="post" enctype="multipart/form-data">
                <table width="100%">
                    <tr>
                        <td>
                            <h1 style="text-align : center;">Upload Foto</h1>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="judul" required class="input" placeholder=" Masukkan Judul Foto"></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="deskripsi" required class="input" placeholder="Masukkan Deskripsi Foto"></td>
                    </tr>
                    <tr>
                        <td><input type="date" name="tanggal" required class="input"></td>
                    </tr>
                    <tr>
                        <td><input type="file" name="file" required></td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            if (mysqli_num_rows($data) == 0) {
                            ?>
                                <select name="album" disabled required class="input">
                                    <option>Tidak ada album tersedia</option>
                                </select>
                    <tr>
                        <td><span class="badge-info"><i class="uil uil-exclamation-triangle" style="color : black; font-size : 16px;"></i> Harap buat album dahulu sebelum upload foto, <a href="tambah_album.php">Disini</a></span></td>
                    </tr>

                    <tr>
                        <td><button type="submit" class="btn btn-primary" style="margin-left : 80%" disabled>Upload</button></td>
                    </tr>
                <?php
                            } else {
                ?>
                    <select name="album" required class="input">
                        <?php while ($row = mysqli_fetch_assoc($data)): ?>

                            <option value="<?php echo $row['album_id'] ?>"><?php echo $row['nama_album'] ?></option>
                        <?php endwhile; ?>
                    </select>
                    </td>
                    </tr>
                    <tr>
                        <td><button type="submit" name="submit" class="btn btn-primary" style="margin-left : 80%">Upload</button></td>
                    </tr>
                <?php } ?>
                </table>
            </form>
        </div>
    </center>
</body>
</html>

<?php
if (isset($_POST['submit'])) {
    $judul = $_POST['judul'];
    $desk = $_POST['deskripsi'];
    $tanggal = $_POST['tanggal'];
    $file = $_FILES['file']['name'];
    $album = $_POST['album'];

    $query = mysqli_query($conn, "INSERT INTO `foto` (judul_foto, deskripsi, tanggal_unggah, lokasi_file, album_id, user_id)
        VALUES ('$judul', '$desk', '$tanggal', '$file', '$album', '$id')");

    if ($query) {
        echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Foto berhasil di upload!',
                        text: 'Mengalihkan ke Detail Album',
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
                    title: 'Foto gagal di upload!',
                });
                </script>
                ";
    }
}
?>