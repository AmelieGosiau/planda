<?php include_once('core/autoload.php');?>
<?php include_once('loggedin.inc.php');?>
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$listId = Listitem::getlistnameById($_SESSION['listId']);

    if(!empty($_POST)){
        try {
            $task = new Task();
            $task->setTaskId($listId);
            $task->setTaskname($_POST["task_name"]);
            $task->setTaskhours($_POST["task_hours"]);
            $task->setTaskdeadline($_POST["task_deadline"]);
            $task->setpriority($_POST["priority"]);
            $task->savetask();
            $taskOK = true;
            header("index.php");

        } catch (\Throwable $e) {
            $error = $e->getMessage();
        }
        
}
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planda</title>

    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">

    <link rel="icon" href="images/favicon_planda/favicon.ico">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;300;500&display=swap');
    </style> 

</head>
<body>
<?php include_once("navigation.php")?>

<form method="post" action="manage-lists.php">
<?php if(isset($error)):?>
        <div class="alert">
        <?php echo $error;?></div>
    <?php endif;?>

<table>
<tr>
    <td>Task Name: </td>
    <td><input type="text" name="task_name" placeholder="Type task name here"/> </td>
</tr>
<tr>
    <td>List Description: </td>
    <td><textarea name="task_hours" placeholder="Type task hours here"></textarea></td>
</tr>
<tr>
    <td>List Description: </td>
    <td><textarea name="task_deadline" placeholder="Type task deadline here"></textarea></td>
</tr>
<tr>
    <td>List Description: </td>
    <td><textarea name="priority" placeholder="priority HIGH/MEDIUM/LOW"></textarea></td>
</tr>
    <tr>
        <td><input type="submit" name="submit" value="add list"/></td>
    </tr>
</table>
    


</form>
    <?php include_once("footer.php")?>
</body>
</html>

