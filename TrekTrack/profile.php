<?php
require_once 'php/utilities.php';
require_once 'php/user-info-module.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/newstyle.css">
    <script src="https://kit.fontawesome.com/66d74c224c.js" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="scripts/jquery-3.6.4.min.js"></script>
    <script src="scripts/profile.js" type="module" defer></script>
    <script src="scripts/modal.js" type="module" defer></script>
</head>

<body>
    <header class="primary-gradient">
        <div class="head logo">
            <a href="home.php" class="not-link"><img src="images/logoex.png" width="50" id="logo" alt="Trek&Track-Logo"></a>
            <a href="home.php" class="text-thick-invert-neutral not-link logo-text">
                <p>Trek&Track</p>
            </a>
        </div>
        <div class="head search-bar bg-invert-neutral">
            <label for="head-search-bar" id="label-head-search-bar"></label>
            <!-- <i class="fa-solid fa-magnifying-glass"></i> -->
            <input type="search" id="head-search-bar" placeholder=" Search Trek&Track..." name="search">
        </div>
        <nav class="text-medium-invert-neutral">
            <ul class="head nav-list">
                <li><a href="home.php"><i class="fa-solid fa-house not-link"></i>
                        <p>Home</p>
                    </a></li>
                <li><a href="map.php"><i class="fa-solid fa-map not-link"></i>
                        <p>Map</p>
                    </a></li>
                <li><a href="profile.php"><i class="fa-solid fa-user not-link"></i>
                        <p>Profile</p>
                    </a></li>
            </ul>
        </nav>
        <div class="head account">
            <a href="login.php" id="button-head-log-out" style="display:<?= checkLoginStatus() ? "block" : "none" ?>;" class="button text-medium-invert-neutral bg-secondary border-secondary">Log Out</a>
        </div>
    </header>
    <main class="grid-home">
        <aside class="home collection bg-invert-neutral">
            <div class="profilepic">
                <a href="profile.php" class="not-link"><img id="avatar" src="<?= $avatarSrc ?>" class="medium-avatar avatar" alt="User-Profile">
                    <p id="collection-username" class="text-medium-neutral clickable">@<?= $userName ?></p>
                </a>
            </div>
            <div class="list-collection-container">
                <ul class="list-collection">
                    <li>
                        <p id="collection-trips" class="icon"><i class="fa-regular fa-map"></i>My Trips</p>
                        <div class="dropdown-content">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia qui perferendis labore
                                possimus, asperiores cupiditate explicabo vero deserunt delectus similique nam deleniti
                                fugiat dolorem natus nisi quod eligendi culpa dignissimos.</p>
                        </div>
                    </li>
                    <li>
                        <p><i class="fa-regular fa-calendar"></i>Calendar</p>
                        <div class="dropdown-content">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia qui perferendis labore
                                possimus, asperiores cupiditate explicabo vero deserunt delectus similique nam deleniti
                                fugiat dolorem natus nisi quod eligendi culpa dignissimos.</p>
                        </div>
                    </li>
                    <li>
                        <p>Friends' Trips</p>
                        <div class="dropdown-content">
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Officia qui perferendis labore
                                possimus, asperiores cupiditate explicabo vero deserunt delectus similique nam deleniti
                                fugiat dolorem natus nisi quod eligendi culpa dignissimos.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </aside>
        <div class="profile bg-invert-neutral">
            <form class="container-p-header" id="form-edit-profile" method="post" enctype="multipart/form-data" action="php/edit-profile.php">
                <div id="container-p-avatar" class="container-p-avatar" style="position: relative;">
                    <label for="input-p-avatar" id="label-input-p-avatar" style="position: absolute; display: none;"><i class="fa-solid fa-camera-rotate"></i></label>
                    <input type="file" id="input-p-avatar" style="display: none;" accept="image/jpeg, image/png" name="p-avatar">
                    <img id="p-avatar" src="<?= $avatarSrc ?>" class="large-avatar avatar" >
                </div>
                <div class="container-p-bio">
                    <div>
                        <div class="container-p-bio-header">
                            <p id="p-username" class="text-medium-neutral"><?= $userName ?></p>
                            <button type="button" id="button-p-edit">Edit Profile</button>
                            <button type="button" id="button-p-settings"><i class="fa-solid fa-gear"></i></button>
                        </div>
                        <div class="container-p-bio-text" id="container-p-bio-text">
                            <textarea readonly id="text-p-bio" style="cursor: default; background-color: inherit;" rows="4" maxlength="280" name="p-bio"><?= $userBio ?></textarea>
                        </div>
                    </div>
                </div>
            </form>
            <div class="container-p-content-buttons">
                <div>
                    <div class="container-p-content-button">
                        <button id="button-p-posts" class="not-button button-p-content">My Posts</button>
                    </div>
                    <button id="button-p-new-post" class="button-p-new not-button button-new-post"><i class="fa-solid fa-plus"></i></button>
                    <div id="modal-new-post" class="modal">
                        <div class="post-container">
                            <div class="modal-header">
                                <h1>Create a post!</h1>
                            </div>
                            <form id="form-new-post" method="post" enctype="multipart/form-data" action="php/submit-post.php">
                                <div class="post-header">
                                    <img src="<?= $avatarSrc ?>" alt="User Avatar" id="post-avatar" class="normal-avatar avatar">
                                    <div class="post-user-info">
                                        <h3 id="post-username"><?= $userName ?></h3>
                                        <p id="post-timestamp" class="post-timestamp" data-date=""><?= $currentDate ?></p>
                                        <textarea id="new-post-caption" name="new-post-caption" maxlength="280" rows="1" placeholder="Enter caption: Maximum length 280"></textarea>
                                    </div>
                                </div>
                                <div class="post-image-container" id="post-image-container">
                                    <input type="file" accept="image/jpeg, image/png" id="new-post-image" style="display: none;" name="new-post-image">
                                    <label for="new-post-image" id="label-post-image"><i class="fa-solid fa-folder-plus"></i><p>Upload an image.<br>This is optional; you can also just post your text!</p>
                                    </label>
                                </div>
                                <div class="buttons-modal-new-post">
                                    <button type="reset" id="cancel-new-post" class="modal-close" name="cancel">Cancel</button>
                                    <button type="button" id="button-new-post-submit" name="submit">Submit Post</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                    <div>
                        <div class="container-p-content-button">
                            <button id="button-p-trips" class="not-button button-p-content">My Trips</button>
                        </div>
                        <button id="button-p-new-trip" class="button-p-new not-button"><i class="fa-solid fa-plus"></i></button>
                    </div>
                </div>
                <div class="container-p-content">
                    <div class="container-p-posts">
                        <div class="container-p-no">
                            <p>
                                It appears you have no posts yet. Click the button below to share a memory!
                            </p>
                            <button id="button-first-post">
                                Create New Post
                            </button>
                        </div>
                    </div>
                    <div class="container-p-trips hidden">
                        <div class="container-p-no">
                            <p>
                                It appears you have no trips yet. Click the button below to start planning your next adventure!
                            </p>
                            <button>
                                Plan New Trip
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <aside class="home social bg-invert-neutral" style="display: none;">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, fugit voluptatibus animi molestias nam non
                    minima at, laudantium consectetur ipsam qui beatae dolorum pariatur quasi perferendis ratione, voluptate
                    magnam ullam!</p>
            </aside>
    </main>
    
</body>

</html>