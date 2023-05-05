<?php
require_once 'utilities.php';

function invalidUsername($username) {
    $min_length = 4;
    $max_length = 15;
    if (!preg_match("/^[a-zA-Z0-9]{{$min_length},{$max_length}}$/", htmlspecialchars_decode($username))) {
        $result = true;
    }    
    else {
        $result = false;
    }
    return $result;
}

// Function to check if the given username already exists in the db
function existingUsername($conn, $username) {
    $query = "SELECT * FROM users WHERE user_name = ?;";

    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if (mysqli_fetch_assoc($resultData)) {
        $result = true;
    }
    else {
        $result = false;
    }

    mysqli_stmt_close($stmt);
    return $result;
}

// Function to check if the given email already exists in the db
function existingEmail($conn, $email) {
    $query = "SELECT * FROM users WHERE user_email = ?;";

    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        header("location: ../signup.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if (mysqli_fetch_assoc($resultData)) {
        $result = true;
    }
    else {
        $result = false;
    }

    mysqli_stmt_close($stmt);
    return $result;
}


function invalidEmail($email) {
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

// Function to check if the given passwords do not match
function difPassword($password, $passwordrepeat) {
    if ($password !== $passwordrepeat) {
        $result = true;
    }
    else {
        $result = false;
    }
    return $result;
}
