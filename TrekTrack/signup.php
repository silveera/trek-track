<?php

require_once 'php/utilities.php';
if (checkLoginStatus()) {
    session_unset();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="images/Icon.svg">
    <link rel="stylesheet" href="styles/newstyle.css">
    <script src="scripts/main.js"></script>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <script src="scripts/darkmode.js" defer></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Batu Durmazel, Michelle Watford, Yuto Kobayashi">
    <meta name="description" content="Join a passionate community of travellers who love to share our travel memories, make  exciting travel plans, and meet new people from around the globe.">
    <meta name="keywords" content="travel, social, media, posts, friends, explore">

<noscript><p>Your browser does not support JavaScript!</p></noscript></head>

<body>
    <header class="primary-gradient">
        <div class="head logo">
            <a href="index.php" class="not-link" style="margin-left: 0.2em; margin-block: 0.2em;"><img src="images/Banner.svg" width="170" id="logo" alt="Trek&Track-Logo">
            </a>
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
    </header>
    <main class="form-account bg-image-element">
        <div class="container bg-invert-neutral">
            <form action="php/signup-inc.php" method="POST" class="form-signup" novalidate>
                <input type="text" placeholder="Username" id="uid" name="uid" value="<?= checkValueAndReturn("signusername") ?>" class="<?= checkArraySetMissing('signerrortypes','username' ) ?>" required>
                <input type="email" placeholder="Email" id="email" name="email" value="<?= checkValueAndReturn("signemail") ?>" class="<?= checkArraySetMissing('signerrortypes','email' ) ?>" required> <br>
                <input type="password" placeholder="Password" id="pw" name="pw" value="<?= checkValueAndReturn("signpassword") ?>" class="<?= checkArraySetMissing('signerrortypes','password' ) ?>" required>
                <input type="password" placeholder="Repeat Password" id="pw-rpt" name="pw-rpt" class="<?= checkArraySetMissing('signerrortypes','passwordrepeat' ) ?>" required>

                <button type="submit"  id="submit" name="submit" class="border-secondary text-medium-invert-neutral bg-secondary">Create Account</button>

                <p id="errormessage"> <?= checkValueAndReturn("signerrormsg") ?>  </p>

                <p id="login">Have an account? <a href="login.php">LOG IN</a></p>
            </form>
        </div>
    </main>
</body>

</html>
