<?php
    require_once 'config/config.php';
    require_once root.'functions/helperFunctions.php';
    require_once root.'functions/checkLogin.php';
    require_once root.'functions/createData.php';
    use app\Controllers\adminLogin;
    use app\Controllers\inputValidation;

    if (isLogin())
    {
        header('Location: '.baseURL.'/admin/film/insert');
        exit();
    }
    function getData($data)
    {
        echo adminLogin::checkData($data);
    }


?>

<div class="wrapAll">
    <div class="loginContent">
        <form action="" method="post">

            <div class="wrapper1 col-lg-6">
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">Login </span>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter Username Or Email" aria-describedby="basic-addon1" value="<?php if (isset($_POST['username'])) {echo $_POST['username'];}?>">
                </div>
                <div class="input-group">
                    <span class="input-group-addon" id="basic-addon2">Pass </span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" aria-describedby="basic-addon2">
                </div>

                <!--todo: create input to set captcha security code-->
                <!--<div class="input-group">
                    <span class="input-group-addon" id="basic-addon2">Security code</span>
                    <input type="text" id="secCode" class="form-control" placeholder="Enter Security Code" aria-describedby="basic-addon2">
                </div>-->

                <input type="submit" name="login" id="btnLogin" />
            </div>
            <!--todo: create php captcha-->
           <!-- <div class="wrapper2 col-lg-6">
                <div class="captcha"></div>
            </div>-->
        </form>
            <div class="clearFix"></div>
            <div class="wrapper3 col-lg-12" id="msgWrapper">
                <?php
                    if (isset($_POST['login']))
                    {
                        call_user_func_array('getData', array($_POST));
                    }
                ?>
            </div>

    </div>
</div>
<div id="output"></div>

<?php
