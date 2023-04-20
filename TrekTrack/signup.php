<?php
session_start();
require_once 'php/utilities.php';
if (checkLoginStatus()) {
    session_unset();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="styles/newstyle.css">
    <script src="scripts/main.js"></script>
    <meta charset="UTF-8">
</head>

<body>
    <header class="primary-gradient">
        <div class="head logo">
            <a href="index.php" class="not-link"><img src="images/logoex.png" width="50" id="logo"
                    alt="Trek&Track-Logo"></a>
            <a href="index.php" class="text-thick-invert-neutral not-link logo-text">
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

                <p id="or"> or </p>
                
                <button type="submit" id="facebook" class="border-secondary text-medium-invert-neutral bg-secondary" formnovalidate>Continue with Facebook</button>
                <button type="submit" id="google" class="border-secondary text-medium-invert-neutral bg-secondary" formnovalidate>Continue with Google</button>
                <p id="login">Have an account? <a href="login.php">LOG IN</a></p>
            </form>
        </div>
    </main>
</body>

</html>