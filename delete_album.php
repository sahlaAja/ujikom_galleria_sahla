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
$album = intval($_GET['id_album']); 

if ($album) {
    $delete_likes = mysqli_query($conn, "DELETE FROM `like_foto` WHERE `foto_id` IN (SELECT `foto_id` FROM `foto` WHERE `album_id` = $album)");

    $delete_comment = mysqli_query($conn, "DELETE FROM `komentar_foto` WHERE `foto_id` IN (SELECT `foto_id` FROM `foto` WHERE `album_id` = $album)");

    $delete_foto = mysqli_query($conn, "DELETE FROM `foto` WHERE `album_id` = $album");
    
    if ($delete_foto) {
        $delete_album = mysqli_query($conn, "DELETE FROM `album` WHERE `album_id` = $album");
        if ($delete_album) {
            echo "
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Album berhasil di hapus!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.location.href='album.php';
                });    
            </script>
            ";
        } else {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal menghapus album!',
                    text: 'Silakan coba lagi.'
                });
            </script>
            ";
        }
    }
} else {
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Album tidak ditemukan!',
            text: 'ID album tidak valid.'
        });
    </script>
    ";
}
?>
