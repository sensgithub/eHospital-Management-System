<?php
    @session_start();

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" || $_SESSION['usertype'] != 'p') {
            echo '<script>window.location.href = "../login.php";</script>';
            exit();
        }
    } else {
        echo '<script>window.location.href = "../login.php";</script>';
        exit();
    }

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