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
    <div class="header" style="background : rgba(232, 235, 234, 0.5);">
        <img src="Asset/img/logo.png" class="logo">
        <button class="button_menu" style="margin-left: 850px;"><a href="dashboard.php" class="a">Dashboard</a></button>
        <span><a href="tambah_album.php"><i class="uil uil-folder-plus" style="font-size: 48px;" title="Tambah Album"></i></a></span>
        <span><a href="upload-foto.php"><i class="uil uil-image-plus" style="font-size: 48px;" title="Upload foto"></i></a></span>
        <span><i class="uil uil-sign-out-alt" style="font-size:48px;" title="logout" onclick="confirmLogout()"></i></span>
    </div>
    <div class="box" style="margin-top: 20px;">
        <h3>MY ALBUM</h3>
    </div>
    <div class="container" style="margin-left: 50px; margin-top:10px;">
        <?php
        $query = "SELECT * FROM `album` INNER JOIN `user` ON `album`.`user_id` = `user`.`user_id` WHERE `album`.`user_id` = $id";
        $hasil = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($hasil)):
            $timestamp = strtotime($row['tanggal_buat']);
            $tanggal = date("d M Y", $timestamp);
        ?>
            <table>
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
                        <span><a href="delete_album.php?id_album=<?php echo $row['album_id'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus album ini?')"><i class="uil uil-trash" style="font-size : 36px;"></i></a></span>
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