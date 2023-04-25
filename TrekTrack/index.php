<?php
require_once 'php/utilities.php'; 
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles/newstyle.css">
    <script src="https://kit.fontawesome.com/66d74c224c.js" crossorigin="anonymous"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing</title>
</head>

<body>
    <header class="primary-gradient">
        <div class="head logo">
            <a href="<?= checkLoginStatus() ? "home.php" : "index.php" ?>" class="not-link"><img src="images/logoex.png" width="50" id="logo"
                    alt="Trek&Track-Logo"></a>
            <a href="<?= checkLoginStatus() ? "home.php" : "index.php" ?>" class="text-thick-invert-neutral not-link logo-text">
                <p>Trek&Track</p>
            </a>
        </div>
        <nav class="text-medium-invert-neutral">
            <ul class="head nav-list">
                <li><a href="privacy.php">Privacy</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>
        <div class="head account">
            <a href="login.php" id="button-head-log-in"
                style="display:<?= checkLoginStatus() ? "none" : "block"?>;" class="button text-medium-invert-neutral bg-secondary border-secondary">Log In</a>

            <a href="login.php" id="button-head-log-out"
                style="display:<?= checkLoginStatus() ? "block" : "none"?>;" class="button text-medium-invert-neutral bg-secondary border-secondary">Log Out</a>
        </div>
    </header>
    <main class="landing bg-image-element">
        <div class="landing quote">
            <h1 class="text-thick-invert-neutral">Memories</h1>
            <h3 class="text-thick-invert-neutral">in your pocket</h3>
            <p class="text-regular-invert-neutral">Share your journey to the world.<br>Explore unlimited possibilites.
            </p>
            <a href="signup.php" id="button-landing-create-account"
                style="display:<?= checkLoginStatus() ? "none" : "inline-block"?>;" class="button text-medium-invert-neutral bg-secondary border-secondary">Create Account</a>
        </div>
    </main>
</body>

</html>