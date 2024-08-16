<?php
require_once('dbinfo.php');
session_start();

//setting up variables for cookies

$userFromCookies = "";
$passFromCookies = "";

//selected option

$check = "";

//checking for cookies 

if(isset($_COOKIE['user-data'])) {
  echo "<p>there is data inside this cookies</p>";
  $data = trim($_COOKIE['user-data']);
  $arrayOfData = explode(',', $data);
  $userFromCookies = $arrayOfData[0];
  $passFromCookies = $arrayOfData[1];
  $check = "checked";
  //this leaves the remeber me check
}

//checking my sessions for errors

if(isset($_SESSION['my-errors']) ){
  echo "<ul>";
  foreach($_SESSION['my-errors'] as $oneError){
    echo "<li>$oneError</li>";
  }
  echo "</ul>";
  unset($_SESSION['my-errors']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>log in</title>
</head>
<body>
<header>
  <h1>Assigment10 Sample Login</h1>
</header>
<main>
<form method="post" action="form-proccesor.php">
          <article class="log-in-info">
            <input type="text" 
            placeholder="enter username" 
            name="username" 
            id="username" 
            value="<?php echo $userFromCookies; ?>">
            <label for="username">Username</label>
            <br>
            <input type="password" 
            placeholder="enter password" 
            name="password" 
            id="password"
            value="<?php echo $passFromCookies; ?>">
            <label for="password">Password</label>
            <br>
            <article>
              <input type="checkbox" 
              name="cookies" 
              id="cookies"
              <?php echo $check; ?>
              value="checked">
              <label for="cookies">Remeber me</label>
            </article>
            <br>
            <article class="submit-button">
              <input type="submit" value="submit">
            </article>
          </article>
      </form>

      <footer>
        <p>&copy;Ezequiel Munoz MArte : 2024</p>
      </footer>
</main>
  
</body>
</html><?php

?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project One</title>
</head>
<body>




  
</body>
</html>