<?php

    ob_start();
    @session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='d'){
        header("location: ../login.php");
    }else{
        $useremail=$_SESSION["user"];
    }

        }else{
    header("location: ../login.php");
    }
       
    if($_GET){
        include("../connection.php");
        $id=$_GET["id"];
        $sql= $database->query("DELETE FROM prescriptions WHERE prescription_id='$id';");
        header("location: prescription.php");
    }
?>