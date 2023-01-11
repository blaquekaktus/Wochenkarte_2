 <?php

class CookieHelper
{
    public static function checkCookie(){
        return isset($_COOKIE['accept']) && $_COOKIE['accept'] == 1;
    }

    public static function createCookie(){
        setcookie('accept', 1, time() + (60 * 60), '/', '', false, true);
        echo "cookie created";
    }

}