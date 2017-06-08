<?php namespace app;

    class databaseConfigReader
    {
        private static $configName = NULL;
        public static function readConfigs($data = NULL, $configName = NULL)
        {
            $data = (isset($data) && !empty($data) && is_string($data)) ? $data : 'dbConfigs.json';
            $fileData = root.'db-configs'.DIRECTORY_SEPARATOR.$data;
            try
            {
                if (is_readable($fileData) && is_string($data))
                {
                    $data = json_decode(file_get_contents($fileData), TRUE);
                    self::$configName = (isset($configName) && !empty($configName) && is_string($configName)) ? $configName : 'database';
                    $db_data = [];
                    foreach ($data as $config)
                    {
                        $db_data = $config;
                    }
                    return $db_data;
                }
                throw new \Exception('<h3>Error: The File Type or File Content is Not Invalid!!</h3><br>');
            }
            catch (\Exception $error)
            {
                return $error -> getMessage();
            }
        }
    }