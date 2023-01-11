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

        <div class="container-sm align-content-sm-center" id="cookie">
            <h1 class="text-center"> Wochenkarte</h1>
            <br/>
            <h3>Willkommen</h3>
            <form action="index.php" method="post">
                <div class="form-group text-center">
                    <p>Diese Webseite verwendet Cookies</p>
                </div class = "form-group">
                <div class="form-group text-center">
                    <input class="btn btn-warning" type="submit" name="accept" value="Akzeptieren" required/>
                </div>
            </form>
        </div>

        <?php
    } else {
        ?>
        <div class="container col-sm-4">
            <h1 class="text-center"> Wochenkarte</h1>
            <br/>
            <form action="index.php" method="post" class="form-group">
                <h3 class="text-center">Bitte anmelden:</h3>
                <div class="mb-3 mt-5 align-content-center">
                    <div class="col-sm-4 ">
                        <label for="email"></label>
                            <input
                                    type="email"
                                    class="form-control <?= $user->hasErrors('email') ? 'is-invalid' : '' ?>"
                            name="email"
                            placeholder="Enter email"
                            value="<?=htmlspecialchars($user->getEmail()) ?>"
                    />

                <br>
                <?php if($user->hasErrors('email'))
                echo "<div>" . $user->getErrors()['email'] . "</div>";
            ?>
                    </div>
                    <div class="col-sm-4">
                        <label for="password"></label>
                            <input type="password"
                                   class="form-control" <?= $user->hasErrors('password') ? 'is-invalid' : '' ?>"
                           name="password"
                           placeholder="Enter password"
                           value="<?=htmlspecialchars($user->getPassword()) ?>"
                            />

                    <?php if($user->hasErrors('password'))
                        echo "<div>" . $user->getErrors()['password'] . "</div>";
                    ?>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-5 text-center">Anmelden</button>
                </div>
            </form>
        </div>


        <?php
    }
    ?>

</body>
</html>