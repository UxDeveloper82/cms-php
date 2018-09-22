<?php
    require_once("db/dbcms.php");
    require_once("db/Sessions.php");

?>
<?php
    function Redirect_to($New_Location){
        header("Location:" .$New_Location);
             exit;
    }

    function Login_Attempt($Username,$Password){
         global $conn;
         $Query = "SELECT * FROM registration 
         WHERE username='$Username' AND password = '$Password'";
         $Execute = $conn->query($Query);
         if($Admin = mysqli_fetch_assoc($Execute)){
            return $Admin;
         }else{
             return null;
         }
    }
    function login(){
        if(isset($_SESSION["User_Id"])){
           return true;
        }
    }
    function Confirm_Login(){
        if(!Login()){
            $_SESSION["ErrorMessage"]="Login Required";
           Redirect_to("Login.php");




        }




    }
 




?>