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

    $sqlmain= "SELECT * FROM patient WHERE patient_email=?";
    $stmt = $database->prepare($sqlmain);
    $stmt->bind_param("s",$useremail);
    $stmt->execute();
    $userrow = $stmt->get_result();
    $userfetch=$userrow->fetch_assoc();

    $userid= $userfetch["patient_id"];
    $username=$userfetch["patient_name"];

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
    <link rel="stylesheet" href="../css/mobi.css">
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <title> eHospital| Patient| Dashboard </title>
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
                        <div class="abc scroll" style="padding: 30px 50px 10px">
                        <table width="93%" class="sub-table scrolldown" border="0">
                        <thead>
                        <tr>
                                <th class="table-headin">                        
                                        Диагноза                        
                                </th>
                                <th class="table-headin">
                                        Медикамент
                                </th>
                                <th class="table-headin">                         
                                        Дата                  
                                </th>
                                <th class="table-headin">                         
                                        Доктор                  
                                </th>
                                <th class="table-headin">                         
                                        Рецепта                  
                                </th>
                        </thead>
                        <tbody>
                                    <?php
                                    $query = "SELECT * FROM prescriptions WHERE patient_id = '$userid'";
                                    $result = $database->query($query);
                                    
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $prescription_id=$row["prescription_id"];
                                            $diagnosis_id = $row['diagnosis_id'];
                                            $medication_id = $row['medication_id'];
                                            $prescription_date = $row['prescription_date'];
                                            $doctor_id = $row['doctor_id'];

                                            $medication_query = "SELECT * FROM medications WHERE medication_id = '$medication_id'";
                                            $medication_result = $database->query($medication_query);
                                            $medication_row = $medication_result->fetch_assoc();
                                            $medication_name = $medication_row['medication_name'];
                                    
                                            $diagnosis_query = "SELECT * FROM diagnoses WHERE diagnosis_id = '$diagnosis_id'";
                                            $diagnosis_result = $database->query($diagnosis_query);
                                            $diagnosis_row = $diagnosis_result->fetch_assoc();
                                            $diagnosis_name = $diagnosis_row['diagnosis_name'];
                                    
                                            $doctor_query = "SELECT * FROM doctor WHERE doctor_id = '$doctor_id'";
                                            $doctor_result = $database->query($doctor_query);
                                            $doctor_row = $doctor_result->fetch_assoc();
                                            $doctor_name = $doctor_row['doctor_name'];

                                            echo '<tr>';
                                            echo '<td style="text-align: center; font-size:18px">' . $diagnosis_name . '</td>';
                                            echo '<td style="text-align: center; font-size:18px">' . $medication_name . '</td>';
                                            echo '<td style="text-align: center; font-size:18px">' . $prescription_date . '</td>';
                                            echo '<td style="text-align: center; font-size:18px">' . $doctor_name . '</td>';
                                            echo '<td style="text-align: center; font-size:18px"> <a href="print-prescription.php?prescription_id='.$prescription_id.'" class="non-style-link"> <button  class="btn-primary-soft btn button-icon btn-delete"  style="padding-left: 20px;padding-top: 12px;padding-bottom: 12px;margin-top: 10px;"><font class="tn-in-text">PDF </font> </button> </a>
                                            </button> 
                                           </a> </td>';
                                            echo '</tr>';
                                        }
                                    } else {
                                        echo '<tr><td colspan="4" style="text-align: center; font-size: 18px; padding: 30px 20px 50px;";"> Нямате текущи лекарски предписания.</td></tr>';
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
    <script>
        function show() {
    document.querySelector('.hamburger').classList.toggle('open');
    document.querySelector('.navigation').classList.toggle('active');
    }
    </script>
</body>
</html>