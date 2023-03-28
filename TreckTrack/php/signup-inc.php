<?php

if (isset($_POST["submit"])) {

    $username = $_POST["uid"];
    $email = $_POST["email"];
    $password = $_POST["pw"];
    $passwordrepeat = $_POST["pw-rpt"];

    //require_once 'database-inc.php';
    require_once 'error-inc.php';

    if (noInputSignup($username, $email, $password, $passwordrepeat) == true) {
        header("location: ../signup.html?error=noinput");
        exit();
    }
    if (invalidUsername($username) == true) {
        header("location: ../signup.html?error=invaliduid");
        exit();
    }
    if (existingUsernameCSV($username) == true) {
        header("location: ../signup.html?error=uidexists");
        exit();
    }
    if (invalidEmail($email) == true) {
        header("location: ../signup.html?error=invalidemail");
        exit();
    }
    if (existingEmailCSV($email) == true) {
        header("location: ../signup.html?error=emailexists");
        exit();
    }
    if (difPassword($password, $passwordrepeat) == true) {
        header("location: ../signup.html?error=unidenticalpasswords");
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
      
        if (file_exists("userdata.csv")) {
            if (($handle = fopen("userdata.csv", "r")) !== FALSE) {
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

        $file = fopen('userdata.csv', 'a');
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