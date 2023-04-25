<?php
require_once 'utilities.php';

$userInfoArray = fetchUserInfoID($conn, $_SESSION['userid']);
$avatarSrc = $userInfoArray["user_avatar_ref"];
$userBio = $userInfoArray["user_bio"];
$userID = $userInfoArray["user_id"];
$userName = $userInfoArray["user_name"];