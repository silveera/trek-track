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
    <meta name="author" content="Batu Durmazel, Michelle Watford, Yuto Kobayashi">
    <meta name="description" content="Join a passionate community of travellers who love to share our travel memories, make  exciting travel plans, and meet new people from around the globe.">
    <meta name="keywords" content="travel, social, media, posts, friends, explore">
    <title>Contact Us</title>
<noscript><p>Your browser does not support JavaScript!</p></noscript></head>

<body>
    <header class="primary-gradient">
        <div class="head logo">
            <a href="<?= checkLoginStatus() ? "home.php" : "index.php" ?>" class="not-link" style="margin-bottom: -0.1em; margin-top: -0.3em; margin-left: 0.2em;"><img src="images/Banner.svg" width="170" id="logo" alt="Trek&Track-Logo"></a>
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
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php" style="border-bottom:2px solid;">Contact</a></li>
                <li><a href="profile.php"><i class="fa-solid fa-user not-link"></i><p>Profile</p></a></li>
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
            <div>
        <form method="POST">
                <input type="text" name="Name" placeholder="Full Name" required>
                <input type="email" name="Email Address" placeholder="Email" required>
                <input type="number" name="Phone Number" placeholder="Phone Number" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit" class="btn">Submit</button>
            </form>
        </div>
        </article>
        
    </main>
    <script>
    const form = document.querySelector('form');
    form.addEventListener('submit', (event) => {
        event.preventDefault();
        const name = document.querySelector('input[name="Name"]').value;
        const email = document.querySelector('input[name="Email Address"]').value;
        const phone = document.querySelector('input[name="Phone Number"]').value;
        const message = document.querySelector('textarea[name="message"]').value;
        const body = `Name: ${name}%0D%0AEmail: ${email}%0D%0APhone Number: ${phone}%0D%0AMessage: ${message}`;
        const subject = 'Contact Us Form Submission';
        const mailto = `mailto:support@trekandtrack.com?subject=${subject}&body=${body}`;
        window.location.href = mailto;
    });
</script>
</body>

</html>
