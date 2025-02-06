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

if ($id) {
    $delete_likes = mysqli_query($conn, "DELETE FROM `like_foto` WHERE `foto_id` = $id");
    $delete_comment = mysqli_query($conn, "DELETE FROM `komentar_foto` WHERE `foto_id` = $id");

    if ($delete_likes || $delete_comment) {
        $query = mysqli_query($conn, "DELETE FROM `foto` WHERE `foto_id` = $id");
    }
}
if ($query) {
    echo "
        <script>
                window.history.back();
        </script>
        ";
} else {
    echo "
        <script>
        Swal.fire({
            icon: 'error',
            title: 'foto gagal dihapus!',
            text: 'Silahkan coba lagi'
        });
        </script>
        ";
}
?>