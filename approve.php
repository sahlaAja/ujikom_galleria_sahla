<?php
include "connection.php";
$id = $_GET['id'];

$query = mysqli_query($conn, "UPDATE `user` SET `verifikasi`= 1 WHERE `user_id`=$id");

if ($query) {
    echo "
    <script>
    alert('User berhasil di verifikasi');
    window.location.href = 'master_user.php';
    </script>
    
    ";
} else {
    echo "
    <script>
    alert('User gagal di verifikasi');
    window.location.href = 'master_user.php';
    </script>
    ";
}
