<?php require_once("db/dbcms.php");?>
<?php require_once("db/Sessions.php");?>
<?php require_once("db/function.php");?>
<?php Confirm_Login() ?>
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
</head>
<body>
<div style="height:10px; background:#27aae1;"></div>
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
             <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
                       <span class="sr-only">Toggle Navigation</span>
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>
                       <span class="icon-bar"></span>    
                </button>
                <a class="navbar-brand" href="Blog.php">
                  <img src="images_UxDesign/icons/logo2.jpg" width=96;height=20; alt="">
                </a>  
             </div>
             <div class="collapse navbar-collapse" id="collapse">
                <ul class="nav navbar-nav">
                    <li><a href="">Home</a></li>
                    <li class="active"><a href="">Blog</a></li>
                    <li><a href="">About Us</a></li>
                    <li><a href="">Services</a></li>
                    <li><a href="">Contact Us</a></li>
                    <li><a href="">Feature</a></li>
                </ul>
                    <form action="FrontPage.php" class="navbar-form navbar-right">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search" name="Search">
                        </div>
                        <button class="btn btn-default" name="SearchButton">Go</button>
                    </form>
              </div>
        </div>
    </nav>
    <div class="line" style="height:10px; background:#27aae1;"></div>
<div class="container-fluid">
    <div class="row">
         <div class="col-md-2">
             <br><br>
             <ul id="Side_Menu" class="nav nav-pills nav-stacked">
                 <li class="active"><a href=""><span class="glyphicon glyphicon-th"></span>&nbsp;Dashboard</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-list-alt"></span>&nbsp;Add New Post</a></li>
                 <li><a href="Categories.php"><span class="glyphicon glyphicon-tags"></span>&nbsp;Categories</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-user"></span>&nbsp;Manage Admins</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-comment"></span>&nbsp;Comments</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-equalizer"></span>&nbsp;Live Blog</a></li>
                 <li><a href=""><span class="glyphicon glyphicon-log-out"></span>&nbsp;Logout</a></li>
             </ul>
         </div>    
        <div class="col-sm-10"><!-- Main Area-->
                <div><?php echo Message();
                        echo SuccessMessage();
                    ?>
                </div>
                <h1>Admin Dashboard</h1>
                    <div class="table-responsive">
                            <table class="table table-stripped table-hover">
                                    <tr>
                                        <th>No</th>
                                        <th>Post Title</th>
                                        <th>Date & Time</th>
                                        <th>Author</th>
                                        <th>Category</th>
                                        <th>Banner</th>
                                        <th>Comments</th>
                                        <th>Action</th>
                                        <th>Details</th>
                                    </tr>                   
                            <?php                            
                            global $conn;                
                            $ViewQuery = "SELECT * FROM admin_panel ORDER BY datetime desc";                  
                            $Execute = $conn->query($ViewQuery);   
                            $SrNo = 0;                
                            while($DataRows= mysqli_fetch_assoc($Execute)){
                                    $Id=$DataRows['id'];
                                    $DateTime=$DataRows['datetime'];
                                    $Title=$DataRows['title'];
                                    $Category=$DataRows['category'];
                                    $Admin=$DataRows['author'];
                                    $Image=$DataRows['image'];
                                    $Post=$DataRows['post'];
                                    $SrNo++;
                            ?> 
                                <tr>
                                    <td><?php echo $SrNo;?></td>
                                    <td style="color:#5e5eff;"><?php 
                                    if(strlen($Title)>20){$Title= substr($Title,0,20).'..';}              
                                    echo $Title;?></td>
                                    <td><?php 
                                     if(strlen($DateTime)>11){$DateTime= substr($DateTime,0,11).'..';}
                                    echo $DateTime;?></td>
                                    <td><?php
                                     if(strlen($Admin)>6){$Admin= substr($Admin,0,6).'..';}
                                    echo $Admin;?></td>
                                    <td><?php
                                     if(strlen($Category)>8){$Category= substr($Category,0,8).'..';}
                                    echo $Category;?></td>
                                    <td><img src="Upload/<?php echo $Image;?>" width="170px";height="50px" alt=""></td>
                                    <td>Processing</td>
                                    <td>
                                    <a href="EditPost.php?Edit=<?php echo $Id;?>"><span class="btn btn-warning">Edit</span></a> 
                                    <a href="DeletePost.php?Delete=<?php echo $Id;?>"><span class="btn btn-danger">Delete</span></a> 
                                    </td>
                                    <td>
                                    <a href="FullPost.php?id=<?php echo $Id;?>" target="_blank">
                                    <span class="btn btn-primary">Live Preview</span>
                                    </a></td>
                                </tr>

                            <?php
                            }                  
                                            
                            ?>                      
                            </table>                
                    </div>              
        </div><!--Ending of Main Area--> 
    </div><!--Ending of Row-->
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