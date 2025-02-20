<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Galleria</title>
    <link rel="stylesheet" href="asset.css"> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <style>
        .a{
            color: white;
            text-decoration: none;
        }
        .a:hover {
            color: white;
            text-decoration: underline;
        }

        .filled {
            background-color: red;
        }
        .text1{
            width: 700px;
            height: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
            margin-top: 5px;
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
        
    </style>
</head>

<body>
    <div class="header">
        <img src="Asset/img/logo.png" class="logo1">
        <form method="POST">
        <input type="text" name="isi" placeholder="Cari foto dengan nama foto / username pemilik..." required class="text1">
                <button type="submit" name="search" class="button"><center><img src="Asset/icon/search.svg" width="16px" height="16px"></center></button>
        </form>
        <img src="Asset/icon/reset.svg" width="30px" height="30px" class="icon" title="reset" name="reset" onclick="resetSearch()" style="margin-left:3px;margin-top: 3px;">
        <button class="button_menu" style="margin-top: -1px; margin-left:3px; width : 130px;"><a href="login.php" class="a">LOGIN</a></button>
        <button class="button_menu" style="margin-top: -1px; margin-left:7px; background-color:#4e97c2; width:130px;"><a href="register.php" class="a">REGISTER</a></button>
    </div>
    </div>
    <div class="card-container">
        <?php
        if (isset($_POST['search'])) {
            if (isset($_POST['search'])) {
                $search = mysqli_real_escape_string($conn,$_POST['isi']);
                $query = "SELECT * FROM `foto` INNER JOIN `user` ON `foto`.`user_id` = `user`.`user_id` WHERE `judul_foto` LIKE '%$search%' OR `username` LIKE '%$search%'";
            }else{
              $query = "SELECT * FROM `foto` INNER JOIN `user` ON `foto`.`user_id` = `user`.`user_id`";  
            }    
        } else {
            $query = "SELECT * FROM `foto` INNER JOIN `user` ON `foto`.`user_id` = `user`.`user_id`";
        }
        $hasil = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($hasil)) :
        ?>
            <div class="card_box">
                <div class="card-foto">
                    <img src="Asset/img/<?php echo $row['lokasi_file'] ?>" class="img-fluid" style="max-width: 100%; height:auto; display:block; border-radius:20px;">
                    <center><a href="login.php"><span class="detail-text">Details</span></a></center>
                </div>
                <table>
                    <tr>
                        <td>
                            <b><i><?php echo $row['judul_foto'] ?></i></b>
                        </td>
                    </tr>
                </table>
            </div>
        <?php endwhile; ?>
    </div>
    </div>

</body>

</html>

<script>
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) {
            location.reload();
        }
    });

    function resetSearch(){
        document.querySelector('select[name="type"]').selectedIndex = 0;
        document.querySelector('select[name="jumlah"]').selectedIndex = 0;
        document.querySelector('form').submit(); 
    }

    function resetSearch(){
        document.querySelector('input[name="isi"]').value = "";
        document.querySelector('form').submit(); 
    }
</script>