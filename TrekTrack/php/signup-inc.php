<?php

if (isset($_POST["submit"])) {

    $username = $_POST["uid"];
    $email = $_POST["email"];
    $password = $_POST["pw"];
    $passwordrepeat = $_POST["pw-rpt"];

    require_once 'database-inc.php';
    require_once 'error-inc.php';

    if (noInputSignup($username, $email, $password, $passwordrepeat) == true) {
        header("location: ../signup.html?error=noinput");
        exit();
    }
    if (invalidUsername($username) == true) {
        header("location: ../signup.html?error=invaliduid");
        exit();
    }
    if (existingUsername($conn, $username) == true) {
        header("location: ../signup.html?error=uidexists");
        exit();
    }
    if (invalidEmail($username) == true) {
        header("location: ../signup.html?error=invalidemail");
        exit();
    }
    if (existingEmail($conn, $username) == true) {
        header("location: ../signup.html?error=emailexists");
        exit();
    }
    if (difPassword($password, $passwordrepeat) == true) {
        header("location: ../signup.html?error=unidenticalpasswords");
        exit();
    }
    function createUser($conn, $username, $email, $password) {
        $sql = "INSER INTO users (usersUid, usersEmail, usersPw) VALUES (?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        $result = NULL;
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
}
else {
    header("location: ../signup.html");
}