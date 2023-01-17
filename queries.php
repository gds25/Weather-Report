<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//SQL Connection Parameters
$host = 'localhost';
$userSQL = 'root';
$passSQL = '';
$db = 'weatherDatabase';

//Establishing connection
$mysql = new mysqli($host, $userSQL, $passSQL, $db);
if ($mysql -> connect_errno){
    return "Could not connect to mysql: ". $mysql->connect_error;
    exit();
}


//For Logging in to website by queuering User Table
function authenticate($user, $pass){
    global $mysql;
    //Select Query
    $query = "SELECT username, password FROM users WHERE username = '" . $user . "';";
    //Executing Query
    $result = $mysql->query($query);
    //Retrieving Row
    $loginInfo = $result->fetch_row();
    $mysql->close();
    if ($loginInfo) {
        if (password_hash($pass, PASSWORD_DEFAULT) == $loginInfo['password']){
            return true;
        }
        else{
            return false;
        }
    }
    else {
        return false;
    }
}

// test the authenticate function
function auth_test ($user, $pass) {
    // authorization failure
    if (!authenticate ($user, $pass)){
        echo "<script>alert('Wrong username or password.')</script>";
    }
    
    // authorization success
    else if (authenticate ($user, $pass)) {
        if(isset($_SESSION)){
            session_destroy();
            session_start();
        }else{
            session_start();
        }
        $_SESSION["Logged"] = TRUE;
        $_SESSION["username"] = $user;
        header("refresh:0.1; url = addCity.php");
    }
}

// user sign up
function signup($user, $pass){
    global $mysql;
    //Preparing statement and binding parameters
    $stmt = $mysql->prepare("INSERT INTO users (username, password) VALUES (?,?)");
    $stmt->bind_param('ss', $user, $pass);
    
    //If executed correctly, return. Else, return the statement error
    if($stmt->execute()){
        $mysql->close();
        if(isset($_SESSION)){
            session_destroy();
            session_start();
        }else{
            session_start();
        }
        $_SESSION["Logged"] = TRUE;
        $_SESSION["username"] = $user;
        header("refresh:0.1; url = addCity.php");
    }
    
    $error = $stmt->error;
    $mysql->close();
    return $error;
    
}

//Adding city to location table
function addCity($username, $city, $state, $country){
    global $mysql;
    
    $query = "SELECT * FROM cities WHERE username = '". $username ."' and city = '". $city ."' and state = '". $state ."' and country = '". $country ."';";
    //Executing Query
    $result = $mysql->query($query);
    //Retrieving Row
    $duplicate = $result->fetch_row();
    if ($duplicate) {
        echo "<script>alert('City already part of your list.')</script>";
    }
    else{ 
        //Preparing statement and binding parameters
        $stmt = $mysql->prepare("INSERT INTO cities (username, city, state, country) VALUES (?,?,?,?)");
        $stmt->bind_param('ssss', $username, $city, $state, $country);
            //If executed correctly, return 1. Else, return the statement error
        if($stmt->execute()){
            $mysql->close();
            header("refresh:0.1; url = weather.html");
        }
        $error = $stmt->error;
        $mysql->close();
        return $error;
    }
}

//Removing city from location table
function removeCity($username, $city, $state, $country){
    global $mysql;
    //Preparing statement
    $stmt = "DELETE FROM cities where username = '". $username ."' and city = '". $city ."' and state = '". $state ."' and country = '". $country ."';";
    //If executed correctly, return 1. Else, return the statement error
    if($mysql->query($stmt)){
          $mysql->close();
          return;
        }
    $error = $stmt->error;
    $mysql->close();
    return $error;
}

//Get all cities a user has saved
function getCities($username){
    global $mysql;
    //Preparing query
    $query = "SELECT * FROM cities WHERE username = '". $username ."' ;";
    
    $result = $mysql->query($query);
    $mysql->close();
    $cities = array();
    foreach ($result as $row){
        array_push($cities, $row);
    }
    return $cities;
}


?>