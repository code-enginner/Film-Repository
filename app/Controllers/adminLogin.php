<?php namespace app\Controllers; use app\Model;

    class adminLogin
    {
        private static $data = [];

        public static function checkData($data)
        {
            $emptyInput = [];
            foreach ($data as $key => $value)
            {
                if (empty($value))
                {
                    $emptyInput[] = $key;
                }
                else
                {
                    $data[$key] = htmlentities($value, ENT_QUOTES);
                }
            }
            self::$data = $data;
            self::$data = array_slice(self::$data, 0, count(self::$data) - 1);
            try
            {
                if (count($emptyInput) > 0)
                {
                    $emptyInput = implode(' , ', $emptyInput);
                    throw new \Exception("<div class='alert alert-danger'><h5 id='msg'>Warning! Some fields are empty. Please check:</h5><span>".$emptyInput."</span></div>");
                }
                else
                {
                    self::$data['operation'] = [' = ', ' AND '];
                    return Model::run() -> find(self::$data);
                }
            }
            catch (\Exception $error)
            {
                return $error -> getMessage();
            }
        }
    }