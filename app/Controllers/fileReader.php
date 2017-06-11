<?php namespace app\Controllers;

    class fileReader
    {
        private static $type = ['json', 'txt', 'md'];
        public static function readeFile($file)
        {
            $filePath = root.'systemFiles/'.$file;
            $info = pathinfo($file);
            try
            {
                if (isset($info['extension']))
                {
                    if (in_array($info['extension'], self::$type))
                    {
                        if (is_readable($filePath))
                        {
                            switch ($info['extension'])
                            {
                                case 'json':
                                    $fetchedData = json_decode(file_get_contents($filePath), TRUE);
                                    return $fetchedData;
                                case 'txt':
                                    echo "<div class='alert alert-warning'><h3>Sorry! At The Moment Just, JSON File Is Acceptable!</h3></div>";
                                    return FALSE;
                                case 'md':
                                    echo "<div class='alert alert-warning'><h3>Sorry! At The Moment Just, JSON File Is Acceptable!</h3></div>";
                                    return FALSE;
                            }
                        }
                        throw new \Exception("<div class='alert alert-danger'><h3>Warning! File Is Not Readable Or Does Not Exist!</h3></div>");
                    }
                    throw new \Exception("<div class='alert alert-danger'><h3>Warning! The File Type Is Unacceptable!</h3></div>");
                }
                throw new \Exception("<div class='alert alert-warning'><h3>Please Enter A File Name With Extension!</h3></div>");
            }
            catch (\Exception $error)
            {
                echo $error -> getMessage();
                return FALSE;
            }
        }
    }