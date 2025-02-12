<?php
include "connection.php";
$id = $_SESSION['id'];
$album = $_GET['id'];
// select data album
$data1 = mysqli_query($conn, "SELECT * FROM `album` INNER JOIN `user` ON `album`.`user_id` = `user`.`user_id`
WHERE `album`.`user_id` = $id");
// select data foto
$data2 = mysqli_query($conn, "SELECT * FROM `foto` INNER JOIN `album` ON `foto`.`album_id` = `album`.`album_id`
INNER JOIN `user` ON `foto`.`user_id` = `user`.`user_id`
WHERE `foto`.`user_id` = $id AND `foto`.`album_id` = $album");

$hasil = mysqli_fetch_assoc($data1);
if (!empty($hasil)) {
    $timestamp = strtotime($hasil['tanggal_buat']);
    $tanggal = date("d M Y", $timestamp);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galleria | detail album</title>
    <link rel="stylesheet" href="asset.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        input[type="text"] {
            width: 200px;
            height: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 20px;
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

        a:hover {
            color: whitesmoke;
        }
    </style>
</head>

<body>
    <div class="header">
        <a href="album.php" style="margin-left: 20px;"><img src="Asset/img/left.svg" class="left"></a>
        <img src="Asset/img/logo.png" class="logo">
    </div>
    <?php if (!empty($hasil)) {
    ?>
        <div class="container">
            <div class="detail">
                <h3 style="margin-top : 0px;">Nama Album : <?php echo $hasil['nama_album'] ?></h3>
            </div>
            <div class="detail">
                <h3 style="margin-top : 0px;">Tanggal Buat : <?php echo $tanggal ?>
            </div>
            <div class="detail">
                <h3 style="margin-top : 0px;">Deskripsi : <?php echo $hasil['deskripsi'] ?>
            </div>
        </div>
        <br>
        <div class="card-container">
            <?php while ($row = mysqli_fetch_assoc($data2)) :
                $total = $row['foto_id'];
                $query_komentar_count = mysqli_query($conn, "SELECT COUNT(*) AS total_komentar FROM `komentar_foto` WHERE `foto_id` = $total");
                $row_komentar_count = mysqli_fetch_assoc($query_komentar_count);
                $total_komentar = $row_komentar_count['total_komentar'];

                $query_like_count = mysqli_query($conn, "SELECT COUNT(*) AS total_like FROM `like_foto` WHERE `foto_id` = $total");
                $row_like_count = mysqli_fetch_assoc($query_like_count);
                $total_like = $row_like_count['total_like'];

                $query_check = mysqli_query($conn, "SELECT * FROM `like_foto` WHERE `foto_id` = $total AND `user_id` = $id");
            ?>
                <div class="card_box">
                    <div class="card-foto">
                        <img src="Asset/img/<?php echo $row['lokasi_file'] ?>" class="img-fluid" style="max-width: 100%; height:auto; display:block; border-radius:20px;">
                        <center><a href="detail_foto.php?id=<?php echo $row['foto_id'] ?>"><span class="detail-text">Details</span></a></center>
                    </div>
                    <center>
                        <table>
                            <tr>
                                <td>
                                    <p>@<?php echo $row['username'] ?></p>
                                </td>
                                <?php if ($is_like = mysqli_num_rows($query_check) > 0) { ?>
                                    <td><span><a href="like.php?id=<?php echo $row['foto_id'] ?>"><img src="Asset/icon/heart.png" width="16px" height="16px" class="icon"></a></span></td>
                                    <td><?php echo $total_like ?></td>
                                <?php } else { ?>
                                    <td><span><a href="like.php?id=<?php echo $row['foto_id'] ?>"><img src="Asset/icon/heart-alt.svg" width="16px" height="16px" class="icon"></a></span></td>
                                    <td><?php echo $total_like ?></td>
                                <?php } ?>
                                <td><span><a href="detail_foto.php?id=<?php echo $row['foto_id'] ?>"><img src="Asset/icon/comment.svg" width="16px" height="16px" class="icon"></a></span></td>
                                <td><?php echo $total_komentar ?></td>
                                <td><span><a href="delete.php?id=<?php echo $row['foto_id'] ?>" onclick="return confirm('Apakah anda yakin akan menghapus foto ini?')"><img src="Asset/icon/trash.svg" width="16px" height="16px" class="icon"></a></span></td>
                                <td><span><a href="unduh.php?file=<?php echo $row['lokasi_file']?>" onclick="return confirm('Apakah anda ingin mengunduh foto ini?')"><img src="Asset/icon/import.svg" width="16px" height="16px" title="Unduh" style="margin-top: 3px;"></a></span></td>
                                <td><img src="Asset/icon/elipsis.svg" width="16px" height="16px" title="Detail like" style="margin-top: 3px; cursor:pointer;" class="openModal" data-id="<?php echo $row['foto_id'] ?>"></td>

                                <div id="likeModal<?php echo $row['foto_id'] ?>" class="modal" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width:auto;
                                background: white; padding: 20px; box-shadow: 0px 0px 10px rgba(0,0,0,0.5);">
                                    <h3>Riwayat Like "<?php echo $row['judul_foto'] ?>"</h3>
                                    <?php
                                    if ($total_like == 0) {
                                        echo "<p>Belum ada like untuk foto ini.</p>";
                                    } else {
                                        $like = mysqli_query($conn, "SELECT * FROM `like_foto` INNER JOIN `user` ON `like_foto`.`user_id` = `user`.`user_id` WHERE `like_foto`.`foto_id` = $total");
                                        while ($q = mysqli_fetch_array($like)) {
                                            echo '@' . $q['username'] . ' ';
                                        }
                                    }
                                    ?>
                                    <br>
                                    <button class="closeModal" data-id="<?php echo $row['foto_id']; ?>">Tutup</button>
                            </tr>
                        </table>
                    </center>
                </div>
            <?php endwhile; ?>
    <?php } else {
    ?>
        <center><span class="badge-info" style=" margin-top:100px;"><i class="uil uil-exclamation-triangle" style="color : black; font-size : 36px;"></i> Anda belum memiliki Album, <a href="tambah_album.php">Buat disini</a> </span></center>
    <?php
    } ?>
    </div>
</body>
</html>


<script>
    window.addEventListener('pageshow', function(event) {
        if (event.persisted) { // Memeriksa apakah halaman dimuat dari cache (history back)
            location.reload(); // Menyegarkan halaman
        }
    });

    function confirmLogout() {
        var confirmation = confirm("Apakah Anda yakin ingin logout?");

        if (confirmation) {
            window.location.href = "logout.php";
        }

    }

    document.querySelectorAll(".openModal").forEach(button => {
        button.addEventListener("click", function() {
            let fotoId = this.getAttribute("data-id");
            document.getElementById("likeModal" + fotoId).style.display = "block";
        });
    });

    document.querySelectorAll(".closeModal").forEach(button => {
        button.addEventListener("click", function() {
            let modalId = this.getAttribute("data-id");
            document.getElementById("likeModal" + modalId).style.display = "none";
        });
    });
</script>