<?php
require_once 'php/utilities.php';
require_once 'php/user-info-module.php';
require_once 'php/profile-checker.php';

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
    <title>Profile</title>
    <script src="scripts/jquery-3.6.4.min.js"></script>
    <script src="scripts/profile.js" type="module"></script>
    <script src="scripts/modal.js" type="module"></script>
    <script src="scripts/feed.js" type="module"></script>
    <script src="scripts/social.js" type="module"></script>
    <script src="scripts/tripmodal.js" type="module"></script>
</head>

<body>
    <header class="primary-gradient">
        <div class="head logo">
            <a href="home.php" class="not-link" style="margin-bottom: -0.1em; margin-top: -0.3em; margin-left: 0.2em;"><img src="images/Banner.svg" width="170px" id="logo" alt="Trek&Track-Logo"></a>
        </div>
        <nav class="text-medium-invert-neutral">
            <ul class="head nav-list">
                <li class="toggle-switch-wrapper">
                    <label class="toggle-switch-label" for="toggle-switch-input">Dark Mode</label>
                    <div class="toggle-switch">
                        <label class="switch">
                            <input type="checkbox" id="toggle-switch-input">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </li>
                <li><a href="home.php"><i class="fa-solid fa-house not-link"></i>
                        <p>Home</p>
                    </a></li>
                <li><a href="contact.php"></p>Contact</p></a></li>
                <li><a href="profile.php"><i class="fa-solid fa-user not-link"></i>
                        <p style="border-bottom:2px solid;">Profile</p>
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
                <a href="profile.php" class="not-link"><img id="avatar" src="<?= $clientAvatarSrc ?>" class="medium-avatar avatar" alt="User-Profile">
                    <p id="collection-username" class="text-medium-neutral clickable"><?= $clientUserName ?></p>
                </a>
            </div>
            <div class="list-collection-container">
                <ul class="list-collection">
                    <li>
                        <p><i class="fa-regular fa-images"></i>My Posts</p>
                    </li>
                    <li>
                        <p id="collection-trips" class="icon"><i class="fa-regular fa-map"></i>My Trips</p>
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
        </aside>
        <div class="profile bg-invert-neutral">
            <form class="container-p-header" id="form-edit-profile" method="post" enctype="multipart/form-data" action="php/edit-profile.php" <?= $client ? "" : "disabled" ?>>
                <div id="container-p-avatar" class="container-p-avatar" style="position: relative;">
                    <label for="input-p-avatar" id="label-input-p-avatar" style="position: absolute; display: none;"><i class="fa-solid fa-camera-rotate"></i></label>
                    <input type="file" id="input-p-avatar" style="display: none;" accept="image/jpeg, image/png" name="p-avatar">
                    <img id="p-avatar" src="<?= $avatarSrc ?>" class="large-avatar avatar">
                </div>
                <div class="container-p-bio">
                    <div>
                        <div class="container-p-bio-header">
                            <p id="p-username" class="text-medium-neutral"><?= $userName ?></p>
                            <button type="button" id="button-p-edit" style="display: <?= $client ? "flex" : "none" ?>;">Edit Profile</button>
                            <?php if (!$client) { ?>
                                <div class="friend-container profile-page">
                                    <i class="fa-solid fa-user-plus positive button-add-friend status-none" tabindex="0"></i>
                                    <i class="fa-solid fa-user-xmark negative button-reject-friend status-received" tabindex="0"></i>
                                    <i class="fa-solid fa-user-check positive button-accept-friend status-received" tabindex="0"></i>
                                    <i class="fa-solid fa-user-minus negative button-remove-friend status-accepted" tabindex="0"></i>
                                </div>
                            <?php } ?>
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
                        <button id="button-p-posts" class="not-button button-p-content"><?= $client ? "My" : "$userName's" ?> Posts</button>
                    </div>
                    <?php if ($client) { ?>
                        <button id="button-p-new-post" class="button-p-new not-button button-new-post"><i class="fa-solid fa-plus"></i></button>
                        <div id="modal-new-post" class="modal">
                            <div class="post-container">
                                <div class="modal-header">
                                    <h1>Create a post!</h1>
                                </div>
                                <form id="form-new-post" method="post" enctype="multipart/form-data" action="php/submit-post.php">
                                    <div class="post-header">
                                        <img src="<?= $clientAvatarSrc ?>" alt="User Avatar" id="post-avatar" class="normal-avatar avatar">
                                        <div class="post-user-info">
                                            <p class="post-username"><?= $clientUserName ?></p>
                                            <p id="post-timestamp" class="post-timestamp" data-date=""><?= $currentDate ?></p>
                                            <textarea id="new-post-caption" name="new-post-caption" maxlength="280" rows="1" placeholder="Enter caption: Maximum length 280"></textarea>
                                        </div>
                                    </div>
                                    <div class="post-image-container" id="post-image-container">
                                        <input type="file" accept="image/jpeg, image/png" id="new-post-image" style="display: none;" name="new-post-image">
                                        <label for="new-post-image" id="label-post-image"><i class="fa-solid fa-folder-plus"></i>
                                            <p>Upload an image.<br>This is optional; you can also just post your text!</p>
                                        </label>
                                    </div>
                                    <div class="buttons-modal-new-post">
                                        <button type="reset" id="cancel-new-post" class="modal-close" name="cancel">Cancel</button>
                                        <button type="button" id="button-new-post-submit" name="submit">Submit Post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div>
                    <div class="container-p-content-button">
                        <button id="button-p-trips" class="not-button button-p-content"><?= $client ? "My" : "$userName's" ?> Trips</button>
                    </div>
                    <?php if ($client) { ?>
                        <button id="button-p-new-trip" class="button-p-new not-button"><i class="fa-solid fa-plus"></i></button>
                    <?php } ?>
                    <div id="modal-new-trip" class="modal">
                        <div class="trip-container">
                            <div class="modal-header">
                                <h1>Create a Trip!</h1>
                            </div>
                            <form id="form-new-trip" method="post" action="php/submit-trip.php">
                                    <div class="trip-header">
                                        <img src="<?= $avatarSrc ?>" alt="User Avatar" id="trip-avatar" class="normal-avatar avatar">
                                        <div class="trip-info-header">
                                            <p id="trip-username" class="username"><?= $userName ?></p>
                                            <p id="trip-timestamp" class="trip-timestamp" data-date=""><?= $currentDate ?></p>
                                        </div>
                                    </div>
                                    <div class="trip-content">
                                        <textarea id="new-trip-title" name="trip_title" maxlength="32" rows="1" cols="32" placeholder="Enter Trip Title..."></textarea>
                                        <div class="container-ongoing-trip">
                                            <div class="ongoing-trip">
                                                <div class="cont-icon"><i class="fa-solid fa-location-dot"></i>
                                                    <input type="text" id="input-start" name="trip_start" placeholder="Trip Start" class="new-trip-input" maxlength="24">
                                                </div>
                                                <div class="cont-line">
                                                    <div class="line"></div>
                                                </div>
                                                <div class="cont-icon trip-stop"><i class="fa-solid fa-route"></i>
                                                    <input type="text" id="input-stop" name="trip_stop" placeholder="Trip Stop" class="new-trip-input" maxlength="24">
                                                </div>
                                                <div class="cont-line">
                                                    <div class="line"></div>
                                                </div>
                                                <div class="cont-icon"><i class="fa-solid fa-flag"></i>
                                                    <input type="text" id="input-destination" name="trip_end" placeholder="Destination" class="new-trip-input" maxlength="24">
                                                </div>
                                            </div>
                                        </div>
                                    <div class="buttons-modal-new-trip">
                                        <button type="reset" id="cancel-new-trip" class="modal-close" name="cancel">Cancel</button>
                                        <button type="button" id="btn-new-trip-submit" name="submit" class='modal-close'>Submit Trip</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-p-content">
                <div class="container-p-posts">
                    <div class="container-p-no">
                        <?php if ($client) { ?>
                            <p>
                                It appears you have no posts yet. Click the button below to share a memory!
                            </p>
                            <button id="button-first-post">
                                Create New Post
                            </button>
                        <?php } else { ?>
                            <p>
                                It appears <?= $userName ?> has no posts yet.
                            </p>
                        <?php } ?>
                    </div>
                    <template id="template-comment">
                        <div class="container-comment">
                            <div class="comments-header">
                                <a class="not-link profile-link"><img alt="User Avatar" class="small-avatar avatar comment-avatar"></a>
                                <a class="not-link profile-link">
                                    <p class="comment-username"></p>
                                </a>
                                <p class="reply-content">replied to</p>
                                <a class="reply-content replied-to not-link"></a>
                            </div>
                            <div class="cont-comment-content"><textarea class="comment" name="comment-content" maxlength="280" rows="1" placeholder="Enter comment" readonly></textarea></div>
                            <div class="comments-footer">
                                <p class="comment-timestamp"></p>
                                <i class="fa-regular fa-heart comment-like-button" tabindex="0"></i>
                                <p class="comment-like-count counter"></p>
                                <i class="fa-regular fa-comments comment-reply-button" tabindex="0"></i>
                                <p class="comment-reply-count counter"></p>
                                <div class="non-reply-content show-replies clickable">
                                    <p><span class="show-status">Show</span><span class="comment-reply-count"></span>replies</p><i class="fa-solid fa-chevron-down"></i>
                                </div>
                            </div>
                            <div class="comment-replies"></div>
                        </div>
                    </template>
                    <template id="template-post">
                        <div class="post-container">
                            <div class="post-header">
                                <a class="profile-link not-link"><img alt="User Avatar" class="normal-avatar avatar post-avatar"></a>
                                <div class="post-user-info">
                                    <a class="profile-link not-link">
                                        <p class="post-username"></p>
                                    </a>
                                    <p class="post-timestamp"></p>
                                    <p class="post-caption"></p>
                                </div>
                            </div>
                            <div class="post-image-container">
                                <img alt="Example Image" class="post-image">
                                <div class="image-footer">
                                    <i class="fa-regular fa-heart like-button" tabindex="0"></i>
                                    <p class="like-count counter"></p>
                                    <i class="fa-regular fa-comment comment-button" tabindex="0"></i>
                                    <p class="comment-count counter"></p>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=" class="facebook-btn not-link" target="_blank"><i class="fa-brands fa-facebook share-btn"></i></a>
                                    <a href="https://twitter.com/intent/tweet?text=https://enos.itcollege.ee/~badurm/trektrack1/TrekTrack/home.php" class="twitter-btn not-link"><i class="fa-brands fa-square-twitter share-btn" target="_blank"></i></a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=https://enos.itcollege.ee/~badurm/trektrack1/TrekTrack/home.php" class="linkedin-btn not-link" target="_blank"><i class="fa-brands fa-linkedin share-btn"></i></a>
                                </div>
                            </div>
                            <div class="post-comments">

                            </div>
                        </div>
                    </template>
                </div>
                <div class="container-p-trips" style='display: none;'>
                    <div class="container-p-no">
                        <p>
                            It appears you have no trips yet. Click the button below to start planning your next adventure!
                        </p>
                        <button id="button-first-trip">
                            Plan New Trip
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <aside class="home social bg-invert-neutral">
            <div class="container-friend-searchbar">
                <h1 class="text-medium-neutral">Friends</h1>
                <input type="search" class="search" id="friends-search" placeholder="Search or add">
            </div>
            <div class="no-friends-container">
                <p class="text-medium-neutral">It appears you have no friends yet!</p><br>
                <p class="text-medium-neutral">Search for them using the searchbar or add them on their profile to get started.</p>
            </div>
            <div class="social-container">
                <template id="friend-template">
                    <div class="friend-container">
                        <a class="clickable not-link profile-link"><img alt="User Avatar" class="okay-avatar avatar friend-avatar"></a>
                        <div class="friend-info">
                            <a class="clickable not-link friend-username profile-link"></a>
                            <div class="container-status-buttons">
                                <p class="status-text"></p>
                                <i class="fa-solid fa-user-plus positive button-add-friend status-none" tabindex="0"></i>
                                <i class="fa-solid fa-user-xmark negative button-reject-friend status-received" tabindex="0"></i>
                                <i class="fa-solid fa-user-check positive button-accept-friend status-received" tabindex="0"></i>
                                <i class="fa-solid fa-user-minus negative button-remove-friend status-accepted" tabindex="0"></i>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </aside>
    </main>
</body>

</html>