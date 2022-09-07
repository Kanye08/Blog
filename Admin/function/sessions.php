<?php
session_start();

function errorMessage()
{
    if (isset($_SESSION['errorMessage'])) {
        $output = '<div class="alert alert-danger">';
        $output .= htmlentities($_SESSION['errorMessage']);
        $output .= '</div>';
        // div and html entity is used to display the bootstrap class error message 
        $_SESSION['errorMessage'] = null;
        // $_SESSION['errorMessage'] = null is used to avoid error message when one is entering the page for the first time
        return $output;
    }
}

function successMessage()
{
    if (isset($_SESSION['successMessage'])) {
        $output = '<div class="alert alert-success">';
        $output .= htmlentities($_SESSION['successMessage']);
        $output .= '</div>';
        // div and html entity is used to display the bootstrap class success message 
        $_SESSION['successMessage'] = null;
        // $_SESSION['errorMessage'] = null is used to avoid success message when one is entering the page for the first time
        return $output;
    }
}


function errorUser()
{
    if (isset($_SESSION['errorUser'])) {
        $output = '<div >';
        $output .= htmlentities($_SESSION['errorUser']);
        $output .= '</div>';
        // div and html entity is used to display the bootstrap class error message 
        $_SESSION['errorUser'] = null;
        // $_SESSION['errorMessage'] = null is used to avoid error message when one is entering the page for the first time
        return $output;
    }
}

function successUser()
{
    if (isset($_SESSION['successUser'])) {
        $output = '<div style="color:white; background-color:black; padding:5px 15px; border-radius:5px 10px;">';
        $output .= htmlentities($_SESSION['successUser']);
        $output .= '</div>';
        // div and html entity is used to display the bootstrap class success message 
        $_SESSION['successUser'] = null;
        // $_SESSION['errorMessage'] = null is used to avoid success message when one is entering the page for the first time
        return $output;
    }
}