<?php
require_once 'php/utilities.php';
require_once 'php/user-info-module.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/Icon.svg">
    <link rel="stylesheet" href="styles/newstyle.css">
    <script src="https://kit.fontawesome.com/66d74c224c.js" crossorigin="anonymous"></script>
    <script src="scripts/darkmode.js" defer></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="scripts/jquery-3.6.4.min.js"></script>
    <script src="scripts/feed.js" type="module" ></script>
    <script src="scripts/social.js" type="module" ></script>
    <script src="scripts/ongoingtrips.js" type="module" ></script>
    <title>Home</title>
<noscript>Your browser does not support JavaScript!</noscript></head>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v16.0" nonce="w8VcQxbH"></script>
    <header class="primary-gradient">
        <div class="head logo">
            <a href="home.php" class="not-link" style="margin-bottom: -0.1em; margin-top: -0.3em; margin-left: 0.2em;"><img src="images/Banner.svg" width="170px" id="logo" alt="Trek&Track-Logo"></a>
        </div>
        <nav class="text-medium-invert-neutral">
            <ul class="head nav-list">
                <li class="toggle-switch-wrapper">
                    <label class="toggle-switch-label clickable" for="toggle-switch-input">Dark Mode</label>
                    <div class="toggle-switch">
                        <label class="switch">
                            <input type="checkbox" id="toggle-switch-input">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </li>
                <li><a href="home.php"><i class="fa-solid fa-house not-link"></i><p>Home</p></a></li>
                <li><a href="profile.php"><i class="fa-solid fa-user not-link"></i><p>Profile</p></a></li>
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
                <a href="profile.php" class="not-link"><img src="<?= $clientAvatarSrc ?>" id="collection-profile-pic"
                        class="medium-avatar avatar" alt="User-Profile">
                    <p id="collection-username" class="text-medium-neutral line-after-neutral clickable"><?= $clientUserName ?></p>
                </a>
            </div>
            <div class="list-collection-container" >
            <ul class="list-collection">
                <li>
                    <a class="not-link" href="profile.php#posts"><p><i class="fa-regular fa-images"></i>My Posts</p></a>
                </li>
                <li>
                    <a class="not-link" href="profile.php#trips"><p id="collection-trips" class="icon"><i class="fa-regular fa-map"></i>My Trips</p></a>
                </li>
            </ul>
            </div>
            <div class="cont-line collection-center"><div class="line"></div></div>
            <div class="container-ongoing-trip current-trip">
                <p class="text-medium-invert-neutral p-ongoing-trip">Ongoing Trip:</p>
                <div class="trip-cont-invis" style="display: none;">
                <div class="trip-header">
                    <div class="trip-creator">
                        <p class="trip-title">Loading...</p>
                        <p class="trip-timestamp">Loading...</p>
                    </div>
                    <div>
                        <a href="profile.php#trips" class="not-link"><i class="fa-solid fa-arrow-right-arrow-left switch-trip-button" title="Switch Ongoing Trip" tabindex="0"></i></a>
                    </div>
                </div>
                <div class="ongoing-trip">
                    <div class="cont-icon"><i class="fa-solid fa-location-dot"></i>
                        <p class="trip-start">Loading...</p><span>Start</span>
                    </div>
                    <div class="cont-line">
                        <div class="line"></div>
                    </div>
                    <div class="cont-icon trip-stop"><i class="fa-solid fa-route"></i>
                        <p class="trip-stops">Loading...</p><span>Stop</span>
                    </div>
                    <div class="cont-line">
                        <div class="line"></div>
                    </div>
                    <div class="cont-icon"><i class="fa-solid fa-flag"></i>
                        <p class="trip-end">Loading...</p><span>End</span>
                    </div>
                </div>
                </div>
                <div class="no-ongoing-trips">
                    <p>You do not have any ongoing trips. Click <a href="profile.php#trips" class="not-link"><i class="fa-solid fa-arrow-right-arrow-left switch-trip-button" title="Switch Ongoing Trip" style="color: var(--accent-tint-1);" tabindex="0"></i></a> to pick or create one!</p>
                </div>
            </div>
        </aside>
        <div class="home feed bg-invert-neutral">
            <div class="container-feed">
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
                        <i class="fa-regular fa-heart comment-like-button" tabindex="0" title="Like"></i><p class="comment-like-count counter"></p>
                        <i class="fa-regular fa-comments comment-reply-button" tabindex="0" title="Reply"></i><p class="comment-reply-count counter"></p>
                        <div class="non-reply-content show-replies clickable show-button"><p><span class="show-status">Show</span><span class="comment-reply-count"></span>replies</p><i class="fa-solid fa-chevron-down"></i></div>
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
                            <i class="fa-regular fa-heart like-button" tabindex="0" title="Like"></i><p class="like-count counter"></p>
                            <i class="fa-regular fa-comment comment-button" tabindex="0" title="Add Comment"></i><p class="comment-count counter"></p><div class="show-comments clickable show-button"><p><span class="show-status">Show</span><span class="comment-count"></span>comments</p><i class="fa-solid fa-chevron-down"></i></div>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=" class="facebook-btn not-link" target="_blank"><i class="fa-brands fa-facebook share-btn" title="Share Page on Facebook"></i></a>
                            <a href="https://twitter.com/intent/tweet?text=https://enos.itcollege.ee/~badurm/trektrack1/TrekTrack/home.php" class="twitter-btn not-link" target="_blank"><i class="fa-brands fa-square-twitter share-btn" title="Share Page on Twitter"></i></a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url=https://enos.itcollege.ee/~badurm/trektrack1/TrekTrack/home.php" class="linkedin-btn not-link" target="_blank"><i class="fa-brands fa-linkedin share-btn" title="Share Page on LinkedIn"></i></a>
                        </div>
                    </div>
                    <div class="post-comments">
                    </div>
                </div>
            </template>
            </div>
            <footer class="quick-links bg-transparent">
                <ul>
                    <li><a href="about.php">About Us</a></li>
                    <li><a href="contact.php">Contact</a></li>
                    <li><a href="privacy.php">Privacy</a></li>
                </ul>
            </footer>
        </div>
        <aside class="home social bg-invert-neutral">
            <div class="container-friend-searchbar">
                <h1 class="text-medium-neutral">Friends</h1>
                <input type="search" class="search" id="friends-search" placeholder="Search or add">
            </div>
            <div class="no-friends-container">
                <p>It appears you have no friends yet!</p><br>
                <p>Search for them using the searchbar or add them on their profile to get started.</p>
            </div>
            <div class="social-container">
                <template id="friend-template">
                <div class="friend-container">
                    <a class="clickable not-link profile-link"><img alt="User Avatar" class="okay-avatar avatar friend-avatar"></a>
                    <div class="friend-info">
                        <a class="clickable not-link friend-username profile-link"></a>
                        <div class="container-status-buttons">
                        <p class="status-text"></p>
                        <i class="fa-solid fa-user-plus positive button-add-friend status-none" title="Add Friend" tabindex="0"></i>
                        <i class="fa-solid fa-user-xmark negative button-reject-friend status-received" title="Reject Friend" tabindex="0"></i>
                        <i class="fa-solid fa-user-check positive button-accept-friend status-received" title="Accept Friend" tabindex="0"></i>
                        <i class="fa-solid fa-user-minus negative button-remove-friend status-accepted" title="Remove Friend" tabindex="0"></i>
                        </div>
                    </div>
                </div>
                </template>
            </div>
        </aside>
    </main>
</body>

</html>