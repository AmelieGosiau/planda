<?php include_once('core/autoload.php');
   include_once('loggedin.inc.php');

$listId = Listitem::getlistnameById($_SESSION['listId']);

//add list
$list = new Listitem();
    if(!empty($_POST)){
        try {
            $list = new Listitem();
            $list->setListId($_SESSION['listId']);
            $list->setListname($_POST["list_name"]);
            $list->setListdescription($_POST["list_description"]);
            $list->savelist();
            $listOK = true;
            //header("manage-lists.php");

        } catch (\Throwable $e) {
            $error = $e->getMessage();
        }
        
}

    //show the lists
    $listLists = Listitem::getAllLists($listId);
    
     //delete + edit list
    $listname =Listitem::getlistnameById($listId);
    $listdescription =Listitem::getdescriptionById($listId);
    
    if(isset($_POST['deleteList'])){
        $list->deleteList($userId, $image);
    
        header('location: profilePage.php?user=' . $_SESSION['username']);
    }

    if($_GET['list_id']){
		$list = $_GET['list_id'];
 
		$conn->query("DELETE FROM `tbl_lists` WHERE `list_id` = $list_id") or die(mysqli_errno($conn));
		header("location: index.php");
	}

    if(!empty($_POST)){
        try {
        $list->setlistId($_POST["list_name"]);
        $list->setlistname($_POST["list_name"]);
        $list->setlistdescription($_POST["list_description"]);
        $list->update();
		$listOK = true;
      
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
        <td><input type="submit" name="submit" value="add new list"/>
    </tr>
</table>
</form>
<div class="all-lists">
<table>
    <tr>
    <th>List Name</th>
    <th>Description</th>
    <th>Actions</th>
    <th>Add tasks</th>
    </tr>
<?php foreach($listLists as $list): ?>

    <form action="adjust-list.php" method="updateList" id="profileEditForm"  enctype="multipart/form-data">
        <tr>
        <td><?php echo htmlspecialchars($list['list_name']) ?></td>
        <td><?php echo htmlspecialchars($list['list_description']) ?></td>

        <td><button action="addnewtasks.php">Edit</button>
        <button action="addnewtasks.php">Delete</button>
        <td><button action="adjust-list.php">Add task</button>
        </form>
    
        
    </tr>
    <?php endforeach; ?>



    </table>


    
    
    
    <?php include_once("footer.php")?>
</body>
</html>