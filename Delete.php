<?php
    require_once"db/connection.php";
    $Delete_Record_Id= $_GET['Delete'];
    $Delete_quary= "DELETE FROM emp_record 
    WHERE id='$Delete_Record_Id'";
    $Execute = $conn->query($Delete_quary); 
    if($Execute){
       echo '<script>window.open("Delete_From_DataBase.php?Deleted=Recorded Deleted Succesfully", "_self")</script>';
    }
?>