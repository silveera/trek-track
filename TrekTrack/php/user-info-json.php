<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

if (checkLoginStatus()) {
    header('Content-Type: application/json');
    echo fetchUserInfoJSON($conn, $_SESSION['userid']);
} else {
    echo json_encode(array("user_id" => "0", "user_name" => "Guest", "user_bio" => "You are not logged in.", "user_avatar_ref" => "filesystem/avatars/default.png"));
}

