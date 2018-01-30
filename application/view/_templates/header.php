<?php

include_once '../application/authentication/Auth.php';

Auth::security_session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>News</title>
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/simplemde.min.css" rel="stylesheet">
    <link href="<?php echo URL; ?>css/notifier.css" rel="stylesheet">
</head>
<body>
    <div id="wrap">
    
        <div class="logo">
            <span>{ </span>News<span> }</span>
        </div>

        <!-- authentication -->
        <?php
        if (Auth::check_login($this->myDb) == true) {
            echo '<div class="auth main">';
            echo "<p>Currently logged in as <span><b>'".$_SESSION['username']."'</b></span></p>";
            echo '<p><a href="'.URL.'login/logout">Logout</a></p>';
            echo "</div>";
        } else { 
            echo '<div class="auth">';
            echo '<p><a class="logout" href="'.URL.'login">Login</a></p>';
            echo "</div>";
        }
        ?>

        <!-- navigation -->