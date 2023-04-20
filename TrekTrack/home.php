<?php
require_once 'php/utilities.php'; 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/newstyle.css">
    <script src="https://kit.fontawesome.com/66d74c224c.js" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                <a href="profile.php" class="not-link"><img src="images/profilepic.png" id="collection-profile-pic"
                        class="medium-avatar" alt="User-Profile">
                    <p id="collection-username" class="text-medium-neutral line-after-neutral clickable">@username</p>
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
        </aside>
        <div class="home feed bg-invert-neutral">
            <div class="post-container">
                <div class="post-header">
                    <img src="images/profilepic.png" alt="User Avatar" id="post-avatar" class="avatar">
                    <div class="post-user-info">
                        <h3 id="post-username">Username</h3>
                        <p id="post-timestamp">2 weeks ago</p>
                        <p id="post-caption">Hello im new here</p>
                    </div>
                </div>
                <div class="post-image-container">
                    <img src="images/trialbg.jpg" alt="Example Image" id="post-image">
                    <div class="image-footer">
                        <i class="fa-regular fa-heart"></i>
                        <i class="fa-regular fa-paper-plane"></i>
                        <i class="fa-regular fa-comment"></i>
                        <i class="fa-regular fa-map"></i>
                        <i class="fa-regular fa-bookmark"></i>
                    </div>
                </div>
                <div class="post-comments">
                    <div class="comments-header">
                        <a class="not-link clickable"><img src="images/profilepic.png" alt="User Avatar"
                                id="comment-avatar" class="small-avatar"></a>
                        <a class="clickable not-link">
                            <p id="comment-account"><b></b>goat</p>
                        </a>
                    </div>
                    <p id="comment">welcome!</p>
                    <div class="comments-footer">
                        <p id="comment-timestamp">1w</p>
                        <p id="like-p">Like</p>
                        <p id="reply-p">Reply</p>
                        <p id="share-p">Share</p>
                    </div>
                </div>
            </div>
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