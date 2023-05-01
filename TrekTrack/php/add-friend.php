<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'add-friend'){

    function addFriend($conn, $userID, $receiver_ID) {
        $query = "INSERT INTO user_relations (sender_id, receiver_id) VALUES (?, ?);";
        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            /* header("location: ../signup.php?error=stmtfailed"); */
            echo "stmtfailed";
            exit();
        }

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
            /* header("location: ../signup.php?error=stmtfailed"); */
            echo "stmtfailed";
            exit();
        };

        mysqli_stmt_bind_param($stmt, 'iiii', $userID, $targetID, $targetID, $userID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    };

    removeFriend($conn, $userID, $_POST['target_id']);

} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'accept-friend') {

    function acceptFriend($conn, $userID, $targetID) {

        $query = "UPDATE user_relations
                    SET status = 'accepted',
                        updated_at = CURRENT_TIMESTAMP
                    WHERE (sender_id = ? AND receiver_id = ?)
                    OR (sender_id = ? AND receiver_id = ?);";
                    
        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            /* header("location: ../signup.php?error=stmtfailed"); */
            echo "stmtfailed";
            exit();
        };

        mysqli_stmt_bind_param($stmt, 'iiii', $userID, $targetID, $targetID, $userID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    };

    acceptFriend($conn, $userID, $_POST['target_id']);
}

