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
  public function executeValidate(sfWebRequest $request)
  {
    $this->records=Doctrine_Query::create()
        ->from('Record r')
      	->where('r.is_valid = 0')
      	->orderBy("r.employee_name,r.datetime")
      	->execute();
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
        ->andWhere("r.datetime<=\"".$enddate."\"")
      	->orderBy('r.datetime desc')
      	->execute();
	
  }
}
