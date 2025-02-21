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
        $query = mysqli_query($conn, "DELETE FROM `user` WHERE `user_id` = $id");
if ($query) {
    echo "
        <script>
        Swal.fire({
                    icon: 'success',
                    title: 'User berhasil di hapus!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    window.history.back();
                });
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