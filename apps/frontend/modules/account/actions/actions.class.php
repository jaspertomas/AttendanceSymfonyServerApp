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
  /*
  //-------------SALES REPORT--------------
  public function executeSalesReport(sfWebRequest $request)
  {
  	// if id not specified, get latest
    $this->account = Doctrine::getTable('Account')->find(array($request->getParameter('id')));
    if(!$this->account)
    {
      return $this->redirect('home/error?msg=Sorry, that account does not exist');
    }
//    $this->salesReport($account);
  }
  private function salesReport($account)
  {
    $this->invoices = $account->getInvoice();
    //$this->invoices = InvoiceTable::fetchByDateRange($account->getStartdate(),$account->getEnddate());
    //$this->events = EventTable::fetchByDatenParentclass($invoice->getDate(),"Invoice");


    //calculations start
    $this->totalsales=0;
    $this->totalpaid=0;
    $this->totalcash=0;
    $this->totalunpaid=0;
    $this->totalcheque=0;
    $this->products=array();
    foreach($this->invoices as $invoice)
    {
    	if($invoice->getStatus()!="Cancelled")
        $this->totalsales+=$invoice->getTotal();
    	if($invoice->getStatus()=="Paid")
      {
        $this->totalpaid+=$invoice->getTotal();
      	if($invoice->getSaleType()=="Cheque")
        {
          $this->totalcheque+=$invoice->getTotal();
      	}
      	else
      	{
          $this->totalcash+=$invoice->getTotal();
      	}
    	}
    	elseif($invoice->getStatus()=="Pending")
    	{
        $this->totalunpaid+=$invoice->getTotal();
    	}
      
      //count total products sold per product
	    foreach($invoice->getInvoicedetails() as $detail)
	    {
	      if(!isset($this->products[$detail->getProduct()->getName()]))
	    		$this->products[$detail->getProduct()->getName()]=0;
	      $this->products[$detail->getProduct()->getName()]+=$detail->getQty();
	    }
    }

    $this->account=$account;
  }
  
  //-------------------EVENT REPORT-----------------------------------
  public function executeEventReport(sfWebRequest $request)
  {
  	// if id not specified, get latest
  	if(!$request->hasParameter('id'))
  	{
	    $account=Doctrine_Query::create()
	        ->from('Account o')
	      	->orderBy('startdate desc')
	      	->fetchOne();
  	}
	  else
	  {
	    $account = Doctrine::getTable('Account')->find(array($request->getParameter('id')));
      $this->account=$account;
	    if(!$account)
	    {
	      return $this->redirect('home/error?msg=Sorry, that event does not exist');
	    }
	  }  
	  $this->incomeStatement($account);
	  $this->salesReport($account);
	  $this->expenseReport($account);
  }
  //-------------------INCOME STATEMENT-----------------------------------
  public function executeIncomeStatement(sfWebRequest $request)
  {
  	// if id not specified, get latest
  	if(!$request->hasParameter('id'))
  	{
	    $account=Doctrine_Query::create()
	        ->from('Account o')
	      	->orderBy('startdate desc')
	      	->fetchOne();
  	}
	  else
	  {
	    $account = Doctrine::getTable('Account')->find(array($request->getParameter('id')));
      $this->account=$account;
	    if(!$account)
	    {
	      return $this->redirect('home/error?msg=Sorry, that event does not exist');
	    }
	  }  
	  $this->incomeStatement($account);
  }
  private function incomeStatement($account)
  {
	  //read all accounts from database
    $this->accounts=Doctrine_Query::create()
        ->from('Account a')
      	->execute();
	  
	  //load this event's account entries from database
    //arrange account entries into an array by account
    $entriesByAccount = array();
    foreach($account->getAccountEntry() as $entry)
    {
      $entriesByAccount[$entry->getAccountId()][]=$entry;
    }
    $this->entriesByAccount=$entriesByAccount;

    //calculate total for each account
    $totalsByAccount = array();
    foreach($entriesByAccount as $account_id => $ledger)
    {
      $total=0;
      foreach($ledger as $entry)
      {
        $total+=$entry->getAmount();
      }
      $totalsByAccount[$account_id]=$total;
    }
    $this->totalsByAccount=$totalsByAccount;

    $this->accountTypes=array(
      1=>"Assets",
      //2=>"Liabilities",
      //3=>"Capital",
      4=>"Income",
      5=>"Expenses"
      );
    
    //calculate total assets, income, expense
    $totalsByAccountType = array();
    foreach($this->accountTypes as $accttype_id=>$accttype)
    {
      $total=0;
      foreach($this->accounts as $account)if($account->getAccountTypeId()==$accttype_id)
      {
        $total+=$totalsByAccount[$account->getId()];
      }
      $totalsByAccountType[$accttype_id]=$total;
    }
    $this->totalsByAccountType=$totalsByAccountType;
    
    $this->totalIncome=$totalsByAccountType[AccountTable::$INCOME];
    $this->totalExpense=$totalsByAccountType[AccountTable::$EXPENSE];
    $this->totalProfit=$this->totalIncome-$this->totalExpense;
  }
  //--------EXPENSE REPORT---------------
  public function executeExpenseReport(sfWebRequest $request)
  {
    $account = Doctrine::getTable('Account')->find(array($request->getParameter('id')));
    $this->account=$account;
    if(!$account)
    {
      return $this->redirect('home/error?msg=Sorry, that event does not exist');
    }
    $this->expenseReport($account);
  }
  
  private function expenseReport($account)
  {
    $this->vouchers=$account->getVoucher();	  
    
    $this->total=0;
    foreach($this->vouchers as $voucher)
      $this->total+=$voucher->getAmount();    
  
  }
  //-----------PDF----------------
  public function executeEventReportPdf(sfWebRequest $request)
  {
    $this->executeEventReport($request);

    $this->download=true;//$request->getParameter('download');
    $this->setLayout(false);
    $this->getResponse()->setContentType('pdf');
  }
  public function executeSalesReportPdf(sfWebRequest $request)
  {
    $this->executeSalesReport($request);

    $this->download=true;//$request->getParameter('download');
    $this->setLayout(false);
    $this->getResponse()->setContentType('pdf');
  }
  public function executeIncomeStatementPdf(sfWebRequest $request)
  {
    $this->executeIncomeStatement($request);

    $this->download=true;//$request->getParameter('download');
    $this->setLayout(false);
    $this->getResponse()->setContentType('pdf');
  }
  public function executeExpenseReportPdf(sfWebRequest $request)
  {
    $this->executeExpenseReport($request);

    $this->download=true;//$request->getParameter('download');
    $this->setLayout(false);
    $this->getResponse()->setContentType('pdf');
  }
  */
}
