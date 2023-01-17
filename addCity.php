<?php
require('session.php');
require('queries.php');

checkLogin();
//Checks if submissions are not empty
if(isset($_POST['cty']) && !empty($_POST['city'])) {

    $country = $_POST['cty'];
    $state = $_POST['state'];
    $city = $_POST['city'];
    
    addCity($_SESSION['username'], $city, $state, $country);
  
}
?>

<!DOCTYPE HTML>
<html>
    
    <head>
        <title>Signup</title>
        <link rel="stylesheet" href="weather.css">
        <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
        <meta content="utf-8" http-equiv="encoding">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script type="text/javascript" src="addCity.js"></script>  
    </head> 

   <body>
		<form method = 'post'>     
        <h2> Add a City</h2> <br><br>
        <select name = "cty" id = "cty"></select><br>
        <select name = "state" id = "state"></select><br>
        <input type = text id = "city" type = "text" name = "city" placeholder="Enter a city" autocomplete="off">
        <input type = "submit" value = "REQUEST WEATHER"></input>
		</form>
		
        <a href="index.php">Home</a>
    </body>
</html>

