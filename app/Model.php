<?php namespace app;

    class Model
    {
        private $tableName;
        private $properties =  ['name' ,'rank', 'gener'];
        public function __construct()
        {

        }

        private static function __database_readConfigs()
        {
            $configs = databaseConfigReader::readConfigs();
            return $configs;
        }

        private function getConfigs()
        {
            $databaseConfigs = self::__database_readConfigs();
            $this -> tableName = $databaseConfigs['tablePerfix'].$databaseConfigs['tableName'];
            $dsn = "{$databaseConfigs['driver']}: host={$databaseConfigs['host']};dbname={$databaseConfigs['databaseName']};charset={$databaseConfigs['charset']}";
            $connection = new DB($dsn, $databaseConfigs['username'], $databaseConfigs['password']);
            $connection -> setAttribute(DB::ATTR_ERRMODE, DB::ERRMODE_EXCEPTION);
            $connection -> exec('SET NAMES utf8');
            return $connection;
        }

        private function db()
        {
            $connection = $this -> getConfigs();
            return $connection;
        }

        public static function run()
        {
            $class = get_class();
            return new $class;
        }

        public function findBy($val, $prop)
        {
            $connection = $this -> db();
            $tableName = $this -> tableName;
            $variable = wrapData($prop, 'both').' = :'.$prop;
            $query = "SELECT * FROM `{$tableName}` WHERE ( {$variable} );";
            $result = $connection -> prepare($query);
            $result -> execute([$prop => $val]);
            if ($result)
            {
                while ($rows = $result -> fetchAll(DB::FETCH_ASSOC))
                {
                    for ($i = 0; $i < count($rows); $i++)
                    {
                        if (isset($rows[$i]['Cover']))
                        {
                            echo "<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right cover clearFix'>";
                            echo "<img src='".dirname(dirname(baseURL)).'/images/'.$rows[$i]['Cover']."'alt='".$rows[$i]['Cover']."' title='".$rows[$i]['Cover']."'>";
                            echo "</div>";
                        }
                        echo "<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-left details clearFix'>";
                        echo "<ul>";
                        foreach ($rows[$i] as $key => $value)
                        {
                            switch ($key)
                            {
                                case 'Name':
                                    echo "<li><span>".$key."</span>";
                                    echo "<p>".$rows[$i][$key]."</p>";
                                    echo "<hr>";
                                    echo "</li>";
                                break;
                                case 'Genre':
                                    echo "<li><span>".$key."</span>";
                                    echo "<p>".$rows[$i][$key]."</p>";
                                    echo "<hr>";
                                    echo "</li>";
                                break;
                                case 'Rank':
                                    echo "<li><span>".$key."</span>";
                                    echo "<p>".$rows[$i][$key]."</p>";
                                    echo "<hr>";
                                    echo "</li>";
                                break;
                                case 'Awards':
                                    echo "<li><span>".$key."</span>";
                                    echo "<p>".$rows[$i][$key]."</p>";
                                    echo "<hr>";
                                    echo "</li>";
                                break;
                                case 'Quality':
                                    echo "<li><span>".$key."</span>";
                                    echo "<p>".$rows[$i][$key]."</p>";
                                    echo "<hr>";
                                    echo "</li>";
                                break;
                                case 'Release_Date':
                                    echo "<li><span>".$key."</span>";
                                    echo "<p>".$rows[$i][$key]."</p>";
                                    echo "<hr>";
                                    echo "</li>";
                                break;
                                case 'Product':
                                    echo "<li><span>".$key."</span>";
                                    echo "<p>".$rows[$i][$key]."</p>";
                                    echo "<hr>";
                                    echo "</li>";
                                break;
                                case 'Duration':
                                    echo "<li><span>".$key."</span>";
                                    echo "<p>".$rows[$i][$key]."</p>";
                                    echo "<hr>";
                                    echo "</li>";
                                break;
                                case 'DVD_Number':
                                    echo "<li><span>".$key."</span>";
                                    echo "<p>".$rows[$i][$key]."</p>";
                                    echo "<hr>";
                                    echo "</li>";
                                break;
                                case 'Synopsis':
                                    echo "<li><span>".$key."</span>";
                                    echo "<p>".$rows[$i][$key]."</p>";
                                    echo "<hr>";
                                    echo "</li>";
                                break;
                                case 'Comment':
                                    echo "<li><span>".$key."</span>";
                                    echo "<p>".$rows[$i][$key]."</p>";
                                    echo "<hr>";
                                    echo "</li>";
                                break;
                            }
                        }
                        echo "</ul>";
                        echo "</div>";
                        echo "<div class='clearFix'></div>";
                        echo "<hr>";
                    }
                    $connection = NULL;
                    return TRUE;
                }
                $connection = NULL;
                echo "<div class='alert alert-danger' role='alert' id='nullError'><h1>OOPS! No Film Found With This Title!</h1></div>";
                return FALSE;
            }
            $connection = NULL;
            return '<h3>query wrong!!</h3><br>';
        }

        public function find($params)
        {
            $connection = $this -> db();
            $tableName = $this -> tableName;
            $variables = [];
            $values = [];
            $temp = [];
            $op = $compare = NULL;
            foreach ($params as $conf => $val)
            {
                $val = is_array($val) ? $val : [$val];
                $temp[] = $val[0];
                $values[] = $conf;
                $compare = isset($val[1]) && !empty($val[1])? ' '.$val[1].' ' : ' = ';
                $op = isset($val[2]) && !empty($val[2])? ' '.strtoupper($val[2]).' ' : ' AND ';
                $variables[] = wrapData($conf, 'both').$compare.wrapData($conf, 'l', ':');
            }
            $values = array_flip($values);
            foreach ($values as $key => $index)
            {
                $values[$key] = $temp[$index];
            }
            $variables = implode($op, $variables);
            $query = "SELECT * FROM `{$tableName}` WHERE ($variables);";
            $result = $connection -> prepare($query);
            $result -> execute($values);
            if ($result)
            {
                while($rows = $result -> fetchAll(DB:: FETCH_ASSOC))
                {
                    // TODO: make a returned values
                    $connection = NULL;
                }
            }
        }

        public function __set($varName, $value)
        {
            // TODO: Implement __set() method.
        }

        public function __call($funcName, $arguments)
        {
            if (substr($funcName, 0, strlen('findBy')) === 'findBy')
            {
                $prop = strtolower(ltrim($funcName, 'findBy'));
                if (in_array($prop, $this -> properties))
                {
                    $arguments[] = $prop;
                    return call_user_func_array(array($this, 'findBy'), $arguments);
                }
            }
            elseif(substr($funcName, 0, strlen('find')) === 'find')
            {
                foreach ($arguments[0] as $configs => $value)
                {
                    if (in_array($configs, $this -> properties))
                    {
                        return call_user_func_array(array($this, 'find'), $arguments);
                    }
                }
            }
            return FALSE;
        }
    }