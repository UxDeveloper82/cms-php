<?php
     //echo "Server Details-><br>";
           //echo "SERVER_NAME->" . $_SERVER['SERVER_NAME']."<br>";
           //echo "SERVER_ADDR->" .$_SERVER['SERVER_ADDR']."<br>";
           //echo "SERVER_PORT->" .$_SERVER['SERVER_PORT']."<br>";
           //echo "DOCUMENT_ROOT->" .$_SERVER['DOCUMENT_ROOT']."<br>";
           //echo "<br>";
           //echo "Request Details-><br>";
           //echo "REMOTE_ADDR->". $_SERVER['REMOTE_ADDR']."<br>";
           //echo "REMOTE_PORT->". $_SERVER['REMOTE_PORT']."<br>";
           //echo "REQUEST_URI->". $_SERVER['REQUEST_URI']."<br>";

        session_start();
        function Message(){
            if(isset($_SESSION["ErrorMessage"])){
               $Output = "<div class=\"alert alert-danger\">";
               $Output .= htmlentities($_SESSION["ErrorMessage"]);
               $Output .= "</div>";
               $_SESSION["ErrorMessage"]=null;
               return $Output;
            }
        }
        function SuccessMessage(){
            if(isset($_SESSION["SuccessMessage"])){
               $Output = "<div class=\"alert alert-success\">";
               $Output .= htmlentities($_SESSION["SuccessMessage"]);
               $Output .= "</div>";
               $_SESSION["SuccessMessage"]=null;
               return $Output;
            }
        }
?>    
