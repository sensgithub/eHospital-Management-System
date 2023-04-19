<?php
include('../connection.php');
function generateRow($patientName, $diagnosisName, $medicationName) 
{
    global $database;
    $contents = '';
    $sql =  "SELECT patient_name, patient_email, patient_city, patient_egn, patient_tel FROM patient WHERE patient_name='$patientName'";
    $sql2 = "SELECT diagnosis_name FROM diagnoses WHERE diagnosis_name='$diagnosisName'";
    $sql3 = "SELECT medication_name FROM medications WHERE medication_name='$medicationName'";

    $query = $database->query($sql);
    while($row = $query->fetch_assoc())
    {
        $contents .= "
        <tr>
            <td>".$row['patient_name']."</td>
            <td>".$row['patient_email']."</td>
            <td>".$row['patient_city']."</td>
            <td>".$row['patient_egn']."</td>
            <td>".$row['patient_tel']."</td>
        </tr>
        ";
    }
    $query = $database->query($sql2);
    while($row = $query->fetch_assoc())
    {
        $contents .= "
        <tr>
            <td>".$row['diagnosis_name']."</td>
        </tr>
        ";
    }
    $query = $database->query($sql3);
    while($row = $query->fetch_assoc())
    {
        $contents .= "
        <tr>
            <td>".$row['medication_name']."</td>
        </tr>
        ";
    }
    return $contents;
}

?>