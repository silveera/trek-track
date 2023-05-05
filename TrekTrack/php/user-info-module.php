<?php
require_once 'utilities.php';

if (checkLoginStatus()) {
    $userInfoArray = fetchUserInfoID($conn, $_SESSION['userid']);
    $clientAvatarSrc = $userInfoArray["user_avatar_ref"];
    $userBio = $userInfoArray["user_bio"];
    $userID = $userInfoArray["user_id"];
    $clientUserName = $userInfoArray["user_name"];
} else {
    $clientAvatarSrc = "filesystem/avatars/default.png";
    $userBio = "You are not logged in.";
    $userID = "0";
    $clientUserName = "Guest";
}

