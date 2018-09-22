<?php
require_once"db/connection.php";
$Update_Record = $_GET['Update'];
$ShowQuery = "SELECT * FROM emp_record
Where id = '$Update_Record'";
$Update = $conn->query($ShowQuery);
while($DataRows = mysqli_fetch_array($Update)){
      $Update_Id = $DataRows['id'];
      $Ename = $DataRows['enam'];
      $SSN = $DataRows['ssn'];
      $Dept = $DataRows['dept'];
      $Salary = $DataRows['salary'];
      $HomeAddress = $DataRows['homeaddress'];


}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update DataBase</title>
<style>
     input[type="text"],textarea{
          border:1px solid dashed;
          background-color:rgb(221,216,212);
          width:480px;
          padding:.5em;
          font-size: 1.0em;
     }

</style>

</head>
<body>
      <form action="Update.php?Update_Id=<?php echo $Update_Id;?>" method="post">
            <fieldset>
               Employee Name:<br><input type="text" name="Ename" value="<?php echo $Ename;?>"><br>
               Social SecurityNumber:<br><input type="text" name="SSN" value="<?php echo $SSN;?>"><br>
               Department: <br><input type="text" name="Dept" value="<?php echo $Dept;?>"><br>
               Salary: <br><input type="text" name="Salary" value="<?php echo $Salary;?>"><br> 
               Homeaddress:<br><textarea name="HomeAddress"><?php echo $HomeAddress;?></textarea><br>
               <br><input type="Submit" name="Submit" value="Submit Your Record"><br>            
            </fieldset>
      </form>
</body>
</html>


<?php
     require_once"db/connection.php";
     if(isset($_POST['Submit'])){
         $Update_Id = $_GET['Update_Id'];
        $Ename = $_POST['Ename'];
        $SSN = $_POST['SSN'];
        $Dept = $_POST['Dept'];
        $Salary = $_POST['Salary'];
        $HomeAddress = $_POST['HomeAddress'];
        $UpdateQuery = "Update emp_record SET
        enam ='$Ename',
        ssn ='$SSN', 
        dept='$Dept',
        salary ='$Salary',
        homeaddress='$HomeAddress'WHERE id='$Update_Id'";
        $Execute = $conn->query($UpdateQuery);
        if($Execute){
            function redirect_to($NewLocation){
                  header("Location:" .$NewLocation);
                  exit;
                }
        redirect_to("Update_Into_DataBase.php?Updated=Record has been Updated Successfully");

        } 



     }









?>