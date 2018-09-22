<?php
   
    $conn = new mysqli("localhost","root","","phpcms");
    if($conn){
       //echo "Your are Connected";
    }else{
        echo "Connection is Down";
    }



?>