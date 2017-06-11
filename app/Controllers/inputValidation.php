<?php namespace app\Controllers; use app\Model;

    class inputValidation
    {
        private $cover = [];
        private $data = [];
        private $allData = [];
        private $primaryKey = ['id' => 'NULL'];
        private static $suffix = ['image/jpeg', 'image/png'];

        public function __construct($inputs)
        {
            foreach ($inputs['cover'] as $key => $value)
            {
                $this -> cover[$key] = $value;
            }
            $temp = array_slice($inputs, 1 - count($inputs));
            foreach ($temp as $key => $value)
            {
                $this -> data[$key] = $value;
            }
            return array
            (
                $this -> cover,
                $this -> data
            );
        }

        public function checkout()
        {
            return $this -> checkData();
        }

        private function checkCover()
        {
            try
            {
                if (empty($this -> cover))
                {
                    throw new \Exception("<div class='alert alert-danger' role='alert'><h3>Warning! The Form Has Changed!</h3></div>");
                }
                else
                {
                    if (is_uploaded_file($this -> cover['tmp_name']))
                    {
                        $this -> cover['name'] = htmlentities($this -> cover['name']);
                        if (!in_array($this -> cover['type'], self::$suffix))
                        {
                            throw new \Exception("<div class='alert alert-danger' role='alert'><h3>Warning! Unauthorized File Format. Just Use [ jpg - jpeg - png ].</h3></div>");
                        }
                        else
                        {
                            if ($this -> cover['error'] !== 0)
                            {
                                throw new \Exception("<div class='alert alert-danger' role='alert'><h3>OOPS! Occur Inner Wrong! Please Try Again!</h3></div>");
                            }
                            else
                            {
                                // todo: create size file validation
                                if (!move_uploaded_file($this -> cover['tmp_name'], root.'images/'.$this -> cover['name']))
                                {
                                    throw new \Exception("<div class='alert alert-danger' role='alert'><h3>Warning! Could Not Save Your Cover</h3></div>");
                                }
                                $this -> allData['Cover'] = str_replace('\\', '/', $this -> cover['name']);
                                return TRUE;
                            }
                        }
                    }
                    throw new \Exception("<div class='alert alert-danger' role='alert'><h3>Warning! The Cover Was Not Uploaded Please Set Your Cover!</h3></div>");
                }
            }
            catch (\Exception $error)
            {
                return $error -> getMessage();
            }
        }

        private function checkData()
        {
            $msg = NULL;
            $emptyFields = [];
            foreach ($this -> data as $key => $value)
            {
                if (empty($value))
                {
                    $emptyFields[] = $key;
                }
                else
                {
                    $this -> data[$key] = htmlentities($value, ENT_QUOTES);
                }
            }
            try
            {
                if (count($emptyFields) !== 0)
                {
                    $emptyFields = implode(' - ', $emptyFields);
                    $msg = "<div class='alert alert-danger' role='alert'><h3>Warning! Some Fields Are Empty:</h3><span id='details' >".$emptyFields."</span></div>";
                    throw new \Exception($msg);
                }
                else
                {
                    if ($this -> checkCover() === TRUE)
                    {
                        $primaryKey = $this -> primaryKey;
                        $this -> allData = array_merge($this -> data, $this -> allData);
                        //array_unshift($this -> allData, $primaryKey);
                        //cpd($this -> allData);
                        return Model::run() -> save($this -> allData);
                    }
                    return $this -> checkCover();
                }
            }
            catch (\Exception $error)
            {
                return $error -> getMessage();
            }
        }
    }