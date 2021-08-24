<?php include_once('core/autoload.php'); ?>

<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

    if(!empty($_POST)){
        try {
            $user = new User();

            $user->setUsername($_POST["username"]);
            $user->setPassword($_POST["password"]);
            $user->setEmail($_POST["email"]);

            $user->save();
            
            session_start();
            header('location: login.php');
        } catch (\Throwable $e) {
            $error = $e->getMessage();
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

    <title>Sign up</title>
</head>
<body>

<div id="app">
<form method="post">
<img class="logo" src="images/logo/planda.png" alt="Planda logo" >
    <h1>Sign up to Planda</h1>
    <nav class="nav--login">
        <a href="login.php" id="tabLogin">Log in</a>
        <a href="" id="tabSignIn">Sign up</a>
    </nav>
  

    <?php if(isset($error)):?>
        <div class="alert">
        <?php echo $error;?></div>
    <?php endif;?>
  
 
  
  <div class="form form--login">

  <label for="username">username</label>
    <input type="text" id="username" name="username">

  <label for="email">email</label>
    <input type="text" id="email" name="email">
  
    <label for="password">Password</label>
    <input type="password" id="password" name="password">
    
  </div>
  
<input type="submit" value="Sign up " class="btn">
</div>

</body>
</html>