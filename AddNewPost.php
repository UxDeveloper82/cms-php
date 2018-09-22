<?php
    require_once("db/dbcms.php");
    require_once("db/Sessions.php");
    require_once("db/function.php");
?>
<?php
    if(isset($_POST['Submit'])){
      $Title=$conn->real_escape_string($_POST['Title']);
      $Category=$conn->real_escape_string($_POST["Category"]);
      $Post=$conn->real_escape_string($_POST["Post"]);
      $CurrentTime=time();
      //$DateTime = strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
      $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
      $DateTime;
      $Admin = "Martin Fernandez";
      $Image = $_FILES['Image']['name'];
      $Target = "Upload/".basename($_FILES["Image"]["name"]);
      if(empty($Title)){
          $_SESSION["ErrorMessage"]="Title must be filled out";
          Redirect_to("AddNewPost.php");
      }elseif(strlen($Title)<2){
        $_SESSION["ErrorMessage"]="Title Should be a least 2 Characters";
        Redirect_to("AddNewPost.php");
      }else{
          global $conn;
          $query = "INSERT INTO admin_panel(datetime,title,category,author,image,post)
          VALUES('$DateTime','$Title','$Category','$Admin','$Image','$Post')";
          $Execute = $conn->query($query);
          move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);

          if($Execute){
          $_SESSION["SuccessMessage"]="Category Added Successfully";
          Redirect_to("AddNewPost.php");
          }else{
            $_SESSION["ErrorMessage"]="Category fail to Add";
            Redirect_to("AddNewPost.php");
          }
      }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add New Post</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<style>
    .FieldInfo{
       color:rgb(251,174,44);
       font-family: Bitter,Georgia,"Times New Roman";
       font-size:1.2em;
    }
</style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
         <div class="col-md-2">
            
             <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                 <li><a href="Dashboard.php"><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
                 <li class="active"><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
             </ul>
        </div>    
        <div class="col-sm-10">
                <h1>Add New Post</h1>
                <div>
                <!--php Code-area-->
                <?php echo Message();
                      echo SuccessMessage();
                ?>
                </div>
                <div>
                    <form action="AddNewPost.php" method="post" enctype="multipart/form-data">
                        <fieldset>
                                <div class="form-group">
                                    <label for="title"><span class="FieldInfo">Title:</span></label>
                                <input class="form-control" type="text" name="Title" id="title" placeholder="Title"><br>
                                </div> 
                                <div class="form-group">
                                    <label for="categoryselect"><span class="FieldInfo">Category:</span></label> 
                                    <select class="form-control" id="categoryselect" name="Category">
                                    <?php
                                        global $conn;
                                        $ViewQuery= "SELECT * FROM category ORDER BY datetime desc";
                                        $Execute = $conn->query($ViewQuery);
                                        while($DataRows= mysqli_fetch_array($Execute)){
                                                $Id = $DataRows['id'];
                                                $CategoryName = $DataRows['name'];
                                    ?>
                                    <option><?php echo $CategoryName;?></option>
                                    <?php } ?>
                                    </select>  
                                </div>
                                <div class="form-group">
                                    <label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
                                    <input type="File" class="form-control" name="Image" id="imageselect">
                                </div>    
                                <div class="form-group">
                                    <label for="postarea"><span class="FieldInfo">Post:</span></label>
                                    <textarea class="form-control" name="Post" id="postarea"></textarea>
                                </div>    
                                <br>
                                <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Post">      
                        </fieldset>
                    </form>            
                </div>
         </div> 
    </div>
</div>
<div id="footer">
     <hr><p>Theme By | Martin  Fernandez &copy;2016-2020 --- All right Reserved.
     </p>
     <a href="" style="color:white; text-decoration:none;cursor:pointer;font-weight:bold;"></a>
     <p>
        This Site is only used for study purpose UxdesingStyle.com have all the rights. no one is alow to copies other then <br>&trade;
     </p>

</div>

    
</body>
</html>