<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

// Checking if the request method is using POST insteead of GET & it is doing 'add-friend'
if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'add-friend'){

// Function for adding a friend by inserting it into the user_relations table in DB
    function addFriend($conn, $userID, $receiver_ID) {
        // Preparing SQL query to insert sender_id & receiver_id into the user_relations table in DB
        $query = "INSERT INTO user_relations (sender_id, receiver_id) VALUES (?, ?);";
        $stmt = mysqli_prepare($conn, $query);

// If statement fails, output an error message & exit
        if (!$stmt) {
            
            echo "stmtfailed";
            exit();
        }
// Binding the parameters to statement, execute it, & close it
        mysqli_stmt_bind_param($stmt, 'ii', $userID, $receiver_ID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    addFriend($conn, $userID, $_POST['receiver_id']);

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'remove-friend') {

    function removeFriend($conn, $userID, $targetID) {

        $query = "DELETE FROM user_relations
                    WHERE
                    (sender_id = ? AND receiver_id = ?)
                    OR
                    (sender_id = ? AND receiver_id = ?);";
        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            
            echo "stmtfailed";
            exit();
        };

        mysqli_stmt_bind_param($stmt, 'iiii', $userID, $targetID, $targetID, $userID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    };

    removeFriend($conn, $userID, $_POST['target_id']);

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'accept-friend') {
// Function for accepting a friend request by updating the status in the user_relations table
    function acceptFriend($conn, $userID, $targetID) {
// Preparing SQL query to update the status and updated_at timestamp in the user_relations table
        $query = "UPDATE user_relations
                    SET status = 'accepted',
                        updated_at = CURRENT_TIMESTAMP
                    WHERE (sender_id = ? AND receiver_id = ?)
                    OR (sender_id = ? AND receiver_id = ?);";
                    
        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            
            echo "stmtfailed";
            exit();
        };

        mysqli_stmt_bind_param($stmt, 'iiii', $userID, $targetID, $targetID, $userID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    };

    acceptFriend($conn, $userID, $_POST['target_id']);
}

