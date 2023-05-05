<?php

    session_start();

    include("../connection.php");

    var_dump($_SESSION["user"], $_SESSION["usertype"]);

    if(isset($_SESSION["user"])){
    if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
        echo '<script>window.location.href = "../login.php";</script>';
        exit();
    }else{
        $useremail=$_SESSION["user"];
    }
    }else{
       echo '<script>window.location.href = "../login.php";</script>';
       exit();
    }
?>
<?php
    if($_GET){
        include("../connection.php");
        $id = $_GET["id"];
        $sql = $database->query("DELETE FROM appointment WHERE appointment_id = '$id';");
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        echo "<script>window.location.href='../patient/index.php';</script>";
    }
?>