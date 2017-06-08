<?php namespace app\Controllers; use app\Model;

    require_once root.'vendor/autoload.php';
    require_once root.'functions/helperFunctions.php';

    class ajax_manage_request
    {
        private $data;
        public function __construct($data)
        {
            $this -> data = $data;
            if (is_array($this -> data))
            {
                if (count($this -> data) == 1)
                {
                    call_user_func_array(array($this, 'search'), $this ->data);
                }
                if (count($this -> data) > 1)
                {
                    cpd($this -> data);
                    call_user_func_array(array($this, 'adminLogin'), array($this -> data));
                }
            }
            return '<h3>The input arguments is wrong!</h3><br>';
        }

        private function search($value)
        {
            $search = Model::run() -> findByName($value);
            return $search;
        }

        private function adminLogin($value)
        {
            cpd($value);
        }
    }