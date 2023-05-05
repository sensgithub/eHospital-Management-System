<?php
    session_start();

    include("../connection.php");

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
    $sql = "DELETE FROM appointment WHERE appointment_id = ?";
    $stmt = $database->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    echo "<script>window.location.href='../patient/index.php';</script>";
}
?>