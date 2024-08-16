<?php
//starting sessions to be able to use global sessions
session_start();
require_once("../dbinfo.php");

//calling my database where I am going to inser information or get
$databaseU = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
/* determine if connection was successful */
if(mysqli_connect_errno() !=0 ){
	$_SESSION['errorMessages'] = "<p class='error'>Uh oh... could not connect to database to log you in. Please try again later.</p>";
	header("Location: login.php");
	die();
}


//getting choosen student to update from update-students page
$_SESSION['number-update'];
$_SESSION['firstname-update'];
$_SESSION['lastname-update'];

//saving id inside variable to then be able to target it inside the database && for end message at showall
$idChoosenUserToDelete = $_SESSION['number-update'];
$idChoosenFirstname = $_SESSION['firstname-update'];
$idChoosenLastname = $_SESSION['lastname-update'];

//message displaying infromation amount student
echo $_SESSION['message-update'];

//making a errors array to displaylater
$errorsUpdate = array();


//checking if form is wokring
if(isset($_POST['number']) || isset($_POST['firstname']) || isset($_POST['lastname'])){
  
  //checking if information proved is empty
  if(!empty($_POST['number']) && !empty($_POST['firstname']) && !empty($_POST['lastname'])){
    echo "<p>infromation is not empty all fields have been filled</p>";
  } else {
    $errorsUpdate[] = "<p>Please fill out all fields</p>";
    $_SESSION['errors-update'] = $errorsUpdate;
    header('location: ../options/update-students.php');
    die();
  }
  //trimming information gotten from form
  $trimmedNumber = $_POST['number'];
  $trimmedFirstname = $_POST['firstname'];
  $trimmedLastname = $_POST['lastname'];

  //displaying student user wants to updatte
  echo "<p>user wants to update id:$trimmedNumber firstname:$trimmedFirstname lastname:$trimmedLastname </p>";

  //protexting from sql injection attacks
  $sqlNumber = $databaseU->real_escape_string($trimmedNumber);
  $sqlFirstname = $databaseU->real_escape_string($trimmedFirstname);
  $sqlLastname = $databaseU->real_escape_string($trimmedLastname);

  //setting update into data base
  $result = "UPDATE students SET id='$sqlNumber', firstname='$sqlFirstname', lastname='$trimmedLastname' WHERE BINARY id='$idChoosenUserToDelete';";
   
  //checking if users choice to update is alredy regestered

  $sumOfStudents = "SELECT * FROM students WHERE BINARY id='$sqlNumber';";
  //saving request into variable
  $resultUpdate = $databaseU->query( $sumOfStudents );
  //sending them back id user they want to update is alredy isnide data base
  if($resultUpdate->num_rows > 0){
    $errorsUpdate[] = "<p>Sorry this user is alredy inside database</p>";
    $_SESSION['errors-update'] = $errorsUpdate;
    header("location: ../options/update-students.php");
    die();
  } 

  //checking if the update worked
  if($databaseU->query($result) === TRUE){
    //checking if errors where updated
    if($databaseU-> affected_rows > 0){
      $_SESSION['updated-user'] = "<p>Student with ID $idChoosenUserToDelete, Firstname: $idChoosenFirstname, LastName: $idChoosenLastname  was successfully updated to Id: $sqlNumber, Firstname: $trimmedFirstname, LastName: $trimmedLastname.<p>";
      header('location: ../showall.php');
      die();
    } else {
      $errorsUpdate = "<p>Failed to delete user please try again<p>";
    }
  }



  echo "<p>Post has been seccesful</p>";
}else {
  echo "<p>connection with post has NOT been seccesful</p>";
}

//checking for errors

if( count( $errorsUpdate ) > 0){
  $_SESSION['errors-update'] = $errorsUpdate;
  header('location: ../showall.php');
  die();
} else {
// process has been complated 
}






?>