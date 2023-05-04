<?php

    @session_start();
    
    include("../connection.php");

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" || $_SESSION['usertype'] != 'p') {
            echo '<script>window.location.href = "../login.php";</script>';
            exit();
        }
    } else {
        echo '<script>window.location.href = "../login.php";</script>';
        exit();
    }

    $sqlmain= "SELECT * FROM patient WHERE patient_email=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["patient_id"];
    $username=$userfetch["patient_name"];

    
    if($_GET){

        include("../connection.php");
        $id=$_GET["id"];
        $sqlmain= "SELECT * FROM patient WHERE patient_id=?";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result001 = $stmt->get_result();
        $email=($result001->fetch_assoc())["patient_email"];

        $sqlmain= "DELETE FROM webuser WHERE email=?;";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();

        $sqlmain= "DELETE FROM patient WHERE patient_email=?";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();

        header("location: ../logout.php");
    }

?>