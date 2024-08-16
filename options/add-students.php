<?php
session_start();
echo "add students";

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
  <h1>Preparing Query</h1>
  <h2>Add a student</h2>
</header>
<main>
  <!-- Displaying Errors -->
  <?php
  if(isset($_SESSION['add-errors'])){
    $arrayOfErrors = $_SESSION['add-errors'];
    echo "<ul>";
    foreach ($arrayOfErrors as $singleError){
     echo "<li>$singleError</li>";
    }
    echo "</ul>";
  } else {
    echo "<p>session of erros not found</p>";
  }
  ?>

<form method="post" action="../confirm/add.php">
      <article>
        <label for="number">Student ID</label>
        <input type="text"
        name="number"
        id="number">
      </article>    
        <!--  -->
        <article>
          <label for="firstname">First Name</label>
          <input type="text"
          name="firstname"
          id="firstname">
        </article>
          <!--  -->
          <article>
            <label for="lastname">Last Name</label>
            <input type="text"
            name="lastname"
            id="lastname">
          </article>

          <!--  -->
          <article>
            <input type="submit" value="submit">
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