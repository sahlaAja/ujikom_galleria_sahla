<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="asset.css">
    <style>
        a{
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
<a href="dashboard.php"><img src="Asset/img/left.svg" class="left"></a>
    <?php
    include "connection.php";

    $user_id = intval($_SESSION['id']);

    $notification_query = "SELECT * FROM `notifikasi` WHERE `penerima_id` = $user_id AND `pengirim_id` != $user_id AND `is_read` = 0 ORDER BY `created_at` DESC";
    $result = mysqli_query($conn, $notification_query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <center>
        <div class="notification">
            <p><?php echo $row['message']?></p>
            <small><?php echo date('H:i d-m-Y',strtotime($row['created_at']))?></small>
        </div>
       </center>
       <?php }
    } else {
        echo "
        <center>
        <p>Tidak ada notifikasi baru.</p>
        </center>
        ";
    }

    $update_query = "UPDATE `notifikasi` SET `is_read` = 1 WHERE `penerima_id` = $user_id";
    if (mysqli_query($conn, $update_query)) {
        echo "<center>
        <p>Notifikasi telah diperbarui.</p>
        <button class='button_menu' style='width:150px;'><a href='rekap_notifikasi.php'>Riwayat Notifikasi</a></button>
        </center>";
    } else {
        echo "Gagal memperbarui notifikasi.";
    }
    ?>

</body>
</html>