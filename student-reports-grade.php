<?php
include_once 'assets/fpdf/fpdf.php';
include_once 'StudentManager.php';



$session = new SessionManager();

$studentManager = new StudentManager;

$students = $studentManager->retrieveStudentGrade($_GET['studentGrade']);




class PDF extends FPDF {
    function Footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',7);
        $this->Cell(0 ,5,'Note : This is a computer generated sheet, no signature is required.',1,1,'C');
        $this->SetFont('Arial','',8);
        $this->Cell(0,5,'Page '.$this->PageNo()." / {nb}",0,0,'C');
    }
}

$pdf = new PDF('P','mm','Letter');
$pdf->AliasNbPages();
$pdf->SetTitle("Success Internation School -Student user Enrollment Details");
$pdf->AddPage();

$pdf->SetFont('Arial','',12);
$pdf->SetFillColor(230,230,230);
$pdf->Cell(15 ,15, $pdf->Image('assets/images/sis-logo-md.png', 10, 9.5, 16, 16), 0, 0, 'C', false);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(115 ,15,' SUCCESS INTERNATIONAL SCHOOL',0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,15,'Report: ',0,0);
$pdf->Cell(50,15,'Grade '.$_GET['studentGrade'].' Student Database',0,1);

$pdf->Cell(195 ,5,'',0,1);

$pdf->SetFont('Arial','',10);
$pdf->Cell(30 ,5,'Head Office        :',0,0);
$pdf->Cell(100 ,5,'No 13/B, Colombo Road,',0,0);
$pdf->Cell(15 ,5,'Tel      :',0,0);
$pdf->Cell(50 ,5,'011-2345678',0,1);

$pdf->Cell(30 ,5,'',0,0);
$pdf->Cell(100 ,5,'Wattala.',0,0);
$pdf->Cell(15 ,5,'Email  :',0,0);
$pdf->Cell(50 ,5,'info@sis.edu',0,1);

$pdf->Cell(195 ,5,'',0,1);

$pdf->Cell(30 ,5,'Generated By     :',0,0);
$pdf->Cell(35, 5, $session->get_session('fname') . ' ' . $session->get_session('lname') . ' (' . $session->get_session('userid') . ')', 0, 0);
$pdf->Cell(30 ,5,'',0,0);
$pdf->Cell(35 ,5,'',0,0);
$pdf->Cell(30 ,5,'',0,0);
$pdf->Cell(35 ,5,'',0,1);

$pdf->Cell(0 ,15,'__________________________________________________________________________________________________',0,1);

if($students == NULL){
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(5, 5, '---------- No Data Available for Grade '.$_GET['studentGrade'].' ----------', 0, 0);
}else {
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(5, 5,'#',0,0);
    $pdf->Cell(20, 5,'ID',0,0);
    $pdf->Cell(40, 5,'Name',0,0);
    $pdf->Cell(50, 5,'E-Mail',0,0);
    $pdf->Cell(35, 5,'Contact Number',0,0);
    $pdf->Cell(30, 5,'Date Of Birth',0,0);
    $pdf->Cell(20, 5,'Gender',0,1);

    $student_count = 1;
    foreach ($students as $student) {
        $pdf->SetFont('Arial', '', 9);
        $pdf->Cell(5, 5, $student_count++, 0, 0);
        $pdf->Cell(20, 5, $student['sid'], 0, 0);
        $pdf->Cell(40, 5, $student['fname'], 0, 0);
        $pdf->Cell(50, 5, $student['email'], 0, 0);
        $pdf->Cell(35, 5, $student['mobile_no'], 0, 0);
        $pdf->Cell(30, 5, $student['dob'], 0, 0);
        $pdf->Cell(20, 5, ($student['gender'] == 1) ? 'Male' : 'Female', 0, 1);
//	$pdf->Cell(30, 5, ();
    }
}

$pdf->Close();
$pdf->Output();

?>
