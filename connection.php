<?php

    $database= new mysqli("localhost","root","","ehospital");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>