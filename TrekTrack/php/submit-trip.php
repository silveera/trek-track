<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST["action"])) {

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
    header('location: ../profile.php#trips');

} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
    function fetchTrips($conn, $targetUserID, $userID) {
        $query = "SELECT * FROM trips WHERE user_id = ? OR (user_id = ? && status = '1') ORDER BY created_at DESC;";

        $stmt = mysqli_prepare($conn, $query);

        /* if (!$stmt) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        } */

        mysqli_stmt_bind_param($stmt, "ii", $targetUserID, $userID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        $trips = [];
        while ($trip = mysqli_fetch_assoc($resultData)) {
            $trips[] = $trip;
        }

        /* header('location: ../profile.php'); */
        return $trips;
    }

    $targetUserID = $_GET['id'];

    header('Content-Type: application/json');
    echo json_encode(fetchTrips($conn, $targetUserID, $userID));

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST["action"] == 'toggleOngoing' && isset($_POST["toggleTo"])) {

    function setOngoing($conn, $tripID, $toggleTo) {
        $query = "UPDATE trips SET status = ? WHERE trip_id = ?;";

        $stmt = mysqli_prepare($conn, $query);

        /* if (!$stmt) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        } */

        mysqli_stmt_bind_param($stmt, "ii", $toggleTo, $tripID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $tripID = $_POST['trip_id'];
    $toggleTo = $_POST['toggleTo'];

    setOngoing($conn, $tripID, $toggleTo);
    header('location: ../profile.php#trips');
}