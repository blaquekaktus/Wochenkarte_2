<?php
session_start();

require 'class/user.php';

User::logout();

header("location: index.php");
exit();

?>