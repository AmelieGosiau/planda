<?php include_once('core/autoload.php');?>
<?php include_once('loggedin.inc.php');?>

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
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;500&display=swap');
    </style> 

</head>
<body>
    <?php include_once("navigation.php")?>

<h3>manage lists</h3>
<div class="all-lists">

<a href="add-list.php">Add list</a>
    <table >
    <tr>
    <th>S.N.</th>
    <th>List Name</th>
    <th>Actions</th>
    </tr>

    <tr>
        <td>1. </td>
        <td>To DO</td>
        <td>
            <a href="#">Update</a>

            <a href="#">Delete</a>
            </td>
    </tr>
    </table>
 
    </div>

    
    
    
    <?php include_once("footer.php")?>
</body>
</html>