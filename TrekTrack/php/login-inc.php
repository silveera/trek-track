<?php
session_start();

require_once 'utilities.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["submit"])) {

    require_once 'error-inc.php';
    require_once 'database-inc.php';

    $username = sanitize($_POST["uid"]);
    $password = $_POST["pw"];

    $_SESSION["loginusername"] = $username;
    $_SESSION["loginpassword"] = $password;

    $errMsg = "";
    $errType = [];

    if (empty($username)) {
        array_push($errType, "username", "missing");
        $errMsg .= nl2br("*Please enter your username.\n");
    }
    if (empty($password)) {
        array_push($errType, "password", "missing");
        $errMsg .= nl2br("*Please enter your password.\n");
    }
    
    if (in_array("missing", $errType) && in_array("username", $errType) && in_array("password", $errType)) {
        $errMsg = "";
        $errMsg .= nl2br("*Please fill out the required fields.\n");
    }

    function loginUser($conn, $username, $password) {
        $uidExists = existingUsername($conn, $username);

        if ($uidExists === false) {
            // no username error message
            exit();
        }

        $pwHashed = $uidExists["usersPwd"];
        $checkPassword = password_verify($password, $pwHashed);
        
        if ($checkPassword === false) {
            // password incorrect error message
            exit();
        }
        else if ($checkPassword === true) {
            session_start();
            $_SESSION["userid"] = $uidExists["usersId"];
            $_SESSION["useruid"] = $uidExists["usersUid"];
            header("location: ../home.php");
            exit();
        }
    }

    if ($errMsg != "") {
        header("location: ../login.php?error=invalidlogin");
        $_SESSION["loginerrormsg"] = trim($errMsg);
        $_SESSION["loginerrortypes"] = $errType;
        exit();
    }
} else {
    header("location: ../login.php");
}