<?php
    //date_default_timezone_set("Florida");
    $CurrentTime=time();
    //$DateTime=strftime("%y-%m-%d %H:%M:%S",$CurrentTime);
    $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);
    echo $DateTime;

?>