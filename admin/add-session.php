<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
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
        header("location: schedule.php?action=session-added&title=$title");
    }

?>