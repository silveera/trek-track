<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    function submitReply($conn, $commentID, $userID, $replyTo, $replyContent) {
        $query = "INSERT INTO comment_replies (comment_id, user_id, reply_to_name, reply_content) VALUES (?, ?, ?, ?);";

        $stmt = mysqli_prepare($conn, $query);

        /* if (!$stmt) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        } */

        mysqli_stmt_bind_param($stmt, "iiss", $commentID, $userID, $replyTo, $replyContent);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $commentID = $_POST['commentID'];
    $replyContent = $_POST['replyContent'];
    $replyTo = $_POST['replyTo'];

    submitReply($conn, $commentID, $userID, $replyTo, $replyContent);
}