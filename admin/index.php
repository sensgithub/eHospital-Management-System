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
    <title>eHospital | Admin | Меню </title>

</head>
<body>
    <?php
    @session_start();
    
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
        <div class="dash-body" style="margin-top: 15px">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;" >                       
                        <tr>  
                            <td colspan="2" class="nav-bar" >
                                
                                <form action="doctors.php" method="post" class="header-search" style="padding-right: 200px">
        
                                    <input type="search" name="search" class="input-text header-searchbar" placeholder="Търсене на доктори по име/емайл" list="doctors">
                                    
                                    <?php
                                        echo '<datalist id="doctors">';
                                        $list11 = $database->query("SELECT doctor_name, doctor_email FROM doctor;");
        
                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row00=$list11->fetch_assoc();
                                            $d=$row00["doctor_name"];
                                            $c=$row00["doctor_email"];
                                            echo "<option value='$d'><br/>";
                                            echo "<option value='$c'><br/>";
                                        };
        
                                    echo ' </datalist>';
                                    ?>
                                    <input type="Submit" value="Търсене" class="login-btn btn-primary-soft btn" style="padding-left: 35px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;"> 
                                </form>
                            </td>
                            <td width="15%">
                                <p class="heading-sub12" style="padding: 0;margin: 0; padding-right: 62px">
                                <?php 
                                date_default_timezone_set('Europe/Sofia'); 
                                $today = date('d.m.Y');
                                $patientrow = $database->query("SELECT  * FROM  patient;");
                                $doctorrow = $database->query("SELECT  * FROM  doctor;");
                                $appointmentrow = $database->query("SELECT  * FROM  appointment WHERE appointment_date>='$today';");
                                $schedulerow = $database->query("SELECT  * FROM  schedule WHERE schedule_date='$today';");
                                ?>
                                </p>
                            </td>
                        </tr>
                <tr>
                    <td colspan="4">
                        
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
                                                    <?php    echo $doctorrow->num_rows ?>
                                                </div>
                                                <br>
                                                <div class="h3-dashboard"> Лекари </div>
                                        </div>
                                    </div>
                                </td>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;">
                                        <div>
                                                <div class="h1-dashboard">
                                                    <?php    echo $patientrow->num_rows ?>
                                                </div>
                                                <br>
                                                <div class="h3-dashboard">Пациенти </div>
                                        </div>
                                </td>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex; ">
                                        <div>
                                                <div class="h1-dashboard" >
                                                    <?php echo $appointmentrow ->num_rows  ?> </div><br>
                                                <div class="h3-dashboard" > Нов запазен час
                                                </div>
                                        </div>
                                </td>
                                <td style="width: 25%;">
                                    <div  class="dashboard-items"  style="padding:20px;margin:auto;width:95%;display: flex;padding-top:26px;padding-bottom:26px;">
                                        <div>
                                                <div class="h1-dashboard">
                                                    <?php    echo $schedulerow ->num_rows  ?>
                                                </div><br>
                                                <div class="h3-dashboard" style="font-size: 12px; ">
                                                    Днешни сесии
                                                </div>
                                        </div>
                                </td>                           
                            </tr>
                        </table>
                    </center>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <table width="100%" border="0" class="dashbord-tables">
                            <tr>
                                <td>
                                <?php 
                                $date = strtotime("+1 week"); 
                                $dayOfWeekEnglish = date('l', $date); 
                                $dayNames = array(
                                'Monday' => 'понеделник',
                                'Tuesday' => 'вторник',
                                'Wednesday' => 'сряда',
                                'Thursday' => 'четвъртък',
                                'Friday' => 'петък',
                                'Saturday' => 'събота',
                                'Sunday' => 'неделя'
                                );
                                $day = $dayNames[$dayOfWeekEnglish]; 
                                ?>
                                <p style="padding:10px;padding-left:48px;padding-bottom:0;font-size:23px;font-weight:700;color:var(--primarycolor);">
                                Предстоящи запазени часове до <?php echo $day; ?>
                                </p>
                                </td>
                                <td>
                                    <p style="text-align:right;padding:10px;padding-right:48px;padding-bottom:0;font-size:23px;font-weight:700;color:var(--primarycolor);">
                                        <?php  
                                        $date = strtotime("+1 week"); 
                                        $dayOfWeekEnglish = date('l', $date); 
                                        $dayNames = array(
                                        'Monday' => 'понеделник',
                                        'Tuesday' => 'вторник',
                                        'Wednesday' => 'сряда',
                                        'Thursday' => 'четвъртък',
                                        'Friday' => 'петък',
                                        'Saturday' => 'събота',
                                        'Sunday' => 'неделя'
                                        );
                                        $day = $dayNames[$dayOfWeekEnglish]; 
                                        if ($day == 'събота' || $day == 'неделя' || $day == 'сряда') {
                                          echo 'Остават запазени часове до следващата ' . $day;
                                        } else {
                                          echo 'Остават запазени часове до следващия ' . $dayy;
                                        }
                                        ?> 
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td width="50%">
                                    <center>
                                        <div class="abc scroll" style="height: 200px;">
                                        <table width="85%" class="sub-table scrolldown" border="0">
                                        <thead>
                                        <tr>    
                                                <th class="table-headin" style="font-size: 12px;"> Номер на запазен час </th>
                                                <th class="table-headin">Име на пациент </th>
                                                <th class="table-headin"> Доктор</th>
                                                <th class="table-headin">Сесия</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $nextweek=date("d.m.Y",strtotime("+1 week"));
                                            $sqlmain= "SELECT appointment.appointment_id,schedule.schedule_id,schedule.title,doctor.doctor_name,patient.patient_name,schedule.schedule_date,schedule.schedule_time,appointment.appointment_num,appointment.appointment_date 
                                            FROM schedule 
                                            INNER JOIN appointment 
                                            on schedule.schedule_id=appointment.schedule_id 
                                            INNER JOIN patient 
                                            on patient.patient_id=appointment.patient_id 
                                            INNER JOIN doctor on schedule.doctor_id=doctor.doctor_id 
                                            WHERE schedule.schedule_date>='$today' and schedule.schedule_date<='$nextweek' 
                                            ORDER BY schedule.schedule_date DESC";

                                                $result= $database->query($sqlmain);
                
                                                if($result->num_rows==0){
                                                    echo '<tr>
                                                    <td colspan="3">
                                                    <br><br><br><br>
                                                    <center>    
                                                    <br>
                                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)"> Ненамерни записи!</p>
                                                    <a class="non-style-link" href="appointment.php"><button  class="login-btn btn-primary-soft btn"  style="display: flex;justify-content: center;align-items: center;margin-left:20px;">&nbsp; Покажи всички запазени часове &nbsp;</font></button>
                                                    </a>
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
                                                    echo '<tr>
                                                        <td style="text-align:center;font-size:23px;font-weight:500; color: var(--btnnicetext);padding:20px;">
                                                            '.$appointment_num.'     
                                                        </td>
                                                        <td style="font-weight:600;"> &nbsp;'.                       
                                                        substr($patient_name,0,50)
                                                        .'</td >
                                                        <td style="font-weight:600;"> &nbsp;'.
                                                        
                                                            substr($doctor_name,0,100)
                                                            .'</td >

                                                        <td>
                                                        '.substr($title,0,100).'
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
                                <td width="50%" style="padding: 0;">
                                    <center>
                                        <div class="abc scroll" style="height: 200px;padding: 0;margin: 0;">
                                        <table width="85%" class="sub-table scrolldown" border="0" >
                                        <thead>
                                        <tr>
                                                <th class="table-headin">  Име на сесията </th>
                                                <th class="table-headin"> Лекар</th>
                                                <th class="table-headin">  Дата и час на сесията  </th>
                                                </tr>
                                        </thead>
                                        <tbody>
                                        
                                            <?php
                                            $nextweek=date("d.m.Y",strtotime("+1 week"));
                                            $sqlmain= "SELECT schedule.schedule_id,schedule.title,doctor.doctor_name,schedule.schedule_date,schedule.schedule_time,schedule.nop 
                                            FROM schedule INNER JOIN doctor on schedule.doctor_id=doctor.doctor_id  
                                            WHERE schedule.schedule_date>='$today' and schedule.schedule_date<='$nextweek' 
                                            ORDER BY schedule.schedule_date DESC"; 
                                                $result= $database->query($sqlmain);
                
                                                if($result->num_rows==0){
                                                    echo '<tr>
                                                    <td colspan="4">
                                                    <br><br><br><br>
                                                    <center>
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
                                                        <td style="padding:20px;"> &nbsp;'.
                                                        substr($title,0,100)
                                                        .'</td>
                                                        <td>
                                                        '.substr($doctor_name,0,100).'
                                                        </td>
                                                        <td style="text-align:center;">
                                                            '.substr($schedule_date,0,50).' '.substr($schedule_time,0,5).'
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
                            <tr>
                                <td>
                                    <center>
                                        <a href="appointment.php" class="non-style-link"><button class="btn-primary btn" style="width:85%">Виж всички запазени часове</button></a>
                                    </center>
                                </td>
                                <td>
                                    <center>
                                        <a href="schedule.php" class="non-style-link"><button class="btn-primary btn" style="width:85%">Виж всички сесии</button></a>
                                    </center>
                                </td>
                            </tr>
                                 </table>
                                </td>
                        </tr>
                    </table>
                    </center>
                    </td>
                 </tr>
             </table>
        </div>
    </div>
    <script>
        function show() {
    document.querySelector('.hamburger').classList.toggle('open');
    document.querySelector('.navigation').classList.toggle('active');
    }
    </script>
</body>
</html>