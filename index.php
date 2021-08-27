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
    
    //show all the tasks
    $taskId = Task::getTasknameById($_SESSION['taskId']);
//add list
$task = new Task();

    $taskLists = Task::getAllTasks($taskId);

     //delete + edit list
    $listname =Listitem::getlistnameById($listId);
    $listdescription =Listitem::getdescriptionById($listId);
    
    if(isset($_POST['deleteList'])){
        $list->deleteList($userId, $image);
    
        header('location: profilePage.php?user=' . $_SESSION['username']);
    }

    if($_SESSION['listId']){
		$list = $_SESSION['listId'];
 
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

    <form action="addnewtasks.php" method="updateList" id="profileEditForm"  enctype="multipart/form-data">
        <tr>
        <td><?php echo htmlspecialchars($list['list_name']) ?></td>
        <td><?php echo htmlspecialchars($list['list_description']) ?></td>

        <td><button action="addnewtasks.php">Edit</button>
        <button action="addnewtasks.php">Delete</button>
        <td><button action="adjust-list.php">Add task</button>
        <?php foreach($taskLists as $task): ?>
            <?php endforeach; ?>
        </form>
    </tr>
    <tr>
    <?php endforeach; ?>
    
    <!-- comment Ajax 
    <div class="comment-form-container">
        <form id="frm-comment">
            <div class="input-row">
                <input type="hidden" name="comment_id" id="commentId"
                    placeholder="Name" /> <input class="input-field"
                    type="text" name="name" id="name" placeholder="Name" />
            </div>
            <div class="input-row">
                <textarea class="input-field" type="text" name="comment"
                    id="comment" placeholder="Add a Comment">  </textarea>
            </div>
            <div>
                <input type="button" class="btn-submit" id="submitButton"
                    value="Publish" /><div id="comment-message">Comments Added Successfully!</div>
            </div>

        </form>
    </div>

    <div id="output"></div>
    <script>
            function postReply(commentId) {
                $('#commentId').val(commentId);
                $("#name").focus();
            }

            $("#submitButton").click(function () {
            	   $("#comment-message").css('display', 'none');
                var str = $("#frm-comment").serialize();

                $.ajax({
                    url: "comment-add.php",
                    data: str,
                    type: 'post',
                    success: function (response)
                    {
                        var result = eval('(' + response + ')');
                        if (response)
                        {
                        	$("#comment-message").css('display', 'inline-block');
                            $("#name").val("");
                            $("#comment").val("");
                            $("#commentId").val("");
                     	   listComment();
                        } else
                        {
                            alert("Failed to add comments !");
                            return false;
                        }
                    }
                });
            });
            
            $(document).ready(function () {
            	   listComment();
            });

            function listComment() {
                $.post("comment-list.php",
                        function (data) {
                               var data = JSON.parse(data);
                            
                            var comments = "";
                            var replies = "";
                            var item = "";
                            var parent = -1;
                            var results = new Array();

                            var list = $("<ul class='outer-comment'>");
                            var item = $("<li>").html(comments);

                            for (var i = 0; (i < data.length); i++)
                            {
                                var commentId = data[i]['comment_id'];
                                parent = data[i]['parent_comment_id'];

                                if (parent == "0")
                                {
                                    comments = "<div class='comment-row'>"+
                                    "<div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>" + data[i]['comment_sender_name'] + " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>" + data[i]['date'] + "</span></div>" + 
                                    "<div class='comment-text'>" + data[i]['comment'] + "</div>"+
                                    "<div><a class='btn-reply' onClick='postReply(" + commentId + ")'>Reply</a></div>"+
                                    "</div>";

                                    var item = $("<li>").html(comments);
                                    list.append(item);
                                    var reply_list = $('<ul>');
                                    item.append(reply_list);
                                    listReplies(commentId, data, reply_list);
                                }
                            }
                            $("#output").html(list);
                        });
            }

            function listReplies(commentId, data, list) {
                for (var i = 0; (i < data.length); i++)
                {
                    if (commentId == data[i].parent_comment_id)
                    {
                        var comments = "<div class='comment-row'>"+
                        " <div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>" + data[i]['comment_sender_name'] + " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>" + data[i]['date'] + "</span></div>" + 
                        "<div class='comment-text'>" + data[i]['comment'] + "</div>"+
                        "<div><a class='btn-reply' onClick='postReply(" + data[i]['comment_id'] + ")'>Reply</a></div>"+
                        "</div>";
                        var item = $("<li>").html(comments);
                        var reply_list = $('<ul>');
                        list.append(item);
                        item.append(reply_list);
                        listReplies(data[i].comment_id, data, reply_list);
                    }
                }
            }
        </script>
 
 -->

    </tr>
  
  


    </table>



    
    <?php include_once("footer.php")?>
</body>
</html>