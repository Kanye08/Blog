<?php


function redirectTo($newLocation)
{
    header("Location:" . $newLocation);
    exit;
}

function Login()
{
    if (isset($_SESSION['user_id'])) {
        return true;
    } else {
        return false;
    }
}

function confirmLogin()
{
    if (!Login()) {
        $_SESSION['errorMessage'] = "You have to Login first";
        redirectTo('login.php');
    }
}