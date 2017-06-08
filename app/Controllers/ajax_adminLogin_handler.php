<?php
    require_once '../../config/config.php';
    require_once root.'vendor/autoload.php';
    require_once '../../functions/helperFunctions.php';
    use app\Controllers\ajax_manage_request as ajaxSearch;

    $data = json_decode(file_get_contents('php://input'), TRUE);

    function getData($data)
    {

    }
    call_user_func_array('getData', array($data));
