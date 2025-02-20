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

<!-- fungsi -->
<?php
include "connection.php";
$user = $_SESSION['id'];

if (isset($_POST['kirim'])) {
    $id = $_POST['foto_id'];
    $komentar = $_POST['komentar'];
    $date = date('Y-m-d H:i:s');
     // Ambil username untuk notifikasi
     $user_query = mysqli_query($conn, "SELECT `username` FROM `user` WHERE `user_id` = $user");
     $user_data = mysqli_fetch_assoc($user_query);
     $username = $user_data['username'];
     $select = mysqli_query($conn, "SELECT * FROM `foto`  WHERE `foto_id` = $id");
     $hasil = mysqli_fetch_array($select);
     $judul = $hasil['judul_foto'];
     $user_id = $hasil['user_id'];
     // Buat pesan notifikasi
     $message = "@$username memberi komentar -$komentar- pada postingan $judul Anda ";


    $query = mysqli_query($conn, "INSERT INTO `komentar_foto` (foto_id, user_id, penerima_id, isi_komentar, tanggal_komentar) VALUES ('$id','$user',$user_id,'$komentar','$date')");

    if ($query) {
        $notification_query = mysqli_query($conn, "INSERT INTO `notifikasi` (`penerima_id`, `pengirim_id`, `message`) 
                           VALUES ('$user_id', '$user', '$message')");
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Comment berhasil di kirim!',
                showConfirmButton: false,
                timer: 1500
            }).then(function() {
                window.location.href='./detail_foto.php?id=$id';
            });
        </script>
        ";
    } else {
        echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'comment gagal dikirim!',
            text: 'Silahkan comment ulang'
        });
        </script>
        ";
    }
}
?>