<?php
/**
 * User: amoy
 */

namespace Amoy\Regex;


class Search{
    public static function email($words){

    }
    public static function ip($words){
        $pattern='\d+\.\d+\.\d+\.\d+';
        preg_match_all($pattern,$words,$res);
        return $res;
    }
}