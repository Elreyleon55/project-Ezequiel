<?php
session_start();

echo "delete Students";

//this page is now my processing for my link tag

if(isset($_GET['id']) && isset($_GET['firstname']) && isset($_GET['lastname'])){
  
  //sacing infromaton from url/a tag into variables
  $idOfUser = $_GET['id'];
  $idFirstname = $_GET['firstname'];
  $idLastname = $_GET['lastname'];

  //trimming information from a tag
  $trimIdOfUser = $idOfUser;
  $trimFirstname = $idFirstname;
  $trimLastname = $idLastname;

  //saving trimmed information from a tag into sessions
  $_SESSION['id-user'] = $trimIdOfUser;
  $_SESSION['firstname'] = $trimFirstname;
  $_SESSION['lastname'] = $trimLastname;

  echo "<p>is of user is the id $idOfUser this is the first name $idFirstname this is the last name $idLastname</p>";
} else {
  echo "<p>Sorry information not recived</p>";
  header('location: ../showall.php');
  die();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Project One</title>
</head>
<body>
  <?php
  echo "<p>Are you sure you want to delete the current information id: $trimIdOfUser & Firstname: $trimFirstname & Lastname: $trimLastname</p>";

  ?>
  <p>DELETE record - are you sure?</p>
  <form action="../confirm/delete.php" method="post">
    <article>
      <label for="option1">No?</label>
      <input type="radio"
      name="decision"
      id="option1"
      value="no">

    </article>
    <!--  -->
    <article>
      <label for="option2">Yes?</label>
      <input type="radio"
      name="decision"
      id="option2"
      value="yes">
    </article>
    <input type="submit" value="submit">
    
  </form>
  
</body>
</html>