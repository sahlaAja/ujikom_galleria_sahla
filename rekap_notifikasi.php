<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="asset.css">
</head>
<body>
<a href="notifikasi.php"><img src="Asset/img/left.svg" class="left"></a>
<?php
include "connection.php";
$id = $_SESSION['id'];

$query = mysqli_query($conn, "SELECT * FROM `notifikasi` WHERE `penerima_id` = $id AND `pengirim_id` != $id AND `is_read` = 1 ORDER BY `created_at` DESC");

if (mysqli_num_rows($query) > 0) {
while($result = mysqli_fetch_assoc($query)):
    
?>
    <center>
        <div class="notification">
            <p><?php echo $result['message']?></p>
            <small><?php echo date('H:i d-m-Y',strtotime($result['created_at']))?></small>
        </div>
    </center>
<?php
endwhile;
}else{
    echo "<center><h2>Tidak ada riwayat notifikasi.</h2></center>";
}
?>
</body>
</html>
