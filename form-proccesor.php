<?php
 session_start();
 require_once('config.php');
 require("dbinfo.php");

 //setting expirity for my cookies
   $expiry	= time() + 20;

   //checking to activate coookies 

   if (!isset($_POST['cookies'])){
     $iAmACookie = false;
     //works
   } else {
     $iAmACookie = true;
    //works
   }

   //making array of errors
   $errors = array();



   //checking if the form has been submited
   if(isset($_POST['username']) && $_POST['password']) {
    echo "<p>the username and password have been submited</p>";
  
    //trim my values to avoid missleaing spaces

    $user = trim($_POST['username']);
    $pass = trim($_POST['password']);

    echo $pass;

     //trying to make it not case sensitive
     $fUpperCaseUser = ucfirst($user);
     $AllUpperCaseUser = strtoupper($fUpperCaseUser);


     //instantiate a mysqli object
    //attempting to connect to db

    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    /* determine if connection was successful */
    if( mysqli_connect_errno() != 0 ){
      die("<p>Could not connect to DB</p>");	
    } else {
      echo "<p>Connection was successful</p>";
    }

        //saving variable giving username to make sure we dont get a sql injection attact
        $user = $mysqli->real_escape_string($user);
        $pass = $mysqli->real_escape_string($pass);

        //hasing password for security

        $hashPass = password_hash($pass, PASSWORD_BCRYPT);

    $query = "SELECT password FROM secure_users WHERE BINARY username='$user';";
    //use ->query() function to run SQL on the database
    //but the $result returned is a 2D array 

    //getting my username 
    
    $results = $mysqli->query($query);

    $input = $results->fetch_row();


      /* process query results */
      /* if no records matched the provided username/password, 
      then this user is not in our database, and so are unauthorized
      */
        if($results->num_rows != 1){
          $errors[] = "<p>inputs does not match our data bases</p>";
        } else {
          echo "<p class='error'>We have a valid username</p>";
        }

        $passwordFieldFromDatabase = $input[0];


    if($results -> num_rows > 0){
      
      echo "<p>There are ".$results->num_rows." students.</p>";
  
      $arrayOfFieldNames =  $results->fetch_fields();
    
      // $results->data_seek(0);
  
      while( $oneRecord = $results->fetch_row() ){
        echo "<tr>";
        foreach($oneRecord as $field){
          echo "<td>" .$field . "</td>"; 
        }
        if($field === $pass ){
          echo "<p>There are secceslog in students.</p>";
        } else {
          $errors[] = "<p>Username does not match our data bases</p>";
        }
        echo "</tr>";	
      }
      echo "</table>";
    } else {
      $errors[] = "<p>The username was not in our database</p>";
      echo "<p class='error'>The username was not in our database</p>";
    }

    if(password_verify( $pass, $passwordFieldFromDatabase) == false ){
      $errors[] = "<p>invalid password</p>";
    } else {
      echo "<p>PAssword has been varafied222</p>";
    }

    $mysqli->close();

  
  } 

  else if (empty($pass) || empty($user)){
    // nothing was filled inside the form
    $errors[] = "<p class='error'>Please fill in username and password to be able to log in</p>";
  }

  //checking for errors
  if( count( $errors ) > 0){
    $_SESSION['my-errors'] = $errors;
    header('location: ./index.php');
    exit();
  } else {
    $_SESSION['greeting'] = "<p>OK, $user, you seem ok... you will be logged in to db from a form</p>";

    echo "<p>OK, $user, you seem ok...</p>";

    //setting my cookies if they clicked remeber me
    if($iAmACookie){
      setcookie('user-data', "$user, $pass", $expiry);
    } else {
      setcookie("user-data", "", $expiry - 1);
       }
       //secure user security
       $_SESSION["username"] = $user;

      //time for security
      $_SESSION['timeLastActive'] = time();

      header('location: ./showall.php');

  }


  //processing my form in seach 

  if(isset($_POST['id-number']) ||isset($_POST['first-name']) || isset($_POST['last-name']) ){
    echo "<p>form usbmission was succesfull</p>";
  } else {
    echo "<p>please Fill out form/p>";
  }

    






?>