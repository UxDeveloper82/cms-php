<?php
    require_once("db/dbcms.php");
    require_once("db/Sessions.php");
    require_once("db/function.php");
?>
<?php
    if(isset($_POST["Submit"])){
      $Username=($_POST["Username"]);
      $Password=($_POST["Password"]);
      $ConfirmPassword=($_POST["ConfirmPassword"]);
      $CurrentTime=time();
      //$DateTime = strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
      $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
      $DateTime;
      $Admin = "Martin Fernandez";
      if(empty($Username) || empty($Password) || empty($ConfirmPassword)){
          $_SESSION["ErrorMessage"]="All Fields must be filled out";
          redirect_to("Admin.php");
      }elseif(strlen($Password)<4){
        $_SESSION["ErrorMessage"]="At least 4 Characters For Password are Required";
        redirect_to("Admin.php");
      }elseif($Password !== $ConfirmPassword){
        $_SESSION["ErrorMessage"]="Password Confirm does not match";
        redirect_to("Admin.php");
      }else{
          global $conn;
          $query = "INSERT INTO registration(datetime,username,password,addedby)
          VALUES('$DateTime','$Username','$Password','$Admin')";
          $Execute = $conn->query($query);
          if($Execute){
          $_SESSION["SuccessMessage"]="Admin Added Successfully";
          redirect_to("Admin.php");
          }else{
            $_SESSION["ErrorMessage"]="Admin fail to Add";
            redirect_to("Admin.php");
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
    <title>Manage Admins</title>
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
                 <li><a href=""><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
                 <li class="active"><a href="Admin.php"><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
             </ul>
         </div>    
         <div class="col-sm-10">
                <h1>Manage Admin Access</h1>
                <div><?php echo Message();
                        echo SuccessMessage();
                ?></div>
                <div>
                    <form action="Admin.php" method="post">
                        <fieldset>
                                <div class="form-group">
                                <label for="Username"><span class="FieldInfo">Username:</span></label>
                                <input class="form-control" type="text" name="Username" id="Username" placeholder="Username"><br>
                                </div>  
                                <div class="form-group">
                                <label for="Password"><span class="FieldInfo">Password:</span></label>
                                <input class="form-control" type="Password" name="Password" id="Password" placeholder="Password"><br>
                                </div>  
                                <div class="form-group">
                                <label for="ConfirmPassword"><span class="FieldInfo">Confirm Password:</span></label>
                                <input class="form-control" type="Password" name="ConfirmPassword" id="ConfirmPassword" placeholder="Retype Password"><br>
                                </div>  
                                <input class="btn btn-success btn-block" type="Submit" name="Submit" value="Add New Admin">      
                        </fieldset>
                    </form>            
                </div>
            <div class="table-responsive">
                <table class="table table-stripped table-hover">
                      <tr>
                          <th>Sr No.</th>
                          <th>Date & Time</th>
                          <th>Admin Name</th>
                          <th>Added By</th>
                          <th>Action</th>
                      </tr>
                      <?php
                      global $conn;
                      $ViewQuery= "SELECT * FROM registration ORDER BY datetime desc";
                      $Execute = $conn->query($ViewQuery);
                      $SrNo=0;
                       while($DataRows= mysqli_fetch_array($Execute)){
                             $Id = $DataRows['id'];
                             $DateTime = $DataRows['datetime'];
                             $Username = $DataRows['username'];
                             $Admin = $DataRows['addedby'];
                             $SrNo++;      
                      ?>
                      <tr>
                          <td><?php echo $SrNo;?></td>
                          <td><?php echo $DateTime;?></td>
                          <td><?php echo $Username;?></td>
                          <td><?php echo $Admin;?></td>
                          <td>
                             <a href="DeleteAdmin.php?=id<?php echo $Id;?>">
                             <span class="btn btn-danger">Delete</span></a>
                          
                          </td>
                    </tr> 
                      <?php  }   ;?>               
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