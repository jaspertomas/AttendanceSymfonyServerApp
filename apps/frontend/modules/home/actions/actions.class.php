<?php

/**
 * home actions.
 *
 * @package    sf_sandbox
 * @subpackage home
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
	}
  public function executeError(sfWebRequest $request)
  {
  	$this->msg=$request->getParameter("msg");
  }
}
