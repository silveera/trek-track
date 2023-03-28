<?php
session_start();

require_once 'utilities.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["submit"])) {

    require_once 'error-inc.php';
    require_once 'database-inc.php';

    $username = sanitize($_POST["uid"]);
    $email = sanitize($_POST["email"]);
    $password = $_POST["pw"];
    $passwordrepeat = $_POST["pw-rpt"];
    
    $_SESSION["signusername"] = $username;
    $_SESSION["signemail"] = $email;
    $_SESSION["signpassword"] = $password;

    $errMsg = "";
    $errType = [];

    if (empty($username)) {
        array_push($errType, "username", "missing");
    } else {
        session_start();
        
        if (invalidUsername($username) == true) {
            $errMsg .= nl2br("*Username needs to be between 6 and 15 characters.\n");
            array_push($errType, "username");
        } elseif (existingUsername($conn, $username) == true) {
            $errMsg .= nl2br("*An account with this username already exists.\n");
            array_push($errType, "username");
        }
    }

    if (empty($email)) {
        array_push($errType, "email", "missing");
    } else {
        
        if (invalidEmail($email) == true) {
            $errMsg .= nl2br("*Please enter a valid email.\n");
            array_push($errType, "email");
        } elseif (existingEmail($conn, $email) == true) {
            $errMsg .= nl2br("*An account with this email already exists. \n");
            array_push($errType, "email");
        }
    }

    if (empty($password)) {
        array_push($errType, "password", "missing");
    }

    if (empty($passwordrepeat)) {
        array_push($errType, "passwordrepeat", "missing");
    } else {
        if (difPassword($password, $passwordrepeat) == true) {
            $errMsg .= nl2br("*Passwords do not match.\n");
            array_push($errType, "passwordrepeat");
        }
    }

    if (in_array("missing", $errType)) {
        $errMsg .= nl2br("*Please fill out the required fields.\n");
    }

    if ($errMsg != "") {
        header("location: ../signup.php?error=invalidsignup");
        $_SESSION["signerrormsg"] = trim($errMsg);
        $_SESSION["signerrortypes"] = $errType;
        exit();
    }

    function createUser($conn, $username, $email, $password) {
        $sql = "INSER INTO users (usersUid, usersEmail, usersPw) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        $resultData = mysqli_stmt_get_result($stmt);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.php?error=stmtfailed");

        }
            
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../signup.php?error=none");
    }

    createUser($conn, $username, $email, $password);
} else {
    header("location: ../signup.php");
}
    