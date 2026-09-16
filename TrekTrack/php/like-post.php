<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $post_id = $_POST['post_id'];

// toggles a like for a post bya given user, then executes the SQL query based on 
// if the conditions are met.
    function likePost($conn, $post_id, $userID) {
        $query = "SELECT * FROM likes WHERE post_id = ? AND user_id = ?;";
        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            
            echo "stmtfailed";
            exit();
        }

        mysqli_stmt_bind_param($stmt, 'ii', $post_id, $userID);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if(mysqli_fetch_assoc($resultData)) {
            $query = "DELETE FROM likes WHERE post_id = ? AND user_id = ?;";
            $q = 0;
        }
        else {
            $query = "SELECT * FROM likes WHERE post_id = ? AND user_id = 0;";
            $stmt = mysqli_prepare($conn, $query);

            mysqli_stmt_bind_param($stmt, "i", $post_id);
            mysqli_stmt_execute($stmt);

            $resultData = mysqli_stmt_get_result($stmt);

            if (mysqli_fetch_assoc($resultData)) {
                $query = "UPDATE likes SET user_id = ? WHERE post_id = ?;";
                $q = 1;
            }
            else {
                $query = "INSERT INTO likes (user_id, post_id) VALUES (?, ?);";
                $q = 1;
            }
        }
        
        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            
            echo "stmtfailed";
            exit();
        }

        if ($q == 0) {
            mysqli_stmt_bind_param($stmt, 'ii', $post_id, $userID);
        }
        else if ($q == 1) {
            mysqli_stmt_bind_param($stmt, 'ii', $userID, $post_id);
        }

        mysqli_stmt_execute($stmt);

        mysqli_close($conn);
    }

    likePost($conn, $post_id, $userID);
}


// this page checks if the request method used is POST, if it is,
// it gets the post_id from the request & calls the likePost function 
// with the connection, post ID, & user ID parameters.
