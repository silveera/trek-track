<?php
require_once 'utilities.php';
require_once 'user-info-module.php';


function fetch_feed_items($limit, $conn) {

    $query = "SELECT u.user_name, u.user_avatar_ref, p.* FROM users u INNER JOIN posts p ON p.user_id = u.user_id ORDER BY p.created_at DESC LIMIT ?;";
    
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        /* header("location: ../signup.php?error=stmtfailed"); */
        echo "stmtfailed";
        exit();
    }



    mysqli_stmt_bind_param($stmt, 'i', $limit);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $feed_items = [];
    while ($post = mysqli_fetch_assoc($resultData)) {
        $feed_items[] = $post;
    }

    mysqli_close($conn);

    return $feed_items;
}

$feed_items = fetch_feed_items(10, $conn);
header('Content-Type: application/json');

echo json_encode($feed_items);