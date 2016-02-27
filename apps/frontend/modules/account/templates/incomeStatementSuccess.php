<?php use_helper('I18N', 'Date') ?>
<?php echo link_to("Previous Event","occasion/incStatePrevious?id=".$occasion->getId()); ?> | 
<?php echo link_to("Next Event","occasion/incStateNext?id=".$occasion->getId()); ?> | 
<?php echo link_to("See All Events","occasion/index"); ?> | 
<br><?php echo link_to("View Complete Event Report","occasion/eventReport?id=".$occasion->getId()); ?> | 
<br><?php echo link_to("View Sales Report","occasion/salesReport?id=".$occasion->getId()); ?> | 
<br><?php echo link_to("View Expense Report","occasion/expenseReport?id=".$occasion->getId()); ?> | 
<br><?php echo link_to("Back to Event Home Page","occasion/view?id=".$occasion->getId()); ?> | 

<h1><?php 
$title='Income Statement: '
	.$occasion->getName()
	." ("
	.MyDateTime::frommysql($occasion->getStartdate())->toshortdate()
	." to "
	.MyDateTime::frommysql($occasion->getEnddate())->toshortdate()
	.")"
	;
echo $title;
?></h1>   

Total Sales: <?php echo MyDecimal::format($totalIncome)?>
<br>Total Expense: <?php echo MyDecimal::format($totalExpense)?>
<br>Total Income: <?php echo MyDecimal::format($totalProfit)?>
<br><?php echo link_to("Print","occasion/incomeStatementPdf?id=".$occasion->getId()); ?>
<hr>

<?php include_partial('occasion/incomeStatement', array(
'occasion' => $occasion,
'accounts' => $accounts,
'entriesByAccount' => $entriesByAccount,
'totalsByAccount' => $totalsByAccount,
'accountTypes' => $accountTypes,
'totalsByAccountType' => $totalsByAccountType,
'totalIncome' => $totalIncome,
'totalExpense' => $totalExpense,
'totalProfit' => $totalProfit,
)) ?>

