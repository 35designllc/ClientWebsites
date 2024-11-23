<?php

/**
 * URL Format
 */
function urlFormat($str)
{
    //Strip out all white space
    $str = preg_replace('/\s*/', '', $str);
    //Convert the string to all lowercase
    $str = strtolower($str);
    //URL Encode
    $str = urlencode($str);

    return $str;
}
