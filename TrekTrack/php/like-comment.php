<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $comment_id = $_POST['comment_id'];
    
// toggles a like for a comment by a given user, hecks if there's already
// a like for the specified comment & user in the comment_likes table,
// if the like exists, the function prepares a SQL query to delete the like.
// if the like doesn't exist, it checks if there's a like with a user ID set 
// to 0 (a placeholder) for the specified comment, if there is,
// it prepares a SQL query to update the user ID of that like to the given user ID. 
// if there isn't, it prepares a SQL query to insert a new like with the given user ID and comment ID
    function likeComment($conn, $comment_id, $userID) {
        $query = "SELECT * FROM comment_likes WHERE comment_id = ? AND user_id = ?;";
        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            
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

// The page checks if the request method used is POST, if it is, it gets the comment_id 
// from the request & calls the likeComment function with the connection, comment ID, & user ID parameters.
