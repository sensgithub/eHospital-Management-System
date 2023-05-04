<?php

    $database= new mysqli(mysql,"db_user","password","ehospital");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>
