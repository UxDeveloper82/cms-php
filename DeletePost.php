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
     
          global $conn;
          $DeleteFromURL=$_GET['Delete'];
          $Query = "DELETE FROM admin_panel
          WHERE id='$DeleteFromURL'";
          $Execute = $conn->query($Query);
          move_uploaded_file($_FILES["Image"]["tmp_name"],$Target);

          if($Execute){
          $_SESSION["SuccessMessage"]="Post Deleted Successfully";
          Redirect_to("Dashboard.php");
          }else{
            $_SESSION["ErrorMessage"]="Something Went Wrong";
          Redirect_to("Dashboard.php");
          }
      }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete Post</title>
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
                <h1>Delete Post</h1>
            <div>
                <!--php Code-area-->
                <?php echo Message();
                      echo SuccessMessage();
                ?>
            </div>
        <div>
                    <?php
                    global $conn;
                    $SearchQueryParameter = $_GET['Delete'];
                    $Query="SELECT * FROM admin_panel WHERE id='$SearchQueryParameter'";
                    $ExecuteQuery = $conn->query($Query);
                    while($DataRows = mysqli_fetch_array($ExecuteQuery)){
                        $TitleToBeUpdated = $DataRows['title'];
                        $CategoryToBeUpdated = $DataRows['category'];
                        $ImageToBeUpdated = $DataRows['image'];
                        $PostToBeUpdated = $DataRows['post'];
                    }
                    ?>
                    <form action="DeletePost.php?Delete=<?php echo $SearchQueryParameter; ?>" method="post" enctype="multipart/form-data">
                        <fieldset>
                                <div class="form-group">
                                    <label for="title"><span class="FieldInfo">Title:</span></label>
                                <input disabled value="<?php echo $TitleToBeUpdated;?>"class="form-control" type="text" name="Title" id="title" placeholder="Title"><br>
                                </div> 
                                <div class="form-group">
                                    <span class="FieldInfo">Existing Category</span>
                                    <?php echo $CategoryToBeUpdated;?>
                                    <br>
                                    <label for="categoryselect"><span class="FieldInfo">Category:</span></label> 
                                    <select disabled class="form-control" id="categoryselect" name="Category">
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
                                    <span class="FieldInfo">Existing Image:</span>
                                    <img src="Upload/<?php echo $ImageToBeUpdated ;?>" width="170px"; height="70px">
                                    <br>
                                    <label for="imageselect"><span class="FieldInfo">Select Image:</span></label>
                                    <input disabled type="File" class="form-control" name="Image" id="imageselect">
                                </div>    
                                <div class="form-group">
                                    <label for="postarea"><span class="FieldInfo">Post:</span></label>
                                    <textarea disabled class="form-control" name="Post" id="postarea">
                                          <?php echo $PostToBeUpdated;?>
                                    </textarea>
                                </div>    
                                <br>
                                <input class="btn btn-danger btn-block" type="Submit" name="Submit" value="Delete Post">      
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