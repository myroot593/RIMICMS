<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'cmsrimi');
$koneksi = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
if($koneksi === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>
