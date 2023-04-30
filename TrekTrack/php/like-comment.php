<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $comment_id = $_POST['comment_id'];

    function likeComment($conn, $comment_id, $userID) {
        $query = "SELECT * FROM comment_likes WHERE comment_id = ? AND user_id = ?;";
        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            /* header("location: ../signup.php?error=stmtfailed"); */
            echo "stmtfailed";
            exit();
        }

        mysqli_stmt_bind_param($stmt, 'ii', $comment_id, $userID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if(mysqli_fetch_assoc($resultData)) {
            $query = "DELETE FROM comment_likes WHERE comment_id = ? AND user_id = ?;";
            $q = 0;
        }
        else {
            $query = "SELECT * FROM comment_likes WHERE comment_id = ? AND user_id = 0;";
            $stmt = mysqli_prepare($conn, $query);

            mysqli_stmt_bind_param($stmt, "i", $comment_id);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);

            if (mysqli_fetch_assoc($resultData)) {
                $query = "UPDATE comment_likes SET user_id = ? WHERE comment_id = ?;";
                $q = 1;
            }
            else {
                $query = "INSERT INTO comment_likes (user_id, comment_id) VALUES (?, ?);";
                $q = 1;
            }
        }
        
        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            /* header("location: ../signup.php?error=stmtfailed"); */
            echo "stmtfailed";
            exit();
        }

        if ($q == 0) {
            mysqli_stmt_bind_param($stmt, 'ii', $comment_id, $userID);
        }
        else if ($q == 1) {
            mysqli_stmt_bind_param($stmt, 'ii', $userID, $comment_id);
        }

        mysqli_stmt_execute($stmt);

        mysqli_close($conn);
    }

    likeComment($conn, $comment_id, $userID);
}