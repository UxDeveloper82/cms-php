<?php
    require_once("db/function.php");
?>
<?php
    if(isset($_POST["Submit"])){
      $Username= $conn->real_escape_string($_POST["Username"]);
      $Password=$conn->real_escape_string($_POST["Password"]);
      if(empty($Username) || empty($Password)){
          $_SESSION["ErrorMessage"]="All Fields must be filled out";
          redirect_to("Login.php");
      }else{
          $Found_Account = Login_Attempt($Username,$Password);
          $_SESSION["User_Id"]=$Found_Account["id"]; 
          $_SESSION["Username"]=$Found_Account["username"];
          if($Found_Account){
            $_SESSION["SuccessMessage"]="Login Sucessfull {$_SESSION["Username"]}";
            redirect_to("Dashboard.php");

           }else{
            $_SESSION["ErrorMessage"]="Invalid Username/ Password";
            redirect_to("Login.php");
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
    body{
        background-color:#ffffff;
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
                
              </div>
        </div>
    </nav>
    <div class="line" style="height:10px; background:#27aae1;"></div>
<div class="container-fluid">
    <div class="row">  
         <div class="col-sm-offset-4 col-sm-4">
                <br><br>
                <div><?php echo Message();
                        echo SuccessMessage();
                ?></div>
                <br><br>
                <h2>Welcome Back!</h2>
                <div>
                    <form action="Login.php" method="post">
                        <fieldset>
                                <div class="form-group">
                                <label for="Username"><span class="FieldInfo">Username:</span></label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-envelope text-primary"></span>
                                    </span>
                                        <input class="form-control" type="text" name="Username" id="Username" placeholder="Username"><br>
                                    </div>
                                </div>  
                                <div class="form-group">
                                <label for="Password"><span class="FieldInfo">Password:</span></label>
                                <div class="input-group input-group-lg">
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-lock text-primary"></span>
                                    </span>    
                                    <input class="form-control" type="Password" name="Password" id="Password" placeholder="Password"><br>
                                    </div>
                                </div>       
                                <input class="btn btn-info btn-block" type="Submit" name="Submit" value="Login">      
                        </fieldset>
                    </form>            
                </div>
            
         </div> 
    </div>
</div>


    
</body>
</html>