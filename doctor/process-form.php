<?php
    session_start();
    if (isset($_SESSION["user"]) && !empty($_SESSION["user"]) && $_SESSION['usertype'] == 'd') {
        include("../connection.php");
        $useremail = $_SESSION["user"];
        $userrow = $database->query("SELECT * FROM doctor WHERE doctor_email='$useremail'");
        $userfetch = $userrow->fetch_assoc();
        $userid = $userfetch["doctor_id"];
        $username = $userfetch["doctor_name"];
    } else {
        echo '<script>window.location.href = "../login.php";</script>';
        exit();
    }
?>
<?php
    include '../connection.php';

    // Retrieve the doctor ID from the session
    $doctorId = $_SESSION['doctor_id'];

    if (isset($_POST['submit'])) 
    {
        $patientName = $_POST['patient_id'];
        $diagnosisName = $_POST['diagnosis_id'];
        $medicationName = $_POST['medication_id'];
        $prescriptionDate = $_POST['prescription_date'];

        // Get the patient, diagnosis, and medication IDs based on their names
        $patientQuery = "SELECT patient_id FROM patient WHERE patient_name='$patientName'";
        $diagnosisQuery = "SELECT diagnosis_id FROM diagnoses WHERE diagnosis_name='$diagnosisName'";
        $medicationQuery = "SELECT medication_id FROM medications WHERE medication_name='$medicationName'";

        $patientResult = mysqli_query($database, $patientQuery);
        $diagnosisResult = mysqli_query($database, $diagnosisQuery);
        $medicationResult = mysqli_query($database, $medicationQuery);

        if ($patientResult && $diagnosisResult && $medicationResult) 
        {
            $patientId = mysqli_fetch_assoc($patientResult)['patient_id'];
            $diagnosisId = mysqli_fetch_assoc($diagnosisResult)['diagnosis_id'];
            $medicationId = mysqli_fetch_assoc($medicationResult)['medication_id'];

            // Add prescription to the database
            $sql = "INSERT INTO prescriptions (patient_id, diagnosis_id, medication_id, prescription_date, doctor_id) VALUES ('$patientId', '$diagnosisId', '$medicationId', '$prescriptionDate', '$doctorId')";
            if ($database->query($sql)) {
                echo '<div style="display:flex;justify-content: center;align-items: center;width: 100%;height: 50px;background-color: #4CAF50;color: white;font-size: 20px;"><strong> Успешно добавен!</strong> Вашета рецепта бе успешно записана! </div>';
            } else {
                echo "Error: " . mysqli_error($database);
            }
        }
    }
?>