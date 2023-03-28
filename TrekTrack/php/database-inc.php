<?php
require_once 'utilities.php';

//$serverName = "anysql.itcollege.ee";
//$dbUserame = "ICS0008_WT_15";
//$dbPassword = "b765f0649248";
//$dbName = "ICS0008_15";
$serverName = "localhost";
$dbUserame = "root";
$dbPassword = "";
$dbName = "test";

$conn = mysqli_connect($serverName, $dbUserame, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}