<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function deleteItem($conn, $userID, $targetID, $deletionType) {
    
    $acceptedTypes = ['users', 'posts', 'comments', 'comment_replies', 'trips'];

    if (!in_array($deletionType, $acceptedTypes)) {
        echo "Deletion type not accepted.";
        exit();
    } 
    
    if ($deletionType == 'users' && ($userID != $targetID)) {
        echo "You are not authorized to delete this account.";
        exit();
    }

    switch ($deletionType) {
        case 'users':
            $query = "DELETE FROM users
                WHERE
                (user_id = ? AND user_id = ?);";
            break;
        case 'posts':
            $query = "DELETE FROM posts
                WHERE
                (post_id = ? AND user_id = ?);";
            break;
        case 'comments':
            $query = "DELETE FROM comments
                WHERE
                (comment_id = ? AND user_id = ?);";
            break;
        case 'comment_replies':
            $query = "DELETE FROM comment_replies
                WHERE
                (reply_id = ? AND user_id = ?);";
            break;
        case 'trips':
            $query = "DELETE FROM trips
                WHERE
                (trip_id = ? AND user_id = ?);";
            break;
        default:
            echo "Deletion type not accepted.";
            exit();
    }

    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        echo "stmtfailed";
        exit();
    };

    mysqli_stmt_bind_param($stmt, 'ii', $targetID, $userID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    };

    deleteItem($conn, $userID, $_POST['target_id'], $_POST['deletion_type']);
}