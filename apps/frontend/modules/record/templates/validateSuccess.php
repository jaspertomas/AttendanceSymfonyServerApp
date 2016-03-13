<h1>Validate Records</h1>
<?php echo form_tag("record/processValidate");?>
<input type=submit>
<table>
  <tr>
    <td><input type=checkbox id="select-all"></td>
    <td>Account</td>
    <td>Amount</td>
    <td>View Ledger</td>
    <td></td>
  </tr>
  <?php foreach($records as $record){?>
    <tr>
      <td><input type=checkbox name=ids[] value=<?php echo $record->getId(); ?>></td>
      <td><?php echo $record->getEmployeeName() ?></td>
      <td><?php echo $record->getDatetime() ?></td>
      <td><img width=25% src="<?php echo "http://".$_SERVER['SERVER_NAME'].str_replace(array("index.php","frontend_dev.php"),"",$_SERVER['SCRIPT_NAME'])?>/uploads/<?php echo $record->getFilename() ?>"></td>
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