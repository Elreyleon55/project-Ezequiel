<?php
session_start();

if(isset($_SESSION['my-errors'])) {
  // foreach($_SESSION['my-errors'] as $lastingErrors){
  //   echo $lastingErrors;
  // }
  //this makes my my-errors beacome null
  unset($_SESSION['my-errors']);

}

 //clear all session variables
$_SESSION = array();

//destroy

session_destroy();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logout</title>
</head>
<body>
  <header>
  <h1>You are logged out</h1>
  <p><a href="./index.php">lets go back to the log in</a></p>
  </header>
  <main></main>
  <footer></footer>
</body>
</html>