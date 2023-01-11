<?php
require_once ("./models/CookieHelper.php");

// is cookie set?
if(CookieHelper::checkCookie()){
    session_start();
}

// Check if the accept button has been clicked
if (isset($_POST['accept'])) {
    CookieHelper::createCookie();
    // Redirect to login page
    header("Location: index.php");
    exit();
}

require_once ("./models/User.php");
$user = new User();

// Check if the login form was submitted
if (isset($_POST['submit'])) {
        $user->setEmail(isset($_POST['email'])?$_POST['email']:'');
        $user->setPassword(isset($_POST['password'])?$_POST['password']:'');

        //validate input
        if($user->validate()){
            //check credentials
            if($user->login()){
                header("Location:wochenkarte.php");
                exit();
            }
            else{
                $hasError = true;
                header("Location:index.php");
            }
        }
}

?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    } else {
        ?>
    <div>
        <h1 class = "text-center"> Wochenkarte</h1>
        <br/>
        <form action="index.php" method="post">
            <h3 class = "align-content-sm-center">Bitte anmelden:</h3>
            <div class="form-group mb-3 mt-5">
                <label for="email"></label>
                <label>
                    <input
                            type="email"
                            class="form-control <?= $user->hasErrors('email') ? 'is-invalid' : '' ?>"
                            name="email"
                            placeholder="Enter email"
                            value="<?=htmlspecialchars($user->getEmail()) ?>"
                    />
                </label>
                <br>
                <?php if($user->hasErrors('email'))
                echo "<div>" . $user->getErrors()['email'] . "</div>";
            ?>
                <label for="password"></label>
                <label>
                    <input type="password"
                           class="form-control<?= $user->hasErrors('password') ? 'is-invalid' : '' ?>"
                           name="password"
                           placeholder="Enter password"
                           value="<?=htmlspecialchars($user->getPassword()) ?>"
                    />
                </label>

                <?php if($user->hasErrors('password'))
                    echo "<div>" . $user->getErrors()['password'] . "</div>";
                ?>
            <br>
            <button type="submit" name="submit" class="btn btn-primary">Anmelden</button>
            </div>
        </form>
    </div>


    <?php
    }
    ?>

</body>
</html>