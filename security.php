<?php

@session_start();

require_once('config.php');

if(isset($_SESSION['timeLastActive'])){

  //determing the time now 
  $timeNow = time();

  //determing the last time active 

  $lastTimeActive = $_SESSION['timeLastActive'];

  //figuring out the diffrence

  $timeSinceLoggedIn = $timeNow - $lastTimeActive;

  echo "<p>time since last request $timeSinceLoggedIn</p>";
   if($timeSinceLoggedIn > TIMEOUT_IN_SECONDS) {
    echo "<p>time is up you have been logged out";
    $_SESSION['my-errors'] = array("<p>Timeout! you have been logged out<p/>");
    header('location: ./log-out.php');
    die();
   } else {
    $_SESSION['timeLastActive'] = time();
   }

} else {
  $_SESSION['my-errors'] = array("<p>Who are you? you need to log in<p/>");
  header('location: ../log-out.php');
    die();
}


//securing users edintity

if (!isset($_SESSION["username"]) ){
  $_SESSION['my-errors'] = array("<p>Who are you? you need to log in<p/>");
  header('location: ../log-out.php');
}


?>