<?php
    require_once 'config/config.php';
    require_once root.'config/page_reference.php';
    require_once root.'vendor/autoload.php';
    //require_once root.'functions/autoLoader.php';
    require_once root.'functions/pageLoader.php';
    require_once root.'functions/helperFunctions.php';
    require_once root.'functions/checkLogin.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="<?= baseURL; ?>/lib/bootstrap-3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= baseURL; ?>/assets/styles/scss/style.css">
    <script type="text/javascript">var baseURL = "<?= baseURL;?>";</script>
    <script type="text/javascript" src="<?= baseURL; ?>/assets/scripts/javascript_class.js"></script>
    <title><?php if (!isset($_GET['url']) && empty($_GET) && isset($__page_reference)) {echo $__page_reference['public/home']['title'];} elseif(isset($__page_reference[$_GET['url']]['title'])) {echo $__page_reference[$_GET['url']]['title'];} ?></title>
</head>
<body>
<header class="container-fluid unSelect">
    <div class="row">
        <div id="logo"><h1>Film Repository</h1></div>
        <nav id="menu" class="col-lg-12 col-md-12 col-sm-12 clearFix">
            <ul class="clearFix">
                <li><a href="<?= baseURL; ?>/public/home">Home</a></li>
                <li><a href="<?= baseURL; ?>/search/division">Search / Division</a></li>
                <?php
                    if (isLogin())
                    {
                        echo "<li><a href='".baseURL."/admin/film/insert'>Admin Panel</a></li>";
                        echo "<li><a href='".baseURL."/admin/logout'>Logout</a></li>";
                    }
                    else
                    {
                        echo "<li><a href='".baseURL."/admin/login'>Login</a></li>";
                    }
                ?>
            </ul>
        </nav>
    </div>
</header>

<div class="container-fluid unSelect">
    <div id="pages" class="row">
        <?php
            call_user_func_array('pageLoader', array($_GET, $__page_reference));
        ?>
    </div>
</div>

<footer>
    <div class="container-fluid unSelect">
        <div class="row">
            <div class="footerContent">
                <ul>
                    <li><h5>Powered By Sina</h5></li>
                    <li><span>all right received</span></li>
                    <li><span>2016-2017</span></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="<?= baseURL; ?>/lib/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?= baseURL; ?>/lib/bootstrap-3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?= baseURL; ?>/assets/scripts/script.js"></script>
<script type="text/javascript" src="<?= baseURL; ?>/assets/scripts/script_2.js"></script>
<script type="text/javascript" src="<?= baseURL; ?>/assets/scripts/script_3.js"></script>
<script type="text/javascript" src="<?= baseURL; ?>/assets/scripts/script_4.js"></script>
</body>
</html>