<?php

session_start();

function apakahUserSudahLogin()
{
    return isset($_SESSION['user_logged_id']) && $_SESSION['user_logged_id'] === true;
}

function login($id, $username)
{
    $_SESSION['user_logged_id'] = true;
    $_SESSION['user_id'] = $id;
    $_SESSION['user_username'] = $username;
}

function logout()
{
    $_SESSION = [];
    unset($_SESSION);
    session_destroy();
}