<?php
include "header.php";
$query = mysqli_query($conn, "SELECT * FROM `user` INNER JOIN `role` ON `user`.`role_id` = `role`.`role_id`");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master User</title>
    <link rel="stylesheet" href="asset.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        img {
            width: 50px;
            height: 50px;
            border-radius: 50px;
        }
    </style>
</head>
<body>
    <h1 style="color: #4e97c2;">MASTER USER</h1>
    <legend>
        <?php
        while ($row = mysqli_fetch_assoc($query)):
        ?>
            <div class="user">
                <table>
                    <tr>
                        <td><img src="Asset/img/<?php echo $row['foto_profil'] ?>" alt=""></td>
                        <td>
                            <h3> | @<?php echo $row['username'] ?></h3>
                        </td>
                        <td>
                            <h3> | <?php echo $row['name'] ?></h3>
                        </td>
                        <td>
                            <h3> | <?php echo $row['email'] ?></h3>
                        </td>
                        <td>
                            <h3> | <?php echo $row['alamat'] ?></h3>
                        </td>
                        <td><a href="delete_user.php?id=<?php echo $row['user_id'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus user ini?')"><button style="background-color: red; border-radius:5px;"><i class="uil uil-trash" title="delete" style="color: white;"></i></button></a></td>
                        <?php if ($row['verifikasi'] == 1) { ?>
                            <td><a href="approve.php?id=<?php echo $row['user_id'] ?>" onclick="return confirm('Apakah anda akan membatalkan verifikasi user ini?')"><button style="background-color: green;border-radius:5px;color:white;" disabled>Sudah Approve</button></a></td>
                        <?php } else { ?>
                            <td><a href="approve.php?id=<?php echo $row['user_id'] ?>" onclick="return confirm('Apakah anda akan memverifikasi user ini?')"><button style="background-color: #4e97c2;border-radius:5px;color:white;">Belum Approve</button></a></td>
                        <?php } ?>
                    </tr>
                </table>
            </div>
            <br>
        <?php endwhile; ?>

    </legend>
</body>
</html>