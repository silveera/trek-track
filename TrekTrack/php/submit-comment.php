<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function submitComment($conn, $postID, $userID, $commentContent) {
        $query = "INSERT INTO comments (post_id, user_id, comment_content) VALUES (?, ?, ?);";

        $stmt = mysqli_prepare($conn, $query);

        /* if (!$stmt) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        } */

        mysqli_stmt_bind_param($stmt, "iis", $postID, $userID, $commentContent);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $postID = $_POST['postID'];
    $commentContent = $_POST['commentContent'];

    submitComment($conn, $postID, $userID, $commentContent);
}
