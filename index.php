<?php


    session_start();
    if(isset($_SESSION['email'])){
        // user is ingelogged
        echo "welcome " . $_SESSION['username'];
    }
    else {
        // user is niet ingelogged
       header("location: login.php");
    }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengram</title>

    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">

    <link rel="icon" href="images/favicon_planda/favicon.ico">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Ubuntu:wght@500;700&display=swap');
    </style> 

</head>
<body>
    <?php include_once("navigation.php")?>
    <div id="notdone">
   <h3>Not Done</h3>
    </div>
   
    <div id="done">
    <h3>Done</h3>
    </div>
  
   
              

    
    
    <?php include_once("footer.php")?>
</body>
</html>