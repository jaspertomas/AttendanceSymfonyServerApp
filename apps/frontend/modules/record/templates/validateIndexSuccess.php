<h1>Validate By Employee</h1>

<table>
  <tr>
    <td>Employee</td>
  </tr>
  <?php foreach($employees as $employee){?>
    <tr>
      <td><?php echo link_to($employee->getName(),"record/validate?employee_name=".$employee->getName()) ?></td>
    </tr>
  <?php }?>
</table>
