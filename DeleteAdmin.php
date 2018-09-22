<?php
     require_once("db/dbcms.php");
     require_once("db/Sessions.php");
     require_once("db/function.php");
    
?>
<?php    
    if(isset($_GET["id"])){
        $IdFromURL =$_GET["id"];
        global $conn;  
        $Delete_quary= "DELETE FROM registration 
        WHERE id='$IdFromURL'";
        $Execute = $conn->query($Delete_quary); 
        if($Execute){
            $_SESSION["SuccessMessage"]= "Admin Deleted Successfully";
            Redirect_to("Admin.php");
        }else{
            $_SESSION["ErrorMessage"]="Something Went Wrong. Try Again";
            Redirect_to("Admin.php");
        }

    }
?>