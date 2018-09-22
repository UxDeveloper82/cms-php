<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Into DataBase</title>
</head>
<style>
    .DeleteButton{
       background-color:#f4bbb3;
    }
    .EditButton{
       background-color:#5d0580;

    }
</style>

<body>
    <div class="container">
        <form action="Search_From_DataBase.php" method="GET">
            <fieldset>
                    <input type="text" Name="Search" value="" placeholder="Search By Employee Name / SSN ">
                    <input type="Submit" Name="SearchButton" value="Search">


            </fieldset>   
        </form>
    </div>
    <?php
        require_once"db/connection.php";
        if(isset($_GET['SearchButton'])){
align                $Search = $_GET['Search'];
                $SearchQuery = "SELECT * FROM emp_record WHERE enam ='$Search' OR ssn= '$Search'";
                $Execute = $conn->query($SearchQuery);
                while($DataRows = mysqli_fetch_array($Execute)){
                      $Id = $DataRows['id'];
                      $Ename = $DataRows['enam'];
                      $SSN = $DataRows['ssn'];
                      $Dept = $DataRows['dept'];
                      $Salary = $DataRows['salary'];
                      $HomeAddress = $DataRows['homeaddress'];
                
                ?>
                <table width="1000" border="5" align="center">
                       <caption>Search Result</caption>
                       <tr>
                            <th>ID</th>
                            <th>Ename</th>
                            <th>SSN</th>
                            <th>Department</th>
                            <th>Salary</th>
                            <th>Home Address</th>
                            <th>New</th>
                       </tr>
                       <tr>
                            <td><?php echo $Id;?></td>
                            <td><?php echo $Ename;?></td>
                            <td><?php echo $SSN;?></td>
                            <td><?php echo $Dept;?></td>
                            <td><?php echo $Salary;?></td>
                            <td><?php echo $HomeAddress;?></td>
                            <td align="center"><a href="Search_From_DataBase.php">Search Again</a></td>
                       </tr>
                </table>
  
    <?php 
                }
        }


    ?>
    <h2><?php echo @$_GET['Deleted'];?></h2>
    <h2><?php echo @$_GET['Updated'];?></h2>
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
              $Id = $row['id'];
              $Ename = $row['enam'];
              $SSN = $row['ssn'];
              $Dept = $row['dept']; 
              $HomeAddress = $row['homeaddress'];  
    ?>
        <tr>
        <td><?php echo $Id;?></td>
        <td><?php echo $Ename;?></td>
        <td><?php echo $SSN;?></td>
        <td><?php echo $Dept;?></td>
        <td><?php echo $Dept;?></td>
        <td><?php echo $HomeAddress;?></td>
        <td class="DeleteButton"><a style="color:#ffffff;" href="Delete.php?Delete=<?php echo $Id; ?>">Delete</a></td>
        <td class="EditButton"><a style="color:#ffffff;" href="Update.php?Update=<?php echo $Id;?>">Update</a></td>
        </tr>
    <?php } ?>
     
    </table>
</body>
</html>