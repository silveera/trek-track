<?php
require_once 'utilities.php';

/* mysql --host=anysql.itcollege.ee --user=ICS0008_WT_X
--password
 */
/* The database server is: anysql.itcollege.ee
Do note!
The DBMS can only be accessed from itcollege.ee domain!
• From home (or elsewhere) you need to establish a SSH connection
to enos.itcollege.ee and then connect to DB at anysql.itcollege.ee
•MySQL Workbench has a SSH tunneling option */

/* DATABASE,USER,PASSWORD
ICS0008_15,ICS0008_WT_15,b765f0649248 */

/*
$serverName = "127.0.0.1";
$dbUsername = "root";
$dbPassword = "";
$dbName = "trektrack"; */

$serverName = "anysql.itcollege.ee";
$dbUsername = "ICS0008_WT_15";
$dbPassword = "b765f0649248";
$dbName = "ICS0008_15";

$conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

