<?php

require_once dirname(__FILE__).'/../lib/account_entryGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/account_entryGeneratorHelper.class.php';

/**
 * account_entry actions.
 *
 * @package    sf_sandbox
 * @subpackage account_entry
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class account_entryActions extends autoAccount_entryActions
{
  public function executeNew(sfWebRequest $request)
  {
    $this->account_entry = new AccountEntry();
    $this->account_entry->setDate(MyDate::today());

    //set invoice no if param invno is present
    if($request->getParameter("account_id"))
    {
      $this->account_entry->setAccountId($request->getParameter("account_id"));
    }
    $this->form = $this->configuration->getForm($this->account_entry);
  }
}
