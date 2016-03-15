 
 <div class="sf_admin_form_row sf_admin_foreignkey sf_admin_form_field_employee_name">
 <div>
 <label for="record_employee_name">Employee name</label>
 <div class="content"><select name="record[employee_name]" id="record_employee_name">
<?php
 foreach(Doctrine_Query::create()
 ->from('Employee e')
 	->orderBy("e.name")
		->execute() as $employee)
	{
?>
<option value="<?php echo $employee->getName() ?>" <?php if($form->getObject()->getEmployeeName()==$employee->getName())echo 'selected="selected"' ?> ><?php echo $employee->getName() ?></option>
<?php
	}
?>
</select></div>

 </div>
 </div>



 <div class="sf_admin_form_row sf_admin_foreignkey sf_admin_form_field_employee_name">
 <div>
 <label for="record_employee_name">Date</label>
 <div class="content">
 
<?php
$date="";
$time="";
$datetime=$form->getObject()->getDatetime();
$segments=explode(" ",$datetime);
if(count($segments)>=2)
{
	list($date,$time)=$segments;
	$timesegments=explode(":",$time);
	if(count($timesegments)>=2)
	{
		$time=$timesegments[0].$timesegments[1];
		$time=MyTime::militaryTimeToOrdinary($time);
	}
}
$form->getObject()->getDatetime();
$dateForm = new sfWidgetFormDate();
echo $dateForm->render('date',$date);
?>
 
 
 </div>

 </div>
 </div>
 
 
 <div class="sf_admin_form_row sf_admin_foreignkey sf_admin_form_field_employee_name">
 <div>
 <label for="record_employee_name">Time</label>
 <div class="content">
 
<input id=time name=time value="<?php echo $time?>">
 
 
 </div>

 </div>
 </div>
 
 