<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/animations.css">  
    <link rel="stylesheet" href="../css/main.css">  
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="stylesheet" href="../css/portal.css">
    <link rel="stylesheet" href="../css/mobi.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <title>eHospital | Запазени часове </title>
</head>
<body>
<?php

session_start();

if (isset($_SESSION["user"])) {
  if (($_SESSION["user"]) == "" || $_SESSION['usertype'] != 'p') {
    header("location: ../login.php");
    exit();
  } else {
    $useremail = $_SESSION["user"];
  }
} else {
  header("location: ../login.php");
  exit();
}

include("../connection.php");

    $sqlmain = "SELECT * FROM patient WHERE patient_email=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s", $useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch = $userrow->fetch_assoc();
    $userid = $userfetch["patient_id"];
    $username = $userfetch["patient_name"];

    $sqlmain = "SELECT appointment.appointment_id,schedule.schedule_id,schedule.title,doctor.doctor_name,patient.patient_name,schedule.schedule_date,schedule.schedule_time,appointment.appointment_num,appointment.appointment_date 
        FROM schedule 
        INNER JOIN appointment on schedule.schedule_id = appointment.schedule_id 
        INNER JOIN patient on patient.patient_id = appointment.patient_id 
        INNER JOIN doctor on schedule.doctor_id = doctor.doctor_id 
        WHERE patient.patient_id=?";

    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("i", $userid);

    if ($_POST) 
    {
        if (!empty($_POST["schedule_date"])) 
        {
         $schedule_date = $_POST["schedule_date"];
         $sqlmain .= " and schedule.schedule_date=?";
         $stmt->bind_param("s", $schedule_date);
        };
    }

    $sqlmain .= " ORDER BY appointment.appointment_date asc";
    $stmt->execute();
    $result = $stmt->get_result();
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
    <nav>
                <ul>
                         <li>    
                             <div style="padding:10px">
                                <div class="profile-container">
                                <div style="width:30%; padding-left:20px;"> 
                                <img src="../img/user.png?v=2" alt="" width="100%" style="border-radius:50%">
                        </div>
                        <div style="padding:0px;margin:0px;">
                            <p class="profile-title">
                                <?php echo substr($username,0,50)?>             
                            </p>
                            <p class="profile-subtitle">
                                <?php echo substr($useremail,0,50)?>
                            </p>
                        </div>
                        <div>
                            <a href="../logout.php"><input type="button" value="Излизане" class="logout-btn btn-primary-soft btn"></a>
                        </div>
                     </div>
                    </div> 
                        </li>
                        <div class="menu-btn"> <a href="index.php"    style="text-decoration: none;"> <p class="menu-text">Начало</p> </a> </div>
                        <div class="menu-btn"> <a href="doctors.php"  style="text-decoration: none;"> <p class="menu-text">Лекари</p> </a> </div>
                        <div class="menu-btn"> <a href="schedule.php" style="text-decoration: none;"> <p class="menu-text">Сесии</p> </a> </div>
                        <div class="menu-btn"> <a href="appointment.php" style="text-decoration: none;"> <p class="menu-text">Запазени часове</p> </a> </div>
                        <div class="menu-btn"> <a href="diagnoses.php" style="text-decoration: none;"> <p class="menu-text">Диагнози</p> </a> </div>
                        <div class="menu-btn"> <a href="settings.php" style="text-decoration: none;"> <p class="menu-text">Настройки</p> </a> </div>
                </ul>
        </nav>
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
                            <p class="profile-title"><?php echo substr($username,0,50)  ?>..</p>
                            <p class="profile-subtitle"><?php echo substr($useremail,0,50)  ?></p>
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
                        <div class="menu-btn"> <a href="diagnoses.php" style="text-decoration: none;"> <p class="menu-text">Диагнози</p> </a> </div>
                        <div class="menu-btn"> <a href="settings.php" style="text-decoration: none;"> <p class="menu-text">Настройки</p> </a> </div>
    </div>
</div>
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="javascript:history.go(-1)"><button class="login-btn btn-primary-soft btn" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">Назад</button></a>
                    </td>
                    <td>
                        <p style="font-size: 23px;padding-left:12px;font-weight: 600;">Запазени часове</p>
                                           
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Моите запазени часове (<?php echo $result->num_rows; ?>)</p>
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
                        <input type="submit"  name="filter" value="Филтър" class=" btn-primary-soft btn button-icon btn-filter"  style="padding: 15px; margin :0;width:100%">
                        </form>
                    </td>

                    </tr>
                            </table>
                        </center>
                    </td>   
                </tr>
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0" style="border:none">
                        
                        <tbody>
                        
                            <?php
                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="7">
                                    <br><br><br><br>
                                    <center>             
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Системата не намери търсеното !</p>
                                    </a>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{

                                    for ( $x=0; $x<($result->num_rows);$x++){
                                        echo "<tr>";
                                        for($q=0;$q<3;$q++){
                                            $row=$result->fetch_assoc();
                                            if (!isset($row)){
                                            break;
                                            };
                                            $schedule_id=$row["schedule_id"];
                                            $title=$row["title"];
                                            $doctor_name=$row["doctor_name"];
                                            $schedule_date=$row["schedule_date"];
                                            $schedule_time=$row["schedule_time"];
                                            $appointment_num=$row["appointment_num"];
                                            $appointment_date=$row["appointment_date"];
                                            $appointment_id=$row["appointment_id"];
    
                                            if($schedule_id==""){
                                                break;
                                            }
    
                                            echo '
                                            <td style="width: 25%;">
                                                    <div  class="dashboard-items search-items"  >
                                                    
                                                        <div style="width:100%;">
                                                        <div class="h3-search">
                                                                    Дата на резервацията: '.substr($appointment_date,0,30).'<br>
                                                                    Номер: OC-000-'.$appointment_id.'
                                                                </div>
                                                                <div class="h1-search">
                                                                    '.substr($title,0,100).'<br>
                                                                </div>
                                                                <div class="h3-search">
                                                                    Номер на резервацията:<div class="h1-search">0'.$appointment_num.'</div>
                                                                </div>
                                                                <div class="h3-search">
                                                                    '.substr($doctor_name,0,100).'
                                                                </div>                                                                                                        
                                                                <div class="h4-search">
                                                                    Резервирана дата: '.$schedule_date.'<br>Започва в: <b>'.substr($schedule_time,0,5).'</b>
                                                                </div>
                                                                <br>
                                                                <a href="?action=drop&id='.$appointment_id.'&title='.$title.'&doc='.$doctor_name.'" ><button  class="login-btn btn-primary-soft btn "  style="padding-top:11px;padding-bottom:11px;width:100%"><font class="tn-in-text">Отмяна</font></button></a>
                                                        </div>
                                                                
                                                    </div>
                                                </td>';
    
                                        }
                                        echo "</tr>"; 
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
        if($action=='booking-added'){
            
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    <br><br>
                        <h2>Успешно добавен.</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                        Вашият резервиран номер е '.$id.'.<br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                        <br><br><br><br>
                        </div>
                    </center>
            </div>
            </div>
            ';
        }elseif($action=='drop'){
            $title=$_GET["title"];
            $doctor_name=$_GET["doc"];
            
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Сигурни ли сте?</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                            Искате да отмените този час?<br><br>
                            Сесия: <b>'.substr($title,0,40).'</b><br>
                            Лекар: <b>'.substr($doctor_name,0,40).'</b><br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-appointment.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Да&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="appointment.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;Не&nbsp;&nbsp;</font></button></a>
                        </div>
                    </center>
            </div>
            </div>
            '; 
        }elseif($action=='view'){
            $sqlmain= "SELECT * FROM doctor WHERE doctor_id=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row=$result->fetch_assoc();
            $name=$row["doctor_name"];
            $email=$row["doctor_email"];
            $spe=$row["specialties"];
            
            $sqlmain= "SELECT specialty_name FROM specialties WHERE id=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("s",$spe);
            $stmt->execute();
            $spcil_res = $stmt->get_result();
            $spcil_array= $spcil_res->fetch_assoc();
            $spcil_name=$spcil_array["specialty_name"];
            $tele=$row['doctor_tel'];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2></h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Виж детайли.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Име: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    '.$name.'<br><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Е-майл: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$email.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Телефон: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                '.$tele.'<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Специалности: </label>      
                                </td>
                            </tr>
                            <tr>
                            <td class="label-td" colspan="2">
                            '.$spcil_name.'<br><br>
                            </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="doctors.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>  
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
    <script>
        function show() {
    document.querySelector('.hamburger').classList.toggle('open');
    document.querySelector('.navigation').classList.toggle('active');
    }
    </script>
</body>
</html>
