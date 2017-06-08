<?php
    function pageLoader($url, $pages)
    {
        try
        {
            if (isset($url))
            {
                if (empty($url))
                {
                    try
                    {
                        $path = $pages['public/home']['file'];
                        if (is_readable($path))
                        {
                            return require_once $path;
                        }
                        throw new Exception('<h3>Page Not Found</h3><br>');
                    }
                    catch (Exception $error)
                    {
                        throw new Exception();
                    }
                }
                elseif (!empty($url))
                {
                    try
                    {
                        if(in_array($url['url'], array_keys($pages)))
                        {
                            try
                            {
                                $temp = $url['url'];
                                $path = $pages[$temp]['file'];
                                if (is_readable($path))
                                {
                                    return require_once $path;
                                }
                                throw new Exception('<h3>Page Not Found</h3><br>');
                            }
                            catch (Exception $error)
                            {
                                throw new Exception();
                            }
                        }
                        throw new Exception('<h3>Page Not Found</h3><br>');
                    }
                    catch (Exception $error)
                    {
                        throw new Exception();
                    }
                }
            }
            throw new Exception('<h4>The URL Entered Is Wrong!!</h4><br>');
        }
        catch (Exception $error)
        {
            return $error -> getMessage();
        }
    }