<?php
session_start();

require 'class/user.php';
//to prevent backdoor entry
if(!CookieHelper::checkCookie()){
    header("Location:index.php");
    exit();
}

User::logout();
header("location: index.php");
exit();

