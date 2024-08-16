<?php
//starting a session
session_start();

/* check the database to see if this individual username already exists */
require_once("../dbinfo.php");
/* attempt a connection to MySQL */
$database = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
/* determine if connection was successful */
if(mysqli_connect_errno() !=0 ){
	$errorsAdd[] = "<p class='error'>Uh oh... could not connect to database to register you. Please try again later.</p>";
	header("Location: register.php");
	die();
} else {
  echo "<p>Connection to data base has been succesful</p>";
}

//adding error array 
$errorsAdd = array();

//checking if form is wokring
if(isset($_POST['number']) || isset($_POST['firstname']) || isset($_POST['lastname']) )
{
  echo "<p>Post has been seccesful</p>";
  //connection confirmed

  //checking if fileds are empty
  if(empty($_POST['number']) || empty($_POST['firstname']) || empty($_POST['lastname']))  {
    $errorsAdd[] = "<p>Please fill out all inputs in form</p>";
    
    
  } else {
    //saving information inside variables
    $formNumber =  $_POST['number'];
    $formFirstname = $_POST['firstname'];
    $formLastname = $_POST['lastname'];
  
    //trimming infromation given
    $trimmedFormNumber = $formNumber;
    $trimmedFormFirstname = $formFirstname;
    $trimmedFormLastname = $formLastname;

    //protecting from sql attacks
    $sqlNumber = $database->real_escape_string($trimmedFormNumber);
    $sqlFirstname = $database->real_escape_string($trimmedFormFirstname);
    $sqlLastname = $database->real_escape_string($trimmedFormLastname);

    //selecting all the students from the database
    $allStudents = "SELECT * FROM students WHERE BINARY id='$sqlNumber';";
    //saving request into variable 
    $result = $database->query( $allStudents );

    //checking if id number is alredy in the list 
    if($result->num_rows > 0){
      $errorsAdd[] = "<p>This student is already regested, please pick a another one</p>";
    } 

    //adding student into database
    $student = "INSERT INTO students (id, firstname, lastname) VALUES ('$sqlNumber', '$sqlFirstname', '$sqlLastname');";
    $erros;

    //testing connection and grabbing error
    try{
      $result = $database->query( $student );
    }catch(Exception $e){
      $error = $e->getMessage();
    }

    
    //testing if any rows were added to the data base
    if($database->affected_rows == 0){
      $errorsAdd[] = "<p>Sorry we were anable to precceed with yout request to add a student you got a $error</p>";
    }
    //closing my connection with the database
    $database->close();


  }

} else {
  echo "<p>connection with post has NOT been seccesful</p>";
}

//checking for errors 

if(count( $errorsAdd ) > 0){
  echo "<p>Sorry errors were found</p>";
  $_SESSION['add-errors'] = $errorsAdd;
  print_r($_SESSION['add-errors']);
  header('location: ../showall.php');
  die();
} else {
  header('location: ../showall.php');
  die();
}








?>