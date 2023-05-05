<?php

require_once 'php/utilities.php';
if (checkLoginStatus()) {
    session_unset();
}
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
    <title>Login</title>
<<noscript><p>Your browser does not support JavaScript!</p></noscript></head>

<body>
    <header class="primary-gradient">
        <div class="head logo">
            <a href="index.php" class="not-link" style="margin-left: 0.2em; margin-block: 0.2em;"><img src="images/Banner.svg" width="170px" id="logo" alt="Trek&Track-Logo">
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
            <form action="php/login-inc.php" method="post" class="form-login" novalidate>
                <input type="text" placeholder="Username" id="uid" name="uid" value="<?= checkValueAndReturn("loginusername") ?>" class="<?= checkArraySetMissing('loginerrortypes','username' ) ?>" required>

                <input type="password" placeholder="Password" id="pw" name="pw" value="<?= checkValueAndReturn("loginpassword") ?>" class="<?= checkArraySetMissing('loginerrortypes','password' ) ?>" required>
    
                <button type="submit" id="submit" name="submit" class="button border-secondary text-medium-invert-neutral bg-secondary">Log in</button>
                <p id="errormessage"> <?= checkValueAndReturn("loginerrormsg") ?>  </p>

                <p id="register">Need an account?<a href="signup.php">SIGN UP</a></p>
            </form>
        </div>
    </main>
<!--     <div class="container">
        <form action="home.php">
            <label for="uname">Username</label> <br>
            <input type="text" placeholder="Username" id="uname" required> <br>

            <label for="psw">Password</label> <br>
            <input type="password" placeholder="Password" id="psw" required> <br>

            <p id="forgor"><a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley">Forgot your password?</a></p>

            <button type="submit">Log in</button>
            <p id="or"> or </p>
            <button type="submit" id="facebook" formnovalidate>Continue with Facebook</button>
            <button type="submit" id="google" formnovalidate>Continue with Google</button>
            <p id="register">Need an account? <a href="signup.php">SIGN UP</a></p>
        </form>
    </div> -->
</body>

</html>
