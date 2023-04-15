<?php
    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"]) == "" or $_SESSION['usertype'] != 'a'){
            header("location: ../patient/index.php");
        }

    }else{
        header("location: ../patient/index.php");
    }

    if($_GET){
        include("../connection.php");
        $id = $_GET["id"];
        $sql = $database->query("DELETE FROM appointment WHERE appointment_id = '$id';");
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        header("location: ../patient/index.php"); 
    }
?>