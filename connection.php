<?php

    $database= new mysqli("mysql","root","password","ehospital");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>
<?php
# for Local 
#   $database= new mysqli("localhost","root","","ehospital");
#   if ($database->connect_error){
#        die("Connection failed:  ".$database->connect_error);
#    }
#
?>
