<?php
require_once 'database-inc.php';
require_once 'utilities.php';

if (!isset($_SESSION['lastUpdate'])) {
    $_SESSION['lastUpdate'] = time();
}

if (!isset($_SESSION['updateTime'])) {
    $_SESSION['updateTime'] = time();
}

if ($_SESSION['lastUpdate'] < $_SESSION['updateTime']) {
    $_SESSION['lastUpdate'] = time();
    echo '1';
} else {
    echo '0';
}