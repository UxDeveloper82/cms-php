<?php

require_once"db/connection.php";
        if(isset($_POST['Submit'])){
        if(!empty($_POST['Ename']) 
        && !empty($_POST['SSN'])
        && !empty($_POST['Dept']) 
        && !empty($_POST['Salary'])
        && !empty($_POST['HomeAddress'])){   
                $Ename =$_POST['Ename'];
                $SSN =$_POST['SSN'];
                $Dept =$_POST['Dept'];
                $Salary =$_POST['Salary'];
                $HomeAddress =$conn->real_escape_string($_POST['HomeAddress']);
                $query= "INSERT INTO emp_record(enam,ssn,dept,salary,homeaddress)
                            Values('$Ename','$SSN','$Dept','$Salary','$HomeAddress')"; 
                $result = $conn->query($query);         
                        if($result){
                            echo '<span>Record Has been Added</span>';
                        }
                    }
                        
                        else{
                            echo '<span>Please Add Name and Social Security</span>';
                }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Insert Into DataBase</title>
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
      <form action="Insert_Into_Database.php" method="post">
            <fieldset>
               Employee Name:<br><input type="text" name="Ename" value=""><br>
               Social SecurityNumber:<br><input type="text" name="SSN" value=""><br>
               Department: <br><input type="text" name="Dept" value=""><br>
               Salary: <br><input type="text" name="Salary" value=""><br> 
               Homeaddress:<br><textarea name="HomeAddress"></textarea><br>
               <br><input type="Submit" name="Submit" value="Submit Your Record"><br>            
            </fieldset>
      </form>
</body>
</html>