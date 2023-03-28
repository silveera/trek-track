<?php
require_once 'utilities.php';

function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function checkLoginStatus()
{
    if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        return true;
    }
    return false;
}

function checkValue($value)
{
    if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION[$value]) && !empty($_SESSION[$value])) {
        return true;
    }
    return false;
}

function checkValueAndReturn($value)
{
    if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION[$value]) && !empty($_SESSION[$value])) {
        return $_SESSION[$value];
    }
    
    return "";
}

function checkArraySetMissing($arraykey, $value)
{
    if (session_status() === PHP_SESSION_ACTIVE && isset($_SESSION[$arraykey]) && !empty($_SESSION[$arraykey])) {
        if (in_array($value, $_SESSION[$arraykey])) {
            return "input-missing";
        }
    }
    return "";
}
