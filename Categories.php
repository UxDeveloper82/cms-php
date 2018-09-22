<?php
    require_once("db/dbcms.php");
    require_once("db/Sessions.php");
    require_once("db/function.php");
?>
<?php
    if(isset($_POST["Submit"])){
      $Category=($_POST["Category"]);
      $CurrentTime=time();
      //$DateTime = strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
      $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
      $DateTime;
      $Admin = "Martin Fernandez";
      if(empty($Category)){
          $_SESSION["ErrorMessage"]="All Fields must be filled out";
          redirect_to("Categories.php");
      }elseif(strlen($Category)>99){
        $_SESSION["ErrorMessage"]="Too long Name For Category";
        redirect_to("Categories.php");
      }else{
          global $conn;
          $query = "INSERT INTO category(datetime,name,creatername)
          VALUES('$DateTime','$Category','$Admin')";
          $Execute = $conn->query($query);
          if($Execute){
          $_SESSION["SuccessMessage"]="Category Added Successfully";
          redirect_to("Categories.php");
          }else{
            $_SESSION["ErrorMessage"]="Category fall to Add";
            redirect_to("Categories.php");
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
    <title>Admin Dashboard</title>
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
                 <li><a href=""><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
                 <li><a href="AddNewPost.php"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
                 <li class="active"><a href=""><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
             </ul>
         </div>    
         <div class="col-sm-10">
                <h1>Manage Categories</h1>
                <div><?php echo Message();
                        echo SuccessMessage();
                ?></div>
                <div>
                    <form action="Categories.php" method="post">
                        <fieldset>
                                <div class="form-group">
                                <label for="categoryname"><span class="FieldInfo">Name:</span></label>
                                <input class="form-control" type="text" name="Category" id="categoryname" placeholder="Name"><br>
                                </div>  
                                <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Category">      
                        </fieldset>
                    </form>            
                </div>
            <div class="table-responsive">
                <table class="table table-stripped table-hover">
                      <tr>
                          <th>Sr No.</th>
                          <th>Date & Time</th>
                          <th>Category Name</th>
                          <th>Creator Name</th>
                      </tr>
                      <?php
                      global $conn;
                      $ViewQuery= "SELECT * FROM category ORDER BY datetime desc";
                      $Execute = $conn->query($ViewQuery);
                      $SrNo=0;
                       while($DataRows= mysqli_fetch_array($Execute)){
                             $Id = $DataRows['id'];
                             $DateTime = $DataRows['datetime'];
                             $CategoryName = $DataRows['name'];
                             $CreatorName = $DataRows['creatername'];
                             $SrNo++;      
                      ?>
                      <tr>
                          <td><?php echo $SrNo;?></td>
                          <td><?php echo $DateTime;?></td>
                          <td><?php echo $CategoryName;?></td>
                          <td><?php echo $CreatorName;?></td>
                      
                      <?php  }   ;?>
                      </tr>                
                </table>
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