<?php
include "connection.php";
$id = $_SESSION['id'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galleria | Dashboard</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="Asset/bootstrap/dist/css/bootstrap.min.css">
    <style>
        .text1 {
            width: 690px;
            height: 30px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            margin-top: 5px;
        }

        .select {
            width: 150px;
            height: auto;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 20px;
            margin-left: 50px;
            margin-top: 10px;
            margin-bottom: 15px;
            font-size: small;
        }

        .button {
            width: 30px;
            height: 30px;
            background-color: #4e97c2;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 20px;
        }

        .a {
            color: white;
            text-decoration: none;
        }

        .a:hover {
            text-decoration: underline;
        }

        .profil {
            height: auto;
            z-index: 9999;
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: auto;
            background: white;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
            border-radius: 20px;
        }

        tr {
            padding: 5px;
        }

        h5 {
            margin: 5px 0;
        }

        td {
            line-height: 1;
        }
    </style>
</head>

<body>
    <?php
    if ($role == 'USER') {
        $query = mysqli_query($conn, "SELECT * FROM `user` WHERE `user_id` = $id");
        $row = mysqli_fetch_array($query);
        $query2 = mysqli_query($conn, "SELECT COUNT(*) AS unread FROM `notifikasi` WHERE `penerima_id` = $id AND `pengirim_id` != $id AND `is_read` = 0");
        $row2 = mysqli_fetch_array($query2);
    ?>
        <div class="header">
            <img src="Asset/img/logo.png" class="logo1">
            <button class="button_menu"><a href="report.php" class="a">Insight Report</a></button>
            <img src="Asset/img/<?php echo $row['foto_profil'] ?>" width="36px" height="36px" style="border-radius:20px; margin-left:5px; margin-top:10px;" class="openModalProfil" data-id="<?php echo $row['user_id'] ?>">
            <div id="profil<?php echo $row['user_id'] ?>" class="profil">
                <center>
                    <img src="Asset/img/<?php echo $row['foto_profil'] ?>" width="81px" height="81px" style="border-radius : 50px;">
                    <h3>@<?php echo $row['username'] ?></h3>
                    <p><?php echo $row['email'] ?></p>
                </center>
                <form action="" method="post">
                    <table style="border-collapse: collapse;">
                        <tr>
                            <td>
                                <h5>Name</h5>
                            </td>
                            <td><input type="text" name="name" value="<?php echo $row['name'] ?>" style="border-radius: 10px;"></td>
                        </tr>
                        <tr>
                            <td>
                                <h5>Address</h5>
                            </td>
                            <td><textarea name="alamat" style="resize: none; border-radius : 10px;" cols="20" rows="4"><?php echo $row['alamat'] ?></textarea></td>
                        </tr>
                        <tr>
                            <td>
                                <h5>Username</h5>
                            </td>
                            <td><input type="text" name="username" value="<?php echo $row['username'] ?>" style="border-radius: 10px;"></td>
                        </tr>
                        <tr>
                            <td>
                                <h5>Email</h5>
                            </td>
                            <td><input type="email" name="email" value="<?php echo $row['email'] ?>" style="border-radius: 10px;"></td>
                        </tr>
                    </table><br>
                    <button class="closeModal" data-id="<?php echo $row['user_id']; ?>" style="background-color: #CC3636; color:white; margin-left:30%">Cancel</button>
                    <button type="submit" name="profil" style="background-color: #23486A; color:white;">Save changes</button>
                </form>
            </div>
            <div class="notification-icon">
                <span><a href="notifikasi.php"><img src="Asset/icon/bell.png" width="36px" height="36px"></a></span>
                <div class="notification-count"><?php echo $row2['unread'] ?></div>
            </div>
            <form method="POST" action="dashboard.php">
                <input type="text" name="isi" placeholder="Cari foto dengan nama foto / username pemilik..." required style="margin-left:10px;" class="text1">
                <button type="submit" name="search" class="button">
                    <center><img src="Asset/icon/search.svg" width="16px" height="16px" style="margin-top: -5px;"></center>
                </button>
            </form>
            <img src="Asset/icon/reset.svg" width="36px" height="36px" class="icon" title="reset" name="reset" onclick="resetSearch()">
            <span><a href="album.php"><img src="Asset/icon/folder.svg" width="36px" height="36px" title="album" class="icon"></a></span>
            <span><a href="upload-foto.php"><img src="Asset/icon/image-plus.svg" width="36px" height="36px" class="icon" title="tambah foto"></a></span>
            <span><img src="Asset/icon/logout.svg" class="icon" width="36px" height="36px" title="logout" onclick="confirmLogout()"></span>
        </div>
    <?php } else { ?>
        <div class="header">
            <img src="Asset/img/logo.png" class="logo1">
            <button class="button_menu" style="background-color: grey; margin-left : 10px; width:200px; height:35px; margin-top:2px;"><a href="master_user.php" class="a">Master User</a></button>
            <img src="Asset/icon/reset.svg" width="36px" height="36px" class="icon" title="reset" name="reset" onclick="resetSearch()" style="margin-top: -1px;">
            <span><a href="tambah_user.php"><i class="uil uil-plus" style="font-size: 36px;" title="Tambah Admin"></i></a></span>
            <span><img src="Asset/icon/logout.svg" class="icon" width="36px" height="36px" title="logout" onclick="confirmLogout()" style="margin-top: -2px;"></span>
        </div>
    <?php } ?>
</body>

</html>

<?php

if (isset($_POST['profil'])) {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $address = $_POST['alamat'];
    $email = $_POST['email'];

    $update = mysqli_query($conn, "UPDATE user SET username='$username', name='$name', email='$email', alamat='$address' WHERE user_id = $id");

    if ($update) {
        echo "<script>
            alert('Data profil berhasil di update!');
            window.location.href = window.location.href;
            </script>";
    } else {
        echo "<script>
            alert('Data profil gagal di update!');
            </script>";
    }
}

?>

<script>
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            location.reload();
        }
    });

    function confirmLogout() {
        var confirmation = confirm("Apakah Anda yakin ingin logout?");

        if (confirmation) {
            window.location.href = "logout.php";
        }

    }

    //modal profil
    document.querySelectorAll(".openModalProfil").forEach(button => {
        button.addEventListener("click", function() {
            let profilId = this.getAttribute("data-id");
            document.getElementById("profil" + profilId).style.display = "block";
        });
    });

    document.querySelectorAll(".closeModal").forEach(button => {
        button.addEventListener("click", function() {
            let modalId = this.getAttribute("data-id");
            document.getElementById("profil" + modalId).style.display = "none";
        });
    });

    //reset
    function resetSearch() {
        document.querySelector('select[name="type"]').selectedIndex = 0;
        document.querySelector('select[name="jumlah"]').selectedIndex = 0;
        document.querySelector('form').submit();
    }
</script>