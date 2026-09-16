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
    <title>Privacy</title>
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
                <li><a href="privacy.php" title="Privacy" style="border-bottom: 2px solid"><i class="fa-solid fa-eye not-link"></i><p>Privacy</p></a></li>
                <li><a href="about.php" title="About"><i class="fa-solid fa-circle-info not-link"></i><p>About</p></a></li>
                <li><a href="contact.php" title="Contact"><i class="fa-solid fa-phone not-link"></i><p>Contact</p></a></li>
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
            <h1>Privacy Policy</h1>

<p><i>Last updated: 27/03/2023</i></p>

<h2>Introduction</h2>

<p>Welcome to the Privacy Policy for Trek&Track, a social media platform dedicated to sharing travel memories and making travel plans. We are committed to protecting the privacy of our users and have created this Privacy Policy to inform you about the information we collect, how we use it, and the choices you have regarding your personal information.</p>

<p>Please read this Privacy Policy carefully. By using our website and services, you agree to the collection and use of your information in accordance with this policy.</p>

<h2>Information Collection and Use</h2>

<p>While using our website, we may ask you to provide us with certain personally identifiable information that can be used to contact or identify you. This may include, but is not limited to:</p>

<p>Personal Information: such as your name, email address, phone number, and date of birth. User Content: such as photos, videos, and text you post, share or store on our platform. Travel Information: such as your travel plans, destinations, and preferences. Usage Information: such as your browsing history, search queries, and interactions with other users. We collect this information to provide and improve our services, personalize your experience, and keep you informed about updates and new features.</p>

<h2>Cookies and Web Beacons</h2>

<p>We use cookies and similar tracking technologies to track the activity on our website and store certain information. Cookies are small data files that are stored on your device and help us analyze how you use our website. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, some portions of our website may not function properly.</p>

<p>Sharing and Disclosure of Information</p>

<p>We do not sell, trade, or rent your personal information to third parties. However, we may share your information with selected partners and service providers to help us operate, maintain, and improve our platform. These third parties have access to your personal information only to perform specific tasks on our behalf and are obligated not to disclose or use it for any other purpose.</p>

<p>We may also disclose your personal information if required by law, in response to a legal request, or to protect the rights, property, or safety of our users and the public.</p>

<h2>Security</h2>

<p>The security of your personal information is important to us. We strive to use commercially acceptable means to protect your information. However, no method of transmission over the internet or electronic storage is 100% secure, and we cannot guarantee absolute security.</p>

<h2>Links to Other Sites</h2>

<p>Our website may contain links to external sites that are not operated by us. If you click on a third-party link, you will be directed to that site. We strongly advise you to review the Privacy Policy of every site you visit. We have no control over, and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.</p>

<h2>Children's Privacy</h2>

<p>Our platform is not intended for use by anyone under the age of 13 (or the age of consent in your jurisdiction). We do not knowingly collect personally identifiable information from children under 13. If you are a parent or guardian and you learn that your child has provided us with personal information, please contact us. If we become aware that we have collected personal information from a child under the age of 13 without verification of parental consent, we will take steps to remove that information from our servers.</p>

<h2>Changes to This Privacy Policy</h2>

<p>We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page. You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.</p>

<h2>Contact Information</h2>

<p>If you have any questions, comments, or concerns about this Privacy Policy or our privacy practices, please contact us at:</p>

<p>Trek&Track<br>
123 Traveler's Lane, Adventure City, Country<br>
support@trekandtrack.com<br>
+1 (123) 456-7890</p>
        </article>
    </main>
</body>

</html>
