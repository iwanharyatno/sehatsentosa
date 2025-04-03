<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "db_sehatsentosa";

$db = mysqli_connect($hostname, $username, $password, $dbname);

if (!$db) {
    die("Gagal terhubung ke database" . mysqli_connect_error());
}