<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>
<body>
</body>
</html>

<?php
include "connection.php";
$id = $_GET['id'];
$user = $_SESSION['id'];
$date = date("Y-m-d H:i:s");
$query_foto = mysqli_query($conn, "SELECT user_id FROM `foto` WHERE `foto_id` = $id");
$penerima = mysqli_fetch_array($query_foto);
$penerima_id = $penerima['user_id'];


$query = mysqli_query($conn, "SELECT * FROM `like_foto` INNER JOIN `user`ON `like_foto`.`user_id` = `user`.`user_id` WHERE `like_foto`.`foto_id` = $id AND `like_foto`.`user_id` = $user");

if (mysqli_num_rows($query) > 0) {
    $query_delete_like = mysqli_query($conn, "DELETE FROM `like_foto` WHERE `foto_id` = '$id' AND `user_id` = '$user'");
    if ($query_delete_like) {
        echo "
        <script>
                window.location.href='./dashboard.php'; // Redirect setelah aksi selesai
        </script>
        ";
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal menghapus like',
                text: 'Silahkan coba lagi'
            });
        </script>
        ";
    }
} else {
    $query_like = mysqli_query($conn, "INSERT INTO `like_foto` (foto_id, user_id, penerima_id, tanggal_like) VALUES ('$id', '$penerima_id','$user','$date')");
    if ($query_like) {
        // Ambil username untuk notifikasi
        $user_query = mysqli_query($conn, "SELECT `username` FROM `user` WHERE `user_id` = $user");
        $user_data = mysqli_fetch_assoc($user_query);
        $username = $user_data['username'];
        $select = mysqli_query($conn, "SELECT * FROM `foto`  WHERE `foto_id` = $id");
        $hasil = mysqli_fetch_array($select);
        $judul = $hasil['judul_foto'];
        $user_id = $hasil['user_id'];
        // Buat pesan notifikasi
        $message = "@$username menyukai postingan $judul Anda ";

        // Simpan notifikasi ke tabel `notifikasi`
        $notification_query = mysqli_query($conn, "INSERT INTO `notifikasi` (`penerima_id`, `pengirim_id`, `message`) 
                           VALUES ('$user_id', '$user', '$message')");
        echo "
        <script>
                window.location.href='./dashboard.php';
        </script>
        ";
    } else {
    }
}
?>