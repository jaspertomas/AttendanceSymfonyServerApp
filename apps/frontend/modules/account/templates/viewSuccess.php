<?php use_helper('I18N', 'Date') ?>
<?php echo link_to("Previous Event","occasion/viewPrevious?id=".$occasion->getId()); ?> | 
<?php echo link_to("Next Event","occasion/viewNext?id=".$occasion->getId()); ?> | 
<?php echo link_to("See All Events","occasion/index"); ?> | 

<h1><?php 
$title=''
	.$occasion->getName()
	." ("
	.MyDateTime::frommysql($occasion->getStartdate())->toshortdate()
	." to "
	.MyDateTime::frommysql($occasion->getEnddate())->toshortdate()
	.")"
	;
echo $title;
?></h1>   
<h2><?php echo link_to("Create new Invoice (Sale)","invoice/new?event_id=".$occasion->getId()); ?>
<br><?php echo link_to('Create new Voucher (Expense)',"voucher/new?event_id=".$occasion->getId()); ?>
</h3>

<?php echo link_to("View Event Report","occasion/eventReport?id=".$occasion->getId()); ?>
<br><?php echo link_to("View Income Statement","occasion/incomeStatement?id=".$occasion->getId()); ?>
<br><?php echo link_to('View Sales Report','occasion/salesReport?id='.$occasion->getId()); ?>
<br><?php echo link_to('View Expense Report','occasion/expenseReport?id='.$occasion->getId()); ?>

<br>
<br><a href="<?php echo url_for('occasion/edit?id='.$occasion->getId()) ?>">Edit</a>

