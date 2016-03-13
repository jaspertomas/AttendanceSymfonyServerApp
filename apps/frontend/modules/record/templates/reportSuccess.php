<?php use_helper('I18N', 'Date') ?>
<?php echo form_tag_for(new InvoiceForm(),"invoice/dsrmulti")?>
<?php 
$today=MyDateTime::frommysql($form->getObject()->getDate()); 
$yesterday=MyDateTime::frommysql($form->getObject()->getDate()); 
$yesterday->adddays(-1);
$tomorrow=MyDateTime::frommysql($form->getObject()->getDate()); 
$tomorrow->adddays(1);
?>
<table>
  <tr>
    <td>From Date</td>
    <td><?php echo $form["date"] ?></td>
  </tr>
  <tr>
    <td>To Date</td>
    <td><?php echo $toform["date"] ?></td>
    <td><input type=submit value=View ></td>
  </tr>
</table>
    <?php echo link_to("Yesterday","invoice/dsr?invoice[date][day]=".$yesterday->getDay()."&invoice[date][month]=".$yesterday->getMonth()."&invoice[date][year]=".$yesterday->getYear()); ?>
    <?php echo link_to("Tomorrow","invoice/dsr?invoice[date][day]=".$tomorrow->getDay()."&invoice[date][month]=".$tomorrow->getMonth()."&invoice[date][year]=".$tomorrow->getYear()); ?>

</form><h1>Period Sales Report </h1>
Date: <?php echo $form->getObject()->getDate(); ?>

<br>Cash Sales: <?php echo MyDecimal::format($cashtotal)?>
<br>Cheque Sales: <?php echo MyDecimal::format($chequetotal)?>
<br>Credit Sales: <?php echo MyDecimal::format($credittotal)?>
<br>Total Sales: <?php echo MyDecimal::format($total)?>
<br>
<?php 
$datearray=explode("-",$form->getObject()->getDate());
$todatearray=explode("-",$toform->getObject()->getDate());
echo link_to("Print","invoice/dsrmultipdf?invoice[date][year]=".
                $datearray[0]."&invoice[date][month]=".
                $datearray[1]."&invoice[date][day]=".
                $datearray[2]."&purchase[date][year]=".
                $todatearray[0]."&purchase[date][month]=".
                $todatearray[1]."&purchase[date][day]=".
                $todatearray[2]);?>


<br>
<br>
<table border=1>
  <tr>
    <td>Form</td>
    <td>Customer</td>
    <td>Reference</td>
    <td>Code</td>
    <td>Item Description</td>
    <td>Terms</td>
    <td>Cash</td>
    <td>Cheque</td>
    <td>Acct Sales</td>
    <td>Discount</td>
    <td>Salesman</td>
    <td>Remarks</td>
  </tr>
  <?php 
foreach($templates as $template){
//foreach(array(2,4,1,3) as $template_id){
?>
    <?php 
/*
foreach($events as $event){
      $invoice=$event->getParent();
      if($invoice->getTemplateId()==$template->getId()){?>
    <tr>
      <td><?php echo $invoice->getInvoiceTemplate() ?></td>
      <td><?php echo $invoice->getCustomer()." ".$invoice->getCustomerName() ?></td>
      <td><?php echo link_to($invoice->getInvno(),"invoice/view?id=".$invoice->getId()) ?></td>
      <td><?php echo $invoice->getDate() ?></td>
      <td><?php echo $event->getType().": ".$event->getDetail1().": ".$event->getDetail2() ?></td>
      <td><?php //echo $invoice->getTotal() ?></td>
      <td align=right><?php if($invoice->getStatus()!="Cancelled")echo $event->getDetail("cashamt");?></td>
      <td align=right><?php if($invoice->getStatus()!="Cancelled")echo $event->getDetail("chequeamt");?></td>
      <td align=right><?php if($invoice->getStatus()!="Cancelled")echo $event->getDetail("creditamt");?></td>
      <td><?php echo $invoice->getEmployee() ?></td>
      <td><?php echo $invoice->getStatus() ?></td>
      <td><?php echo $event->getNotes() ?></td>
      <td><?php echo link_to("Edit","event/edit?id=".$event->getId()) ?></td>
      <td><?php echo $invoice->getDate() ?></td>
    </tr>
    <?php }?>
    <?php }
*/
?>
    <?php foreach($invoices as $invoice)if($invoice->getTemplateId()==$template->getId())
        //$invoice->getStatus()!="Cancelled" and 
        if(!$invoice->getHidden()){?>
    <tr>
      <td><?php echo $invoice->getInvoiceTemplate() ?></td>
      <td><?php echo $invoice->getCustomer()." ".$invoice->getCustomerName() ?></td>
      <td><?php echo link_to($invoice->getInvno(),"invoice/view?id=".$invoice->getId()) ?></td>
      <td><?php //echo $invoice->getTotal() ?></td>
      <td><?php echo $invoice->getParticularsString().($invoice->getCheque()?("; Check No.:".$invoice->getCheque().": ".$invoice->getChequedate()):"") ?></td>
      <td><?php //echo $invoice->getTotal() ?></td>
      <td align=right><?php if($invoice->getCash()>0 and $invoice->getStatus()!="Cancelled")echo $invoice->getCash() ?></td>
      <td align=right><?php if($invoice->getChequeamt()>0 and $invoice->getStatus()!="Cancelled")echo $invoice->getChequeamt() ?></td>
      <td align=right><?php if($invoice->getCredit()>0 and $invoice->getStatus()!="Cancelled")echo $invoice->getCredit() ?></td>
      <td align=right><?php echo $invoice->getDiscamt() ?></td>
      <td><?php echo $invoice->getEmployee() ?></td>
      <td><?php echo $invoice->getStatus() ?></td>
      <td><?php echo $invoice->getNotes() ?></td>
      <td><?php echo link_to("Edit","invoice/edit?id=".$invoice->getId()) ?></td>
      <td><?php echo $invoice->getDate() ?></td>
    </tr>
    <?php }?>
    <tr>
      <td></td>
    </tr>
  <?php }?>
</table>


