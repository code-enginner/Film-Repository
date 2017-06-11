<?php

    /********* Wrap Data *********/
    function wrapData($data, $turn, $wrapSing = '`'/*, $flag = FALSE*/)
    {
        $turn = strtolower($turn);
        if (is_array($data))
        {
            switch ($turn)
            {
                case 'both':
                    foreach ($data as $key => $value)
                    {
                        $data[$key] = $wrapSing.$value.$wrapSing;
                    }
                    return $data;
                case 'r':
                    foreach ($data as $key => $value)
                    {
                        $data[$key] = $value.$wrapSing;
                    }
                    return $data;
                case 'l':
                    foreach ($data as $key => $value)
                    {
                        $data[$key] = $wrapSing.$value;
                    }
                    return $data;
            }
        }
        else
        {
            switch ($turn)
            {
                case 'both':
                    $data = $wrapSing.$data.$wrapSing;
                    return $data;
                case 'r':
                    $data = $data.$wrapSing;
                    return $data;
                case 'l':
                    $data = $wrapSing.$data;
                    return $data;
            }
        }
        return NULL;
    }
    function wrapVar($data, $wrapSing = '`')
    {
        if (is_array($data))
        {
            foreach ($data as $key => $value)
            {
                $data[$key] = $wrapSing.$key.$wrapSing;
            }
        }
        return $data;
    }

    function createVar($data, $wrapSign = ':')
    {
        if (is_array($data))
        {
            foreach ($data as $key => $value)
            {
                $data[$key] = $wrapSign.$key;
            }
        }
        return $data;
    }

    /********* Dump Data *********/
    function cp($data = NULL)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }

    function cpd($data = NULL)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        exit();
    }