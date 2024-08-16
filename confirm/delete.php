<?php
session_start();
/* check the database for this individual */
require_once("../dbinfo.php");
/* attempt a connection to MySQL */
$database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
/* determine if connection was successful */
if(mysqli_connect_errno() !=0 ){
	$_SESSION['errorMessages'] = "<p class='error'>Uh oh... could not connect to database to log you in. Please try again later.</p>";
	header("Location: login.php");
	die();
}

//making a array of errors
$errorsDel = array();

//checking if the decision went trough
if(isset($_POST['decision'])){
  //saving users decition inside a variable
  $usersDecition = $_POST['decision'];

  //depending on choice sending them back or continuing
  if($usersDecition === "no"){
    header('location: ../showall.php');
  } else {
    //contine with operation of deleting
    echo "<p>we are going to continue operation to delete</p>";

    //getting sessions from delete-students

    $sessId = $_SESSION['id-user'];
    $sessUsername = $_SESSION['firstname'];
    $sessLastname = $_SESSION['lastname'];

    //confirming session tranfer worked

    echo "<p>info from session $sessId, $sessUsername, $sessLastname</p>";

    //protecting from sql injection attacks

    $sqlNumber = $database->real_escape_string($sessId);
    $sqlUsername = $database->real_escape_string($sessUsername);
    $sqlLastname = $database->real_escape_string($sessLastname);

    //setting deletion of data
    $delete = "DELETE FROM students WHERE BINARY id='$sqlNumber';";

    //checking if DEL worked
    if($database ->query($delete) === TRUE){
      //check if any rows were effect
      if($database->affected_rows > 0 ){
        echo "<p>Student with ID $sqlNumber was successfully deleted.<p>";
      } else {
        $errorsDel[] = "<p>No student found with Id $sqlNumber<p>";
      }
    } else {
      // If there was an error with the query
      $errorsDel[] = "Error deleting student: " . $database->error;
    }


  }

  //displaying decition
  echo "<p>User picked $usersDecition to delete info </p>";
} else {
  $errorsDel[] = "<p>was not able to gather information from radio button</p>";
}


//settting up error checker

if( count($errorsDel) > 0 ){
  $_SESSION['errors-del'] = $errorsDel;
  header('location: ../showall.php');
  die();
} else {
  //operation was completed
  header('location: ../showall.php');
  die();
}




?>