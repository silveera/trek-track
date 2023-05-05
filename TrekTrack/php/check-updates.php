<?php
require_once 'database-inc.php';
require_once 'utilities.php';

// Checking if session variable 'lastUpdate' is not set, then setting it with the current timestamp
if (!isset($_SESSION['lastUpdate'])) {
    $_SESSION['lastUpdate'] = time();
}

// Checking if the session variable 'updateTime' is not set, then setting it with the current timestamp
if (!isset($_SESSION['updateTime'])) {
    $_SESSION['updateTime'] = time();
}

// Comparing 'lastUpdate' and 'updateTime' session variables,
// if 'lastUpdate' is less than 'updateTime', update the 'lastUpdate' session variable with the current timestamp,
// and echo '1', else echo '0'
if ($_SESSION['lastUpdate'] < $_SESSION['updateTime']) {
    $_SESSION['lastUpdate'] = time();
    echo '1';
} else {
    echo '0';
}
