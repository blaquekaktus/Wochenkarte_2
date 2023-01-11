<?php

require_once ("CookieHelper.php");
require_once ("User.php");
$message='';
$user = new User();
//$cookiechecker =  new CookieHelper(); //brauch ich das überhaupt?

if(isset($_POST['submit'])){
    $user->setEmail(isset($_POST['email'])?$_POST['email']:'');
    $user->setPassword(isset($_POST['password'])?$_POST['password']:'');

    //validate input
    if($user->validate()){
        //check credentials
        if($user->login()){
            $message="<p class = 'alert alert-success>Die eingegeben Credentials sind in Ordnung!</p>";
            header("Location:wochenkarte.php");
            exit();
        }
        else{
            $message="<p class = 'alert alert-danger>Die eingegeben Credentials sind  nicht in Ordnung!</p>";
            header("Location:index.php");
        }
    }
}
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="./css/bootstrap.min.css">
<title>Wochenkarte</title>
</head>
<body>

    <?php

    // Check if the cookie has been accepted
    if (!CookieHelper::checkCookie()) {

    // If the cookie has not been accepted, display the cookie acceptance form
    ?>

    <div class = "container-sm" id="cookie">
        <form action="index.php" method="post">
            <h1 class = "text-center"> Wochenkarte</h1>
            <br/>
            <div class = "form-group text-center">
                <h3>Willkommen</h3>
            </div>
            <div class = "form-group text-center">
                <p>Diese Webseite verwendet Cookies</p>
            </div class = "form-group">
            <div class="form-group text-center">
                <input class="btn btn-warning"  type="submit" name="accept" value="Akzeptieren" required/>
            </div>
        </form>
    </div>

    <?php
    } else  {
    session_start();
    ?>
    <div id="login">
        <form action="index.php" method="post">
            <h1 class = "text-center"> Wochenkarte</h1>
            <br/>
            <div class = "form-group text-center">
                <h3>Bitte anmelden:</h3>
            </div>
            <div class="form-group">
                <input
                        type="email"
                        class="form-control <?= $user->hasErrors('email') ? 'is-invalid' : '' ?>"
                        name="email"
                        placeholder="Enter email"
                        value="<?=htmlspecialchars($user->getEmail()) ?>"
                />
            </div>
            <?php
            if(isset($user->getErrors()['email'])){
                echo $user->getErrors()['email'];
            }
            ?>
            <div class="form-group">
                <input type="password"
                       class="form-control<?= $user->hasErrors('password') ? 'is-invalid' : '' ?>"
                       name="password"
                       placeholder="Enter password"
                       value="<?=htmlspecialchars($user->getPasswort()) ?>"
                />
            </div>
            <?php
            if(isset($user->getErrors()['password'])){
                echo $user->getErrors()['password'];
            }
            ?>
            <button type="submit" class="btn btn-primary">Anmelden</button>
        </form>
    </div>

    <?php
    }
    ?>

</body>
</html>