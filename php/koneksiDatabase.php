<?php

//membuat koneksi file ke database
$dbhost = "localhost";
$dbname = "dbwebesteh";
$dbuser = "root";
$dbpass = "";
$koneksi = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

//jika tidak bisa masuk ke database
if(!$koneksi){
    die("Koneksi database gagal:" . mysqli_connect_error());
}
else{
    echo' <script>console.log("berhasil konek")</script>';
    
}
?>