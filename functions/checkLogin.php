<?php
    function isLogin()
    {
        return isset($_SESSION['logged']);
    }