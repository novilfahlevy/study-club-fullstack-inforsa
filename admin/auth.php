<?php

session_start();

function apakahUserSudahLogin()
{
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function login($username)
{
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $username;
}

function logout()
{
    $_SESSION = [];
    unset($_SESSION);
    session_destroy();
}
