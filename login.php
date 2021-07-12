<?php
function canLogin($username, $password)
{
    if($username === "ameliegosiau" && $password === "Test1") {
        return true;
    }
    else {
        return false;
    }
}
   if(!empty($_POST)){
       $username = $_POST['username']; 
       $password = $_POST['password'];

       if(canLogin($username, $password)){
        session_start();
        $_SESSION["username"] =$username;
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
<?php include_once("navigation.php")?>


<div id="app">
<form action="" method="post">
    <h1>Log in to Planda</h1>
    <nav class="nav--login">
        <a href="#" id="tabLogin">Log in</a>
        <a href="#" id="tabSignIn">Sign up</a>
    </nav>
  
  <?php if(isset($error)); ?>
    <div class="alert">That password was incorrect. Please try again</div>
  
  <div class="form form--login">
    <label for="username">Username</label>
    <input type="text" id="username" name="username">
  
    <label for="password">Password</label>
    <input type="password" id="password" name="password">
  </div>
  
  <div class="form form--signup hidden">
    <label for="username2">Username</label>
    <input type="text" id="username2">
  
    <label for="password2">Password</label>
    <input type="password" id="password2">
    
    <label for="email">Email</label>
    <input type="text" id="email">
  </div>
  
<input type="submit" value="log in" class="btn">
</div>

</body>
</html>