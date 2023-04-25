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
    <title>Contact Us</title>
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
            <a href="signup.php" id="button-head-sign-up"
                style="display:<?= checkLoginStatus() ? "none" : "block"?>;" class="button text-medium-secondary bg-primary-tint-1 border-primary-tint-1">Sign Up</a>
            <a href="login.php" id="button-head-log-out"
                style="display:<?= checkLoginStatus() ? "block" : "none"?>;" class="button text-medium-invert-neutral bg-secondary border-secondary">Log Out</a>
        </div>
    </header>
    <main class="text bg-image-element">
        <article class="bg-invert-neutral">
            <h1>Contact Us</h1>

            <p>At Trek&amp;Track, we're committed to providing our users with the best possible experience as they share their travel memories, make travel plans, and meet new people. We value your feedback and are here to help with any questions, concerns, or suggestions you may have. Please don't hesitate to get in touch with us using the contact details below:</p>
            
            <p><b>Email:</b> support@trekandtrack.com<br>
            <b>Phone:</b> +1 (123) 456-7890<br>
            <b>Address:</b> Trek&amp;Track, 123 Traveler's Lane, Adventure City, Country</p>
            
            <p>Our customer support team is available Monday through Friday, 9:00 AM to 5:00 PM (Your Time Zone). We aim to respond to all inquiries within 24 hours.</p>
            
            <p>Alternatively, you can reach out to us through our social media channels:</p>
            
            <p><b>Facebook:</b> fb.com/trekandtrack<br>
            <b>Instagram:</b> instagram.com/trekandtrack<br>
            <b>Twitter:</b> twitter.com/trekandtrack<br></p>

            <p>For media inquiries, partnership opportunities, or advertising requests, please contact our marketing team at marketing@trekandtrack.com.</p>
            
            <p>We look forward to hearing from you and assisting you in any way we can. Together, let's continue to explore the world and create unforgettable memories with Trek&amp;Track.</p>
        </article>
    </main>
</body>

</html>