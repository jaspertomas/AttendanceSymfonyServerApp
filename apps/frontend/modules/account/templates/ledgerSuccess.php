<?php use_helper('I18N', 'Date') ?>
<h1><?php echo 'Ledger: '.$account->getName();?></h1>   

<?php 
//show date form
echo form_tag("account/ledger");
$startDateForm = new sfWidgetFormDate();
$endDateForm = new sfWidgetFormDate();
echo "From ".$startDateForm->render('startdatesplit',$startdate);
echo " to ".$endDateForm->render('enddatesplit',$enddate);
?>
<input type=hidden name=id id=id value="<?php echo $account->getId();?>">
<input type=submit value="View">
</form>

<br>Total: <?php echo MyDecimal::format($total)?>

<br><?php echo link_to("Back to Income Statement","report/incomeStatement"); ?> | 
<br>
<br>
<table border=1>
    <tr>
      <td>Date</td>
      <td>Amount</td>
      <td>Notes</td>
    </tr>
    <?php foreach($entries as $entry){?>
    <tr>
      <td><?php echo $entry->getDate()?></td>
      <td align=right><?php echo $entry->getAmount()?></td>
      <td><?php echo $entry->getDescription()?></td>
      <td><?php echo link_to("Edit","account_entry/edit?id=".$entry->getId());?></td>
    </tr>
  <?php } ?>
</table>
