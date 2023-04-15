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
    <title>eHospital | Сесии </title>

</head>
<body>
    <?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p'){
            header("location: ../login.php");
        }else{
            $useremail=$_SESSION["user"];
        }

    }else{
        header("location: ../login.php");
    }

    include("../connection.php");

    $sqlmain= "SELECT* FROM patient WHERE patient_email=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch=$userrow->fetch_assoc();

    $userid= $userfetch["patient_id"];
    $username=$userfetch["patient_name"];

    date_default_timezone_set('Europe/Sofia');

    $today = date('d.m.Y');


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
                        <div class="menu-btn"> <a href="settings.php" style="text-decoration: none;"> <p class="menu-text">Настройки</p> </a> </div>
    </div>
</div>
        <?php

                $sqlmain= "SELECT * FROM schedule INNER JOIN doctor on schedule.doctor_id=doctor.doctor_id where schedule.schedule_date>='$today'  order by schedule.schedule_date asc";
                $sqlpt1="";
                $insertkey="";
                $q='';
                $searchtype="All";
                        if($_POST){                     
                        if(!empty($_POST["search"])){
                            $keyword=$_POST["search"];
                            $sqlmain= "SELECT * FROM schedule INNER JOIN doctor on schedule.doctor_id=doctor.doctor_id where schedule.schedule_date>='$today' and (doctor.doctor_name='$keyword' or doctor.doctor_name like '$keyword%' or doctor.doctor_name like '%$keyword' or doctor.doctor_name like '%$keyword%' or schedule.title='$keyword' or schedule.title like '$keyword%' or schedule.title like '%$keyword' or schedule.title like '%$keyword%' or schedule.schedule_date like '$keyword%' or schedule.schedule_date like '%$keyword' or schedule.schedule_date like '%$keyword%' or schedule.schedule_date='$keyword' )  order by schedule.schedule_date asc";
                            $insertkey=$keyword;
                            $searchtype="Търсен резултат: ";
                            $q='"';
                        }
                    }
                $result= $database->query($sqlmain)
                ?>
                  
    <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%" >
                    <a href="javascript:history.go(-1)"><button class="login-btn btn-primary-soft btn" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">Назад</button></a>
                    </td>
                    <td >
                            <form action="" method="post" class="header-search">

                                        <input type="search" name="search" class="input-text header-searchbar" placeholder="Търсене на лекар" list="doctors" value="<?php  echo $insertkey ?>">&nbsp;&nbsp;
                                        
                                        <?php
                                            echo '<datalist id="doctors">';
                                            $list11 = $database->query("SELECT DISTINCT * FROM  doctor;");
                                            $list12 = $database->query("SELECT DISTINCT * FROM  schedule GROUP BY title;");
                                            for ($y=0;$y<$list11->num_rows;$y++)
                                            {
                                                $row00=$list11->fetch_assoc();
                                                $d=$row00["doctor_name"];
                                               
                                                echo "<option value='$d'><br/>";
                                               
                                            };
                                            for ($y=0;$y<$list12->num_rows;$y++)
                                            {
                                                $row00=$list12->fetch_assoc();
                                                $d=$row00["title"];
                                               
                                                echo "<option value='$d'><br/>";
                                            };
                                        echo ' </datalist>';
                                         ?>
                                        
                                
                                        <input type="Submit" value="Търсене" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                                        </form>
                    </td>        
                <tr>
                    <td colspan="4" style="padding-top:10px;width: 100%;" >
                    <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)"> <?php $searchtype_bg = "Всички сесии "; echo $searchtype_bg."(".$result->num_rows.")"; ?> </p>
                    </td>     
                </tr>

                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">
                            
                        <tbody>
                        
                            <?php

                                if($result->num_rows==0)
                                {
                                    echo '<tr>
                                    <td colspan="4">
                                    <center>
                                    <br>
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">Системата не намери вашето търсене!</p>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{

                                for ( $x=0; $x<($result->num_rows);$x++)
                                {
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

                                        if($schedule_id==""){
                                            break;
                                        }

                                        echo '
                                        <td style="width: 25%;">
                                                <div  class="dashboard-items search-items"  >
                                                
                                                    <div style="width:100%">
                                                            <div class="h1-search">
                                                                Сесия '.substr($title,0,21).'
                                                            </div><br>
                                                            <div class="h3-search">
                                                                '.substr($doctor_name,0,50).'
                                                            </div>
                                                            <div class="h4-search">
                                                                '.$schedule_date.'<br> Започва в: <b>'.substr($schedule_time,0,5).'</b>
                                                            </div>
                                                            <br>
                                                            <a href="booking.php?id='.$schedule_id.'" ><button  class="login-btn btn-primary-soft btn "  style="padding-top:11px;padding-bottom:11px;width:100%"><font class="tn-in-text">Запази час</font></button></a>
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
    </div>
    <script>
        function show() {
    document.querySelector('.hamburger').classList.toggle('open');
    document.querySelector('.navigation').classList.toggle('active');
}
    </script>
</body>
</html>
