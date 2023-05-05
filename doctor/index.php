<?php
    session_start();
    if (isset($_SESSION["user"]) && !empty($_SESSION["user"]) && $_SESSION['usertype'] == 'd') {
        include("../connection.php");
        $useremail = $_SESSION["user"];
        $userrow = $database->query("SELECT * FROM doctor WHERE doctor_email='$useremail'");
        $userfetch = $userrow->fetch_assoc();
        $userid = $userfetch["doctor_id"];
        $username = $userfetch["doctor_name"];
    } else {
        echo '<script>window.location.href = "../login.php";</script>';
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="stylesheet" href="../css/portal.css">
    <link rel="stylesheet" href="../css/admin-mobile.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        
    <title> eHospital | Doctor | Menu </title>
    
</head>
<body>
    <div class="container">
    <div class="navigation">
    <div class="navbar-toggler">
    <button class="hamburger" onclick="show()">
        <div id="bar1" class="bar"> </div>
        <div id="bar2" class="bar"> </div>
        <div id="bar3" class="bar"> </div>
    </button>
    </div>
    <div class="menu-container">
        </div>
    </div>
    <div class="menu">
            <div class="menu-container">
                <div style="padding:10px">
                    <div class="profile-container">
                        <div style="width:30%; padding-left:20px;">
                            <img src="../img/user.png" alt="" width="100%" style="border-radius:50%">
                        </div>
                        <div style="padding:0px;margin:0px;">
                        <td style="padding:0px; margin:0px">
                            <p class="profile-title"> <?php echo substr($username,0,50) ?> </p>
                            <p class="profile-subtitle"> <?php echo substr($useremail,0,50) ?> </p>
                        </td>
                        </div>
                        <div>
                            <a href="../logout.php"><input type="button" value="Излизане" class="logout-btn btn-primary-soft btn"></a>
                        </div>
                    </div>
                </div>
                        <div class="menu-btn"> <a href="index.php"    style="text-decoration: none;"> <p class="menu-text">Начало</p> </a> </div>
                        <div class="menu-btn"> <a href="doctors.php"  style="text-decoration: none;"> <p class="menu-text">Лекари</p> </a> </div>
                        <div class="menu-btn"> <a href="schedule.php" style="text-decoration: none;"> <p class="menu-text">Сесии</p> </a> </div>
                        <div class="menu-btn"> <a href="appointment.php" style="text-decoration: none;"> <p class="menu-text">Запазени часове</p> </a> </div>
                        <div class="menu-btn"> <a href="patient.php" style="text-decoration: none;"> <p class="menu-text">Пациенти</p> </a> </div>
                        <div class="menu-btn"> <a href="prescription.php" style="text-decoration: none;"> <p class="menu-text">Рецепти</p> </a> </div>
    </div>
</div>
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >
                        
                        <tr >
                            
                            <td colspan="1" class="nav-bar" >
                            <p style="font-size: 23px;padding-left:12px;font-weight: 600;margin-left:20px;"> Начало </p>
                          
                            </td>
                            <td width="25%">

                            </td>
                            <td width="15%">
                                <p class="heading-sub12" style="padding: 0;margin: 0;">
                                    <?php 
                                date_default_timezone_set('Europe/Sofia');
        
                                $today = date('d.m.Y');

                                $patientrow = $database->query("SELECT  * FROM  patient;");
                                $doctorrow = $database->query("SELECT  * FROM  doctor;");
                                $appointmentrow = $database->query("SELECT  * FROM  appointment where appointment_date>='$today';");
                                $schedulerow = $database->query("SELECT  * FROM  schedule where schedule_date='$today';");

                                ?>
                                </p>
                            </td>    
                        </tr>
                <tr>
                    <td colspan="4" >
                        
                    <center>
                    <table class="filter-container doctor-header" style="border: none;width:95%" border="0" >
                    <tr>
                        <td >
                            <h3>Добре дошли, <?php echo $username  ?> !</h3>
                            <a href="appointment.php" class="non-style-link"><button class="btn-primary btn" style="width:30%">Моите часове</button></a>
                            <br>
                            <br>
                        </td>
                    </tr>
                    </table>
                    </center>
                    
                </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table border="0" width="100%"">
                            <tr>
                                <td width="50%">
                                    <center>
                                        <table class="filter-container" style="border: none;" border="0">
                                            <tr>
                                                <td colspan="4">
                                                    <p style="font-size: 20px;font-weight:600;padding-left: 12px;">Статут</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 25%;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex">
                                                        <div>
                                                                <div class="h1-dashboard">
                                                                    <?php    echo $doctorrow->num_rows  ?>
                                                                </div><br>
                                                                <div class="h3-dashboard">
                                                                    Всички доктори
                                                                </div>
                                                        </div>
                                                </td>
                                                <td style="width: 25%;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;">
                                                        <div>
                                                                <div class="h1-dashboard">
                                                                    <?php    echo $patientrow->num_rows  ?>
                                                                </div><br>
                                                                <div class="h3-dashboard">
                                                                    Всички пациенти
                                                                </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                </tr>
                                                <tr>
                                                <td style="width: 25%;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex; ">
                                                        <div>
                                                                <div class="h1-dashboard" >
                                                                    <?php    echo $appointmentrow ->num_rows  ?>
                                                                </div><br>
                                                                <div class="h3-dashboard" >
                                                                    Записани часове
                                                                </div>
                                                        </div>
                                                    </div>
                                                    
                                                </td>

                                                <td style="width: 25%;">
                                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;padding-top:21px;padding-bottom:21px;">
                                                        <div>
                                                                <div class="h1-dashboard">
                                                                <?php
                                                                $today = date('Y-m-d');
                                                                $query = "SELECT * FROM schedule WHERE schedule_date = '$today'";
                                                                $result = $database->query($query);
                                                                $num_schedules = $result->num_rows;
                                                                echo $num_schedules;
                                                                ?>
                                                                </div>
                                                                <br>
                                                                <div class="h3-dashboard" style="font-size: 20px">
                                                                     Днешни сесии
                                                        </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                            </tr>
                                        </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                <tr>
            </table>
        </div>
    </div>
</body>
</html>