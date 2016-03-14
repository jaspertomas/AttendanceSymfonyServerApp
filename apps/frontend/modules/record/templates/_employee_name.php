  
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
<option value="<?php echo $employee->getName() ?>"  <?php if($form->getObject()->getEmployeeName()==$employee->getName())echo 'selected="selected"' ?>  ><?php echo $employee->getName() ?></option>
<?php
	}
?>
</select></div>

          </div>
          </div>