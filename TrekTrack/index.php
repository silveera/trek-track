<?php
require_once 'php/utilities.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="icon" href="images/Icon.svg">
    <link rel="stylesheet" href="styles/newstyle.css">
    <script src="https://kit.fontawesome.com/66d74c224c.js" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Batu Durmazel, Michelle Watford, Yuto Kobayashi">
    <meta name="description" content="Join a passionate community of travellers who love to share our travel memories, make  exciting travel plans, and meet new people from around the globe.">
    <meta name="keywords" content="travel, social, media, posts, friends, explore">
    <script src="scripts/darkmode.js" defer></script>
    <title>Landing</title>
<noscript><p>Your browser does not support JavaScript!</p></noscript></head>

<body>
    <header class="primary-gradient">
        <div class="head logo">
            <a href="<?= checkLoginStatus() ? "home.php" : "index.php" ?>" class="not-link" style="margin-block: 0.2em; margin-left: 0.2em;"><img src="images/Banner.svg" width="170px" id="logo" alt="Trek&Track-Logo"></a>
        </div>
        <nav class="text-medium-invert-neutral">
            <ul class="head nav-list">
                <li>
                    <label class="toggle-switch-label clickable" for="toggle-switch-input">Dark Mode</label>
                    <div class="toggle-switch">
                        <label class="switch">
                            <input type="checkbox" id="toggle-switch-input">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </li>
                <li><a href="privacy.php">Privacy</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        <div class="head account">
            <a href="login.php" id="button-head-log-in" style="display:<?= checkLoginStatus() ? "none" : "block" ?>;" class="button text-medium-invert-neutral bg-secondary border-secondary">Log In</a>

            <a href="login.php" id="button-head-log-out" style="display:<?= checkLoginStatus() ? "block" : "none" ?>;" class="button text-medium-invert-neutral bg-secondary border-secondary">Log Out</a>
        </div>
    </header>
    <main class="landing bg-image-element">
        <div class="landing quote">
            <h1 class="text-thick-invert-neutral" style="color: white;">Memories</h1>
            <h3 class="text-thick-invert-neutral" style="color: white;">in your pocket</h3>
            <p class="text-regular-invert-neutral" style="color: white;">Share your journey to the world.<br>Explore unlimited possibilites.
            </p>
            <a href="signup.php" id="button-landing-create-account" style="display:<?= checkLoginStatus() ? "none" : "inline-block" ?>;" class="button text-medium-invert-neutral bg-secondary border-secondary">Create Account</a>
        </div>
    </main>
</body>

</html>
