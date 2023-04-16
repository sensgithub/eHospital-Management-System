<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
        
    <title> eHospital | Регистрация </title>
    <style>
        .container{
            animation: transitionIn-X 0.5s;
        }
    </style>
</head>
<body>
<?php

session_start();

include("connection.php");
require 'vendor/autoload.php';

$_SESSION["user"]="";
$_SESSION["usertype"]="";

date_default_timezone_set('Europe/Sofia');
$date = date('d.m.Y');

$_SESSION["date"]=$date;

if($_POST){

    $result= $database->query("select * from webuser");

    $fname=$_SESSION['personal']['fname'];
    $lname=$_SESSION['personal']['lname'];
    $name=$fname." ".$lname;
    $city=$_SESSION['personal']['city'];
    $egn=$_SESSION['personal']['egn'];
    $dob=$_SESSION['personal']['dob'];

    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $tele = filter_var($_POST['tele'], FILTER_SANITIZE_NUMBER_INT);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
    $cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);

    $email = mysqli_real_escape_string($database, $email);

    $check_email_query = "SELECT patient_email from patient WHERE patient_email=? LIMIT 1";
    $stmt = mysqli_prepare($database, $check_email_query);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $email_exists = mysqli_stmt_num_rows($stmt) > 0;
    mysqli_stmt_close($stmt);

    if ($email_exists) {
        $_SESSION['status'] = "Е-майлът вече е добавен в системата!";
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
            alertBox.innerHTML = "Е-майлът вече е добавен в системата!";
            document.body.appendChild(alertBox);
            setTimeout(function() {
                document.body.removeChild(alertBox);
            }, 3000);
            setTimeout(function() {
                window.location="create-account.php";
            }, 3000);
        </script>';
        exit();
    }
    else
    {
        $query = "INSERT INTO patient (patient_email, patient_name, patient_city, patient_egn, patient_dob, patient_tel) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($database, $query);
        mysqli_stmt_bind_param($stmt, "sssssss", $email, $name, $city, $egn, $dob, $tele);
        $query_run = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        
        $query2 = "INSERT INTO webuser (email, usertype) VALUES (?, ?)";
        $stmt2 = mysqli_prepare($database, $query2);
        $usertype = 'p';
        mysqli_stmt_bind_param($stmt2, "ss", $email, $usertype);
        $query_run2 = mysqli_stmt_execute($stmt2);
        mysqli_stmt_close($stmt2);
        
        

        if($query_run)
        {
            echo '<script>
            var alertBox = document.createElement("div");
            alertBox.style.position = "fixed";
            alertBox.style.top = "30%";
            alertBox.style.left = "50%";
            alertBox.style.fontSize = "36px"; // increased font size to 36px
            alertBox.style.transform = "translate(-50%, -50%)";
            alertBox.style.padding = "30px"; // increased padding to 30px
            alertBox.style.background = "white";
            alertBox.style.color = "black";
            alertBox.style.border = "1px solid cyan";
            alertBox.style.borderRadius = "5px";
            alertBox.style.textAlign = "center";
            alertBox.style.fontFamily = "Arial, sans-serif";
            alertBox.innerHTML = "Успешна регистрация в eHospital!";
            document.body.appendChild(alertBox);
            setTimeout(function() {
                document.body.removeChild(alertBox);
                window.location="login.php";
            }, 3000);
        </script>';
        }
        else
        {
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
                    alertBox.innerHTML = "Неуспешна регистрация, моля опитайте отново.";
                    document.body.appendChild(alertBox);
                    setTimeout(function() {
                        document.body.removeChild(alertBox);
                        window.location="signup.php";
                    }, 3000);
                  </script>';
        }
    }
}

?>
    <center>
    <div class="container">
        <table border="0" style="width: 69%;">
            <tr>
                <td colspan="2">
                    <p class="header-text">Регистрация в eHospital</p>
                    <p class="sub-text">Моля, въведете допълнителните данни, за да създадете вашия акаунт. </p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td" colspan="2">
                    <label for="email" class="form-label">Е-майл: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="email" name="email" class="input-text" placeholder="Въведете вашия е-майл" required>
                </td>
                
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="tele" class="form-label">Телефон: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="tel" name="tele" class="input-text"  placeholder="ex: 0884159887" pattern="[0]{1}[0-9]{9}" >
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="password" class="form-label">Създаване на парола: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="password" name="password" class="input-text" placeholder="Въведете вашата парола" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="cpassword" class="form-label">Потвърждаване на паролата: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="password" name="cpassword" class="input-text" placeholder="Потвърдете вашата парола" required>
                </td>
            </tr>     
            <tr>
                <td>
                    <input type="reset" value="Изчистване на полетата" class="login-btn btn-primary-soft btn" style="color:white" >
                </td>
                <td>
                    <input type="submit" value="Регистрация" class="login-btn btn-primary btn" name="register_btn">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Вече имате акаунт&#63; </label>
                    <a href="login.php" class="hover-link1 non-style-link">Логнете се</a>
                    <br><br><br>
                </td>
            </tr>
        </form>
        </tr>
    </table>
</div>
</center>
</body>
</html>