<?php
    if(!empty($_POST)){
        $email = $_POST['email'];
        $options = [
            'cost' => 12, //niet te hoog anders duurt het te lang op te laden
        ];
        
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT, $options);
       
        $conn = new mysqli("localhost", "root", "root", "planda");
        $result = $conn->query("insert into user (email ,password) values ('".$conn->real_escape_string($email)."','".$conn->real_escape_string($password)."')");
        var_dump($result);
        //


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

    <title>Sign up</title>
</head>
<body>

<div id="app">
<form action="" method="post">
    <h1>Sign up to Planda</h1>
    <nav class="nav--login">
        <a href="login.php" id="tabLogin">Log in</a>
        <a href="" id="tabSignIn">Sign up</a>
    </nav>
  

    <div class="alert hidden">That password was incorrect. Please try again</div>
  
 
  
  <div class="form form--login">

  <label for="email">email</label>
    <input type="text" id="email" name="email">
  
    <label for="password">Password</label>
    <input type="password" id="password" name="password">
    
  </div>
  
<input type="submit" value="sign up " class="btn">
</div>

</body>
</html>