<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $post_id = $_POST['post_id'];

    function likePost($conn, $post_id) {
        $query = "UPDATE posts SET likes = likes + 1 WHERE post_id = ?;";

        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            /* header("location: ../signup.php?error=stmtfailed"); */
            echo "stmtfailed";
            exit();
        }

        mysqli_stmt_bind_param($stmt, 'i', $post_id);
        mysqli_stmt_execute($stmt);

        mysqli_close($conn);
    }

    likePost($conn, $post_id);
}