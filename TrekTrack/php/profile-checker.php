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

// this page checks if user is logged in with checkLoginStatus func, sets variable $client to false initially,
// this var will later used to determine if profile is of the logged-in user or another;
// check if request method is GET & if the username parameter is set in the URL;
// if it is, it fetches the user's info using fetchUserInfoNAME() func with the provided username;
// assigns the user's avatar, bio, & name to the respective vars $avatarSrc, $userBio, & $userName.
 
