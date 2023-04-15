<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    if($_GET){
        include("../connection.php");
        $id=$_GET["id"];
        $result001= $database->query("SELECT * FROM doctor WHERE doctor_id=$id;");
        $email=($result001->fetch_assoc())["doctor_email"];
        $sql= $database->query("DELETE FROM webuser WHERE email='$email';");
        $sql= $database->query("DELETE FROM doctor WHERE doctor_email='$email';");
        header("location: doctors.php");
    }
?>