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
    <script src="scripts/jquery-3.6.4.min.js"></script>
    <script src="scripts/feed.js" type="module" defer></script>
    <script src="scripts/darkmode.js" defer></script>
    <title>Home</title>
</head>

<body>
    <header class="primary-gradient">
        <div class="head logo">
            <a href="home.php" class="not-link"><img src="images/logoex.png" width="50" id="logo"
                    alt="Trek&Track-Logo"></a>
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
                <li class="toggle-switch-wrapper">
                    <label class="toggle-switch-label" for="toggle-switch-input">Dark Mode</label>
                    <div class="toggle-switch">
                        <input type="checkbox" id="toggle-switch-input">
                        <span class="toggle-switch-slider"></span>
                    </div>
                </li>
                <li><a href="home.php"><i class="fa-solid fa-house not-link"></i><p>Home</p></a></li>
                <li><a href="map.php"><i class="fa-solid fa-map not-link"></i><p>Map</p></a></li>
                <li><a href="profile.php"><i class="fa-solid fa-user not-link"></i><p>Profile</p></a></li>
            </ul>

        </nav>
        <div class="head account">
            <a href="login.php" id="button-head-log-in"
                style="display:<?= checkLoginStatus() ? "none" : "block"?>;" class="button text-medium-invert-neutral bg-secondary border-secondary">Log In</a>
            <a href="signup.php" id="button-head-sign-up"
                style="display:<?= checkLoginStatus() ? "none" : "block"?>;" class="button text-medium-secondary bg-primary-tint-1 border-primary-tint-1">Sign Up</a>
            <a href="login.php" id="button-head-log-out"
                style="display:<?= checkLoginStatus() ? "block" : "none"?>;" class="button text-medium-invert-neutral bg-secondary border-secondary">Log Out</a>
        </div>
    </header>
    <main class="grid-home">
        <aside class="home collection bg-invert-neutral">
            <div class="profilepic">
                <a href="profile.php" class="not-link"><img src="<?= $clientAvatarSrc ?>" id="collection-profile-pic"
                        class="medium-avatar avatar" alt="User-Profile">
                    <p id="collection-username" class="text-medium-neutral line-after-neutral clickable">@<?= $clientUserName ?></p>
                </a>
            </div>
            <div class="list-collection-container" >
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
            <div class="container-ongoing-trip">
                <div class="ongoing-trip">
                    <p>Ongoing trip:</p>
                    <div class="cont-icon"><i class="fa-solid fa-location-dot"></i><p>Start</p></div>
                    <div class="cont-line"><div class="line"></div></div>
                    <div class="cont-icon trip-stop"><i class="fa-solid fa-route"></i><p>Stop</p></div>
                    <div class="cont-line"><div class="line"></div></div>
                    <div class="cont-icon"><i class="fa-solid fa-flag"></i><p>End</p><div>
                </div>
            </div>
        </aside>
        <div class="home feed bg-invert-neutral container-feed">
            <template id="template-comment">
                <div class="container-comment">
                    <div class="comments-header">
                        <a class="not-link profile-link"><img alt="User Avatar"
                                class="small-avatar avatar comment-avatar"></a>
                        <a class="not-link profile-link">
                             <p class="comment-username"></p>
                        </a>
                        <p class="reply-content">replied to</p>
                        <a class="reply-content replied-to not-link"></a>
                    </div>
                    <div class="cont-comment-content"><textarea class="comment" name="comment-content" maxlength="280" rows="1" placeholder="Enter comment" readonly></textarea></div>
                    <div class="comments-footer">
                        <p class="comment-timestamp"></p>
                        <i class="fa-regular fa-heart comment-like-button" tabindex="0"></i><p class="comment-like-count counter"></p>
                        <i class="fa-regular fa-comments comment-reply-button" tabindex="0"></i><p class="comment-reply-count counter"></p>
                        <div class="non-reply-content show-replies clickable"><p><span class="show-status">Show</span><span class="comment-reply-count"></span>replies</p><i class="fa-solid fa-chevron-down"></i></div>
                    </div>
                    <div class="comment-replies"></div>
                </div>
            </template>
            <template id="template-post">
                <div class="post-container">
                    <div class="post-header">
                        <a class="profile-link not-link"><img alt="User Avatar" class="normal-avatar avatar post-avatar"></a>
                        <div class="post-user-info">
                            <a class="profile-link not-link"><p class="post-username"></p></a>
                            <p class="post-timestamp"></p>
                            <p class="post-caption"></p>
                        </div>
                    </div>
                    <div class="post-image-container">
                        <img alt="Example Image" class="post-image">
                        <div class="image-footer">
                            <i class="fa-regular fa-heart like-button" tabindex="0"></i><p class="like-count counter"></p>
                            <i class="fa-regular fa-comment comment-button" tabindex="0"></i><p class="comment-count counter"></p>
                            <i class="fa-regular fa-paper-plane"></i>
                        </div>
                    </div>
                    <div class="post-comments">
                        
                    </div>
                </div>
            </template>
        </div>
        <aside class="home social bg-invert-neutral">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum, fugit voluptatibus animi molestias nam non
                minima at, laudantium consectetur ipsam qui beatae dolorum pariatur quasi perferendis ratione, voluptate
                magnam ullam!</p>
        </aside>
    </main>
    <footer class="quick-links bg-transparent">
        <p></p>
    </footer>
</body>

</html>