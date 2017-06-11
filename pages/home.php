<?php
    use app\Controllers\fileReader;
    use app\Model;
    require_once 'config/config.php';
    require_once root.'functions/helperFunctions.php';

    $lastID = fileReader::readeFile('systemData.json');
    $test = Model::run();
    echo "<div id='output' class='col-lg-12 col-md-12 col-ms-12 col-xs-12'>";
    $test -> randomSearch(1, $lastID);
    echo "</div>";