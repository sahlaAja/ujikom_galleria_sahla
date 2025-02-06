<?php
include "connection.php";

if (isset($_GET['file'])) {
    $file = $_GET['file'];

    $file_path = 'Asset/img/'.$file;

    if (file_exists($file_path)) {
        header('Content-Description: File transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
header('Content-Length: '.filesize($file_path));


        readfile($file_path);
        exit;
    }else {
        echo "File tidak ditemukan";
    }
}else {
    echo "Parameter file tidak ada";
}
?>