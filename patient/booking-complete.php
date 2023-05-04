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
    }s

    $sqlmain= "SELECT * FROM patient WHERE patient_email=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["patient_id"];
    $username=$userfetch["patient_name"];


    if($_POST){
        if(isset($_POST["booknow"])){
            $appointment_num=$_POST["appointment_num"];
            $schedule_id=$_POST["schedule_id"];
            $date=$_POST["date"];
            $schedule_id=$_POST["schedule_id"];
            $sql2="INSERT INTO appointment(patient_id,appointment_num,schedule_id,appointment_date) values ($userid,$appointment_num,$schedule_id,'$date')";
            $result= $database->query($sql2);
            echo '<script>
                  window.location.href = "appointment.php?action=booking-added&id='.$appointment_num.'&titleget=none";
                  </script>';
        }
    }
 ?>