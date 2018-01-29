<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Log In</title>
        <link rel="stylesheet" href="css/style.css" />
    </head>
    <body>

        <div id="wrap">
        <div class="login">
        <h2>Log In</h2>

        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
        ?>

        <form action="<?php echo URL; ?>login/loginprocess" method="post" name="login_form">
            <label>Email:</label>
            <input type="text" name="email" required/>
            <label>Password:</label>
            <input type="password" name="password" id="password" required/>
            <input type="submit" value="Login" /> 
        </form>
        <?php

        if (Auth::check_login($mysqli) == true) {
            echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';
            echo '<p>Do you want to change user? <a href="login/logout">Log out</a>.</p>';
        } else {
            echo '<p>Currently logged ' . $logged . '.</p>';
        }

        ?>

        </div>
        </div>

    </body>
</html>