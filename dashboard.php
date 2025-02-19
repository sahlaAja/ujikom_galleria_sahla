<?php
include "header.php";
$id = $_SESSION['id'];
$role = $_SESSION['role'];
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
            .a:hover {
            color: whitesmoke;
        }
        .filled {
            background-color: red;
        }
    </style>
</head>
<body>
    <div class="card-container">
        <?php
        $unread = mysqli_query($conn, "SELECT COUNT(*) AS unread FROM `notifikasi` WHERE `penerima_id` = $id AND `pengirim_id` != $id AND `is_read` = 0");
        $result = mysqli_fetch_assoc($unread);
        if (isset($_POST['search'])) {
            $type = $_POST['type'];
            $jumlah = $_POST['jumlah'];
            if ($type == 'like') {
                if ($jumlah == 'banyak') {
                    $query = "SELECT foto.*,user.username, COUNT(like_foto.foto_id) AS total_like 
                              FROM foto INNER JOIN user ON foto.user_id = user.user_id LEFT JOIN like_foto ON foto.foto_id = like_foto.foto_id 
                              GROUP BY foto.foto_id ORDER BY total_like DESC";
                }else{
                    $query = "SELECT foto.*,user.username, COUNT(like_foto.foto_id) AS total_like 
                    FROM foto INNER JOIN user ON foto.user_id = user.user_id LEFT JOIN like_foto ON foto.foto_id = like_foto.foto_id 
                    GROUP BY foto.foto_id ORDER BY total_like ASC";
                }
            }elseif ($type == 'comment') {
                if ($jumlah == 'banyak') {
                    $query = "SELECT foto.*,user.username, COUNT(komentar_foto.foto_id) AS total_like 
                              FROM foto INNER JOIN user ON foto.user_id = user.user_id LEFT JOIN komentar_foto ON foto.foto_id = komentar_foto.foto_id 
                              GROUP BY foto.foto_id ORDER BY total_like DESC";
                }else{
                    $query = "SELECT foto.*,user.username, COUNT(komentar_foto.foto_id) AS total_like 
                    FROM foto INNER JOIN user ON foto.user_id = user.user_id LEFT JOIN komentar_foto ON foto.foto_id = komentar_foto.foto_id 
                    GROUP BY foto.foto_id ORDER BY total_like ASC";
                }
            }
        } else {
            $query = "SELECT * FROM `foto` INNER JOIN `user` ON `foto`.`user_id` = `user`.`user_id`";
        }
        $hasil = mysqli_query($conn, $query);

        if ($result['unread'] > 0) {
            echo "<script>
                Swal.fire({
                    icon: 'info',
                    title: 'Ada notifikasi baru, harap lihat kotak notifikasi anda!',
                });
                </script>";
        }
        while ($row = mysqli_fetch_assoc($hasil)) :
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
                                @<?php echo $row['username'] ?>
                            </td>
                            <?php if ($is_like = mysqli_num_rows($query_check) > 0) { ?>
                                <td><span><a href="like.php?id=<?php echo $row['foto_id'] ?>"><img src="Asset/icon/heart.png" width="16px" height="16px"></a></span></td>
                                <td><?php echo $total_like ?></td>
                            <?php } else { ?>
                                <td><span><a href="like.php?id=<?php echo $row['foto_id'] ?>"><img src="Asset/icon/heart-alt.svg" width="16px" height="16px"></a></span></td>
                                <td><?php echo $total_like ?></td>
                            <?php } ?>
                            <td><span><a href="detail_foto.php?id=<?php echo $row['foto_id'] ?>"><img src="Asset/icon/comment.svg" width="16px" height="16px"></a></span></td>
                            <td><?php echo $total_komentar ?></td>
                            <?php if ($role == 'USER') { ?>
                                <td><span><a href="unduh.php?file=<?php echo $row['lokasi_file'] ?>" onclick="return confirm('Apakah  anda ingin mengunduh foto ini?')"><img src="Asset/icon/import.svg" width="16px" height="16px"></a></span></td>
                            <?php } ?>
                            <td><img src="Asset/icon/elipsis.svg" width="16px" height="16px" title="Detail like" style="margin-top: 3px; cursor:pointer;" class="openModal" data-id="<?php echo $row['foto_id'] ?>"></td>

                            <div id="likeModal<?php echo $row['foto_id'] ?>" class="modal" style="width:100%;height: 300px; display: none;top: 50%; left: 50%; transform: translate(-50%, -50%); width:auto;
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
                                <br><br>
                                <button class="closeModal btn btn-outline-info" data-id="<?php echo $row['foto_id']; ?>">Tutup</button>
                        </tr>
                    </table>
                </center>
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