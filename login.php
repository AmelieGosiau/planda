<?php

function canLogin($email, $password)
{
    $conn = new PDO('mysql:host=localhost;dbname=planda', "root", "root");
    $statement = $conn->prepare("select * from user where email = :email");
    $statement->bindValue(":email", $email);
    $statement->execute();
    $user = $statement->fetch();
    if(!$user){
        return false;
    }
    $hash = $user["password"];
    if( password_verify($password, $hash)){
        return true;
    } else{
         return false;
    }
}
   if(!empty($_POST)){
       $email = $_POST['email']; 
       $password = $_POST['password'];

       if(canLogin($email, $password)){
        session_start();
        $_SESSION["email"] =$email;
        header("Location: index.php");

       }
       else {
           $error = true;
       }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/registrationLogin.css"/>
    <link rel="icon" href="images/favicon_planda/favicon.ico">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans&family=Ubuntu:wght@500;700&display=swap');
    </style> 

    <title>Log in</title>
</head>
<body>


<div id="app">
<form action="" method="post">
    <h1>Log in to Planda</h1>
    <nav class="nav--login">
        <a href="#" id="tabLogin">Log in</a>
        <a href="register.php" id="tabSignIn">Sign up</a>
    </nav>
  
  <?php if(isset($error)); ?>
    <div class="alert">That password was incorrect. Please try again</div>
  
  <div class="form form--login">
    <label for="email">email</label>
    <input type="text" id="email" name="email">
  
    <label for="password">password</label>
    <input type="password" id="password" name="password">
  </div>
  
  
<input type="submit" value="log in" class="btn">
</div>

</body>
</html>