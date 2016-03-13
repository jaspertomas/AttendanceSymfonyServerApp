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

}
