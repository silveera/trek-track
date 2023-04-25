<?php
session_start();

require_once 'database-inc.php';
require_once 'utilities.php';

function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function checkLoginStatus()
{
    if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        return true;
    }
    return false;
}

function checkValue($value)
{
    if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION[$value]) && !empty($_SESSION[$value])) {
        return true;
    }
    return false;
}

function checkValueAndReturn($value)
{
    if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION[$value]) && !empty($_SESSION[$value])) {
        return $_SESSION[$value];
    }
    
    return "";
}

function checkArraySetMissing($arraykey, $value)
{
    if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION[$arraykey]) && !empty($_SESSION[$arraykey])) {
        if (in_array($value, $_SESSION[$arraykey])) {
            return "input-missing";
        }
    }
    return "";
}

function setUserInfo($conn, $username) {
    $query = "SELECT * FROM users WHERE user_name = ?;";

    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $userInfoArray = mysqli_fetch_assoc($resultData);

    return $userInfoArray;
}   

function fetchUserInfoJSON($conn, $userid) {
    $query = "SELECT * FROM users WHERE user_id = ?;";

    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        /* header("location: ../signup.php?error=stmtfailed"); */
        echo "stmtfailed";
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $userid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $userInfoArray = mysqli_fetch_assoc($resultData);

    /* print_r(json_encode($userInfoArray)); */

    return json_encode($userInfoArray);
}   

function fetchUserInfoID($conn, $userid) {
    $query = "SELECT * FROM users WHERE user_id = ?;";

    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        /* header("location: ../signup.php?error=stmtfailed"); */
        echo "stmtfailed";
        exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $userid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $userInfoArray = mysqli_fetch_assoc($resultData);

    /* print_r(json_encode($userInfoArray)); */

    return $userInfoArray;
}   

$currentDate = gmdate("y-m-d h:i:s");

