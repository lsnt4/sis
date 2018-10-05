<?php
// (c) Xavier Nicolay
// Exemple de génération de devis/facture PDF

require('Finance_Pay_Slip.php');
require('DB_Connection.php');
include_once 'ClassStaff.php';
if(isset($_POST["download_data"])){
$payid=$_POST["payid"];

$session = new SessionManager();

$sql_check_pay = "select * from payroll where id = '$payid'";
			$result_check_pay = $conn->query($sql_check_pay);
			$rowA = $result_check_pay->fetch_assoc();
			
			
			$staff = "select * from users where userid='".$rowA["staff_id"]."'";
			$result_staff = $conn->query($staff);
			$row = $result_staff->fetch_assoc();
			
			$dep = "select * from user_departments where userid = '".$rowA["staff_id"]."'";
			$res_dep = $conn->query($dep);
			$row_dep = $res_dep->fetch_assoc();
			
			$department = "select * from departments where did = '".$row_dep["department_id"]."'";
			$res_depart = $conn->query($department);
			$row_depart = $res_depart->fetch_assoc();
			
			$sql_bank = "select * from bank_accounts where userid = '".$rowA["staff_id"]."'";
			$res_bank = $conn->query($sql_bank);
			$row_bank = $res_bank->fetch_assoc();
			
			
$name = $row["fname"].".".$row["lname"];
$work = $row_depart["name"];
$print = $session->get_session('fname').".".$session->get_session('lname');
$month = substr(strtoupper($rowA["month"]), 0, 3);
date_default_timezone_set('Asia/Colombo');
$date = date("Y-m-d",time());

$pdf = new PDF_Invoice( 'P', 'mm', 'A4' );
$pdf->AddPage();
$pdf->addSociete( $name,$work,
					$row["address"]);
$pdf->fact_dev( "Payslip Printed By :",$session->get_session('userid'), $print );
$pdf->temporaire( "Success International School" );
$pdf->addDate($date);
$pdf->addClient($rowA["year"]);
$pdf->addPageNumber($month);
$pdf->addClientAdresse("Success International School\nNo. 14, Negombo Road,\nWattala,\nGampaha.\nPost Code - 11300.");
$pdf->addReglement($rowA["payment_method"],"Savings");
$pdf->addEcheance($rowA["id"]);
$pdf->addNumTVA($row_bank["bankname"],$row_bank["account_no"]);
$pdf->addReference("if you have any problems about payroll contact the finance department. ");
$cols=array( "REF"    => 15,
             "DESCRIPTION"  => 85,
             "EARNINGS"     => 45,
             "DEDUCTIONS"   => 45);
$pdf->addCols( $cols);
$cols=array( "REF"    => "C",
             "DESCRIPTION"  => "L",
             "EARNINGS"     => "R",
             "DEDUCTIONS"   => "R" );
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);

$y    = 109;
$line = array( "REF"    => "1",
               "DESCRIPTION"  => "Basic Salary",
               "EARNINGS"     => $row["salary"],
               "DEDUCTIONS"   => " ");
$size = $pdf->addLine( $y, $line );
$y   += $size + 10;

$line = array( "REF"    => "2",
               "DESCRIPTION"  => "Shift Allowance",
               "EARNINGS"     => $rowA["allowance"],
               "DEDUCTIONS"   => " ");
$size = $pdf->addLine( $y, $line );
$y   += $size + 10;

$line = array( "REF"    => "3",
               "DESCRIPTION"  => "Employee EPF",
               "EARNINGS"     => " ",
               "DEDUCTIONS"   => $rowA["employee_epf"]);
$size = $pdf->addLine( $y, $line );
$y   += $size + 10;

$line = array( "REF"    => "4",
               "DESCRIPTION"  => "Employee Tax",
               "EARNINGS"     => " ",
               "DEDUCTIONS"   => $rowA["employee_tax"]);
$size = $pdf->addLine( $y, $line );
$y   += $size + 40;

$line = array( "REF"    => " ",
               "DESCRIPTION"  => "Total Gross & Deductions",
               "EARNINGS"     => $row["salary"]+$rowA["allowance"],
               "DEDUCTIONS"   => $rowA["employee_epf"]+$rowA["employee_tax"]);
$size = $pdf->addLine( $y, $line );
$y   += $size + 10;

$line = array( "REF"    => " ",
               "DESCRIPTION"  => "Net Salary",
               "EARNINGS"     => " ",
               "DEDUCTIONS"   => $rowA["net_sal"]);
$size = $pdf->addLine( $y, $line );
$y   += $size + 15;

$line = array( "REF"    => "5",
               "DESCRIPTION"  => "Company EPF",
               "EARNINGS"     => $rowA["employer_epf"],
               "DEDUCTIONS"   => " ");
$size = $pdf->addLine( $y, $line );
$y   += $size + 10;

$line = array( "REF"    => "6",
               "DESCRIPTION"  => "Company ETF",
               "EARNINGS"     => $rowA["employer_etf"],
               "DEDUCTIONS"   => " ");
$size = $pdf->addLine( $y, $line );
$y   += $size + 10;
$pdf->Output();
}
?>
