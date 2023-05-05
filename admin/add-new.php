<?php

    session_start();
    
    include("../connection.php");

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

        $result= $database->query("select * from webuser");
        $name=$_POST['name'];
        $spec=$_POST['spec'];
        $email=$_POST['email'];
        $tele=$_POST['tele'];
        $password=$_POST['password'];
        $cpassword=$_POST['cpassword'];
    
        if ($password==$cpassword){
            $error='3';
            $stmt = $database->prepare("SELECT * FROM webuser WHERE email=?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
            if($result->num_rows==1){
                $error='1';
            }else
            {
                $sql1 = "INSERT INTO doctor (doctor_email, doctor_name, doctor_password, doctor_nickname, doctor_tel, specialties) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt1 = $database->prepare($sql1);
                $stmt1->bind_param("ssssss", $email, $name, $password, $nic, $tele, $spec);
                $stmt1->execute();
                $sql2 = "INSERT INTO webuser (email, usertype) VALUES (?, 'd')";
                $stmt2 = $database->prepare($sql2);
                $stmt2->bind_param("s", $email);
                $stmt2->execute();
                $error= '4';
            }
    
        }else{
            $error='2';
        }
    }else{
        $error='3';
    }
    header("location: doctors.php?action=add&error=".$error);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <title>eHospital | Admin | Add doctor </title>
    <style>
        .popup{
            animation: transitionIn-Y-bottom 0.5s;
        }
</style>
</head>
<body>
</body>
</html>