<?php
session_start();

require 'models/CookieHelper.php';
//to prevent backdoor entry
if(!CookieHelper::checkCookie()){
    header("Location:index.php");
    exit();
}

require 'models/user.php';
User::logout();
header("location: index.php");
exit();

