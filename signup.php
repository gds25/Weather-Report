
<?php
    require("session.php");
    require("queries.php");
    
    //Checks if form submissions are not empty
    if(!empty($_POST['Username']) && !empty($_POST['Password'])) {

        $user = $_POST['Username'];
        $pass = password_hash($_POST['Password'], PASSWORD_DEFAULT);
        
        signup($user, $pass);
        
    }

?>
<!DOCTYPE HTML>
<html>
    
    <head>
        <title>Signup</title>
        <link rel="stylesheet" href="signuplogin.css">
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
    </head> 

    <body>
        <h1 class = "header">Sign up!</h1>
        <form method = 'post' >
                <label>Username</label>
                <input type = "text" name = "Username"></input><br><br>
                <label>Password</label>
                <input type = "password" name = "Password" required></input><br><br>
                <input type = "submit" value = "Submit"></input>
        </form><br>
        
        <a href="index.php">Home</a>
    </body>
</html>