<?php
require_once 'utilities.php';
require_once 'user-info-module.php';
require_once 'profile-checker.php';

/* $query = "SELECT * FROM users WHERE user_name = ?;";

$stmt = mysqli_prepare($conn, $query);

if (!$stmt) {
    header("location: ../signup.php?error=stmtfailed");
    exit();
}

mysqli_stmt_bind_param($stmt, "s", $clientUserName);
mysqli_stmt_execute($stmt);

$resultData = mysqli_stmt_get_result($stmt);

$userInfoArray = mysqli_fetch_assoc($resultData);

mysqli_stmt_close($stmt); */

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $client) {

    $userBio = $_POST["p-bio"];

    if ($_FILES['p-avatar']['error'] == 4 || ($_FILES['p-avatar']['size'] == 0 && $_FILES['p-avatar']['error'] == 0 && $_FILES['p-avatar']['size'] < 1000000)){
        echo "No file was uploaded.";
    } else {

        $allowedMimeTypes = ['image/jpeg', 'image/png'];
        $fileMimeType = mime_content_type($_FILES["p-avatar"]["tmp_name"]);

        if (in_array($fileMimeType, $allowedMimeTypes)) {
            $uploadDir = '../filesystem/avatars/';
            $type = explode(".", $_FILES["p-avatar"]["name"]);
            $fileName = $userID . '.' . end($type);
            /* $fileName = $userID . ".png"; */
            $uploadFile = $uploadDir . $fileName;
            $newRef = "filesystem/avatars/" . $fileName;

            $result = glob($uploadDir . $userID . ".*");

            if (!empty($result)) {
                foreach ($result as $file) {
                    unlink($file);
                }
            }
                
            echo '<pre>';
            if (move_uploaded_file($_FILES['p-avatar']['tmp_name'], $uploadFile)) {
                echo "File is valid, and was successfully uploaded.\n";
            } else {
                echo "Possible file upload attack!\n";
            }

            echo 'Here is some more debugging info:';
            print_r($_FILES);

            print "</pre>";

            /* imagepng(imagecreatefromstring(file_get_contents($_FILES["p-avatar"]["tmp_name"])), $uploadFile, 5); */

            /* echo "File is valid, and was successfully uploaded.\n"; */
            if ($clientAvatarSrc != $newRef || !file_exists($uploadFile)) {
                $query = "UPDATE users SET user_avatar_ref = ? WHERE user_id = ?;";

                $stmt = mysqli_prepare($conn, $query);

                /* if (!$stmt) {
                    header("location: ../signup.php?error=stmtfailed");
                    exit();
                } */

                mysqli_stmt_bind_param($stmt, "si", $newRef, $userID);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
            };

            /* if (!file_exists($uploadFile)) { */
            /* } */
    /*         echo 'Here is some more debugging info:';
            print_r($_FILES);
            print_r($_SESSION); */
        } else {
            echo "Invalid file type. Please upload a JPEG, or PNG image.";
        };
    };

    if (!empty($userBio)) {
        $query = "UPDATE users SET user_bio = ? WHERE user_id = ?;";

        $stmt = mysqli_prepare($conn, $query);

        /* if (!$stmt) {
            header("location: ../signup.php?error=stmtfailed");
            exit();
        } */

        mysqli_stmt_bind_param($stmt, "si", $userBio, $userID);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    };

    header("location: ../profile.php");
} else {
    echo "You cannot edit another user's profile.";
}