<?php
require_once 'utilities.php';
if (isset($_POST["submit"])) {
    $username = $_POST["uid"];
    $password = $_POST["pw"];
    
    require_once 'error-inc.php';

    if (empty($username) || empty($password)) {
        header("location: ../login.php?error=emptyinput");
        exit();
    }

    $filename = '../userdata.csv';
    if (file_exists($filename)) {
        $file = fopen($filename, 'r');
        while (($line = fgetcsv($file, null, ";")) !== false) {
            if ($line[1] === $username) {
                // user exists, check password
                if (password_verify($password, $line[3])) {
                    // password is correct, set session variables and redirect
                    session_start();
                    $_SESSION["loggedin"] = true;
                    $_SESSION["userid"] = $line[0];
                    $_SESSION["username"] = $line[1];
                    $_SESSION["email"] = $line[2];
                    header("location: ../home.php");
                    exit();
                } else {
                    header("location: ../login.php?error=wrongpassword");
                    exit();
                }
            }
        }
        fclose($file);
        header("location: ../login.php?error=wronglogin");
        exit();
    } else {
        header("location: ../login.php?error=dberror");
        exit();
    }
} else {
    header("location: ../login.php");
}
