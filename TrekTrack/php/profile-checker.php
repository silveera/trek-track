<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

if (!checkLoginStatus()) {
    header("location: login.php");
    exit();
}

$client = false;

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET["username"])) {
    $profileData = fetchUserInfoNAME($conn, $_GET["username"]);

    $avatarSrc = $profileData["user_avatar_ref"];
    $userBio = $profileData["user_bio"];
    $userName = $profileData["user_name"];
} else {
    $avatarSrc = $clientAvatarSrc;
    $userName = $clientUserName;

    $client = true;
}