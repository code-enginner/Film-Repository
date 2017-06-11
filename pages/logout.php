<?php
    /*session_destroy($_SESSION['']);
    session_unset();
    $_SESSION = array();
    unset($_SESSION);*/

    unset($_SESSION['logged']);
    header('Location: '.baseURL.'/admin/login');
    exit();