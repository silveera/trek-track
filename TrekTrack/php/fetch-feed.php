<?php
require_once 'utilities.php';
require_once 'user-info-module.php';


function fetch_feed_items($limit, $conn) {

    $query = "SELECT
                u.user_name,
                u.user_avatar_ref,
                p.*,
                COUNT(l.like_id) AS like_amount,
                GROUP_CONCAT(l.user_id) AS liked_by
              FROM
                users u
              INNER JOIN
                posts p ON p.user_id = u.user_id
              LEFT JOIN
                likes l ON l.post_id = p.post_id AND l.user_id IS NOT NULL
              GROUP BY
                p.post_id,
                u.user_id
              ORDER BY
                p.created_at DESC
              LIMIT ?;";
    
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

    return $feed_items;
}

/* function likes($feed_items) {
    $values = '';
    foreach($feed_items as $key => $post){
        if ($key === array_key_last($feed_items)) {
            $values .= $post['post_id'];
        }
        else 
            $values .= $post['post_id'] . ',';
    }
    return $values;
};

function fetch_likes($values, $conn) {
    $query = "SELECT post_id, user_id FROM likes WHERE post_id IN ($values);";
    
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        echo "stmtfailed";
        exit();
    }

    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    $likes = [];
    while ($post = mysqli_fetch_assoc($resultData)) {
        $likes[] = $post;
    }

    mysqli_close($conn);

    return $likes;
} */

$feed_items = fetch_feed_items(10, $conn);

/* $values = likes($feed_items);
$likes = fetch_likes($values, $conn);

$result = ['feed_items' => $feed_items, 'likes' => $likes]; */

header('Content-Type: application/json');
echo json_encode($feed_items);