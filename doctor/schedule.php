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
    <link rel="stylesheet" href="../css/schedule.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
        
    <title>eHospital | Doctor | Sessions </title>
    
</head>
<body>
    <?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='d'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }
    
    include("../connection.php");
    $userrow = $database->query("SELECT * FROM doctor WHERE doctor_email='$useremail'");
    $userfetch=$userrow->fetch_assoc();
    $userid= $userfetch["doctor_id"];
    $username=$userfetch["doctor_name"];


    if (isset($_POST['submit2'])) {
        $doctorID = $userid;
        $title = $_POST['title'];
        $schedule_date = $_POST['schedule_date'];
        $schedule_time = $_POST['schedule_time'];
        $nop = $_POST['nop'];
        
        $smnt = $database->prepare("INSERT INTO schedule (doctor_id, title, schedule_date, schedule_time, nop) VALUES (?, ?, ?, ?, ?)");
        $smnt->bind_param("isssi", $doctorID, $title, $schedule_date, $schedule_time, $nop);
    
        if ($smnt->execute()) {
            echo '<script>
                  var alertBox = document.createElement("div");
                  alertBox.style.position = "fixed";
                  alertBox.style.top = "17%";
                  alertBox.style.left = "50%";
                  alertBox.style.fontSize = "22px";
                  alertBox.style.transform = "translate(-50%, -50%)";
                  alertBox.style.padding = "20px";
                  alertBox.style.background = "white";
                  alertBox.style.color = "black";
                  alertBox.style.border = "1px solid cyan";
                  alertBox.style.borderRadius = "5px";
                  alertBox.style.textAlign = "center";
                  alertBox.style.fontFamily = "Arial, sans-serif";
                  alertBox.innerHTML = "Успешно зададена сесия!";
                  document.body.appendChild(alertBox);
                  setTimeout(function() {
                      document.body.removeChild(alertBox);
                  }, 3000);
                </script>';
             header('Refresh: 3; URL=schedule.php');
        } else {
            echo "<div class='alert alert-danger'>Error: " . mysqli_error($database) . "</div>";
        }
    }
    
    ?>
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
        <div class="dash-body">
            
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="javascript:history.go(-1)" ><button  class="login-btn btn-primary-soft btn btn-icon-back"  style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px"><font class="tn-in-text"> Назад </font></button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Моите сесии </p>
                                           
                    </td>
                    <td width="15%">
                        <p class="heading-sub12" style="padding: 0;margin: 0;">
                            <?php 

                        date_default_timezone_set('Europe/Sofia');
                        $today = date('d.m.Y');

                        $list110 = $database->query("SELECT  * FROM  schedule WHERE doctor_id=$userid;");

                        ?>
                        </p>
                    </td>
                </tr>           
                
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Моите сесии (<?php echo $list110->num_rows; ?>) </p>
                    </td>
                    
                </tr>
                
                <tr>
                    <td colspan="4" style="padding-top:0px;width: 100%;" >
                        <center>
                        <table class="filter-container" border="0" >
                        <tr>
                           <td width="10%">

                           </td> 
                        <td width="5%" style="text-align: center;">
                        Дата:
                        </td>
                        <td width="30%">
                        <form action="" method="post">
                            
                            <input type="date" name="schedule_date" id="date" class="input-text filter-container-items" style="margin: 0;width: 95%;">

                        </td>
                        
                    <td width="12%">
                        <input type="submit"  name="filter" value=" Филтър" class=" btn-primary-soft btn button-icon btn-filter"  style="padding: 15px; margin :0;width:100%">
                        </form>
                    </td>

                    </tr>
                            </table>
                                                                        <form method="POST" action="">
                                                                        <div class="form-group">
                                                                             <label for="title">Име на сесията:</label>
                                                                             <input type="text" name="title" id="title">
                                                                        </div>
                                                                        <div class="form-group">
                                                                             <label for="schedule_time">Час:</label>
                                                                             <input type="time" name="schedule_time" id="schedule_time">
                                                                       </div>
                                                                        <div class="form-group">
                                                                            <label for="nop">Номер на пациенти:</label>
                                                                            <input type="number" name="nop" id="nop" value="0" min="1" max="50">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="schedule_date">Дата:</label>
                                                                            <input type="date" name="schedule_date" id="schedule_date">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <button type="submit" name="submit2" class="btn btn-primary">Задаване</button>
                                                                            <button type="reset" class="btn btn-secondary">Изчистване</button>
                                                                        </div>
                                                                    </form>
                        </center>
                    </td>
                    
                </tr>
                
                <?php

                $sqlmain= "SELECT schedule.schedule_id,schedule.title,doctor.doctor_name,schedule.schedule_date,schedule.schedule_time,schedule.nop FROM schedule INNER JOIN doctor on schedule.doctor_id=doctor.doctor_id WHERE doctor.doctor_id=$userid ";
                    if($_POST){
   
                        $sqlpt1="";
                        if(!empty($_POST["schedule_date"])){
                            $schedule_date=$_POST["schedule_date"];
                            $sqlmain.=" and schedule.schedule_date='$schedule_date' ";
                        }
                    }
                ?>                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                                <th class="table-headin"> Сесия </th>         
                                <th class="table-headin"> Дата и час</th>
                                <th class="table-headin"> Максимален номер за записвания </th>     
                                <th class="table-headin"> Опции </tr>
                        </thead>
                        <tbody>                      
                            <?php                             
                                $result= $database->query($sqlmain);
                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="4">
                                    <br><br><br><br>
                                    <center>
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Системата не намери търсеното!</p>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $schedule_id=$row["schedule_id"];
                                    $title=$row["title"];
                                    $doctor_name=$row["doctor_name"];
                                    $schedule_date=$row["schedule_date"];
                                    $schedule_time=$row["schedule_time"];
                                    $nop=$row["nop"];
                                    echo '<tr>
                                        <td> &nbsp;'.
                                        substr($title,0,100)
                                        .'</td>
                                        
                                        <td style="text-align:center;">
                                            '.substr($schedule_date,0,10).' '.substr($schedule_time,0,5).'
                                        </td>
                                        <td style="text-align:center;">
                                            '.$nop.'
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=view&id='.$schedule_id.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 20px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Преглед</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=drop&id='.$schedule_id.'&name='.$title.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 20px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Отмяна</font></button></a>
                                        </div>
                                        </td>
                                    </tr>';
                                    
                                }
                            }                                
                            ?> 
                            </tbody>
                        </table>
                        </div>
                        </center>
                   </td> 
                </tr>                       
            </table>
        </div>
    </div>
    
    <?php
    
    if($_GET){
        $id=$_GET["id"];
        $action=$_GET["action"];
        if($action=='drop'){
            $nameget=$_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2> Сигурни ли сте?</h2>
                        <a class="close" href="schedule.php">&times;</a>
                        <div class="content">
                            Искате да изтриете този запис?<br>('.substr($nameget,0,100).').
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-session.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp; Да &nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="schedule.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp; Не &nbsp;&nbsp;</font></button></a>

                        </div>
                    </center>
            </div>
            </div>
            '; 
        }elseif($action=='view'){
            $sqlmain= "SELECT schedule.schedule_id,schedule.title,doctor.doctor_name,schedule.schedule_date,schedule.schedule_time,schedule.nop 
            FROM schedule 
            INNER JOIN doctor on schedule.doctor_id=doctor.doctor_id  
            WHERE schedule.schedule_id=$id";

            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $doctor_name=$row["doctor_name"];
            $schedule_id=$row["schedule_id"];
            $title=$row["title"];
            $schedule_date=$row["schedule_date"];
            $schedule_time=$row["schedule_time"];
               
            $nop=$row['nop'];

            $sqlmain12= "SELECT * FROM appointment 
            INNER JOIN patient on patient.patient_id=appointment.patient_id 
            INNER JOIN schedule on schedule.schedule_id=appointment.schedule_id WHERE schedule.schedule_id=$id;";
            $result12= $database->query($sqlmain12);
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup" style="width: 70%;">
                    <center>
                        <h2></h2>
                        <a class="close" href="schedule.php">&times;</a>
                        <div class="content">                    
                        </div>
                        <div class="abc scroll" style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">                                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="title" class="form-label" style="font-weight: bold; font-size:20px">Запазен час: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$title.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <label for="title" class="form-label" style="font-weight: bold; font-size:20px"> Лекар: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$doctor_name.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <label for="title" class="form-label" style="font-weight: bold; font-size:20px"> Дата: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$schedule_date.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <label for="title" class="form-label" style="font-weight: bold; font-size:20px"> Час: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$schedule_time.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label"><b>Вече записани пациенти:</b> ('.$result12->num_rows."/".$nop.')</label>
                                    <br><br>
                                </td>
                            </tr>                        
                            <tr>
                            <td colspan="4">
                                <center>
                                 <div class="abc scroll">
                                 <table width="100%" class="sub-table scrolldown" border="0">
                                 <thead>
                                 <tr>   
                                        <th class="table-headin">  Пациент  </th>
                                        <th class="table-headin"> Име </th>
                                        <th class="table-headin"> Номер на записване </th>
                                        <th class="table-headin"> Телефон </th>                                 
                                 </thead>
                                 <tbody>';            
                                         
                                         $result= $database->query($sqlmain12);
                
                                         if($result->num_rows==0){
                                             echo '<tr>
                                             <td colspan="7">
                                             <br><br><br><br>
                                             <center>                                           
                                             <br>
                                             <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)"> Системата не намери търсеното! </p>
                                             </center>
                                             <br><br><br><br>
                                             </td>
                                             </tr>';
                                             
                                         }
                                         else{
                                         for ( $x=0; $x<$result->num_rows;$x++){
                                             $row=$result->fetch_assoc();
                                             $appointment_num=$row["appointment_num"];
                                             $patient_id=$row["patient_id"];
                                             $patient_name=$row["patient_name"];
                                             $patient_tel=$row["patient_tel"];
                                             
                                             echo '<tr style="text-align:center;">
                                                <td>
                                                '.substr($patient_id,0,15).'
                                                </td>
                                                 <td style="font-weight:600;padding:25px">'.
                                                 
                                                 substr($patient_name,0,25)
                                                 .'</td >
                                                 <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
                                                 '.$appointment_num.'
                                                 
                                                 </td>
                                                 <td>
                                                 '.substr($patient_tel,0,25).'
                                                 </td>                                                                                           
                                             </tr>';
                                             
                                         }
                                     }                                                     
                                    echo '</tbody>
                
                                 </table>
                                 </div>
                                 </center>
                            </td> 
                         </tr>

                        </table>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';  
    }
}
    ?>

    </div>
</body>
</html>