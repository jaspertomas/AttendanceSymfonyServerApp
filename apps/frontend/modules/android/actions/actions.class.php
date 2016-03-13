<?php

/**
 * android actions.
 *
 * @package    sf_sandbox
 * @subpackage android
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class androidActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {


  }
  public function executeUpdate(sfWebRequest $request)
  {
    $access_token="lalalala hey jude";
    if($request->getParameter("access_token")!=$access_token)
    {
      echo json_encode(array("success"=>false,"error"=>"Access denied"));
      die();
    }

	//create output data
	$output=array("success"=>true);
	
    $employees=array();
    foreach(Doctrine_Query::create()
        ->from('Employee e')
      	->execute() as $employee)
    {
    	$employees[]=$employee->getData();
    }  	
	$output['employees']=$employees;
    //create data array to be sent back to android app
    $this->getResponse()->setHttpHeader('Content-type','application/json');
    echo json_encode($output);

    die();

  }
  public function executeUpload(sfWebRequest $request)
  {
	$json = json_decode(file_get_contents('php://input'),true);
	//var_dump($json);

    $access_token="lalalala hey jude";
    if($json["access_token"]!=$access_token)
    {
      echo json_encode(array("success"=>false,"error"=>"Access denied"));
      die();
    }

	$output=array("success"=>true);
	$record_ids=array();    
    foreach($json["records"] as $record)
    {
    	$r=new Record();
    	$r->setEmployeeName($record["employee_name"]);
    	$r->setFilename($record["filename"]);
    	$r->setDatetime($record["datetime"]);
    	$r->save();
    	$record_ids[]=$record["filename"];//send back filename; android uses it to delete old records
    	$this->stringToImageFile($record["image_encoded"],$record["filename"]);
    }
	$output['record_ids']=$record_ids;
    
    //create data array to be sent back to android app
    $this->getResponse()->setHttpHeader('Content-type','application/json');
    echo json_encode($output);

    die();
  }
  public function stringToImageFile($base,$image_name)
  {
	//$base="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";
    $binary = base64_decode($base);
    $file = fopen("uploads//".$image_name, "wb"); // 
    fwrite($file, $binary);
    fclose($file);          
  }
}
