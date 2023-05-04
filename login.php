<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css"> 
    <link rel="stylesheet" href="css/login.css"> 
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="assets/vendor/animate/animate.css">
    <link rel="stylesheet" href="css/preloader.css">
    <title> eHospital | Логин </title>
</head>
<body>
    <?php
    session_start();
    $_SESSION["user"] = "";
    $_SESSION["usertype"] = ""; 
    date_default_timezone_set('Europe/Sofia');
    $date = date('d.m.Y');
    $_SESSION["date"] = $date;

    include("connection.php");

    if ($_POST) {
        $email = $_POST['useremail'];
        $password = $_POST['userpassword'];
        $error = '<label for="promter" class="form-label"></label>';

        $stmt = $database->prepare("SELECT * FROM webuser WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $utype = $result->fetch_assoc()['usertype'];

        if ($utype == 'p') {
            $stmt = $database->prepare("SELECT * FROM patient WHERE patient_email=? AND patient_password=?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $checker = $stmt->get_result();

            if ($checker->num_rows == 1) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'p';                 
                header('location: patient/index.php');
            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Невалиден е-майл или парола.</label>';
            }
        } elseif ($utype == 'a') {
            $stmt = $database->prepare("SELECT * FROM admin WHERE admin_email=? and admin_password=?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $checker = $stmt->get_result();

            if ($checker->num_rows == 1) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'a';   
                header('location: admin/index.php');
            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Невалиден е-майл или парола.</label>';
            }
        } elseif ($utype == 'd') {
            $stmt = $database->prepare("SELECT * FROM doctor WHERE doctor_email=? AND doctor_password=?");
            $stmt->bind_param("ss", $email, $password);
            $stmt->execute();
            $checker = $stmt->get_result();

            if ($checker->num_rows == 1) {
                $_SESSION['user'] = $email;
                $_SESSION['usertype'] = 'd';
                header('location: doctor/index.php');
            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Невалиден е-майл или парола.</label>';
            }
        }        
    } else {
        $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"Системата не намери акаунта за дадения е-майл.</label>';
    }
    }else{
        $error='<label for="promter" class="form-label">&nbsp;</label>';
    }
?>
    <center>
    <div id="preloader">
      <div id="loader"></div>
    </div>
    <div class="container">
        <table border="0" style="margin: 0;padding: 0;width: 60%;">
            <tr>
                <td>
                    <p class="header-text">Добре дошли!</p>
                </td>
            </tr>
        <div class="form-body">
            <tr>
                <td>
                    <p class="sub-text">Логнете се с вашите данни, за да продължите.</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                <td class="label-td">
                    <label for="useremail" class="form-label">Е-майл: </label>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <input type="email" name="useremail" class="input-text" placeholder="" required>
                </td>
            </tr>
            <tr>
                <td class="label-td">
                    <label for="userpassword" class="form-label">Парола: </label>
                </td>
            </tr>

            <tr>
                <td class="label-td">
                    <input type="Password" name="userpassword" class="input-text" placeholder="" required>
                </td>
            </tr>
            <tr>
                <td><br>
                <?php echo $error ?>
                </td>
            </tr>
            <tr>
                 <td>
                    <input type="submit" value="Вход" class="login-btn btn-primary btn" style="background-color: #64B9C5; border: #64B9C5; color:white;">
                </td>
                <tr>
                <td>
                    <input type="button" value="Назад" class="login-btn btn-primary-soft btn" onclick="window.location.href='index.html';" style="background-color: #57B0BE; border: #57B0BE; color:white; font-size:12px">
                    </a>
                </td>
            </tr>
            </tr>
            </tr>
        </div>
            <tr>
                <td>
                    <br>
                    <label for="" class="sub-text" style="font-weight: 280;">Забравили сте си паролата&#63; </label>
                    <a href="#" class="hover-link1 non-style-link">Кликнете тук</a>
                    <br><br><br>
                </td>
            </tr>                
        </form>
    </table>
</div>
</center>
<script src="js/loader.js"></script>
</body>
</html>