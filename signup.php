<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css"> 
    <link rel="stylesheet" href="css/login.css">   
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">  
    <link rel="stylesheet" href="assets/vendor/animate/animate.css">
        
    <title> eHospital | Регистрация </title>
    
</head>
<body style="margin: 30px 0 0">
<?php

session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";

date_default_timezone_set('Europe/Sofia');
$date = date('d.M.YYYY');

$_SESSION["date"]=$date;

if($_POST){

    $_SESSION["personal"]=array(
        'fname'=>$_POST['fname'],
        'lname'=>$_POST['lname'],
        'city'=>$_POST['city'],
        'egn'=>$_POST['egn'],
        'dob'=>$_POST['dob']
    );
    print_r($_SESSION["personal"]);
    header("location: create-account.php");
}

?>
    <center>
    <div class="container">
        <table border="0">
            <tr>
                <td colspan="2">
                    <p class="header-text">Регистрация в eHospital</p>
                    <p class="sub-text">Благодарим Ви, че искате да станете наш потребител! <br> Моля въведете вашите данни, за да продължите. </p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td" colspan="2">
                    <label for="name" class="form-label">Име: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="text" name="fname" class="input-text" placeholder="Лично име" required>
                </td>
                <td class="label-td">
                    <input type="text" name="lname" class="input-text" placeholder="Фамилно име" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="city" class="form-label">Град: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="text" name="city" class="input-text" placeholder="Въведете населено място" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="egn" class="form-label">ЕГН: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                     <input type="text" name="egn" id="egn" class="input-text" placeholder="Въведете вашето ЕГН" required pattern="[0-9]{10}" title="Моля, въведете 10-цифренo ЕГН." oninput="checkUniqueEGN(this)">
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <label for="dob" class="form-label">Дата на раждане: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                    <input type="date" name="dob" class="input-text" required>
                </td>
            </tr>
            <tr>
                <td class="label-td" colspan="2">
                </td>
            </tr>

            <tr>
                <td>
                    <input type="reset" value="Изчистване" class="login-btn btn-primary-soft btn" style="background-color: #57B0BE; border: #57B0BE; color:white; padding-left: 10px">
                </td>
                <td>
                    <input type="submit" value="Напред" class="login-btn btn-primary btn">
                </td>

            </tr>
            <tr>
                <td colspan="2">
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Вече имате акаунт&#63; </label>
                    <a href="login.php" class="hover-link1 non-style-link">Натиснете тук.</a>
                    <br><br><br>
                </td>
            </tr>
           </form>
        </tr>
        </table>
    </div>
</center>
<style>
    .login-btn.btn-primary.btn{
        width:60%;
    }
    .login-btn.btn-primary-soft.btn{
        width:80%;
    }
@media only screen and (max-width: 768px) {
    .container {
        width:90%;
        min-width: 280px;
        padding: 20px;
        font-size: 14px;
    }
    .header-text {
        font-size: 24px;
    }
    .sub-text {
        font-size: 16px;
    }
    .form-label {
        font-size: 16px;
    }
    .input-text {
        padding: 8px;
        font-size: 16px;
    }
    .login-btn {
        font-size: 16px;
    }
    .login-btn.btn-primary.btn{
        width:70%;
    }
    .login-btn.btn-primary-soft.btn{
        width:75%;
    }
}

    </style>
</body>
</html>