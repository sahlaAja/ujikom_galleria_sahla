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
</head>
<body style="background-color: beige;">
<div class="header">
<a href="dashboard.php"><img src="Asset/img/left.svg" class="left"></a>
            <img src="Asset/img/logo.png" class="logo1">
        </div>
    <h2 style="margin-top: 15px; margin-left:10px;">Insight Report</h2>
    <?php
    $query_like_count = mysqli_query($conn, "SELECT COUNT(*) AS total_like FROM `like_foto` WHERE `user_id` = $id");
    $row_like_count = mysqli_fetch_assoc($query_like_count);
    $total_like = $row_like_count['total_like'];
    ?>
    <div class="card" style="width: 18rem; margin-left:10px; margin-top:2rem;">
  <div class="card-body">
    <h5 class="card-title">TOTAL LIKE</h5>
    <b><h4 class="card-subtitle mb-2 text-muted"><?php echo $total_like?></h4></b>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
    <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
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