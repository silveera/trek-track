<?php
if (isset($_POST["submit"])) {
    $username = $_POST["uid"];
    $password = $_POST["pw"];
    
    require_once 'error-inc.php';

    if (empty($username) || empty($password)) {
        header("location: ../login.html?error=emptyinput");
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
                    $_SESSION["userid"] = $data[0];
                    $_SESSION["username"] = $data[1];
                    $_SESSION["email"] = $data[2];
                    header("location: ../home.html");
                    exit();
                } else {
                    header("location: ../login.html?error=wrongpassword");
                    exit();
                }
            }
        }
        fclose($file);
        header("location: ../login.html?error=wronglogin");
        exit();
    } else {
        header("location: ../login.html?error=dberror");
        exit();
    }
} else {
    header("location: ../login.html");
}
