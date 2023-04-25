<?php
require_once 'utilities.php';
require_once 'user-info-module.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !(empty($_POST["new-post-caption"]) && empty($_FILES['new-post-image']['name']))) {

    if (!empty($_POST["new-post-caption"])) {
        $caption = $_POST["new-post-caption"];
    } else {
        $caption = "";
    } 

    $postIDsql = "SELECT MAX(post_id) as max_post_id FROM posts;";
    $postIDresult = mysqli_fetch_assoc(mysqli_query($conn, $postIDsql));

    $maxPostID = $postIDresult["max_post_id"];

    if ($maxPostID == NULL) {
        $maxPostID = 0;
    };

    $postID = $maxPostID + 1;
    if ($_FILES['new-post-image']['error'] == 4 || ($_FILES['new-post-image']['size'] == 0 && $_FILES['new-post-image']['error'] == 0 && $_FILES['new-post-image']['size'] < 1000000)){
        echo "No file was uploaded.";
        $newRef = "";
    } else {
        $allowedMimeTypes = ['image/jpeg', 'image/png'];
        $fileMimeType = mime_content_type($_FILES["new-post-image"]["tmp_name"]);

        if (in_array($fileMimeType, $allowedMimeTypes)) {
            $uploadDir = '../filesystem/posts/';
            $fileName = $postID . "_" . $userID . ".png";

            $uploadFile = $uploadDir . $fileName;

            $newRef = "filesystem/posts/" . $fileName;

            if (file_exists($uploadFile)) {
                unlink($uploadFile);
            };
                    
            imagepng(imagecreatefromstring(file_get_contents($_FILES["new-post-image"]["tmp_name"])), $uploadFile, 5);
        } else {
            $newRef = "";
            echo "Invalid file type. Please upload a JPEG, or PNG image.";
        };
    }

    $query = "INSERT INTO posts(user_id, caption, image_ref) VALUES (?, ?, ?);";
    $stmt = mysqli_prepare($conn, $query);

    if (!$stmt) {
        header("location: ../profile.php?error=stmtfailed");
    }
                
    mysqli_stmt_bind_param($stmt, "iss", $userID, $caption, $newRef);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    
    header("location: ../profile.php");
}