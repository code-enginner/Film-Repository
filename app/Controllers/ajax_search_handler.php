<?php
    /*  Explanation:
     * this function used for AJAX searching.
     * this function get the data from input's user and convert it to JSON.
     * the "searchData" function get this data and first safe it and then create an object of "Model" class.
     * after checking the condition that data passed to the right method of the "Model" class.
     * */

    require_once '../../config/config.php';
    require_once root.'vendor/autoload.php';
    require_once '../../functions/helperFunctions.php';
    use app\Controllers\ajax_manage_request as ajaxSearch;

    $data = json_decode(file_get_contents('php://input'), TRUE);

    function searchData($data)
    {
        $safeData = [];
        /*foreach ($data as $value)
        {
            $safeData[] = htmlentities(utf8_decode($value), ENT_QUOTES);
        }*/
        foreach ($data as $key => $value)
        {
            $safeData[$key] = htmlentities(utf8_decode($value), ENT_QUOTES);
        }
        $searchRequest = new ajaxSearch($safeData);
    }
    call_user_func_array('searchData', array($data));

