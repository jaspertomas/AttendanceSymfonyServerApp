<?php 
//display by account type:
foreach($accountTypes as $accttype_id=>$accttype){ ?>

<h3><?php echo $accttype?></h3>
<table border=1>
  <tr>
    <td>Account</td>
    <td>Amount</td>
    <td>View Ledger</td>
    <td></td>
  </tr>
  <?php foreach($accounts as $account)
  if($account->getAccountTypeId()==$accttype_id)
  if(isset($totalsByAccount[$account->getId()]))
  {?>
    <tr>
      <td><?php echo $account->getName() ?></td>
      <td align=right><?php echo MyDecimal::format($totalsByAccount[$account->getId()]) ?></td>
      <td><?php echo link_to("View Ledger","occasion/ledger?id=".$account->getId()); ?></td>
    </tr>
  <?php }?>
</table>
<?php }?>
