<?php

require_once dirname(__FILE__).'/../lib/recordGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/recordGeneratorHelper.class.php';

/**
 * record actions.
 *
 * @package    sf_sandbox
 * @subpackage record
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class recordActions extends autoRecordActions
{
  public function executeZoom(sfWebRequest $request)
  {
    $this->records=Doctrine_Query::create()
        ->from('Record r')
    	->limit(1)
      	->where('r.id = '.$request->getParameter("id"))
		->execute();
	$this->record=$this->records[0];
  }
  public function executeValidateIndex(sfWebRequest $request)
  {
    $this->employees=Doctrine_Query::create()
        ->from('Employee e')
    	->orderBy("e.name")
		->execute();
  }
  public function executeValidate(sfWebRequest $request)
  {
    $query=Doctrine_Query::create()
        ->from('Record r')
    	->orderBy("r.datetime desc")
      	->where('r.is_valid = 0');
    if($request->hasParameter("employee_name"))
    {
    	$this->employee_name=$request->getParameter("employee_name");
		$query->andWhere("r.employee_name='".$request->getParameter("employee_name")."'");
    }

  	$this->records=$query->execute();
  }
  public function executeProcessValidate(sfWebRequest $request)
  {
  	$ids_string="";
  	$ids=$request->getParameter("ids");
  	for($i=0;$i<count($ids);$i++)
  	{
  		if($i!=0)$ids_string.=",";
  		$ids_string.=$ids[$i];
  	}
  
    $this->records=Doctrine_Query::create()
        ->from('Record r')
      	->where('r.id in ('.$ids_string.')')
      	->execute();
  	foreach($this->records as $record)
  	{
  		$record->setIsValid(1);
  		$record->save();
  	}
  	$this->redirect($request->getReferer());
  }

  public function executeReport(sfWebRequest $request)
  {
    //startdate
    if($request->hasParameter("startdate"))
    {
      $startdate=$request->getParameter("startdate");
    }
    elseif($request->hasParameter("startdatesplit"))
    {
      $requestparams=$request->getParameter("startdatesplit");
      $day=str_pad($requestparams["day"], 2, "0", STR_PAD_LEFT);
      $month=str_pad($requestparams["month"], 2, "0", STR_PAD_LEFT);
      $year=$requestparams["year"];
      $startdate=$year."-".$month."-".$day;
    }
    else
    {
      $startdate=MyDate::today();
    }
    $this->startdate=$startdate;

    //enddate
    if($request->hasParameter("enddate"))
    {
      $enddate=$request->getParameter("enddate");
    }
    elseif($request->hasParameter("enddatesplit"))
    {
      $requestparams=$request->getParameter("enddatesplit");
      $day=str_pad($requestparams["day"], 2, "0", STR_PAD_LEFT);
      $month=str_pad($requestparams["month"], 2, "0", STR_PAD_LEFT);
      $year=$requestparams["year"];
      $enddate=$year."-".$month."-".$day;
    }
    else
    {
      $enddate=MyDate::today();
    }
    $this->enddate=$enddate;
 
    //read account entries from database
    $this->records=Doctrine_Query::create()
        ->from('Record r')
        ->andWhere("r.datetime>=\"".$startdate."\"")
        ->andWhere("r.datetime<=\"".$enddate."z\"")
      	->orderBy('r.datetime desc')
      	->execute();
	
  }
  

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
  	$requestparams=$request->getParameter($form->getName());

	//process datetime
  	$requestparams=$request->getParameter($this->form->getName());
  	$date=$request->getParameter("date");//array of month, day and year
  	$time=$request->getParameter("time");
	//process date
  	$month=$date['month'];
  	$day=$date['day'];
  	$year=$date['year'];  	
  	$date=$year."-".$month."-".$day;
	//process time
	if(strpos("p",strtolower($time)))$m="PM";
	else $m="AM";
	list($hour,$minute)=explode(":",$time);
	$minute=preg_replace("/[^0-9,.]/", "", $minute);//remove all non-numeric chars from minute
  	if($m=="PM")$hour+=12;
  	$time=str_pad($hour,2,"0",STR_PAD_LEFT).":".str_pad($minute,2,"0",STR_PAD_LEFT).":00";
  	$requestparams["datetime"]=$date." ".$time;
  
    $form->bind($requestparams, $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $record = $form->save();
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $record)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@record_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'record_edit', 'sf_subject' => $record));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
}
