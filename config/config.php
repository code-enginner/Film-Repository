<?php
    session_start();

    define('root', dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR);
    define('baseURL', $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['SCRIPT_NAME']));
    define('suffix', '.php');