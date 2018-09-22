<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View From DataBase</title>
</head>
<body>
    <table width="1000" border="5" align="center">
        <caption>View From Database</caption>
            <tr>
                <th>ID</th>
                <th>Employee Name</th>
                <th>SSN</th>
                <th>Department</th>
                <th>Salary</th>
                <th>Home Address</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
    
   <?php
        require_once"db/connection.php";
        $viewquery = "SELECT * FROM emp_record";
        $execute = $conn->query($viewquery);
        while($row = mysqli_fetch_assoc($execute)){
              $ID = $row['id'];
              $Ename = $row['enam'];
              $SSN = $row['ssn'];
              $Dept = $row['dept']; 
              $Salary = $row['salary']; 
              $HomeAddress = $row['homeaddress'];  
    ?>
        <tr>
        <td><?php echo $ID;?></td>
        <td><?php echo $Ename;?></td>
        <td><?php echo $SSN;?></td>
        <td><?php echo $Dept;?></td>
        <td><?php echo $Salary;?></td>
        <td><?php echo $HomeAddress;?></td>
        <td><a href="Delete.php?Delete=<?php echo $Id; ?>">Delete</a></td>
        <td><a href="Update.php?Update=<?php echo $Id;?>">Update</a></td>
        </tr>
    <?php } ?>
     
    </table>
    
    
</body>
</html>