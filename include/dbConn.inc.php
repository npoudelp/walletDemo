<?php

$msg = "";

$dbUrl = "127.0.0.1";
$dbUser = "root";
$dbPasswd = "root";
$dbName = "cello";
$conn = mysqli_connect($dbUrl, $dbUser, $dbPasswd, $dbName);
if(!$conn){
    $msg = "Error connecting to database...";
    echo $msg;
    die();
}

?>