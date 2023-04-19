<?php
       ob_start(); 

       include_once('../connection.php');
       
       function generateRow() 
       {
           global $database;
           $contents = '';
           $sql =  "SELECT patient_name, patient_email, patient_city, patient_egn, patient_tel FROM patient";
           $sql2 = "SELECT diagnosis_name FROM diagnoses";
           $sql3 = "SELECT medication_name FROM medications";

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
       
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle("Generated PDF using TCPDF");  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();  
    $content = '';  
    $content .= 
    '
      	<h2 align="center">Generated PDF using TCPDF</h2>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
				<th width="20%">Име: </th>
				<th width="20%">Е-майл: </th>
				<th width="20%">Населено място: </th> 
                <th width="20%">ЕГН: </th>
                <th width="20%">Телефон: </th>  
           </tr>
           <tr>  
           <th> Диагноза: </th>
           </tr>
           <tr>  
           <th>Лекарство: </th>
           </tr>   
      </table>   
    '
      ;  
    $content .= generateRow();  
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('prescription.pdf', 'I');
    
    ob_end_clean(); 
       
    require_once('../tcpdf/tcpdf.php');

?>