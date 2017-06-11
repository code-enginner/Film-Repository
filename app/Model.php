<?php namespace app;

    class Model
    {
        private $tableName;
        private $properties =  ['name' ,'rank', 'genre'];
        public $primaryKey = ['id'];

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

        public function save($data)
        {
            //todo: set condition to check to save or update
            $connection = $this -> db();
            $tableName = $this -> tableName;
            $variables = wrapVar($data);
            $variables = implode(', ', $variables);
            $values = createVar($data);
            $values = implode(', ', $values);
            $query = "INSERT INTO `$tableName` ($variables) VALUES ($values);";
            $result = $connection -> prepare($query);
            $result -> execute($data);
            try
            {
                if ($result)
                {
                    try
                    {
                        $dataFile = fopen(root.'systemFiles/systemData.json','w');
                        fwrite($dataFile, json_encode($connection -> lastInsertId()));
                        fclose($dataFile);
                    }
                    catch (\Exception $error)
                    {
                        throw new \Exception();
                    }
                    echo "<div class='alert alert-success'><h3>The Film Saved Successfully!</h3></div>";
                    $connection = NULL;
                    header('Refresh:1');
                    return NULL;
                }
                $connection = NULL;
                throw new \Exception("<div class='alert alert-danger'>Warning! Video Was Not Saved</div>");
            }
            catch (\Exception $error)
            {
                return $error -> getMessage();
            }
        }

        public function delete()
        {
            //todo: create delete algorithm
        }

        public function findBy($val, $prop)
        {
            if (!empty($val))
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
                                echo "<div class='imgEffect'><img src='".dirname(dirname(baseURL)).'/images/'.$rows[$i]['Cover']."'alt='".$rows[$i]['Cover']."' title='".$rows[$i]['Cover']."' width='250' height='370'></div>";
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
                    echo "<div class='alert alert-danger' role='alert'><h1>OOPS! No Film Found With This Title!</h1></div>";
                    return FALSE;
                }
                $connection = NULL;
                echo "<div class='alert alert-danger' role='alert'><h1>The Query Is Wrong!</h1></div>";
                return FALSE;
            }
            echo "<div class='alert alert-warning' role='alert'><h1>Please Fill The Search Box By a Film Name!</h1></div>";
            return FALSE;
        }

        public function find($params)
        {
            $connection = $this -> db();
            $tableName = 'admin';

            $variables = [];
            $values = [];
            $configs = [];
            $property = [];
            $operator = NULL;
            $comparison = NULL;

            foreach ($params as $key => $value)
            {
                $variables[] = $key;
                $configs[] = $value;
            }
            $variables = array_slice($variables, 0 , count($variables) - 1);
            $values = array_slice($configs, 0, count($configs) - 1);
            $property = end($configs);
            $comparison = $property[0];
            $operator = $property[1];
            $phrase =  "(`$variables[0]`$comparison:$variables[0]$operator`$variables[1]`$comparison:$variables[1])";
            $variables = array_flip($variables);
            foreach ($variables as $key => $val)
            {
                $variables[$key] = $values[$val];
            }
            $query = "SELECT * FROM `{$tableName}` WHERE $phrase LIMIT 1";
            $result = $connection -> prepare($query);
            $result -> execute($variables);
            if ($result)
            {
                if ($result -> rowCount() > 0)
                {
                    foreach ($result -> fetchAll(DB::FETCH_ASSOC) as $k => $v)
                    {
                        $_SESSION['logged'] = $v['username'];
                    }
                    echo "<div class='alert alert-success'><h3 id='success'>Login Success!</h3></div>";
                    header('refresh:1;url=film/insert');
                    exit();
                }
                else
                {
                    echo "<div class='alert alert-danger'><h3>Access Denied! User Is Invalid</h3></div>";
                    return NULL;
                }
            }
        }

        public function randomSearch($first, $last)
        {
            $first = htmlentities($first);
            $last = htmlentities($last);
            $connection = $this -> db();
            $tableName = $this -> tableName;
            $query = "SELECT * FROM `{$tableName}` WHERE `id` BETWEEN ? AND ? ORDER BY RAND() LIMIT 5;";
            $result = $connection -> prepare($query);
            $result -> execute([$first, $last]);
            if ($result)
            {
                while ($rows = $result -> fetchAll(DB::FETCH_ASSOC))
                {
                    for ($i = 0; $i < count($rows); $i++)
                    {
                        if (isset($rows[$i]['Cover']))
                        {
                            echo "<div class='col-lg-6 col-md-6 col-sm-12 col-xs-12 pull-right cover clearFix'>";
                            echo "<div class='imgEffect'><img src='".baseURL.'/images/'.$rows[$i]['Cover']."'alt='".$rows[$i]['Cover']."' title='".$rows[$i]['Cover']."' width='250' height='370'></div>";
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
                }
            }
        }

        public function getLastId()
        {
            $lastID = json_decode(file_get_contents(root.'dataFile/'));
            return $lastID;
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