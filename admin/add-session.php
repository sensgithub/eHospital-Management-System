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

    
    if($_POST){
        
        include("../connection.php");
        $title=$_POST["title"];
        $doctor_id=$_POST["doctor_id"];
        $date=$_POST["date"];
        $time=$_POST["time"];
        $nop=$_POST["nop"];
        $sql="INSERT INTO schedule (doctor_id,title,schedule_date,schedule_time,nop) VALUES (?,?,?,?,?);";
        $stmt = $database->prepare($sql);
        $stmt->bind_param("isssi",$doctor_id,$title,$date,$time,$nop);
        $stmt->execute();
        echo "<script>window.location.href = 'schedule.php?action=session-added&title=$title';</script>";
    }

?>