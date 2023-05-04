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
    <link rel="stylesheet" href="../css/mobi.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <title>eHospital | Patient | Doctors</title>

</head>
<body>
    <?php

    @session_start();

    include("../connection.php");

    if (isset($_SESSION["user"])) {
        if (($_SESSION["user"]) == "" || $_SESSION['usertype'] != 'p') {
            echo '<script>window.location.href = "../login.php";</script>';
            exit();
        }
    } else {
        echo '<script>window.location.href = "../login.php";</script>';
        exit();
    }


    $sqlmain= "SELECT* FROM patient WHERE patient_email=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch=$userrow->fetch_assoc();

    $userid= $userfetch["patient_id"];
    $username=$userfetch["patient_name"];

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
                    <td width="13%">
                    <a href="javascript:history.go(-1)"><button class="login-btn btn-primary-soft btn" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">Назад</button></a>
                    </td>
                    <td>
                        
                        <form action="" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Търсене на лекар" list="doctors">&nbsp;&nbsp;
                            
                            <?php
                                echo '<datalist id="doctors">';
                                $list11 = $database->query("SELECT doctor_name , doctor_email FROM doctor;");

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $d=$row00["doctor_name"];
                                    $c=$row00["doctor_email"];
                                    echo "<option value='$d'><br/>";
                                    echo "<option value='$c'><br/>";
                                };

                            echo ' </datalist>';
                            ?>                      
                            <input type="Submit" value="Търсене" class="login-btn btn-primary btn" style="padding-left: 21px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        
                        </form>
                        
                    </td>
                </tr>          
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Всички лекари(<?php echo $list11->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <?php
                    if($_POST){
                        $keyword=$_POST["search"];
                        
                        $sqlmain= "SELECT * FROM doctor WHERE doctor_email='$keyword' or doctor_name ='$keyword' or doctor_name  like '$keyword%' or doctor_name  like '%$keyword' or doctor_name  like '%$keyword%'";
                    }else{
                        $sqlmain= "SELECT * FROM doctor order by doctor_id desc";

                    }
                ?>                
                <tr>
                   <td colspan="4">
                       <center>
                        <div class="abc scroll">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                                <th class="table-headin">                        
                                        Лекар                         
                                </th>
                                <th class="table-headin">
                                        Е-майл
                                </th>
                                <th class="table-headin">                         
                                        Специалности                   
                                </th>
                                <th class="table-headin">                          
                                        Опции        
                                </tr>
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
                                    <p class="heading-main12" style="margin-left: 25px;font-size:20px;color:rgb(49, 49, 49)">Системата не намери вашето търсене!</p>
                                    </center>
                                    <br><br><br><br>
                                    </td>
                                    </tr>';
                                    
                                }
                                else{
                                for ( $x=0; $x<$result->num_rows;$x++){
                                    $row=$result->fetch_assoc();
                                    $doctor_id=$row["doctor_id"];
                                    $name=$row["doctor_name"];
                                    $email=$row["doctor_email"];
                                    $spe=$row["specialties"];
                                    $spcil_res= $database->query("SELECT specialty_name FROM specialties WHERE specialty_id='$spe'");
                                    $spcil_array= $spcil_res->fetch_assoc();
                                    $spcil_name=$spcil_array["specialty_name"];
                                    echo '<tr>
                                        <td style="text-align:center"> &nbsp;'.
                                        substr($name,0,100)
                                        .'</td>
                                        <td style="text-align:center">
                                        '.substr($email,0,50).'
                                        </td>
                                        <td style="text-align:center">
                                            '.substr($spcil_name,0,80).'
                                        </td>

                                        <td style="text-align:center">
                                        <div style="display:flex;justify-content: center;">
                                        
                                        <a href="?action=view&id='.$doctor_id.'" class="non-style-link"><button  class="btn-primary-soft btn"  style="padding-left: 20px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Преглед</font></button></a>
                                       &nbsp;&nbsp;&nbsp;
                                       <a href="?action=session&id='.$doctor_id.'&name='.$name.'"  class="non-style-link"><button  class="btn-primary-soft btn button-icon"  style="padding-left: 20px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Сесии</font></button></a>
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
        
        if($action=='view'){
            $sqlmain = "SELECT * FROM doctor WHERE doctor_id=?";
            $stmt = $database->prepare($sqlmain);
            $stmt->bind_param("i",$id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $name=$row["doctor_name"];
            $email=$row["doctor_email"];
            $spe=$row["specialties"];
            
            $stmt = $database->prepare("SELECT specialty_name FROM specialties WHERE specialty_id=?");
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
                                    <label for="spec" class="form-label">Специалости: </label>
                                    
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
        }elseif($action=='session'){
            $name=$_GET["name"];
            echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                        <h2 style=font-size:30px>Препращане към лекарските сесии</h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div class="content" style="font-size:22px">
                            Искате да видите всички сесии от <br>'.substr($name,0,40).'?                            
                        </div>
                        <form action="schedule.php" method="post" style="display: flex">
                                <input type="hidden" name="search" value="'.$name.'">                            
                        <div style="display: flex;justify-content:center;margin-left:45%;margin-top:6%;;margin-bottom:6%;">                       
                        <input type="submit"  value="Да" class="btn-primary btn"   >        
                        </div>
                    </center>
            </div>
            </div>
            ';
        }
    }
?>
    <script>
        function show() {
    document.querySelector('.hamburger').classList.toggle('open');
    document.querySelector('.navigation').classList.toggle('active');
}
    </script>
</div>
</body>
</html>