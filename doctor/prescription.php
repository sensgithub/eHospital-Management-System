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
        
    <title>eHospital | Prescriptions </title>

</head>
<body>
    <?php

    ob_start();
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
                <tr>
                    <td width="13%" >
                    <a href="javascript:history.go(-1)"><button class="login-btn btn-primary-soft btn" style="padding-top:11px;padding-bottom:11px;margin-left:20px;width:125px">Назад</button></a>
                    </td>
                    <td>                     
                        <form action="" method="post" class="header-search">
                        <?php       
                    if($_POST){

                        if(isset($_POST["search"])){
                            $keyword=$_POST["search"];   
                            $sqlmain= "SELECT * FROM patient WHERE patient_email='$keyword' 
                            or patient_name='$keyword' 
                            or patient_name like '$keyword%' 
                            or patient_name like '%$keyword'
                            or patient_name like '%$keyword%' ";
                        }
                    
                    } else{
                        $sqlmain= "SELECT * FROM appointment 
                        INNER JOIN patient on patient.patient_id=appointment.patient_id 
                        INNER JOIN schedule on schedule.schedule_id=appointment.schedule_id 
                        WHERE schedule.doctor_id=$userid;";
                    }

                ?>
                            <input type="search" name="search12" class="input-text header-searchbar" placeholder="Търсене на пациент (име/е-майл)" list="patient">&nbsp;&nbsp;
                            
                            <?php
                                echo '<datalist id="patient">';
                                $list11 = $database->query($sqlmain);
                                for ($y=0;$y<$list11->num_rows;$y++){
                                    $row00=$list11->fetch_assoc();
                                    $d=$row00["patient_name"];
                                    $c=$row00["patient_email"];
                                    echo "<option value='$d'><br/>";
                                    echo "<option value='$c'><br/>";
                                };

                            echo ' </datalist>';
                            ?>                                     
                            <input type="Submit" value="Търсене" name="search" class="login-btn btn-primary btn" style="padding-left: 25px;padding-right: 25px;padding-top: 10px;padding-bottom: 10px;">                        
                        </form>
                            </td>
                        </table>
<div>
  <form method="POST" action="process-form.php">
    <table width="100%" class="sub-table scrolldown" border="0" style="padding: 50px;border:none">
    <table class="filter-container" style="margin: 0 30px 10px">
      <tbody> 
        <tr>
          <td width="25%" style="font-size: 24px; padding: 30px 20px 10px">Пациент:</td>
          <td>
            <select name="patient_id" style="font-size: 18px;">
              <option value="">Изберете пациент</option>
              <?php
                $query = "SELECT patient_name FROM patient ORDER BY patient_name ASC";
                $result = mysqli_query($database, $query);
                while($row = mysqli_fetch_array($result)) {
                  echo '<option value="'. $row['patient_name'] . '">' . $row['patient_name'] . '</option>';
                }
              ?>
            </select>
          </td>
        </tr>
        <tr>
        <td width="25%" style="font-size: 24px; padding: 30px 20px 10px">Диагноза: </td>
          <td>
            <select name="diagnosis_id" style="font-size: 18px;">
              <option value="">Изберете диагноза</option>
              <?php
                $query = "SELECT diagnosis_name FROM diagnoses ORDER BY diagnosis_name ASC";
                $result = mysqli_query($database, $query);
                while($row = mysqli_fetch_array($result)) {
                  echo '<option value="'. $row['diagnosis_name'] . '">' . $row['diagnosis_name'] . '</option>';
                }
              ?>
            </select>
          </td>
        </tr>
        <tr>
        <td width="25%" style="font-size: 24px; padding: 30px 20px 10px"> Медикамент:</td>
          <td>
            <select name="medication_id" style="font-size: 18px;">
              <option value="">Изберете медикамент</option>
              <?php
                $query = "SELECT medication_name FROM medications ORDER BY medication_name ASC";
                $result = mysqli_query($database, $query);
                while($row = mysqli_fetch_array($result)) {
                  echo '<option value="' . $row['medication_name'] . '">' . $row['medication_name'] . '</option>';
                }
              ?>
            </select>
          </td>
        </tr>
        <tr>
        <td width="25%" style="font-size: 24px; padding: 30px 20px 10px"> Дата:</td>
          <td>
            <input type="date" name="prescription_date" style="font-size: 18px;">
          </td>
        </tr>
        <tr>
          <td colspan="2" style="padding-top:30px">
            <center>
              <input type="submit" name="submit" value="Задаване на рецепта" style="font-size: 18px; background-color: #57B0BE; color: white; border: none; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; margin: 4px 2px; cursor: pointer; border-radius:7px;">
              <input type="reset" value="Изчистване на полетата" style="font-size: 18px; background-color:#39d6d4; color: white; border: none; padding: 10px 20px; text-align: center; text-decoration: none; display: inline-block; margin: 4px 2px; cursor: pointer; border-radius:7px;">
            </center>
          </td>
        </tr>
    </tbody>
    </table>
  </table>
</form>
</div>
</body>
</html>