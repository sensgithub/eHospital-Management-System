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
    <title>eHospital | Admin | Doctors </title>
</head>
<body>
    <?php
    session_start();
    setlocale(LC_ALL, 'bg_BG.utf8'); 

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../login.php");
        }

    }else{
        header("location: ../login.php");
    }
    
    include("../connection.php");

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
        <div class="dash-body">
            <table border="0" width="100%" style=" border-spacing: 0;margin:0;padding:0;margin-top:25px; ">
                <tr >
                    <td width="13%">
                    <a href="javascript:history.go(-1)"><button class="login-btn btn-primary-soft btn" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">Назад</button></a>
                    </td>
                    <td>
                        
                        <form action="" method="post" class="header-search">

                            <input type="search" name="search" class="input-text header-searchbar" placeholder="Търсене на доктори или емайл" list="doctors">&nbsp;&nbsp;
                            
                            <?php
                                echo '<datalist id="doctors">';
                                $list11 = $database->query("SELECT  doctor_name, doctor_email FROM  doctor;");

                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $d=$row00["doctor_name"];
                                    $c=$row00["doctor_email"];
                                    echo "<option value='$d'><br/>";
                                    echo "<option value='$c'><br/>";
                                };

                            echo ' </datalist>';
                        ?>
                            <input type="Submit" value="Търсене" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">
                        
                        </form>
                        
                    </td>
                    <td width="15%">
                        <p class="heading-sub12" style="padding: 0;margin: 0; padding-right: 82px">
                        <?php 
                        date_default_timezone_set('Europe/Sofia');
                        $date = date('d.m.Y');
                        ?>
                        </p>
                    </td> 
                <tr>
                    <td colspan="2" style="padding-top:30px; padding-left:50px">
                        <p class="heading-main12" style="font-size:20px;color:rgb(49, 49, 49)">Добавяне на доктор</p> 
                        <a href="?action=add&id=none&error=0" class="non-style-link"> 
                       <button  class="login-btn btn-primary btn button-icon" style="display: flex; justify-content: center; align-items: center; margin-right:75px; background-image: url('../img/icons/add.svg');">Добавяне</font>
                       </button>
                    </a>
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-top:10px;">
                        <p class="heading-main12" style="margin-left: 45px;font-size:18px;color:rgb(49, 49, 49)">Всички доктори (<?php echo $list11->num_rows; ?>)</p>
                    </td>
                    
                </tr>
                <?php
                    if($_POST){
                        $keyword=$_POST["search"];
                        
                        $sqlmain= "SELECT * FROM doctor WHERE doctor_email='$keyword' or doctor_name='$keyword' or doctor_name like '$keyword%' or doctor_name like '%$keyword' or doctor_name like '%$keyword%'";
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
                                <th class="table-headin"> Име на лекар </th>
                                <th class="table-headin"> Емайл </th>
                                <th class="table-headin">  Специалности </th>
                                <th class="table-headin">  Опциии </tr>
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
                                    <p class="heading-main12" style="margin-left: 45px;font-size:20px;color:rgb(49, 49, 49)">We  couldnt find anything related to your keywords !</p>
                                    <a class="non-style-link" href="doctors.php">
                                    <button  class="login-btn btn-primary-soft btn" style="display: flex;justify-content: center;align-items: center;margin-left:20px;"
                                    >&nbsp; Покажи всички доктори &nbsp;</font></button>
                                    </a>
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
                                        <td> &nbsp;'.
                                        substr($name,0,50)
                                        .'</td>
                                        <td>
                                        '.substr($email,0,50).'
                                        </td>
                                        <td>
                                            '.substr($spcil_name,0,50).'
                                        </td>
                                        <td>
                                        <div style="display:flex;justify-content: center;">
                                        <a href="?action=edit&id='.$doctor_id.'&error=0" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-edit"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Редактиране</font></button></a>
                                        &nbsp;&nbsp;&nbsp;
                                       <a href="?action=drop&id='.$doctor_id.'&name='.$name.'" class="non-style-link"><button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 40px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">Изтрий</font></button></a>
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
                        <h2>Сигурни ли сте?</h2>
                        <a class="close" href="doctors.php">&times;</a>
                        <div class="content">
                            Искате ли да изтриете този запис? <br>('.substr($nameget,0,40).').                    
                        </div>
                        <div style="display: flex;justify-content: center;">
                        <a href="delete-doctor.php?id='.$id.'" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"<font class="tn-in-text">&nbsp;Да&nbsp;</font></button></a>&nbsp;&nbsp;&nbsp;
                        <a href="doctors.php" class="non-style-link"><button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;"><font class="tn-in-text">&nbsp;&nbsp;Не&nbsp;&nbsp;</font></button></a>
                        </div>
                    </center>
            </div>
            </div>
            ';
        }elseif($action=='add'){
                $error_1=$_GET["error"];
                $errorlist= array(
                    '1'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Вече съществуващ е-майл адрес. Опитайте отново. </label>',
                    '2'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Несъвпадаща парола. Опитайте отново. </label>',
                    '3'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
                    '4'=>"",
                    '0'=>'',

                );
                if($error_1!='4'){
                echo '
            <div id="popup1" class="overlay">
                    <div class="popup">
                    <center>
                    
                        <a class="close" href="doctors.php">&times;</a> 
                        <div style="display: flex;justify-content: center;">
                        <div class="abc">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                        <tr>
                                <td class="label-td" colspan="2">'.
                                    $errorlist[$error_1]
                                .'</td>
                            </tr>
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Добавяне на нов доктор.</p><br><br>
                                </td>
                            </tr>
                            
                            <tr>
                                <form action="add-new.php" method="POST" class="add-new-form">
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="text" name="name" class="input-text" placeholder="Име на лекар" required><br>
                                </td>
                                
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="email" name="email" class="input-text" placeholder="Е-майл адрес" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Телефон: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="tel" name="Tele" class="input-text" placeholder="Телефонен номер" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Специалности: </label>
                                    
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <SELECT name="spec" id="" class="box" >';
                                        
        
                                        $list11 = $database->query("SELECT * FROM specialties ORDER BY specialty_name ASC;");
        
                                        for ($y=0;$y<$list11->num_rows;$y++){
                                            $row00=$list11->fetch_assoc();
                                            $sn=$row00["specialty_name"];
                                            $id00=$row00["id"];
                                            echo "<option value=".$id00.">$sn</option><br/>";
                                        };
                                        
                        echo     '       </SELECT><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="password" class="form-label">Парола: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="password" class="input-text" placeholder="Задайте парола" required><br>
                                </td>
                            </tr><tr>
                                <td class="label-td" colspan="2">
                                    <label for="cpassword" class="form-label">Потвъждение на парола: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <input type="password" name="cpassword" class="input-text" placeholder="Въведете паролата отново" required><br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <input type="reset" value="Изчистване" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                    <input type="submit" value="Добавяне" class="login-btn btn-primary btn">
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

            }else{
                echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                            <br><br><br><br>
                                <h2>Нов запис успешно добавен!</h2>
                                <a class="close" href="doctors.php">&times;</a>
                                <div class="content">                        
                                </div>
                                <div style="display: flex;justify-content: center;">    
                                <a href="doctors.php" class="non-style-link">
                                <button  class="btn-primary btn"  style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">
                                <font class="tn-in-text">&nbsp;&nbsp;ОК&nbsp;&nbsp;
                                </font>
                                </button>
                                </a>
                                </div>
                                <br><br>
                            </center>
                    </div>
                    </div>
        ';
            }
        }elseif($action=='edit'){
            $sqlmain= "SELECT * FROM doctor WHERE doctor_id='$id'";
            $result= $database->query($sqlmain);
            $row=$result->fetch_assoc();
            $name=$row["doctor_name"];
            $email=$row["doctor_email"];
            $spe=$row["specialties"];
            
            $spcil_res= $database->query("SELECT specialty_name FROM specialties WHERE specialty_id='$spe'");
            $spcil_array= $spcil_res->fetch_assoc();
            $spcil_name=$spcil_array["specialty_name"];
            $nic=$row['doctor_nickname'];
            $tele=$row['doctor_tel'];

            $error_1=$_GET["error"];
                $errorlist= array(
                    '1'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Вече съществуващ е-майл адрес. Опитайте отново. </label>',
                    '2'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Несъвпадаща парола. </label>',
                    '3'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"> </label>',
                    '4'=>"",
                    '0'=>'',

                );

            if($error_1!='4'){
                    echo '
                    <div id="popup1" class="overlay">
                            <div class="popup">
                            <center>
                                <a class="close" href="doctors.php">&times;</a> 
                                <div style="display: flex;justify-content: center;">
                                <div class="abc">
                                <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                        <td class="label-td" colspan="2">'.
                                            $errorlist[$error_1]
                                        .'</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Редактиране на детайли на лекар.</p>
                                        <br>
                                        <br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <form action="edit-doc.php" method="POST" class="add-new-form">
                                            <label for="Email" class="form-label">Email: </label>
                                            <input type="hidden" value="'.$id.'" name="id00">
                                            <input type="hidden" name="oldemail" value="'.$email.'" >
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                        <input type="email" name="email" class="input-text" placeholder="Е-майл:" value="'.$email.'" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        
                                        <td class="label-td" colspan="2">
                                            <label for="name" class="form-label">Име: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="text" name="name" class="input-text" placeholder="Име на лекар:" value="'.$name.'" required><br>
                                        </td>
                                        
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="Tele" class="form-label">Телефон: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="tel" name="Tele" class="input-text" placeholder="Телефонен номер" value="'.$tele.'" required><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="spec" class="form-label">Изберете специалности: (Текущи'.$spcil_name.')</label>
                                            
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <SELECT name="spec" id="" class="box">';
                                                
                
                                                $list11 = $database->query("SELECT * FROM specialties;");
                
                                                for ($y=0;$y<$list11->num_rows;$y++){
                                                    $row00=$list11->fetch_assoc();
                                                    $sn=$row00["specialty_name"];
                                                    $id00=$row00["id"];
                                                    echo "<option value=".$id00.">$sn</option><br/>";
                                                };               
                                echo     '       </SELECT><br><br>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <label for="password" class="form-label">Парола: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="password" class="input-text" placeholder="Задайте парола" required><br>
                                        </td>
                                    </tr><tr>
                                        <td class="label-td" colspan="2">
                                            <label for="cpassword" class="form-label">Парола: </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="label-td" colspan="2">
                                            <input type="password" name="cpassword" class="input-text" placeholder="Потвърдете паролата" required><br>
                                        </td>
                                    </tr>                
                                    <tr>
                                        <td colspan="2">
                                            <input type="reset" value="Изчистване" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <input type="submit" value="Запазване" class="login-btn btn-primary btn">
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
        }else{
            echo '
                <div id="popup1" class="overlay">
                        <div class="popup">
                        <center>
                        <br><br><br><br>
                            <h2>Успешно променен!</h2>
                            <a class="close" href="doctors.php">&times;</a>
                            <div class="content">           
                            </div>
                            <div style="display: flex;justify-content: center;">         
                            <a href="doctors.php" class="non-style-link">
                            <button  class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">
                            <font class="tn-in-text">&nbsp;&nbsp;OK&nbsp;&nbsp;
                            </font>
                            </button>
                            </a>
                            </div>
                            <br><br>
                        </center>
                </div>
                </div>
    ';



        }; };
    };

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