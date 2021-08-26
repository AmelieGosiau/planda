<?php include_once('core/autoload.php');?>
<?php include_once('loggedin.inc.php');
   include_once('classes/listitem.php');
$listId = $_SESSION['listId'];

$listLists = Listitem::getAllLists($listId);

$listname =Listitem::getlistnameById($listId);
$listdescription =Listitem::getdescriptionById($listId);

$list = new Listitem();
if(!empty($_POST['updateList'])){
    try {
        $list->setListId($listId);
        $list->setlistname($_POST["list_name"]);
        $list->setlistdescription($_POST["list_description"]);
        $list->update();
		$listOK = true;
      
    } catch (\Throwable $e) {
        $error = $e->getMessage();
        var_dump($list);
    }
}  

if (isset($_POST['deletelist']))
{
    $deletelist = $_POST['deletelist'];
    if($task->deletetask($id))
    {
        echo "<script>alert('done');
        window.location.href='index.php';</script>";

    }
    else {
        echo "<script>alert('Error');
        window.location.href='index.php';</script>";
    }
}
var_dump($_POST['deletelist'])

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

<h3>manage lists</h3>
<a href="add-list.php">Add list</a>
<div class="all-lists">
<table>
    <tr>
    <th>List Name</th>
    <th>Description</th>
    <th>Actions</th>
    </tr>
<?php foreach($listLists as $list): ?>

    <form action="" method="update_list" id="profileEditForm"  enctype="multipart/form-data">
                <tr>
        <td><?php echo htmlspecialchars($list['list_name']) ?></td>
        <td><?php echo htmlspecialchars($list['list_description']) ?></td>

        <td><button onclick="TestsFunction()">Edit</button>
        <input type="submit" name="deleteList" id="submitBtn" value="Delete">
       
       
        
        <table id="TestsDiv" style="display:none">
 <?php if(isset($error)):?>
        <div class="alert">
        <?php echo $error;?></div>
    <?php endif;?>
<tr>
    <td>List Name: </td>
    <td><input type="text" name="list_name" placeholder="Type list name here"/> </td>
</tr>
<tr>
    <td>List Description: </td>
    <td><textarea name="list_description" placeholder="Type list description here"></textarea></td>
</tr>
    <tr>
        <td><input type="submit" name="updateList" value="save"/></td>
    </tr>
</table>
        
    </tr>

    
    </form>
    <?php endforeach; ?>
    </table>

    
    <script>function TestsFunction() {
    var T = document.getElementById("TestsDiv");
    T.style.display = "block";  // <-- Set it to block
}</script>
    
    <?php include_once("footer.php")?>
</body>
</html>