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
$title='Sales Report: '
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

$title='Sales Report: '
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

$pdf->write(0,"Total Sales: ".MyDecimal::format($totalsales),'',false,'',true,0,false,false,0,0);
$pdf->write(0,"Unpaid Sales: ".MyDecimal::format($totalunpaid),'',false,'',true,0,false,false,0,0);
$pdf->write(0,"Paid Sales: ".MyDecimal::format($totalpaid),'',false,'',true,0,false,false,0,0);
$pdf->write(0,"Cash Sales: ".MyDecimal::format($totalcash),'',false,'',true,0,false,false,0,0);
$pdf->write(0,"Cheque Sales: ".MyDecimal::format($totalcheque),'',false,'',true,0,false,false,0,0);

// Multicell test
$widths=array(35,30,40,110,30,30,25);
$height=5;

$content=array(
    'Date'
    ,'Ref'
    ,'Customer'
    ,'Item Description'
    ,'Total'
    ,'Salesman'
    ,'Remarks'
          );
$pdf->MultiCell($widths[0], $height, $content[0], 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell($widths[1], $height, $content[1], 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell($widths[2], $height, $content[2], 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell($widths[3], $height, $content[3], 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell($widths[4], $height, $content[4], 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell($widths[5], $height, $content[5], 1, 'C', 0, 0, '', '', true);
$pdf->MultiCell($widths[6], $height, $content[6], 1, 'R', 0, 1, '', '', true);
//$pdf->MultiCell($widths[7], $height, $content[7], 1, 'R', 0, 0, '', '', true);
//$pdf->MultiCell($widths[8], $height, $content[8], 1, 'R', 0, 1, '', '', true);

foreach(array(1) as $template_id)
//foreach(array(2,4,1,3) as $template_id)
{
//  $pdf->SetFont('dejavusans', '', 14, '', true);
  //$pdf->MultiCell(265, 0, InvoiceTemplateTable::fetch($template_id), 1, 'L', 0, 1, '', '', true);
  $pdf->SetFont('dejavusans', '', 12, '', true);

  //events section removed

  foreach($invoices as $invoice)if($invoice->getTemplateId()==$template_id)
      if($invoice->getHidden()==0)
  {
			$particularsstring=$invoice->getParticularsString()?$invoice->getParticularsString():" ";
			if($invoice->getCheque())$particularsstring=implode("; ",array($particularsstring,"Cheque no.: ".$invoice->getCheque().", ".MyDateTime::frommysql($invoice->getChequeDate())->toshortdate()));

			$chequestring=$invoice->getChequeamt()>0?$invoice->getChequeamt():" ";
			//if($invoice->getCheque())$chequestring=implode("; ",array($chequestring,"Cheque no.: ".$invoice->getCheque().", ".MyDateTime::frommysql($invoice->getChequeDate())->toshortdate()));
  
      $content=array(
        MyDateTime::frommysql($invoice->getDate())->toshortdate(),
      
      $invoice->getInvno()?"Inv ".$invoice->getInvno():" ",
       $invoice->getCustomer()." ".$invoice->getCustomerName(),
     
      
       $particularsstring,
      ($invoice->getStatus()!="Cancelled")?MyDecimal::format($invoice->getTotal()):" ",
       $invoice->getEmployee()?$invoice->getEmployee():" ",
       $invoice->getStatus()=="Paid Check"?$invoice->getCheque():($invoice->getStatus()?$invoice->getStatus():" "),
      );
      $height=1;
      foreach($content as $index=>$txt) 
      {
        $numlines=$pdf->getNumLines($txt,$widths[$index],false,true,'','');
        if($height<$numlines)$height=$numlines;
      }
      $height*=4.5;
      $pdf->MultiCell($widths[0], $height, $content[0], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[1], $height, $content[1], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[2], $height, $content[2], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[3], $height, $content[3], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[4], $height, $content[4], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[5], $height, $content[5], 1, 'C', 0, 0, '', '', true,0,true);
      $pdf->MultiCell($widths[6], $height, $content[6], 1, 'C', 0, 1, '', '', true,0,true);
  }
}
//-------product sale summary-------------
$pdf->SetFont('dejavusans', '', 14, '', true);
$pdf->write(0,"",'',false,'',true,0,false,false,0,0);
$pdf->write(0,"Product sale summary",'',false,'',true,0,false,false,0,0);
$pdf->SetFont('dejavusans', '', 12, '', true);
$contents=array();
       $contents[]=array(
          'Product',
          'Qty Sold',
          );

foreach($products as $name=>$qty)
{
	$contents[]=array(
          $name,
          number_format($qty,0,".",","),
          );
}

$widths=array(50,40);
$height=1;
foreach($contents as $content)
{
  $pdf->MultiCell($widths[0], $height, $content[0], 1, 'L', 0, 0, '', '', true,0,true);
  $pdf->MultiCell($widths[1], $height, $content[1], 1, 'R', 0, 1, '', '', true,0,true);
}


// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output("Dao De Gong Sales ".$title.'.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

