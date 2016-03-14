<h1>Validate Records
<?php
if(isset($employee_name))
	echo ": ".$employee_name;
?>

</h1>

<?php
if(isset($employee_name))
	echo link_to("Validate All Records","record/validate");
else
	echo link_to("Validate by Employee","record/validateIndex");
?>
<br>
<br>
<?php echo form_tag("record/processValidate");?>
<input type=submit>
<table>
  <tr>
    <td><input type=checkbox id="select-all"></td>
    <td>Date and Time</td>
    <td>Edit</td>
    <td>Employee</td>
    <td>Picture</td>
  </tr>
  <?php foreach($records as $record){?>
    <tr>
      <td><input type=checkbox name=ids[] value=<?php echo $record->getId(); ?>></td>
      <td><?php echo $record->getDatetime() ?></td>
      <td><?php echo link_to("Edit","record/edit?id=".$record->getId()) ?></td>
      <td><?php echo $record->getEmployeeName() ?></td>
      <td>
      <?php echo link_to(
      "<img width=25% src=\""
      ."http://".$_SERVER['SERVER_NAME'].str_replace(array("index.php","frontend_dev.php"),"",$_SERVER['SCRIPT_NAME'])
      ."/uploads/"
      .$record->getFilename()
      ."\">"
		,      
      "record/zoom?id=".$record->getId()
      );?>
      </td>
    </tr>
  <?php }?>
</table>
</form>
<script>
$('#select-all').click(function(event) {   
    if(this.checked) 
    {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    }
    else
    {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = false;                        
        });
    }
});
</script>