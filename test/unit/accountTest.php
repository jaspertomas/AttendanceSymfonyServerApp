<?php
//usage: php symfony test:unit account
 
//include(dirname(__FILE__).'/../bootstrap/unit.php');
include(dirname(__FILE__).'/../bootstrap/Doctrine.php');

/* 
// Stub objects and functions for test purposes
class accountTest
{
  public function myMethod()
  {
  }
}
 
function throw_an_exception()
{
  throw new Exception('exception thrown');
}
 */
 
// Initialize the test object
$t = new lime_test(24, new lime_output_color());

//this means no problems so far, please continue
$resultok=true;
$addedentries=array();

 
$t->diag('Tests for class Account');

//test getaccountentries()
$account= Doctrine_Query::create()
  ->from('Account s')
  ->fetchOne();

$t->diag('Account ID = '.$account->getId());

//maintainance
$accountentries=$account->getaccountentries();  
//delete all entries
foreach($accountentries as $entry)
{
  //if($entry->getRefClass()==null)
    $entry->cascadeDelete();
}
$account->calc();



//fill with new entries
//add entry in the middle with existing date: no problem
$qty=2;
$ref_class=null;
$ref_id=null;
$date='2010-05-01';
$addedentries[]=$account->addEntry($date, $qty, $ref_class, $ref_id);

//test: add new entry to empty account
$t->is($resultok=$account->testEntries(), true , 'adding entry to empty account');

$addedentries[0]->delete();
$t->is($resultok=$account->testEntries(), true , 'deleting lone entry');

//reset entry holder
$addedentries=array();

//filling database with entries
$date='2010-05-01';
$account->addEntry($date, $qty, $ref_class, $ref_id);
$account->addEntry($date, $qty, $ref_class, $ref_id);
$date='2010-06-01';
$account->addEntry($date, $qty, $ref_class, $ref_id);
$account->addEntry($date, $qty, $ref_class, $ref_id);
$date='2010-07-01';
$account->addEntry($date, $qty, $ref_class, $ref_id);
$account->addEntry($date, $qty, $ref_class, $ref_id);
$t->is($resultok=$account->testEntries(), true , 'maintainance phase completed successfully');
//end maintainance

$accountentries=$account->getaccountentries();  

$t->diag('getAccountEntries()');
$t->is(get_class($accountentries), "Doctrine_Collection", 'getaccountentries() fetches a Doctrine_Collection of Accountentry objects');

if (count($accountentries)==0)
{
  $t->skip('getaccountentries() fetches an array of Accountentry objects');
}
else
{
  $t->is(get_class($accountentries[0]), "Accountentry", 'getaccountentries() fetches a Doctrine_Collection of Accountentry objects');
}

//test getFirstEntry()
$t->diag('getFirstEntry()');
$first=$account->getFirstEntry();  
$t->is($first->getId(), $accountentries[0]->getId(), 'getFirstEntry() fetches the first entry');

//test getLastEntry()
$t->diag('getLastEntry()');
$last=$account->getLastEntry();  
$t->is($last->getId(), $accountentries[count($accountentries)-1]->getId(), 'getLastEntry() fetches the last entry');


//-----------------------------------------------
//this should fix balances of entries, even after being messed up
$t->diag('calcFromAccountentry()');

//calcfromaccountentry should set balance of first record to qty, if it is null
$first->setBalance(null);
$first->save();

//fix it
$account->calcFromAccountEntry($first);  

$t->is($first["balance"], $first["qty"], 'balance of first entry is set to qty');

//-----------------------------------
$first=$account->getFirstEntry();  
$last=$account->getLastEntry();  

//mess up second entry, and use that to calc. calculation should start from first entry.
$second=$accountentries[1];
$second->setBalance(null);
$second->save();

//fix it
$account->calcFromAccountEntry($second);  
$t->is($second["balance"], $first["balance"]+$second["qty"], 'if entry passed to calcFromAccountEntry has balance = null, calcFromAccountEntry uses balance of previous entry');

//-----------------------------------
//calculate total balance manually, and compare

$accountentries=$account->getaccountentries();  
$finalbalance=0;
foreach($accountentries as $entry)
  $finalbalance+=$entry->getQty();

$last->setBalance(null);
$last->save();

$account->calcFromAccountEntry($first);  

$t->is($last["balance"], $finalbalance, 'last entry\'s balance should be correct');


//---------------------------------------------
//test updateFromLastEntry()
$t->diag('updateFromLastEntry()');
$account["date"]="2010-01-01";//dummy date
$account["currentqty"]="-99";//dummy qty
$account->updateFromLastEntry();  
$t->is($account["date"], $last->getDate(), 'updateFromLastEntry() copies date of last entry onto account object');
$t->is($account["currentqty"], $last->getBalance()==null?0:$last->getBalance(), 'updateFromLastEntry() copies qty of last entry onto account object');
//$last->getBalance()==null?0:$last->getBalance() because default value is 0

//---------------------------------------------

//test addEntry
//add entry before any records: no problem
if($resultok)
{
$date='2010-01-01';
$qty=2;
$ref_class=null;
$ref_id=null;
$addedentries[]=$account->addEntry($date, $qty, $ref_class, $ref_id);
$t->is($resultok=$account->testEntries(), true , 'addEntry before all records');
}

if($resultok)
{
//add entry to first record date: no problem
//same date
$date='2010-01-01';
$qty=2;
$ref_class=null;
$ref_id=null;
$addedentries[]=$account->addEntry($date, $qty, $ref_class, $ref_id);
$t->is($resultok=$account->testEntries(), true , 'add entry same date as first record');

}

if($resultok)
{
//add entry after all records: no problem
$date='2011-01-01';
$qty=2;
$ref_class=null;
$ref_id=null;
$addedentries[]=$account->addEntry($date, $qty, $ref_class, $ref_id);
$t->is($resultok=$account->testEntries(), true , 'add entry after all records');

}

if($resultok)
{
//add entry to last record date: no problem
$date='2011-01-01';
$qty=2;
$ref_class=null;
$ref_id=null;
$addedentries[]=$account->addEntry($date, $qty, $ref_class, $ref_id);
$t->is($resultok=$account->testEntries(), true , 'add entry same date as last record');

}

if($resultok)
{
//add entry in the middle with existing date: no problem
$date='2010-06-01';
$qty=2;
$ref_class=null;
$ref_id=null;
$addedentries[]=$account->addEntry($date, $qty, $ref_class, $ref_id);
$t->is($resultok=$account->testEntries(), true , 'add entry in the middle with existing date');

}

if($resultok)
{
//add entry in the middle with no existing date
$date='2010-06-05';
$qty=2;
$ref_class=null;
$ref_id=null;
$addedentries[]=$account->addEntry($date, $qty, $ref_class, $ref_id);
$t->is($resultok=$account->testEntries(), true , 'add entry in the middle with no existing date');
}

//delete added entries
foreach($addedentries as $entry)
{
  if($resultok)
  {
    $previous=$entry->getPrevious();
    $entry->delete();
    $t->is($resultok=$account->testEntries(), true , 'deleting entry '.($previous?"after ".$previous->getId():"first"));
  }
}

