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

// this page checks if req method is POST,
// submitComment() func takes the connection, post ID, user ID, & comment content as parameters,
// creates SQL query to insert new comment into "comments" table in db with the given post ID, user ID, & comment content,
// prepares SQL query using mysqli_prepare(), binds parameters (post ID, user ID, and comment content) to statement,
// using mysqli_stmt_bind_param(), executes statement with mysqli_stmt_execute(), closes statement using mysqli_stmt_close(),
// gets post ID & comment content from $_POST superglobal array, calls submitComment() func with connection, post ID, user ID, & 
// comment content.
