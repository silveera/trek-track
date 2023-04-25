<?php
require_once 'utilities.php';

header('Content-Type: application/json');

echo fetchUserInfoJSON($conn, $_SESSION['userid']);

