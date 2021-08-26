<?php include_once('core/autoload.php');
 include_once('classes/Task.php');

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

?>
<?php include_once('loggedin.inc.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>planda</title>

    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">

    <link rel="icon" href="images/favicon_planda/favicon.ico">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;500&display=swap');
    </style> 

</head>
<body>
    <?php include_once("navigation.php")?>

    <div class="all-tasks">
<a href="add-list.php">Add Task</a>
<?php if(isset($listOK)): ?>
        <section class="addsucces">
            <p>You added a new list</p>
        </section>
    <?php endif; ?>
    <table >
    <tr>
    <th>Task number</th>
    <th>Task Name</th>
    <th>priority</th>
    <th>Deadline</th>
    <th>actions</th>
    </tr>

    <tr>
        <td>1. </td>
        <td>Design a website</td>
        <td>Medium</td>
        <td>23/05/2020</td>
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