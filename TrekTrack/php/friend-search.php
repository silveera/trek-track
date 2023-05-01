<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'search-friends') {
    function fetchRelationInfo($conn, $currentUserID, $search){
        $query = "SELECT users.user_id,
                            users.user_name,
                            users.user_avatar_ref,
                            COALESCE(user_relations.status, 'none') AS relation_status,
                            user_relations.updated_at,
                            CASE
                                WHEN user_relations.status IS NOT NULL THEN user_relations.sender_id
                                ELSE NULL
                            END AS sender_id,
                            CASE
                                WHEN user_relations.status IS NOT NULL THEN user_relations.receiver_id
                                ELSE NULL
                            END AS receiver_id
                    FROM users
                    LEFT JOIN user_relations
                        ON (users.user_id = user_relations.sender_id AND user_relations.receiver_id = ?)
                        OR (users.user_id = user_relations.receiver_id AND user_relations.sender_id = ?)
                    WHERE users.user_id != ? AND (users.user_name LIKE ? 
                    OR (? = '' AND (user_relations.status = 'pending' OR user_relations.status = 'accepted')))
                    ORDER BY relation_status ASC, COALESCE(user_relations.updated_at, '9999-12-31') DESC, users.user_name DESC;";

        $stmt = mysqli_prepare($conn, $query);

        if (!$stmt) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        if ($search != '') {
            $search = $search . '%';
        }

        mysqli_stmt_bind_param($stmt, "iiiss", $currentUserID, $currentUserID, $currentUserID, $search, $search);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        $friendsArray = [];
        while ($row = mysqli_fetch_assoc($resultData)) {
            $friendsArray[] = $row;
        }

        return $friendsArray;
    }

    $friendsSearch = fetchRelationInfo($conn, $userID, $_GET['query']);

    header('Content-Type: application/json');
    echo json_encode($friendsSearch);
}