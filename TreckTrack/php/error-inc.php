<?php

function noInputSignup($username, $email, $password, $passwordrepeat) {
    $result;
    if (empty($username) || empty($email) || empty($password) || empty($passwordrepeat)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function invalidUsername($username) {
    $result;
    $min_length = 6;
    $max_length = 15;
    if (!preg_match("/^[a-zA-Z0-9]*{$min_length, $max_length}$/", $username)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function existingUsername($conn, $username) {
    $sql = "SELECT * FROM users WHERE usersUid = ?;";
    $stmt = mysqli_stmt_init($conn);
    $result;
    $resultData = mysqli_stmt_get_result($stmt);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.html?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    if ($row != mysqli_fetch_assoc($resultData)) {
        $result = false
        return $result;
    }
}

function invalidEmail($email, FILTER_VALIDATE_EMAIL) {
    $result;
    $domain = substr(strrchr($email, "@"), 1);
    $blacklist = []; //Blank for now. Admin panel implementation can edit. Maybe blacklist should be hashed too??
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || in_array($domain, $blacklist)) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}

function existingEmail($conn, $email) {
    $sql = "SELECT * FROM users WHERE usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn);
    $result;
    $resultData = mysqli_stmt_get_result($stmt);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../signup.html?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    if ($row != mysqli_fetch_assoc($resultData)) {
        $result = false;
        return $result;
    }
}

function difPassword($password, $passwordrepeat) {
    $result;
    if ($password !== $passwordrepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}