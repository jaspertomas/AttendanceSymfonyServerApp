<?php use_helper('I18N', 'Date') ?>
<h1>Attendance Report</h1>   

<?php 
//show date form
echo form_tag("record/report");
$startDateForm = new sfWidgetFormDate();
$endDateForm = new sfWidgetFormDate();
echo "From ".$startDateForm->render('startdatesplit',$startdate);
echo " to ".$endDateForm->render('enddatesplit',$enddate);
?>
<input type=submit value="View">
</form>


<textarea cols=100 rows=50>
<?php 
echo "No	DN	UID              	Name           	Status	Action	APB	JobCode	DateTime\n\n";
foreach($records as $record)
{
echo str_pad($record->getId(), 6, "0", STR_PAD_LEFT)."\t";
echo "0001\t";
echo "000000000000000000\t";
echo str_pad($record->getEmployeeName(), 12, " ", STR_PAD_RIGHT)."\t";
echo "06\t";
echo "01\t";
echo "0\t";
echo "000\t";
echo str_replace("-","/",$record->getDatetime())."\n\n";
} ?>
</textarea>

<!--

000000	0001	000000000000000004	RUEL        	06	01	0	000	2015/11/14 08:56:11

-->