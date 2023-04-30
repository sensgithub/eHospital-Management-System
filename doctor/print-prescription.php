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

// reference the Dompdf namespace
use Dompdf\Dompdf;
use Dompdf\Options;

define("DOMPDF_DEFAULT_CHARSET", "UTF-8");
require '../vendor/dompdf/dompdf/autoload.inc.php';

// instantiate and use the dompdf class
$dompdf = new Dompdf();
$html = '<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <title>Prescription Report</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }
            body {
                font-family: DejaVu Sans, sans-serif;
            }
            th, td {
                text-align: left;
                padding: 8px;
            }
            th {
                background-color: #008CBA;
                color: white;
            }
            .ehos {
                font-size: 45px;
                margin-left: 420px;
            }
            tr:nth-child(even) {background-color: #f2f2f2}
        </style>
    </head>
    <body>
        <div class="ehos"> 
        <h style="text-align: center"> eHospital </h>
        </div>
        
        <div>
        <h1> Лекарско предписание </h1>
        <table>
            <thead>
                <tr>
                    <th>Пациент</th>
                    <th>Диагноза</th>
                    <th>Медикамент</th>
                    <th>Дата</th>
                    <th>Лекар</th>
                </tr>
            </thead>
            <tbody>
        </div>
        </div>';

// Fetch the required data from the database
    $query = "SELECT p.prescription_id, d.doctor_name, pt.patient_name, m.medication_name, dgn.diagnosis_name, p.prescription_date
        FROM prescriptions p
        INNER JOIN doctor d ON p.doctor_id = d.doctor_id
        INNER JOIN patient pt ON p.patient_id = pt.patient_id
        INNER JOIN medications m ON p.medication_id = m.medication_id
        INNER JOIN diagnoses dgn ON p.diagnosis_id = dgn.diagnosis_id
        WHERE p.doctor_id=$userid;";

$result = $database->query($query);
while($row = $result->fetch_assoc()) {
    $html .= '<tr>
                <td>'.$row["patient_name"].'</td>
                <td>'.$row["diagnosis_name"].'</td>
                <td>'.$row["medication_name"].'</td>
                <td>'.$row["prescription_date"].'</td>
                <td>'.$row["doctor_name"].'</td>
            </tr>';
}
$html .= '</tbody></table>';

// Load HTML to Dompdf
$dompdf->loadHtml($html);

$options = new Options();
$options->set('defaultFont', 'DejaVu Sans');

// Set the options
$dompdf->setOptions($options);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Define the file name
$filename = 'рецепта.pdf';

// Output the generated PDF to Browser
$dompdf->stream($filename);

?>