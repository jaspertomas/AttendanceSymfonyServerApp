<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2010-08-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com s.r.l.
//               Via Della Pace, 11
//               09044 Quartucciu (CA)
//               ITALY
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @copyright 2004-2009 Nicola Asuni - Tecnick.com S.r.l (www.tecnick.com) Via Della Pace, 11 - 09044 - Quartucciu (CA) - ITALY - www.tecnick.com - info@tecnick.com
 * @link http://tcpdf.org
 * @license http://www.gnu.org/copyleft/lesser.html LGPL
 * @since 2008-03-04
 */

//require_once('../../tcpdf/config/lang/eng.php');
require_once('../../tcpdf/tcpdf.php');

// create new PDF document
$pdf = new TCPDF("L", PDF_UNIT, "GOVERNMENTLEGAL", true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$title='Income Statement: '
	.$occasion->getName()
	." ("
	.MyDateTime::frommysql($occasion->getStartdate())->toshortdate()
	." to "
	.MyDateTime::frommysql($occasion->getEnddate())->toshortdate()
	.")"
	;
$pdf->SetTitle("Dao De Gong Sales ".$title);

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(10, 10, 10,5);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

$title='Income Statement: '
	.$occasion->getName()
	." ("
	.MyDateTime::frommysql($occasion->getStartdate())->toshortdate()
	." to "
	.MyDateTime::frommysql($occasion->getEnddate())->toshortdate()
	.")"
	;
$pdf->write(0,"Dao De Gong Temple",'',false,'',true,0,false,false,0,0);
$pdf->write(0,$title,'',false,'',true,0,false,false,0,0);
$pdf->SetFont('dejavusans', '', 14, '', true);
$pdf->write(0,"Printed on: ".MyDateTime::frommysql(MyDate::today())->toshortdate(),'',false,'',true,0,false,false,0,0);
$pdf->write(0,"",'',false,'',true,0,false,false,0,0);

$pdf->write(0,"Total Sales: ".MyDecimal::format($totalIncome),'',false,'',true,0,false,false,0,0);
$pdf->write(0,"Total Expense: ".MyDecimal::format($totalExpense),'',false,'',true,0,false,false,0,0);
$pdf->write(0,"Total Income: ".MyDecimal::format($totalProfit),'',false,'',true,0,false,false,0,0);



//display by account type:
foreach($accountTypes as $accttype_id=>$accttype)
{ 
  $pdf->SetFont('dejavusans', '', 14, '', true);
  $pdf->write(0,"",'',false,'',true,0,false,false,0,0);
  $pdf->write(0,$accttype,'',false,'',true,0,false,false,0,0);
  $pdf->SetFont('dejavusans', '', 12, '', true);
  
  $contents=array();
  $contents[]=array(
    'Account'
    ,'Amount'
    );
  foreach($accounts as $account)if($account->getAccountTypeId()==$accttype_id)
  {
	$contents[]=array(
          $account->getName(),
          MyDecimal::format($totalsByAccount[$account->getId()]),
          );
  }

  $widths=array(75,50);
  $height=1;
  foreach($contents as $content)
  {
    $pdf->MultiCell($widths[0], $height, $content[0], 1, 'L', 0, 0, '', '', true,0,true);
    $pdf->MultiCell($widths[1], $height, $content[1], 1, 'R', 0, 1, '', '', true,0,true);
  }

}



// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output("Dao De Gong Sales ".$title.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

