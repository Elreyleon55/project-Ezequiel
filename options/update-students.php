<?php
session_start();
echo "Update Students";

//checking if information is recived from form

if(isset($_GET['id']) && isset($_GET['firstname']) && isset($_GET['lastname'])){
  //saving information from url and tag inside variable
  $idOfUser = $_GET['id'];
  $idFirstname = $_GET['firstname'];
  $idLastname = $_GET['lastname'];

  //trmming infromation gotten from a tag
  $trimmedIdUser = $idOfUser;
  $trimmedFirstname = $idFirstname;
  $trimmedLastname = $idLastname;

  //saving trimmed variables into a session to use later
  $_SESSION['number-update'] = $trimmedIdUser;
  $_SESSION['firstname-update'] = $trimmedFirstname;
  $_SESSION['lastname-update'] = $trimmedLastname;

  //saving message to display in update
  $_SESSION['message-update'] = "<p>infromation gotten from tag is id: $trimmedIdUser first name: $trimmedFirstname LastName: $trimmedLastname</p>";


} else {
  echo "<p>infromation recieved has not been procced</p>";
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
  <h1>Preparing Query</h1>
  <h2>Update Students</h2>
</header>
<main>
  <!-- displaying errors if form is empty -->
  <?php
  if(isset($_SESSION['errors-update'])){
    $arrayOfErrors = $_SESSION['errors-update'];
    echo "<ul>";
    foreach ($arrayOfErrors as $singleError){
      echo "<li>$singleError</li>";
    }
    echo "</ul>";
    unset($_SESSION['errors-update']);
  }
  ?>


<?php
// echo "<p>You wish to update information of student Id: $trimmedIdUser, Firstname: $trimmedFirstname, Lastname: $trimmedLastname </p>";
?>
<form method="post" action="../confirm/update.php">
      <article>
        <label for="number">Student ID</label>
        <input type="text"
        name="number"
        ida="number">
      </article>    
        <!--  -->
        <article>
          <label for="firstname">First Name</label>
          <input type="text"
          name="firstname"
          ida="firstname">
        </article>
          <!--  -->
          <article>
            <label for="lastname">Last Name</label>
            <input type="text"
            name="lastname"
            ida="lastname">
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