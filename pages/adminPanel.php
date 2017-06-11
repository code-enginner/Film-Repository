<?php
    require_once 'config/config.php';
    require_once root.'functions/helperFunctions.php';
    require_once root.'functions/checkLogin.php';
    require_once root.'functions/createData.php';
    use app\Controllers\inputValidation;

    if (!isLogin())
    {
        header('Location: '.baseURL.'/admin/login');
        exit();
    }

    if (isset($_POST['registerFilm']) && isset($_FILES))
    {
        $joinedArrays = array_merge($_FILES, $_POST);
        $newFilm = call_user_func_array('createData', array($joinedArrays));
        $insertNewFilm = new inputValidation($newFilm);
        $result = $insertNewFilm -> checkout();
        echo $result;
    }
?>


<div id="tabMenuInsert" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <form action="" method="post" enctype="multipart/form-data">
    <!--Short Text Area-->
    <div id="shortText" class="tabContent col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <ul>
            <li>
                <h3 class="insertHeader">Maine Information</h3>
            </li>
            <li><label for="">Name</label><input type="text" class="UserInput" id="name" name="Name" placeholder="Set Film Name" value="<?php if (isset($_POST['Name'])) {echo $_POST['Name'];}?>"></li>
            <li><label for="">Genre</label><input type="text" class="UserInput" id="genre" name="Genre" placeholder="Set Film Genre" value="<?php if (isset($_POST['Genre'])) {echo $_POST['Genre'];}?>"></li>
            <li><label for="">Rank</label><input type="text" class="UserInput" id="rank" name="Rank" placeholder="Set Film Rank" value="<?php if (isset($_POST['Rank'])) {echo $_POST['Rank'];}?>"></li>
            <li><label for="">Release Date</label><input type="text" class="UserInput" id="release_date" name="Release_Date" placeholder="Set Film Release Date" value="<?php if (isset($_POST['Release_Date'])) {echo $_POST['Release_Date'];}?>"></li>
            <li><label for="">Product</label><input type="text" class="UserInput" id="product" name="Product" placeholder="Set Film Product" value="<?php if (isset($_POST['Product'])) {echo $_POST['Product'];}?>"></li>
            <li><label for="">Quality</label><input type="text" class="UserInput" id="quality" name="Quality" placeholder="Set Film Quality" value="<?php if (isset($_POST['Quality'])) {echo $_POST['Quality'];}?>"></li>
            <li><label for="">Awards</label><input type="text" class="UserInput" id="awards" name="Awards" placeholder="Set Film Awards" value="<?php if (isset($_POST['Awards'])) {echo $_POST['Awards'];}?>"></li>
            <li><label for="">Duration</label><input type="text" class="UserInput" id="duration" name="Duration" placeholder="Set Film Duration" value="<?php if (isset($_POST['Duration'])) {echo $_POST['Duration'];}?>"></li>
            <li><label for="">DVD Number</label><input type="text" class="UserInput" id="dvd_number" name="DVD_Number" placeholder="Set Film DVD number" value="<?php if (isset($_POST['DVD_Number'])) {echo $_POST['DVD_Number'];}?>"></li>
        </ul>
    </div>
    <!--Long Text Area-->
    <div id="longText" class="tabContent col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <ul>
            <li><h3 class="insertHeader">Synopsis And Comment</h3></li>
            <li><label for="">Synopsis</label><textarea name="Synopsis" class="UserInput" id="" cols="55" rows="12"><?php if (isset($_POST['Synopsis'])) {echo $_POST['Synopsis'];}?></textarea></li>
            <li><label for="">Comment</label><textarea name="Comment" class="UserInput" id="" cols="55" rows="12"><?php if (isset($_POST['Comment'])) {echo $_POST['Comment'];}?></textarea></li>
        </ul>
    </div>
    <!--Set Cover Area-->
    <div id="setCover" class="tabContent col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <ul>
            <li><h3 class="insertHeader">Cover</h3></li>
        </ul>

        <div class="formWrapper col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form action="" method="post" enctype="multipart/form-data">
                <label for="choice_cover" class="ruleBTN col-lg-3 col-md-12 col-sm-12 col-xs-12">Cover</label><input type="file" name="cover" id="choice_cover" onchange="previewFile()">
            </form>
            <input type="submit" name="registerFilm" value="Register" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
            <input type="reset" value="Reset" id="reset" class="col-lg-3 col-md-12 col-sm-12 col-xs-12">

        </div>
        <div class="coverPrev col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <span id="coverTitle">Cover Your Choice: </span>
            <div class="WrapPrev">
                <img src="<?= baseURL; ?>/images/" alt="" title="" id="prevIMG" width="250" height="370">
            </div>
        </div>
    </div>
    </form>
</div>
<?php
