<?php
require_once 'utilities.php';

$userInfoArray = fetchUserInfoID($conn, $_SESSION['userid']);
$clientAvatarSrc = $userInfoArray["user_avatar_ref"];
$userBio = $userInfoArray["user_bio"];
$userID = $userInfoArray["user_id"];
$clientUserName = $userInfoArray["user_name"];