<?php

require('session.php');
require('queries.php');

//Checks if form submissions are empty
if( !empty($_POST['Username']) && !empty($_POST['Password']) ){
    
    //Creating array and attaching values to send to RabbitMQ

    $user = $_POST['Username'];
    $pass = $_POST['Password'];
    
    auth_test($user, $pass);
}
?>

<!DOCTYPE HTML>
    <html>
    <head>
        
        <title>Login</title>
        <link rel="stylesheet" href="signuplogin.css">
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
        
        </head>

        <body>
            <h1 class = "header">Log in to add different cities to the weather report.</h1>  

            <form method = 'post'>
                <label>Username</label>
                <input type = "text" name = "Username"></input><br><br>
                <label>Password</label>
                <input type = "password" name = "Password"></input><br><br>
                <input type = "submit" value = "Submit"></input>
            </form>
        
        <p>Don't have an account?<p>
        <a href="signup.php">Sign up</a><br>
        <a href="weather.html">Home</a>
        </body>
    
    </html>