<?php
/**
 * Created by PhpStorm.
 * User: alfrednutile
 * Date: 6/4/15
 * Time: 10:34 PM
 */

namespace App;


class Plans {
    public static $LEVEL1 = 'comicslevel1';
    public static $LEVEL2 = 'comicslevel2';
    public static $FAN = 'FAN';
    public static $QUANTITY = 'QUANTITY';
    
    public static function returnDisplayName($level)
    {
        $names = static::getNames();
        
        return $names[$level];
    }

    public static function returnOtherDisplayName($level)
    {
        if($level == static::$LEVEL1) {
            return static::$LEVEL2;
        }

        return static::$LEVEL1;
    }

    public static function getNames()
    {
        return [
            static::$LEVEL1 => "Comics Level 1",
            static::$LEVEL2 => "Comics Level 2",
            static::$FAN    => "Fan of the Site!"
        ];
    }
    
}