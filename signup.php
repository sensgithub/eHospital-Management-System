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
    <link rel="stylesheet" href="css/register.css"> 
    <link rel="stylesheet" href="assets/vendor/animate/animate.css">
        
    <title> eHospital | Регистрация </title>
    
</head>
<body style="margin: 30px 0 0">
<?php

session_start();

$_SESSION["user"]="";
$_SESSION["usertype"]="";

date_default_timezone_set('Europe/Sofia');
$date = date('d.M.Y');

$_SESSION["date"]=$date;

include("connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $egn = $_POST['egn'];

    $check_egn_query = "SELECT patient_egn FROM patient WHERE patient_egn = ? LIMIT 1";
    $stmt = mysqli_prepare($database, $check_egn_query);
    mysqli_stmt_bind_param($stmt, "s", $egn); 
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $egn_exists = mysqli_stmt_num_rows($stmt) > 0;
    mysqli_stmt_close($stmt);

    if ($egn_exists) {
        $_SESSION['status'] = "Вече съществуващо ЕГН!";
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
            alertBox.innerHTML = "Вече съществуващо ЕГН!";
            document.body.appendChild(alertBox);
            setTimeout(function() {
                document.body.removeChild(alertBox);
            }, 3000);
            setTimeout(function() {
                window.location="signup.php";
            }, 3000);
        </script>';
        exit();
    }
}

if($_POST)
{
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
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <td class="label-td" colspan="2">
                    <label for="name" class="form-label">Име: </label>
                </td>
                <?php
                // Валидация на възраст
                if (isset($_POST['dob'])) {
                $dob = new DateTime($_POST['dob']);
                $today = new DateTime();
                $age = $today->diff($dob)->y;
                if ($age < 18) {
                echo '<script>alert("Трябва да сте на 18, за да се регистрирате в системата.");</script>';
                }
                }  
                ?>
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
</body>
</html>