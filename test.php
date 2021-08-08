<?php
$conn = new mysqli("localhost", "root", "root", "planda");
$users = $conn->query("select * from user");

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php foreach( $users as $user): ?>
    <h1><?php echo $user['email'];  ?></h1> 
<?php endforeach; ?>

</body>
</html>