 <?php

class CookieHelper
{
    public function checkCookie(){
        return isset($_COOKIE['accept']) && $_COOKIE['accept'] == 1;
    }

    public function createCookie(){
        if ($this->checkCookie()){
            if (!isset($_COOKIE['accept'])){
                setcookie('accept', 1, time() + (60 * 60), '/', '', false, true);
            }
        }
    }
}