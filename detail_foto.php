<?php
include "connection.php";
$id = $_GET['id'];
$user = $_SESSION['id'];

// query data foto
$query_foto = mysqli_query($conn, "SELECT * FROM `foto` INNER JOIN `user` ON `foto`.`user_id` = `user`.`user_id` WHERE `foto`.`foto_id` = $id");
$foto = mysqli_fetch_assoc($query_foto);

$timestamp2 = strtotime($foto['tanggal_unggah']);
$tanggal2 = date("d M Y", $timestamp2);

//query komentar
$query_komentar = mysqli_query($conn, "SELECT * FROM `komentar_foto` INNER JOIN `user` ON `komentar_foto`.`user_id` = `user`.`user_id` WHERE `komentar_foto`.`foto_id` = $id");

// Query jumlah komentar
$query_komentar_count = mysqli_query($conn, "SELECT COUNT(*) AS total_komentar FROM `komentar_foto` WHERE `foto_id` = $id");
$row_komentar_count = mysqli_fetch_assoc($query_komentar_count);
$total_komentar = $row_komentar_count['total_komentar'];

// query jumlah like
$query_like_count = mysqli_query($conn, "SELECT COUNT(*) AS total_like FROM `like_foto` WHERE `foto_id` = $id");
$row_like_count = mysqli_fetch_assoc($query_like_count);
$total_like = $row_like_count['total_like'];

$query_check = mysqli_query($conn, "SELECT * FROM `like_foto` WHERE `foto_id` = $id AND `user_id` = $user");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Foto</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <link rel="stylesheet" href="asset.css">
    <style>
        .span {
            width: 100%;
            height: auto;
            background-color: #8193b6;
            border-radius: 3px;
        }
       
    </style>
</head>
<body>
<div class="header">
        <a href="dashboard.php"><img src="Asset/img/left.svg" class="left" style="margin-left: 30px;"></a>
        <img src="Asset/img/logo.png" class="logo">
    </div>
    <div class="div-img">
        <div style="height: 420px; width:100%; justify-content:center;display: flex; padding:5px;">
          <img src="Asset/img/<?php echo $foto['lokasi_file']; ?>" style=" max-width:100%; max-height:100%; object-fit:contain; object-position:center;">  
        </div>
        <div class="div-detail">
            <div class="comment">
                <h2 class="text">COMMENTS</h2>
                <table>
                    <?php while ($komentar = mysqli_fetch_assoc($query_komentar)):
                        $timestamp = strtotime($komentar['tanggal_komentar']);
                        $tanggal = date("d M Y", $timestamp);
                    ?>
                        <tr>
                            <td><span class="span"><b>@<?php echo $komentar['username']; ?></b></span></td>
                            <td>
                                <p class="text"><?php echo nl2br($komentar['isi_komentar']); ?> | <?php echo $tanggal ?></p>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <form action="comment.php" method="POST" class="add-comment-form">
                <input type="hidden" name="foto_id" value="<?php echo $foto['foto_id']; ?>">
                <table>
                    <tr>
                        <td><textarea name="komentar" placeholder="Tambahkan komentar Anda..." rows="1" class="textarea" required></textarea></td>
                        <td><button type="submit" class="submit-button" name="kirim">Kirim</button></td>
                    </tr>
                </table>
            </form>
            <div class="ket">
                <table style="margin-top : -15px; white-space:nowrap;">
                    <tr>
                        <td>
                            <h4>@<?php echo $foto['username'] ?></h4>
                        </td>
                        <?php if ($is_like = mysqli_num_rows($query_check) > 0) { ?>
                            <td><span><a href="like.php?id=<?php echo $foto['foto_id'] ?>"><img src="Asset/icon/heart.png" width="16px" height="16px" style="margin-top: 3px;"></a></span></td>
                            <td><?php echo $total_like ?></td>
                        <?php } else { ?>
                            <td><span><a href="like.php?id=<?php echo $foto['foto_id'] ?>"><img src="Asset/icon/heart-alt.svg" width="16px" height="16px" style="margin-top: 3px;"></a></span></td>
                            <td><?php echo $total_like ?></td>
                        <?php } ?>
                        <td><span><img src="Asset/icon/comment.svg" width="16px" height="16px" style="margin-top: 3px;"></i></span></td>
                        <td><?php echo $total_komentar ?></td>
                        <td><span><a href="unduh.php?file=<?php echo $foto['lokasi_file']?>" onclick="return confirm('Apakah anda ingin mengunduh foto ini?')"><img src="Asset/icon/import.svg" width="16px" height="16px" title="Unduh" style="margin-top: 3px;"></a></span></td>
                        <td>|</td>
                        <td>
                            <h4><?php echo $foto['judul_foto'] ?></h4>
                        </td>
                        <td>
                            <p> Diunggah pada <?php echo $tanggal2 ?></p>
                        </td>
                    </tr>
                    </tr>
                </table>
                <p><i><?php echo $foto['deskripsi']?></i></p>
            </div>
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
</script>