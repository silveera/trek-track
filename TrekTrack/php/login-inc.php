<?php
session_start();

require_once 'utilities.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["submit"])) {

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

    $filename = '../userdata.csv';
    if (file_exists($filename)) {
        $file = fopen($filename, 'r');
        while (($line = fgetcsv($file, null, ";")) !== false) {
            if ($line[1] === $username) {
                $userfound = true;
                if (password_verify($password, $line[3])) {
                    $passwordvalid = true;
                    // password is correct, set session variables and redirect
                    session_unset();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["userid"] = $line[0];
                    $_SESSION["username"] = $line[1];
                    $_SESSION["email"] = $line[2];
                    header("location: ../home.php");
                    exit();
                } 
            }
        }
        fclose($file);
        header("location: ../login.php?error=wronglogin");

        if ($userfound != true && !in_array("username", $errType)) {
            $errMsg .= nl2br("*This user does not exist.\n");
            array_push($errType, "username");
        }
        if ($passwordvalid != true && !in_array("password", $errType) && $userfound == true) {
            $errMsg .= nl2br("*Password is incorrect.\n");
            array_push($errType, "password");
        }
    } else {
        header("location: ../login.php?error=dberror");
        exit();
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