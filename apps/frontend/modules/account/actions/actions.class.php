<?php

require_once dirname(__FILE__).'/../lib/accountGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/accountGeneratorHelper.class.php';

/**
 * account actions.
 *
 * @package    sf_sandbox
 * @subpackage account
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class accountActions extends autoAccountActions
{
  public function executeLedger(sfWebRequest $request)
  {
    $this->account = Doctrine::getTable('Account')->find(array($request->getParameter('id')));
    if(!$this->account)
    {
      return $this->redirect('home/error?msg=Sorry, that account does not exist');
    }

    //startdate
    if($request->hasParameter("startdate"))
    {
      $startdate=$request->getParameter("startdate");
    }
    elseif($request->hasParameter("startdatesplit"))
    {
      $requestparams=$request->getParameter("startdatesplit");
      $day=$requestparams["day"];
      $month=$requestparams["month"];
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
      $day=$requestparams["day"];
      $month=$requestparams["month"];
      $year=$requestparams["year"];
      $enddate=$year."-".$month."-".$day;
    }
    else
    {
      $enddate=MyDate::today();
    }
    $this->enddate=$enddate;
 
    //read account entries from database
    $this->entries=Doctrine_Query::create()
        ->from('AccountEntry ae')
        ->where("ae.account_id=".$request->getParameter('id'))
        ->andWhere("ae.date>=\"".$startdate."\"")
        ->andWhere("ae.date<=\"".$enddate."\"")
      	->orderBy('date desc')
      	->execute();
	  
	  //do some counting
	  $this->total=0;
	  foreach($this->entries as $entry)
	    $this->total+=$entry->getAmount();
	  
  }
}
