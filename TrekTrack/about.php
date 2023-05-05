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
    <script src="scripts/darkmode.js" defer></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
<noscript>Your browser does not support JavaScript!</noscript></head>

<body>
    <header class="primary-gradient">
        <div class="head logo">
            <a href="<?= checkLoginStatus() ? "home.php" : "index.php" ?>" class="not-link" style="margin-bottom: -0.1em; margin-top: -0.3em; margin-left: 0.2em;"><img src="images/Banner.svg" width="170" id="logo" alt="Trek&Track-Logo">
            </a>
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
                <li><a href="privacy.php">Privacy</a></li>
                <li><a href="about.php" style="border-bottom:2px solid;">About</a></li>
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
            <h1>About Us</h1>

            <p>Welcome to Trek&amp;Track! We are a passionate community of travelers who love to share our travel memories, make exciting travel plans, and meet new people from around the globe. Our mission is to connect like-minded individuals and provide a platform where users can inspire and be inspired by the endless possibilities the world has to offer.</p>
            
            <p>At Trek&amp;Track, we believe that each journey is unique and has a story worth sharing. Our platform allows you to create albums, share your adventures, and discover the experiences of fellow travelers. Whether you're a seasoned globetrotter or just getting started on your travel bucket list, you'll find a wealth of knowledge and inspiration from our vibrant community.</p>
            
            <p>Our travel planning features help you organize and plan your trips with ease. You can create itineraries, save destinations, and collaborate with friends and family to ensure a memorable experience. We also offer tools for connecting with local experts and finding hidden gems in every corner of the world.</p>
            
            <p>One of the most rewarding aspects of travel is the opportunity to meet new people and form lasting friendships. Trek&amp;Track encourages users to connect with fellow travelers, exchange tips, and even meet up in person during their adventures. Our platform fosters a welcoming and supportive environment where people from all walks of life can come together and bond over their shared love of exploration.</p>
            
            <p>Join us today at Trek&amp;Track and become a part of our thriving community. Together, we'll embark on a journey to explore the world, one adventure at a time.</p>
        </article>
    </main>
</body>

</html>
