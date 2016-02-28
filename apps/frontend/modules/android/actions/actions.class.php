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
  public function executeLogin(sfWebRequest $request)
  {
	$json = json_decode(file_get_contents('php://input'),true);
  
    $access_token=md5("hello".$json['username']."its".MyDate::today());
    if($json['access_token']!=$access_token)
    {
      echo json_encode(array("success"=>false,"error"=>"Access denied"));
      die();
    }

    //if user doesn't exist, fail
    $user = Doctrine_Query::create()
        ->from('SfGuardUser u')
      	->where('u.username = "'.$json['username'].'"')
      	->fetchOne();
    if(!$user)
    {
      echo json_encode(array("success"=>false,"error"=>"Invalid username"));
      die();
    }

    //validate password
    $password=sha1($user->getSalt().$json['password']);
    if($password!=$user->getPassword())
    {
      echo json_encode(array("success"=>false,"error"=>"Invalid password"));
      die();
    }

	//create output data
	$output=array("success"=>true,"message"=>"Welcome");
	
    //create data array to be sent back to android app
    $this->getResponse()->setHttpHeader('Content-type','application/json');
    echo json_encode($output);

    die();

  }
}
