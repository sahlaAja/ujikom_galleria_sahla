<?php
include "connection.php";
$id = $_SESSION['id'];
$role = $_SESSION['role'];

// Query untuk mendapatkan tahun yang ada data like
$query_tahun_like = mysqli_query($conn, "
    SELECT DISTINCT YEAR(tanggal_like) AS tahun
    FROM like_foto
    WHERE penerima_id = $id
");
$tahun_like = [];
while ($row = mysqli_fetch_assoc($query_tahun_like)) {
    $tahun_like[] = $row['tahun'];
}

// Query untuk mendapatkan tahun yang ada data komentar
$query_tahun_comment = mysqli_query($conn, "
    SELECT DISTINCT YEAR(tanggal_komentar) AS tahun
    FROM komentar_foto
    WHERE penerima_id = $id
");
$tahun_comment = [];
while ($row = mysqli_fetch_assoc($query_tahun_comment)) {
    $tahun_comment[] = $row['tahun'];
}

// Gabungkan kedua array tahun like dan comment
$tahun_data = array_unique(array_merge($tahun_like, $tahun_comment));

// Tambahkan tahun sekarang ke dalam array tahun data jika belum ada
$tahun_sekarang = date('Y');
if (!in_array($tahun_sekarang, $tahun_data)) {
    $tahun_data[] = $tahun_sekarang;
}

// Urutkan tahun data
sort($tahun_data);
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
    <link rel="stylesheet" href="report.css">
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

    $tahun = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

    $query_like_per_month = mysqli_query($conn, "SELECT MONTH(tanggal_like) AS bulan, COUNT(*) AS total_like FROM like_foto 
            WHERE penerima_id = $id AND YEAR(tanggal_like) = $tahun GROUP BY MONTH(tanggal_like)");
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
    WHERE penerima_id = $id AND YEAR(tanggal_komentar) = $tahun
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
                              FROM foto INNER JOIN user ON foto.user_id = user.user_id INNER JOIN like_foto ON foto.foto_id = like_foto.foto_id WHERE like_foto.penerima_id = $id 
                              GROUP BY foto.foto_id  ORDER BY total_like DESC limit 1");

    $query_comments = mysqli_query($conn, "SELECT foto.*,user.username, COUNT(komentar_foto.foto_id) AS total_comment
                              FROM foto INNER JOIN user ON foto.user_id = user.user_id INNER JOIN komentar_foto ON foto.foto_id = komentar_foto.foto_id WHERE komentar_foto.penerima_id = $id
                              GROUP BY foto.foto_id ORDER BY total_comment DESC limit 1");

$foto_like_terbanyak = mysqli_fetch_assoc($query_likes);
$foto_comment_terbanyak = mysqli_fetch_assoc($query_comments);
    ?>
    <center>
    <?php
    ?>
    <div class="main-container">
        <div style="margin-left:-90%;">
        <form method="GET" action="">
    <select name="tahun" onchange="this.form.submit()">
        <?php
        // Ambil tahun yang dipilih, default ke tahun sekarang
        $tahun_sekarang = isset($_GET['tahun']) ? $_GET['tahun'] : date('Y');

        // Tampilkan dropdown dengan tahun-tahun yang valid
        foreach ($tahun_data as $tahun) {
            $selected = ($tahun_sekarang == $tahun) ? 'selected' : '';
            echo "<option value='{$tahun}' {$selected}>{$tahun}</option>";
        }
        ?>
    </select>
</form>
        </div>


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
                <?php
                if ($foto_like_terbanyak == NULL) {
                    echo "<p>Most Likes <br /><span>No Data</span></p>";
                }else{
                ?>
                <p>Most Likes <br /><span><?php echo $foto_like_terbanyak['judul_foto']?> | <i><?php echo $foto_like_terbanyak['total_like']?> Likes</i></span></p>
                <?php } if ($foto_comment_terbanyak == NULL) {
                    echo "<p style='margin-left: 3%;'>Most Comments <br /><span>No Data</span></p>";
                }else{?>
                <p style="margin-left: 3%;">Most Comments <br><span><?php echo $foto_comment_terbanyak['judul_foto']?> | <i><?php echo $foto_comment_terbanyak['total_comment']?> Comments</i></span></p>
                <?php } ?>
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