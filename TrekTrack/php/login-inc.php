<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["submit"])) {

    require_once 'utilities.php';
    require_once 'error-inc.php';

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
        global $errMsg, $errType;

        $userInfo = fetchUserInfoNAME($conn, $username);

        $pwHashed = $userInfo["user_password"];
        $checkPassword = password_verify($password, $pwHashed);

        if ($uidExists === false) {
            $errMsg = "";
            $errMsg .= nl2br("*This user does not exist.\n");
            array_push($errType, "username");
            
        } else if ($checkPassword === false && !empty($password)) {
            $errMsg .= nl2br("*Password is incorrect.\n");
            array_push($errType, "password");
        }


        if ($checkPassword === true) {
            session_unset();
            $_SESSION["userid"] = $userInfo["user_id"];
            $_SESSION["userName"] = $userInfo["user_name"];
            $_SESSION["userEmail"] = $userInfo["user_email"];
            $_SESSION['loggedin'] = true;
            
            header("location: ../home.php");
            exit();
        }
    }

    loginUser($conn, $username, $password);

    if ($errMsg != "") {
        header("location: ../login.php?error=invalidlogin");
        $_SESSION["loginerrormsg"] = trim($errMsg);
        $_SESSION["loginerrortypes"] = $errType;
        exit();
    }

} else {
    header("location: ../login.php");
}