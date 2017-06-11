<?php
    function createData($userInput)
    {
        $data = [];
        foreach ($userInput as $key => $value)
        {
            $data[$key] = $value;
        }
        $data = array_slice($data, 0, count($data) - 1);
        return $data;
    }