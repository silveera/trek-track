<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    function submitTrip($conn, $userID, $tripTitle, $tripStart, $tripStop, $tripEnd) {
        $query = "INSERT INTO trips (user_id, trip_title, trip_start, trip_stop, trip_end) VALUES (?, ?, ?, ?, ?);";

        $stmt = mysqli_prepare($conn, $query);

        /* if (!$stmt) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        } */

        mysqli_stmt_bind_param($stmt, "issss", $userID, $tripTitle, $tripStart, $tripStop, $tripEnd);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $tripTitle = $_POST['trip_title'];
    $tripStart = $_POST['trip_start'];
    $tripStop = $_POST['trip_stop'];
    $tripEnd = $_POST['trip_end'];
    
    submitTrip($conn, $userID, $tripTitle, $tripStart, $tripStop, $tripEnd);
}