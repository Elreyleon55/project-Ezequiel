
<?php
session_start();
require_once('config.php');
require("dbinfo.php");
require_once('security.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>showall</title>
</head>
<body>
    <header>
      <h1>Project</h1>
      <h2>Administering DB From a Form</h2>
      <h3>This project by: Ezequiel Munoz Marte</h3>
    </header>
    <main>

      <div class="greeting-message">
        <?php
        echo $_SESSION['greeting'];
        ?>
      </div>

      <article class="log-out">
      <a href="log-out.php">Log Out</a>
      </article>

      <div class="show-all">
        <?php
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if( mysqli_connect_errno() != 0 ){
          die("<p>Could not connect to DB</p>");	
        }
        
        //link to add student
        echo "<p><a href='options/add-students.php' >Add Student</a></p>";

        //displaying message when user is updated 
        if(isset($_SESSION['updated-user'])){
          $updateMessage = $_SESSION['updated-user'];
          echo "<ul>";
          echo "<li>$updateMessage</li>";
          echo "</ul>";
        unset($_SESSION['updated-user']);
        }
          
        

        //displaying errors if user is not able to add
        if(isset($_SESSION['add-errors'])){
          $arrayOfAddErrors = $_SESSION['add-errors'];
          echo "<ul>";
          foreach ($arrayOfAddErrors as $singleError){
            echo "<li>$singleError</li>";
          }
          echo "</ul>";
          unset($_SESSION['add-errors']);
        }

        //displaying errors if user is not able to delete
        if(isset($_SESSION['errors-del'])){
          $arrayOfErrorsDel = $_SESSION['errors-del'];
          echo "<ul>";
          foreach ($arrayOfErrorsDel as $singleError){
            echo "<li>$singleError</li>";
          }
          echo "</ul>";
          unset($_SESSION['errors-del']);
        }

        $query = "SELECT id, firstname, lastname FROM students ORDER BY lastname;";
        $result = $mysqli->query( $query );

        
        echo "<table>";
        $arrayOfFieldNames =  $result->fetch_fields();
        
        echo "<tr>";
        foreach($arrayOfFieldNames  as $oneFieldAsAnObject){	 //loop through the array
          //each item in this array is an Object
          //so use the -> operator to access the Object's values...
          echo "<th>" . $oneFieldAsAnObject->name . "</th>";		  
        }
        echo "<th>DELETE</th>";	
        echo "<th>Update</th>";	
        echo "</tr>";
        
        while( $oneRecord = $result->fetch_row() ){
          $id = $oneRecord[0];
          $firstName = $oneRecord[1];
          $lastName = $oneRecord[2];
       
          echo "<tr>";
          foreach($oneRecord as $field){
            echo "<td>" .$field . "</td>"; 
            
          }
          echo "<td><a href='options/delete-students.php?id=$id&firstname=$firstName&lastname=$lastName' >Delete</a></td>"; 
          echo "<td><a href='options/update-students.php?id=$id&firstname=$firstName&lastname=$lastName' >Update</a></td>"; 
          
          echo "</tr>";	
        }
        echo "</table>";
        
        
        $numberOfRecordsInResult = $result->num_rows;
        echo "<p>Number of records:".$numberOfRecordsInResult ."</p>";
        ?>

      </div>

    </main>

    <footer>
      <p>&copy; Ezequiel Munoz Marte : 2024</p>
    </footer>


</body>
</html>