<?php
    session_start();
    setlocale(LC_ALL, 'bg_BG.utf8'); 
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
    <title>eHospital | Admin | Appointment </title>
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
    <nav>
                <ul>
                         <li>    
                             <div style="padding:10px">
                                <div class="profile-container">
                                <div style="width:30%; padding-left:20px;"> 
                                <img src="../img/user.png?v=2" alt="" width="100%" style="border-radius:50%">
                        </div>
                        <div style="padding:0px;margin:0px;">
                            <p class="profile-title"> Администратор </p>
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
                            <p class="profile-title"> Администратор </p>
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
                    <td width="15%">
                        <p class="heading-sub12" style="padding: 0;margin: 0;padding-right:70px">
                        <?php 
                        date_default_timezone_set('Europe/Sofia');
                        $today = date('d.m.Y');
                        $list110 = $database->query("SELECT * FROM appointment;");
                        ?>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Всички запазени часове (<?php echo $list110->num_rows; ?>)</p>
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
                        <td width="5%" style="text-align: center;">
                        Лекар:
                        </td>
                        <td width="30%">
                        <SELECT name="doctor_id" id="" class="box filter-container-items" style="width:90% ;height: 37px;margin: 0;" >
                            <option value="" disabled SELECTed hidden>Изберете лекар от листа:</option><br/>                
                            <?php      
                                $list11 = $database->query("SELECT * FROM doctor ORDER BY doctor_name ASC;");
                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $sn=$row00["doctor_name"];
                                    $id00=$row00["doctor_id"];
                                    echo "<option value=".$id00.">$sn</option><br/>";
                                };
                                ?>
                        </SELECT>
                    </td>
                    <td width="12%">
                        <input type="submit"  name="filter" value="Филтър" class="btn-primary-soft btn button-icon btn-filter"  style="padding: 15px; margin :0;width:100%">
                        </form>
                    </td>
                    </tr>
                            </table>
                        </center>
                    </td>
                    
                </tr>
                
                <?php
                    if($_POST){
                        $sqlpt1="";
                        if(!empty($_POST["schedule_date"])){
                            $schedule_date=$_POST["schedule_date"];
                            $sqlpt1=" schedule.schedule_date='$schedule_date' ";
                        }
                        $sqlpt2="";
                        if(!empty($_POST["doctor_id"])){
                            $doctor_id=$_POST["doctor_id"];
                            $sqlpt2=" doctor.doctor_id=$doctor_id ";
                        }
                        $sqlmain= "SELECT appointment.appointment_id,schedule.schedule_id,schedule.title,doctor.doctor_name,patient.patient_name,schedule.schedule_date,schedule.schedule_time,appointment.appointment_num,appointment.appointment_date 
                        FROM schedule 
                        INNER JOIN appointment on schedule.schedule_id = appointment.schedule_id 
                        INNER JOIN patient ON patient.patient_id = appointment.patient_id 
                        INNER JOIN doctor ON schedule.doctor_id=doctor.doctor_id";
                        $sqllist=array($sqlpt1,$sqlpt2);
                        $sqlkeywords=array(" where "," and ");
                        $key2=0;
                        foreach($sqllist as $key){

                            if(!empty($key)){
                                $sqlmain.=$sqlkeywords[$key2].$key;
                                $key2++;
                            };
                        };
                    } else{
                        $sqlmain= "SELECT appointment.appointment_id,schedule.schedule_id,schedule.title,doctor.doctor_name,patient.patient_name,schedule.schedule_date,schedule.schedule_time,appointment.appointment_num,appointment.appointment_date 
                        FROM schedule 
                        INNER JOIN appointment 
                        ON schedule.schedule_id=appointment.schedule_id 
                        INNER JOIN patient ON patient.patient_id=appointment.patient_id 
                        INNER JOIN doctor ON schedule.doctor_id=doctor.doctor_id  
                        ORDER BY schedule.schedule_date DESC";
                    }
                ?>
                  
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                                <th class="table-headin"> Име на пациент </th>
                                <th class="table-headin"> Номер на запазен час
                                <th class="table-headin"> Лекар  </th>
                                <th class="table-headin"> Име на сесията </th>
                                <th class="table-headin" style="font-size:10px"> Дата и час на сесията </th>
                                <th class="table-headin"> Дата на запазения час </th> 
                                <th class="table-headin"> Опции </th>
                </tr>
                        </thead>
                    <tbody>                      
                            <?php               
                                $result= $database->query($sqlmain);
                                if($result->num_rows==0){
                                    echo '<tr>
                                    <td colspan="7">
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
                                    $appointment_id=$row["appointment_id"];
                                    $schedule_id=$row["schedule_id"];
                                    $title=$row["title"];
                                    $doctor_name=$row["doctor_name"];
                                    $schedule_date=$row["schedule_date"];
                                    $schedule_time=$row["schedule_time"];
                                    $patient_name=$row["patient_name"];
                                    $appointment_num=$row["appointment_num"];
                                    $appointment_date=$row["appointment_date"];
                                    echo '<tr >
                                        <td style="font-weight:600;"> &nbsp;'.
                                        
                                        substr($patient_name,0,100)
                                        .'</td >
                                        <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);">
                                        '.$appointment_num.'
                                        
                                        </td>
                                        <td>
                                        '.substr($doctor_name,0,100).'
                                        </td>
                                        <td>
                                        '.substr($title,0,100).'
                                        </td>
                                        <td style="text-align:center;font-size:12px;">
                                            '.substr($schedule_date,0,10).' <br>'.substr($schedule_time,0,5).'
                                        </td>
                                        
                                        <td style="text-align:center;">
                                            '.$appointment_date.'
                                        </td>

                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <!--<a href="?action=view&id='.$appointment_id.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-view"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">View</font></button></a>
                                       &nbsp;&nbsp;&nbsp;-->
                                       <a href="?action=drop&id='.$appointment_id.'&name='.$patient_name.'&session='.$title.'&appointment_num='.$appointment_num.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Отмяна</font></button></a>
                                       &nbsp;&nbsp;&nbsp;</div>
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
        if($action=='add-session'){

            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    
                    
                        <a class="close" href="schedule.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                                <td class="label-td" colspan="2">'.
                                   ""
                                
                                .'</td>
                            </tr>

                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Добавяне на сесия.</p><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                <form action="add-session.php" method="POST" class="add-new-form">
                                    <label for="title" class="form-label">Име на сесията : </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="title" class="input-text" placeholder="" required><br>
                                </td>
                            </tr>
                            <tr>
                                
                                <td class="label-td" colspan="2">
                                    <label for="doctor_id" class="form-label">Избиране на лекар: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <SELECT name="doctor_id" id="" class="box" >
                                    <option value="" disabled SELECTed hidden>Изберете лекар от листа: </option><br/>';
                                        
        
                                        $list11 = $database->query("SELECT  * FROM  doctor;");
        
                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row00=$list11->fetch_assoc();
                                            $sn=$row00["doctor_name"];
                                            $id00=$row00["doctor_id"];
                                            echo "<option value=".$id00.">$sn</option><br/>";
                                        };            
                        echo     '       </SELECT><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nop" class="form-label">Общо пациенти и запазени часове: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="number" name="nop" class="input-text" min="0"  placeholder="Финалният номер на запазения час зависи от" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="date" class="form-label">Дата на сесията: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="date" name="date" class="input-text" min="'.date('d.m.Y').'" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="time" class="form-label">Уговорено време: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="time" name="time" class="input-text" placeholder="Време" required><br>
                                </td>
                            </tr>         
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Изчистване" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                    <input type="submit" value="Задаване на сесията" class="login-btn btn-primary btn" name="shedulesubmit">
                                </td>
                            </tr>
                            </form>
                            </tr>
                        </table>
                        </div>
                        </div>
                    </center>
                    <br><br>
            </div>
            </div>
            ';
        }elseif($action=='session-added'){
            $titleget=$_GET["title"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    <br><br>
                        <h2>Сесия добавена.</h2>
                        <a class="close" href="schedule.php">&times;</a>
                        <div class="content">
                        '.substr($titleget,0,40).' бе зададена.<br><br>
                            
                        </div>
                        <div style="display: flex;justify-content: center;">
                        
                        <a href="schedule.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;</font></button></a>
                        <br><br><br><br>
                        </div>
                    </center>
            </div>
            </div>
            ';
        }elseif($action=='drop'){
            $nameget=$_GET["name"];
            $session=$_GET["session"];
            $appointment_num=$_GET["appointment_num"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2>Are you sure?</h2>
                        <a class="close" href="appointment.php">&times;</a>
                        <div class="content">
                            Искате да изтриете този запис? <br><br>
                            Име на пациент: &nbsp;<b>'.substr($nameget,0,40).'</b><br>
                            Номер на запазен час &nbsp; : <b>'.substr($appointment_num,0,40).'</b><br><br>
                            
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
            $sqlmain= "SELECT * FROM doctor where doctor_id='$id'";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $name=$row["doctor_name"];
            $email=$row["doctor_email"];
            $spe=$row["specialties"];
            
            $spcil_res= $database->query("SELECT specialty_name FROM specialties where specialty_id='$spe'");
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
        function show() 
        {
    document.querySelector('.hamburger').classList.toggle('open');
    document.querySelector('.navigation').classList.toggle('active');
    }
    </script>
</body>
</html>