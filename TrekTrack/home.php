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
    <script src="scripts/ongoingtrips.js" type="module" defer></script>
    <script src="scripts/main.js" type="module" defer></script>
    <title>Home</title>
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
                <!-- <li><a href="map.php"><i class="fa-solid fa-map not-link"></i><p>Map</p></a></li> -->
                <li><a href="contact.php"></p>Contact</p></a></li>
                <li><a href="profile.php"><i class="fa-solid fa-user not-link"></i>
                        <p>Profile</p>
                    </a></li>
            </ul>
        </nav>
        <div class="head account">
            <a href="login.php" id="button-head-log-in" style="display:<?= checkLoginStatus() ? "none" : "block" ?>;" class="button text-medium-invert-neutral bg-secondary border-secondary">Log In</a>
            <a href="signup.php" id="button-head-sign-up" style="display:<?= checkLoginStatus() ? "none" : "block" ?>;" class="button text-medium-secondary bg-primary-tint-1 border-primary-tint-1">Sign Up</a>
            <a href="login.php" id="button-head-log-out" style="display:<?= checkLoginStatus() ? "block" : "none" ?>;" class="button text-medium-invert-neutral bg-secondary border-secondary">Log Out</a>
        </div>
    </header>
    <main class="grid-home">
        <aside class="home collection bg-invert-neutral">
            <div class="profilepic">
                <a href="profile.php" class="not-link"><img src="<?= $avatarSrc ?>" id="collection-profile-pic" class="medium-avatar" alt="User-Profile">
                    <p id="collection-username" class="text-medium-neutral line-after-neutral clickable">@<?= $userName ?></p>
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
            <div class="container-ongoing-trip">
                <div class="ongoing-trip">
                    <p>Ongoing Trip:</p><a id="trip-toggle" class="" href='profile.php#ongoing-trips'> Switch Trip</a>
                    <div class="cont-icon"><i class="fa-solid fa-location-dot"></i>
                        <p id="start-text">Start</p>
                    </div>
                    <div class="cont-line">
                        <div class="line"></div>
                    </div>
                    <div class="cont-icon trip-stop"><i class="fa-solid fa-route"></i>
                        <p id="stops-text">Stop</p>
                    </div>
                    <div class="cont-line">
                        <div class="line"></div>
                    </div>
                    <div class="cont-icon"><i class="fa-solid fa-flag"></i>
                        <p id="end-text">End</p>
                    </div>
                </div>
            </div>
            <div id="trip-form-container" style="display: none;">
                <form id="trip-form">
                    <label for="start">Start:</label>
                    <input type="text" id="start" name="start" required>
                    <label for="stops">Stops:</label>
                    <input type="text" id="stops" name="stops" required>
                    <label for="end">End:</label>
                    <input type="text" id="end" name="end" required>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </aside>
        <div class="home feed bg-invert-neutral container-feed">
            <template id="template-post">
                <div class="post-container">
                    <div class="post-header">
                        <img alt="User Avatar" class="normal-avatar avatar post-avatar">
                        <div class="post-user-info">
                            <p class="post-username"></p>
                            <p class="post-timestamp"></p>
                            <p class="post-caption"></p>
                        </div>
                    </div>
                    <div class="post-image-container">
                        <img alt="Example Image" class="post-image">
                        <div class="image-footer">
                            <i class="fa-regular fa-heart like-button"></i>
                            <p class="like-count"></p>
                            <i class="fa-regular fa-comment"></i>
                            <i class="fa-regular fa-paper-plane"></i>
                        </div>
                    </div>
                    <div class="post-comments">
                        <div class="comments-header">
                            <a class="not-link clickable"><img src="images/profilepic.png" alt="User Avatar" class="small-avatar avatar"></a>
                            <a class="clickable not-link">
                                <p class="comment-account"><b></b>goat</p>
                            </a>
                        </div>
                        <p class="comment">welcome!</p>
                        <div class="comments-footer">
                            <p class="comment-timestamp">1w</p>
                            <p class="like-p">Like</p>
                            <p class="reply-p">Reply</p>
                        </div>
                    </div>
                </div>
            </template>
        </div>
<!--         <aside class="home social bg-invert-neutral">
        <div class="messages">
            <div class="heading">
                <h4>Messages</h4>
            </div>
            <div class="search-bar">
               
                <input type="search" placeholder="Search messages" id="message-search">
            </div>
            <div class="category">
                <h6 class="active">Primary</h6>
                <h6>General</h6>
                <h6 class="message-requests">Requests(7)</h6>
            </div>
        </div>
    </aside> -->
    </main>
    <footer class="quick-links bg-transparent">
        <p></p>
    </footer>
</body>

</html>