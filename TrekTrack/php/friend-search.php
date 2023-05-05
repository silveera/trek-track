<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'search-friends') {
    // function for fetching friend relationships for a given user ID and search query in friend search bar,
    // uses SQL query that joins the users and user_relations tables to get information about the users and their relationship 
    // statuses. search query is used to filter users based on their user names, or if the search query is empty, it returns
    // users with 'pending' or 'accepted' relationship statuses. returns an array of users containing information like user ID,
    // user name, user avatar reference, relation status, and the sender and receiver IDs for the relationship.

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
                    ORDER BY
                    CASE 
                        WHEN relation_status = 'none' THEN 1
                        WHEN relation_status = 'pending' THEN 2
                        WHEN relation_status = 'accepted' THEN 3
                    END,
                    COALESCE(user_relations.updated_at, '9999-12-31') DESC,
                    users.user_name DESC;";

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

        $_SESSION['updateTime'] = time();
        return $friendsArray;
    }

    $friendsSearch = fetchRelationInfo($conn, $userID, $_GET['query']);

    header('Content-Type: application/json');
    echo json_encode($friendsSearch);
}

// if the request method is GET & the action parameter is 'search-friends', page calls the fetchRelationInfo function with the
// connection, user ID, & search query parameters. returns the friend search results, & the script sets the content type to JSON
// & echoes the JSON-encoded array of friend search results.
