<?php

require_once 'models/CookieHelper.php';

if(!CookieHelper::checkCookie()){

    header("location: index.php");
    exit();
}

session_start();

require_once 'models/User.php';

if (!User::isLoggedIn()){

    header("location: index.php");
    exit();
}

?>

<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wochenkarte</title>
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
</head>
<body>

<h1 class="align-items-center mb-3">Wochenkarte</h1>
<form action="logout.php" method="post">
    <input type="submit" name="clear" class="btn btn-danger" value="Logout">
</form>
<div class="container">
    <div class="row d-flex justify-content-center flex-wrap">

        <!--Optimal wäre die Bildgröße nicht statisch zu setzen sondern mit CSS oder Bootstrap, nicht gemacht wegen Zeit constraint.-->
        <div class="col-md-4 col-sm-6 mt-5">
            <label for="montag-img">Montag</label>
            <img src="media/Chicken_Mashed-Potatoes_Brocolli.jpg" id="montag-img" width="400px" class="img-thumbnail" alt="Chicken, Mashed Potatoes & Brocolli">
        </div>
        <div class="col-md-4 col-sm-6 mt-5">
            <label for="dienstag-img">Dienstag</label>
            <img src="media/Meat-Potatoes.jpg" id="dienstag-img" width="400px"class="img-thumbnail" alt="Meat and Potatoes">
        </div>
        <div class="col-md-4 col-sm-6 mt-5">
            <label for="mittwoch-img">Mittwoch</label>
            <img src="media/Menu6.jpg" id="mittwoch-img" width="400"px class="img-thumbnail" alt="Meat, Potatoes and Vegetables">
        </div>
        <div class="col-md-4 col-sm-6 mt-5">
            <label for="donnerstag-img">Donnerstag</label>
            <img src="media/vegetarian.jpg" id="donnerstag-img" width="400px" class="img-thumbnail" alt="Vegetarian Meal 1">
        </div>
        <div class="col-md-4 col-sm-6 mt-5 ">
            <label for="freitag-img">Freitag</label>
            <img src="media/vegetarian2.jpg" id="freitag-img" width="400px" class="img-thumbnail" alt="Vegetarian Meal 2">
        </div>
        <div class="col-md-4 col-sm-6 mt-5">
            <label for="samstag-img">Samstag</label>
            <img src="media/pizza.jpg" id="samstag-img" width="400px" class="img-thumbnail" alt="Pizza">
        </div>
    </div>
</div>

</body>
</html>
