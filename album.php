<?php
include "connection.php";
$id = $_SESSION['id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Album</title>
    <link rel="stylesheet" href="asset.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        .box {
            justify-content: center;
            display: flex;
            align-items: center;
            width: 200px;
            height: 30px;
            background-color: #F6D6D6;
            border: 2px #4e97c2 solid;
            border-radius: 5px;
            color: #3E5879;
        }

        .button {
            width: 50px;
            background-color: #4e97c2;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 100px;
        }

        .a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="header" style="background-color: #E5E1DA; margin-left:0px;">
    <a href="dashboard.php"><img src="Asset/img/left.svg" class="left"></a>
        <img src="Asset/img/logo.png" class="logo1">
        <span><a href="tambah_album.php"><img src="Asset/icon/folder-plus.svg" width="42px" height="42px" title="Tambah Album" class="icon" style="margin-left: 1000px;"></a></span>
        <span><a href="upload-foto.php"><img src="Asset/icon/image-plus.svg" width="42px" height="42px" class="icon" title="tambah foto"></a></span>
    </div>
    <div class="box" style="margin-top: 20px;">
        <h3>MY ALBUM</h3>
    </div>
    <div class="container" style="margin-top:10px;">
        <?php
        $query = "SELECT * FROM `album` INNER JOIN `user` ON `album`.`user_id` = `user`.`user_id` WHERE `album`.`user_id` = $id";
        $hasil = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($hasil)):
            $timestamp = strtotime($row['tanggal_buat']);
            $tanggal = date("d M Y", $timestamp);
        ?>
            <table style="margin-left: 50px; margin-top:15px;">
                <tr>
                    <td>
                        <span><a href="detail_album.php?id=<?php echo $row['album_id'] ?>"><img src="Asset/icon/album.png" width="100" height="100"></a></span>
                    </td>
                </tr>
                <tr>
                    <td style="text-align : center;">
                        <h4><?php echo $row['nama_album'] ?></h4>
                        <h4><?php echo $tanggal ?></h4>
                    </td>
                    <td>
                        <span><a href="delete_album.php?id_album=<?php echo $row['album_id'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus album ini?')"><img src="Asset/icon/trash.svg" width="24px" height="24px"></a></span>
                    </td>
                </tr>
            </table>
        <?php endwhile; ?>
    </div>
</body>

</html>

<script>
    function confirmLogout() {
        var confirmation = confirm("Apakah Anda yakin ingin logout?");

        if (confirmation) {
            window.location.href = "logout.php";
        }

    }
</script>