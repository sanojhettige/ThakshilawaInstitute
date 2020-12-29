<?php
ob_start();
class MYPDF extends TCPDF {

    public $app_data;
    public $record;
    
    public function setData($app_data, $record){
    $this->app_data = $app_data;
    $this->record = $record;
    }

    public function Header() {
        $this->SetY(10);
        $this->SetXY(5,10);
        $this->SetFont('helvetica', 'B', 12);
        $this->Cell(0, 15, strtoupper($this->app_data['app_name']), 0, false, 'L', 0, 'B', 0, false, 'M', 'M');
        $this->SetXY(5,15);
        $this->SetFont('helvetica', '', 8);
        $this->Cell(0, 15, 'Address - '.strip_tags($this->app_data['address']), 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->SetXY(5,20);
        $this->Cell(0, 15, 'Phone Number - '.($this->app_data['phone_number']), 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->SetXY(5,25);
        $this->Cell(0, 15, 'Email - '.($this->app_data['email']), 0, false, 'L', 0, '', 0, false, 'M', 'M');

        $this->SetXY(160,9);
        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(0, 15, 'STUDENT ATTENDANCE REPORT', 0, false, 'R', 0, 'B', 0, false, 'M', 'M');
        $this->SetXY(160,14);
        $this->SetFont('helvetica', '', 10);
        $title = get_post('year_id') ? get_post('year_id'): "";
        $title .= get_post('month_id') ? " ".date("F", strtotime("2020-".get_post('month_id')."-01")): "";
        $title .= get_post('class_name') ? " ".get_post('class_name'): "";
        $this->Cell(0, 15, $title, 0, false, 'R', 0, 'B', 0, false, 'M', 'M');

        $xVal = 5;
        $yVal = 13;
        $this->SetFont(PDF_FONT_NAME_MAIN, 'R', 9);
    }

    // Page footer
    public function Footer() {
        $this->SetFont('helvetica', 'I', 8);

        $this->SetXY(5,240);
        $this->Cell(16, 10, 'Authorized By', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->SetXY(30,240);
        $this->Cell(16, 10, '...........................................................', 0, false, 'L', 0, '', 0, false, 'T', 'M');
    
        $this->SetXY(5,250);
        $this->Cell(16, 10, 'This is a computer generated copy', 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->SetXY(80,250);
        $this->Cell(10, 10, 'Printed Date : '.date("Y-m-d h:i A"), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        // $this->SetXY(162,130);
        // $this->Cell(10, 10, 'Printed By : '.date("Y-m-d h:i A"), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        
    }
}

$rowperPage =25;
$pageTemplate = 1;
$tableStartYAx = 30;
$width = 266;  
$height = 175;
$orientation = ($height>$width) ? 'P' : 'L'; 
$itemsPerHalfPage = $rowperPage;
$userRole = get_user_role();

$totalItems = count($attendance);


$totalPages = count($attendance)%$rowperPage;
$page_num = intval(count($attendance)/$rowperPage);

if($totalPages == 0) {
    $pages = $page_num;
} else {
    $pages = $page_num + 1;
}

// print_r($attendance); exit;
$rows = array_chunk($attendance, $rowperPage);


// $pdf->addFormat("custom", $width, $height);  
// $pdf->reFormat("custom", $orientation); 
$pageLayout = array($width, $height);

// $pdf = new MYPDF($orientation, PDF_UNIT, $pageLayout, true, 'UTF-8', false);
$pdf = new MYPDF($orientation, PDF_UNIT, $pageLayout, true, 'UTF-8', false, $record);
$pdf->setData($app_data, $record);
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('PSC');
$pdf->SetTitle('Attendance report');
$pdf->SetSubject('Attendance report');
$pdf->SetKeywords('AttendanceReport');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
// $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
// $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
// $pdf->SetFooterMargin(10);
$pdf->SetPrintHeader(true);
$pdf->SetPrintFooter(true);

// set auto page breaks
// $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$pdf->SetAutoPageBreak(TRUE, 0);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Add a page
// This method has several options, check the source code documentation for more information.
// echo $pages;  exit;
for ($i=0; $i < $pages; $i++) { 

    $pdf->AddPage();

    $pdf->Ln(4);

    $xVal = 5;
    $yVal = $tableStartYAx;
    $pdf->SetFont('helvetica', 'R', 8);
    $pdf->SetXY($xVal, $yVal);
    $r = 1; 

    $table = <<<EOD
    <table cellspacing="0" cellpadding="1" border="0.5">
    <tr>
    EOD;

    $table .= <<<EOD
        <td border="0.5" style="text-align:left; width: 150px;">Student Name</td>
        EOD;
        for($i = $start_date; $i <= $end_date; $i++) {
            $table .= <<<EOD
        <td border="0.5" style="text-align:center; width:24px;">$i</td>
        EOD;
        }
    $table .= <<<EOD
            </tr>
EOD;

foreach($attendance as $student=>$row) { 
    $table .= <<<EOD
        <tr>
        EOD;
    $table .= <<<EOD
        <td border="0.5" style="text-align:left;">$student</td>
        EOD;
        for($i = $start_date; $i <= $end_date; $i++) {
            $checked = "";
            $date = date("Y-m-d", strtotime(get_post('year_id').'-'.get_post('month_id').'-'.$i));
            $checked = $row[$date] ? "P" : "-";

            $table .= <<<EOD
        <td border="0.5" style="text-align:center; width:24px;">$checked</td>
        EOD;
        }
        
        $table .= <<<EOD
        </tr>
        EOD;

}

    $table .= <<<EOD
</table>
EOD;

    $pdf->writeHTML($table, true, false, false, false, '');

}


// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('attendance.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+