<?php

if (isset($_POST["submit"])) {

    require_once 'error-inc.php';

    $username = sanitize($_POST["uid"]);
    $email = sanitize($_POST["email"]);
    $password = $_POST["pw"];
    $passwordrepeat = $_POST["pw-rpt"];

    $errMsg = "";
    $errType = [];

    //require_once 'database-inc.php';
    
    if (noInputSignup($username, $email, $password, $passwordrepeat) == true) {
        header("location: ../signup.html?error=noinput");
        $errMsg .= nl2br("Please fill out the required fields.\n");
        array_push($errType, "username");
        exit();
    }
    if (invalidUsername($username) == true) {
        header("location: ../signup.html?error=invaliduid");
        $errMsg .= nl2br("Username needs to be between 6 and 15 characters.\n");
        array_push($errType, "username");
        exit();
    }
    if (existingUsernameCSV($username) == true) {
        header("location: ../signup.html?error=uidexists");
        $errMsg .= nl2br("An account with this username already exists.\n");
        array_push($errType, "username");
        exit();
    }
    if (invalidEmail($email) == true) {
        header("location: ../signup.html?error=invalidemail");
        $errMsg .= nl2br("Please enter a valid email.\n");
        array_push($errType, "email");
        exit();
    }
    if (existingEmailCSV($email) == true) {
        header("location: ../signup.html?error=emailexists");
        $errMsg .= nl2br("An account with this email already exists. \n");
        array_push($errType, "email");
        exit();
    }
    if (difPassword($password, $passwordrepeat) == true) {
        header("location: ../signup.html?error=unidenticalpasswords");
        $errMsg .= nl2br("Passwords do not match.\n");
        array_push($errType, "password");
        exit();
    }
    /*
    function createUser($conn, $username, $email, $password) {
        $sql = "INSER INTO users (usersUid, usersEmail, usersPw) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        $resultData = mysqli_stmt_get_result($stmt);
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ../signup.html?error=stmtfailed");
            exit();
        }
            
        mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPassword);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: ../signup.html?error=none");
        exit();
    }
    createUser($conn, $username, $email, $password);
    */
    function uuid_create() {
        $uuid = sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
        return $uuid;
    }    
    function generateUUID() {
        $idg = uuid_create();
      
        if (file_exists("../userdata.csv")) {
            if (($handle = fopen("../userdata.csv", "r")) !== FALSE) {
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                    if (in_array($idg, $data)) {
                        fclose($handle);
                        return generateUUID();
                    }
                }
                fclose($handle);
            }
        }
      
        return $idg;
    }      
    function createUserCSV($username, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $uuid = generateUUID();
        $row = [$uuid, $username, $email, $hashedPassword];

        $file = fopen('../userdata.csv', 'a');
        fputcsv($file, $row, ';');
        fclose($file);

        header("location: ../signup.html?error=none");
        exit();
    }
    createUserCSV($username, $email, $password);
}
else {
    header("location: ../signup.html");
}