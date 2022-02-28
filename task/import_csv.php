<?php
  //session start
  session_start();
  // Connect to database
  include("db_connect.php");

  if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    
    if ($_FILES["file"]["size"] > 0) {
      
      $file = fopen($fileName, "r");
      $row = 0;
      while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
        $row++;
        if($row == 1) continue;
        $column[1] = date('Y-m-d',strtotime($column[1]));
        $sql = "INSERT into stocks_list (id,date,stock_name,price)
            values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "')";
        $result = mysqli_query($conn, $sql);
        
        if (!empty($result)) {
          $_SESSION["status"] = "Data is imported into the database";
          header('Location: home.php');
        } else {
          $_SESSION["status"] = "Problem importing CSV data";
          header('Location: index.php');
        }
      }
    }
  }
  //Return to the index page
  $_SESSION["message"] = "something went wrong";
  header('Location: home.php');
  exit;
?>