<?php use_helper('I18N', 'Date') ?>
<h1>Attendance Report</h1>   

<?php 
var_dump($startdate);
var_dump($enddate);
//show date form
echo form_tag("record/report");
$startDateForm = new sfWidgetFormDate();
$endDateForm = new sfWidgetFormDate();
echo "From ".$startDateForm->render('startdatesplit',$startdate);
echo " to ".$endDateForm->render('enddatesplit',$enddate);
?>
<input type=submit value="View">
</form>


<textarea cols=80 rows=50>
    <?php foreach($records as $record){?>
      <?php echo $record->getId()?>
    <?php echo "\t"?>
      <?php echo $record->getDatetime()?>
      <?php echo $record->getEmployeeName()?>
  <?php } ?>

</textarea>

