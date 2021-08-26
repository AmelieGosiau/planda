<?php include_once('core/autoload.php');?>
<?php include_once('loggedin.inc.php');?>
<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$userId = User::getUserIdByName($_SESSION['username']);

    if(!empty($_POST)){
        try {
            $list = new Listitem();
            $list->setListId($listId);
            $list->setListname($_POST["list_name"]);
            $list->setListdescription($_POST["list_description"]);
            $list->savelist();
            $listOK = true;
            //header("manage-lists.php");

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

<form method="post" action="">
<?php if(isset($error)):?>
        <div class="alert">
        <?php echo $error;?></div>
    <?php endif;?>

<table>
<tr>
    <td>List Name: </td>
    <td><input type="text" name="list_name" placeholder="Type list name here"/> </td>
</tr>
<tr>
    <td>List Description: </td>
    <td><textarea name="list_description" placeholder="Type list description here"></textarea></td>
</tr>
    <tr>
        <td><input type="submit" name="submit" value="save"/></td>
    </tr>
</table>
    


</form>
    <?php include_once("footer.php")?>
</body>
</html>