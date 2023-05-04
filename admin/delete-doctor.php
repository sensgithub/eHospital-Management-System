<?php

    @session_start();


    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" || $_SESSION['usertype'] != 'a') {
            echo '<script>window.location.href = "../login.php";</script>';
            exit();
        }
    } else {
        echo '<script>window.location.href = "../login.php";</script>';
        exit();
    }

    if($_GET){
        include("../connection.php");
        $id=$_GET["id"];
        $result001= $database->query("SELECT * FROM doctor WHERE doctor_id=$id;");
        $email=($result001->fetch_assoc())["doctor_email"];
        $sql= $database->query("DELETE FROM webuser WHERE email='$email';");
        $sql= $database->query("DELETE FROM doctor WHERE doctor_email='$email';");
        echo '<script>window.location.href = "doctors.php";</script>';

    }
?>