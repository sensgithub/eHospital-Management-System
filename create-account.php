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

$_SESSION["user"]="";
$_SESSION["usertype"]="";

date_default_timezone_set('Europe/Sofia');
$date = date('d.m.Y');

$_SESSION["date"]=$date;

include("connection.php");


if($_POST){

    $result= $database->query("select * from webuser");

    $fname=$_SESSION['personal']['fname'];
    $lname=$_SESSION['personal']['lname'];
    $name=$fname." ".$lname;
    $city=$_SESSION['personal']['city'];
    $egn=$_SESSION['personal']['egn'];
    $dob=$_SESSION['personal']['dob'];
    /*
    $email=$_POST['newemail'];
    $tele=$_POST['tele'];
    $newpassword=$_POST['newpassword'];
    $cpassword=$_POST['cpassword'];
    */
    $email = filter_var($_POST['newemail'], FILTER_SANITIZE_EMAIL);
    $tele = filter_var($_POST['tele'], FILTER_SANITIZE_NUMBER_INT);
    $newpassword = filter_var($_POST['newpassword'], FILTER_SANITIZE_STRING);
    $cpassword = filter_var($_POST['cpassword'], FILTER_SANITIZE_STRING);
    
    if ($newpassword==$cpassword){
        /* $sqlmain= "select * from webuser where email=?;";
        $stmt = $database->prepare($sqlmain);
        $stmt->bind_param("s",$email);
        $stmt->execute();
        */
        $stmt = $database->prepare("SELECT * FROM webuser WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows==1){
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Вече има регистриран акаунт с този е-майл адрес.</label>';
        }else{

            $database->query("INSERT INTO patient(patient_email,patient_name,patient_password, patient_city, patient_egn,patient_dob,patient_tel) VALUES('$email','$name','$newpassword','$city','$egn','$dob','$tele');");
            $database->query("INSERT INTO webuser VALUES('$email','p')");
            $_SESSION["user"]=$email;
            $_SESSION["usertype"]="p";
            $_SESSION["username"]=$fname;

            header('Location: patient/index.php');
            $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>';
        }
        
    }else{
        $error='<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Несъвпадащи пароли. Моля въведете отново.</label>';
    }
    
}else{
    $error='<label for="promter" class="form-label"></label>';
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
                    <label for="newemail" class="form-label">Е-майл: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="email" name="newemail" class="input-text" placeholder="Въведете вашия е-майл" required>
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
                    <label for="newpassword" class="form-label">Създаване на парола: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="password" name="newpassword" class="input-text" placeholder="Въведете вашата парола" required>
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
                <td colspan="2">
                    <?php echo $error ?>
                </td>
            </tr>      
            <tr>
                <td>
                    <input type="reset" value="Изчистване на полетата" class="login-btn btn-primary-soft btn" style="color:white" >
                </td>
                <td>
                    <input type="submit" value="Регистрация" class="login-btn btn-primary btn">
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