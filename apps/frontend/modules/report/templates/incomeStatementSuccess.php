<?php use_helper('I18N', 'Date') ?>
<h1><?php echo 'Income Statement ';?></h1>   
<?php 
//show date form
echo form_tag("report/incomeStatement");
$startDateForm = new sfWidgetFormDate();
$endDateForm = new sfWidgetFormDate();
echo "From ".$startDateForm->render('startdatesplit',$startdate);
echo " to ".$endDateForm->render('enddatesplit',$enddate);
?>
<input type=submit value="View">
</form>

Total Sales: <?php echo MyDecimal::format($totalIncome)?>
<br>Total Expense: <?php echo MyDecimal::format($totalExpense)?>
<br>Total Income: <?php echo MyDecimal::format($totalProfit)?>
<br><?php //echo link_to("Print","occasion/incomeStatementPdf?id=".$occasion->getId()); ?>
<hr>

<?php include_partial('report/incomeStatement', array(
'accounts' => $accounts,
'entriesByAccount' => $entriesByAccount,
'totalsByAccount' => $totalsByAccount,
'accountTypes' => $accountTypes,
'totalsByAccountType' => $totalsByAccountType,
'totalIncome' => $totalIncome,
'totalExpense' => $totalExpense,
'totalProfit' => $totalProfit,
)) ?>

