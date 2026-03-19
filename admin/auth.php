<?php

session_start();

const ADMIN_USERNAME = 'admin';
const ADMIN_PASSWORD = 'admin123';

function apakahUserSudahLogin()
{
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function login($username, $password)
{
    if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        return true;
    }

    return false;
}

function logout()
{
    $_SESSION = [];
    unset($_SESSION);
    session_destroy();
}
