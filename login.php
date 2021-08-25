<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include_once('core/autoload.php');
session_start();

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
  header("Location: index.php");   
}

if(isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if(User::canLogin($username, $password)) {
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        $_SESSION["userid"] = User::getUserIdByName($username);

        header("Location: index.php");
    } else {
        $alert = "Username or password are incorrect.";
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
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;500&display=swap');
    </style> 

    <title>Log in</title>
</head>
<body>

<div id="app">
<form action="" method="post">
    <h1>Log in to Planda</h1>
    <nav class="nav--login">
    <img class="logo" src="images/logo/planda.png" alt="Planda logo" >
        <a href="#" id="tabLogin">Log in</a>
        <a href="register.php" id="tabSignIn">Sign up</a>
    </nav>
  
    <?php if(isset($error)):?>
        <div class="alert">
        <?php echo $error;?></div>
    <?php endif;?>
  
  <div class="form form--login">
  
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
   
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
    
  </div>
  
  
<input type="submit" name="login" id="submitBtn" class="btn" value="login">
</div>

</body>
</html>