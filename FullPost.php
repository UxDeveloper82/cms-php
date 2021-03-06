<?php require_once("db/dbcms.php");?>
<?php require_once("db/Sessions.php");?>
<?php require_once("db/function.php");?>
<?php
    if(isset($_POST['Submit'])){
      $Name=$conn->real_escape_string($_POST['Name']);
      $Email=$conn->real_escape_string($_POST["Email"]);
      $Comment=$conn->real_escape_string($_POST["Comment"]);
      $CurrentTime=time();
      //$DateTime = strftime("%Y-%m-%d %H:%M:%S",$CurrentTime);
      $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
      $DateTime;
      $PostId=$_GET['id'];
      if(empty($Name) || ($Email)|| ($Comment)){
          $_SESSION["ErrorMessage"]="All filled are Required";
          
      }elseif(strlen($Comment)>500){
        $_SESSION["ErrorMessage"]="Only 500 Characters are Allowed in comment";
    
      }else{
         global $conn;
         $PostIdFromURL=$_GET['id'];
         $query ="INSERT INTO comments(datetime,name,email,comment,status,admin_panel_id)
         VALUES('$Datetime','$Name','$Email','$Comment','OFF','$PostIdFromURL')";
          $Execute = $conn->query($query);
          if($Execute){
          $_SESSION["SuccessMessage"]="Comment Submitted Successfully";
          Redirect_to("FullPost.php?id={$PostId}");
          }else{
            $_SESSION["ErrorMessage"]="Category fail to Add";
            Redirect_to("FullPost.php?id={$PostId}");
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
    <title>Full Blog Post</title>
   <!-- Latest compiled and minified CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<link rel="stylesheet" href="style.css">
<style>
    .col-sm-8{
         background:red;
    }
    .col-sm-3{
        background:green;
    }

</style>    
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
                    <form action="FullPost.php" class="navbar-form navbar-right">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search" name="Search">
                        </div>
                        <button class="btn btn-default" name="SearchButton">Go</button>
                    </form>
              </div>
        </div>
    </nav>
    <div class="line" style="height:10px; background:#27aae1;"></div>
    <div class="container">
         <div class="blog-header">
              <h1>The Complete Responsive CMS Blog</h1>
              <p class="lead">The Complete Blog Using PHP By Martin fernandez</p>     
         </div>
         <div class="row">
              <div class="col-sm-8">
                    <!--php Code-area-->
                <?php echo Message();
                      echo SuccessMessage();
                ?>
                   <?php
                    global $conn;
                    if(isset($_GET["SearchButton"])){
                           $Search = $_GET['Search'];
                           $ViewQuery ="SELECT * FROM admin_panel
                           WHERE datetime LIKE '%$Search%' OR 
                           title LIKE '%$Search%'
                           OR 
                           category LIKE '%$Search%'
                           OR 
                           post LIKE '%$Search%'";
                    }else{
                        $PostIDFrontURL= $_GET['id'];
                    $ViewQuery ="SELECT * FROM admin_panel WHERE id='$PostIDFrontURL'
                    ORDER BY datetime desc";}
                    $Execute=$conn->query($ViewQuery);
                    while($DataRows =mysqli_fetch_array($Execute)){
                          $PostId=$DataRows['id'];
                          $DateTime=$DataRows['datetime'];
                          $Title=$DataRows['title'];
                          $Category=$DataRows['category'];
                          $Admin=$DataRows['author'];
                          $Image=$DataRows['image'];
                          $Post=$DataRows['post'];
                    ?>              
                    <div class="blogpost thumbnail">
                         <img class="img-responsive img-rounded" src="Upload/<?php echo $Image;?>" alt="">
                        <div class="caption">
                            <h1 id="heading"><?php echo htmlentities($Title);?></h1>
                            <p class="description">Category:<?php echo htmlentities($Category);?>
                            Published on <?php echo htmlentities($DateTime);?>
                            </p>
                            <p class="post"><?php   
                              //if(strlen($Post)>150){$Post = substr($Post,0,150).'...';}
                            echo $Post;?>
                            </p>
                        </div>
                            <a href="FrontPage.php"><span class="btn btn-info">Go Back &rsaquo;</span></a>

                    </div>  
                    <?php } ?>
                    <br><br>
                    <br><br>
                    <span class="FieldInfo">Share Your thoughts About This Post</span>
                    <br>
                    <span class="FieldInfo">Comments</span>
                    <div>
                    <form action="FullPost.php?id=<?php echo $PostId ;?>" method="post" enctype="multipart/form-data">
                        <fieldset>
                                <div class="form-group">
                                    <label for="Name"><span class="FieldInfo">Name:</span></label>
                                <input class="form-control" type="text" name="Name" id="Name" placeholder="Name"><br>
                                </div> 
                                <div class="form-group">
                                    <label for="Email"><span class="FieldInfo">Email:</span></label>
                                <input class="form-control" type="email" name="Email" id="Email" placeholder="Email"><br>
                                </div> 
                                <div class="form-group">
                                    <label for="commentarea"><span class="FieldInfo">Comment:</span></label>
                                    <textarea class="form-control" name="Comment" id="postarea"></textarea>
                                </div>    
                                <br>
                                <input class="btn btn-primary btn-block" type="Submit" name="Submit" value="Add New Post">      
                        </fieldset>
                    </form>            
                </div>
              </div>
              <div class="col-sm-offset-1 col-sm-3">
                    <h2>Test</h2>
                        <p>Lorem ipsum dolor sit amet consectetur 
                        adipisicing elit. Fugiat deserunt a temporibus 
                        quaerat, asperiores inventore! Quis distinctio 
                        alias perspiciatis ex a obcaecati quo labore 
                        dolorem nulla suscipit cupiditate modi eaque, 
                        tempore ratione quam non, voluptates dolores rem
                            ea maiores enim, necessitatibus doloribus 
                            repellendus. Magni vel velit ipsam illo? Quod 
                            explicabo quidem enim sunt molestias consectetur
                            tenetur quibusdam sint voluptas, nemo amet aut 
                            eaque magni, atque fuga ullam earum repudiandae re
                            </p>
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
        <div class="line" style="height:10px; background:#27aae1;"></div>            
<!-- Bootstrap Core JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>    
</body>
</html>