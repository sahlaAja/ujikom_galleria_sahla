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
    <title>Document</title>
    <link rel="stylesheet" href="asset.css">
    <link rel="stylesheet" href="Asset/bootstrap/dist/css/bootstrap.min.css">
    <script src="Asset/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .main-container {
            background: #444e80;
            color: #abafc6;
            border-radius: 5px;
            padding: 20px;
            width: 80%;
            height: 350px;
            margin-left: -50px;
        }
        .year-stats {
            white-space: nowrap;
            max-height: 210px;
            overflow: hidden;
        }
        .year-stats:hover {
            overflow-x: auto;
        }
        /* SCROLL BAR STYLE (ONLY WORKS IN CHROME) */
        /* Width */
        ::-webkit-scrollbar {
            height: 5px;
            width: 100%;
        }
        /* Track */
        ::-webkit-scrollbar-track {
            background: #444e80;
        }
        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #abafc6;
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #5397d6;
        }
        .month-group {
            cursor: pointer;
            max-width: 400px;
            height: 500px;
            margin: 10px;
            margin-top: 20px;
            display: inline-block;
        }
        .bar-container {
            display: flex;
            align-items: flex-end;
            height: 160px;
            width: 30px;
            gap: 2px;

        }
        .bar {
            position: relative;
            width: 12px;
            transition: 0.3s;
        }
        .bar::after {
            content: attr(data-count);
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 3px 5px;
            border-radius: 5px;
            font-size: 12px;
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.2s;
            pointer-events: none;
        }
        .bar:hover::after {
            opacity: 1;
        }
        .like-bar {
            margin-top: 50px;
            background-color: blue;
        }
        .comment-bar {
            background-color: orange;
        }
        .month-group:hover p,
        .selected p {
            color: #fff;
        }
        .h-25 {
            height: 25%;
        }
        .h-50 {
            height: 50%;
        }
        .h-75 {
            height: 75%;
        }
        .h-100 {
            height: 100%;
        }
        .info p {
            margin-bottom: 10px;
        }
        .info span {
            color: #fff;
        }
        .legend {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-top: 10px;
        font-size: 14px;
    }

    .legend .legend-item {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .legend .color-box {
        width: 15px;
        height: 15px;
        display: inline-block;
    }

    .color-like {
        background-color: blue;
    }

    .color-comment {
        background-color: orange;
    }
    </style>
</head>

<body style="background-color: beige;">
    <div class="header">
        <a href="dashboard.php"><img src="Asset/img/left.svg" class="left"></a>
        <img src="Asset/img/logo.png" class="logo1">
        <h2 style="margin-top: 20px;">Insight Report</h2>
    </div>
    <?php
    $query_like_count = mysqli_query($conn, "SELECT COUNT(*) AS total_like FROM `like_foto` WHERE `penerima_id` = $id");
    $row_like_count = mysqli_fetch_assoc($query_like_count);
    $total_like = $row_like_count['total_like'];

    $query_komentar_count = mysqli_query($conn, "SELECT COUNT(*) AS total_komentar FROM `komentar_foto` WHERE `penerima_id` = $id");
    $row_komentar_count = mysqli_fetch_assoc($query_komentar_count);
    $total_komentar = $row_komentar_count['total_komentar'];

    $query_album_count = mysqli_query($conn, "SELECT COUNT(*) AS total_album FROM `album` WHERE `user_id` = $id");
    $row_album_count = mysqli_fetch_assoc($query_album_count);
    $total_album = $row_album_count['total_album'];

    $query_foto_count = mysqli_query($conn, "SELECT COUNT(*) AS total_foto FROM `foto` WHERE `user_id` = $id");
    $row_foto_count = mysqli_fetch_assoc($query_foto_count);
    $total_foto = $row_foto_count['total_foto'];

    $query_like_per_month = mysqli_query($conn, "SELECT MONTH(tanggal_like) AS bulan, COUNT(*) AS total_like FROM like_foto 
            WHERE penerima_id = $id GROUP BY MONTH(tanggal_like)");
    $like_per_month = [];
    while ($row = mysqli_fetch_assoc($query_like_per_month)) {
        $like_per_month[$row['bulan']] = $row['total_like'];
    }
    $like_data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; 
    foreach ($like_per_month as $bulan => $total) {
        $like_data[$bulan - 1] = $total; 
    }

    // Ambil data komentar per bulan
    $query_comment_per_month = mysqli_query($conn, "SELECT MONTH(tanggal_komentar) AS bulan, COUNT(*) AS total_comment FROM komentar_foto 
    WHERE penerima_id = $id 
    GROUP BY MONTH(tanggal_komentar)");

    $comment_per_month = [];
    while ($row = mysqli_fetch_assoc($query_comment_per_month)) {
        $comment_per_month[$row['bulan']] = $row['total_comment'];
    }

    $comment_data = array_fill(0, 12, 0);
    foreach ($comment_per_month as $bulan => $total) {
        $comment_data[$bulan - 1] = $total;
    }

    $query_likes = mysqli_query($conn, "SELECT foto.*,user.username, COUNT(like_foto.foto_id) AS total_like 
                              FROM foto INNER JOIN user ON foto.user_id = user.user_id INNER JOIN like_foto ON foto.foto_id = like_foto.foto_id 
                              GROUP BY foto.foto_id ORDER BY total_like DESC limit 1");

    $query_comments = mysqli_query($conn, "SELECT foto.*,user.username, COUNT(komentar_foto.foto_id) AS total_comment
                              FROM foto INNER JOIN user ON foto.user_id = user.user_id INNER JOIN komentar_foto ON foto.foto_id = komentar_foto.foto_id 
                              GROUP BY foto.foto_id ORDER BY total_comment DESC limit 1");

$foto_like_terbanyak = mysqli_fetch_assoc($query_likes);
$foto_comment_terbanyak = mysqli_fetch_assoc($query_comments);
    ?>
    <center>
        <div class="main-container">
            <div class="year-stats">
                <?php
                $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                $max_value = max(array_merge($like_data, $comment_data));
                for ($i = 0; $i < 12; $i++) {
                    $like_count = $like_data[$i];
                    $comment_count = $comment_data[$i];

                    $like_height = ($max_value > 0) ? ($like_count / $max_value) * 100 : 0;
                    $comment_height = ($max_value > 0) ? ($comment_count / $max_value) * 100 : 0;
                    echo "
        <div class='month-group'>
            <div class='bar-container'>
                <div class='bar like-bar' style='height: {$like_height}%' data-count='{$like_count}'></div>
                <div class='bar comment-bar' style='height: {$comment_height}%' data-count='{$comment_count}'></div>
            </div>
            <p class='month'>{$months[$i]}</p>
        </div>";
                }
                ?>
            </div>
            <div class="legend">
    <div class="legend-item">
        <div class="color-box color-like"></div>
        <span>Likes</span>
    </div>
    <div class="legend-item">
        <div class="color-box color-comment"></div>
        <span>Comments</span>
    </div>
</div>
            <div class="info" style="display: flex; padding:10px; white-space:nowrap; margin-top:5px;">
                <p>Most Likes <br /><span><?php echo $foto_like_terbanyak['judul_foto']?> | <i><?php echo $foto_like_terbanyak['total_like']?> Likes</i></span></p>
                <p style="margin-left: 3%;">Most Comments <br><span><?php echo $foto_comment_terbanyak['judul_foto']?> | <i><?php echo $foto_comment_terbanyak['total_comment']?> Comments</i></span></p>
            </div>
        </div>
        </div>
    </center>



    <div class="container" style="margin-left: 6%; margin-bottom:40px;">
        <div class="card" style="width: 25rem; margin-left:10px; margin-top:2rem;border-radius:5px;">
            <div class="card-body">
                <h5 class="card-title">TOTAL ALBUMS <img src="Asset/icon/album.png" width="30px" height="30px"></h5>
                <b>
                    <h3 class="card-subtitle mb-2 text-muted"><?php echo $total_album ?></h3>
                </b>
            </div>
        </div>
        <div class="card" style="width: 25rem; margin-left:10px; margin-top:2rem;border-radius:5px;">
            <div class="card-body">
                <h5 class="card-title">TOTAL PHOTOS <img src="Asset/icon/images.svg" width="30px" height="30px"></h5>
                <b>
                    <h3 class="card-subtitle mb-2 text-muted"><?php echo $total_foto ?></h3>
                </b>
            </div>
        </div>
        <div class="card" style="width: 25rem; margin-left:10px; margin-top:2rem;border-radius:5px;">
            <div class="card-body">
                <h5 class="card-title">TOTAL LIKES <img src="Asset/icon/heart-alt.svg" width="30px" height="30px"></h5>
                <b>
                    <h3 class="card-subtitle mb-2 text-muted"><?php echo $total_like ?></h3>
                </b>
            </div>
        </div>
        <div class="card" style="width: 30rem; margin-left:10px; margin-top:2rem; border-radius:5px;">
            <div class="card-body">
                <h5 class="card-title">TOTAL COMMENTS <img src="Asset/icon/comment.svg" width="30px" height="30px"></h5>
                <b>
                    <h3 class="card-subtitle mb-2 text-muted"><?php echo $total_komentar ?></h3>
                </b>
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

    function confirmLogout() {
        var confirmation = confirm("Apakah Anda yakin ingin logout?");

        if (confirmation) {
            window.location.href = "logout.php";
        }

    }
</script>