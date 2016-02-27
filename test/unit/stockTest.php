<?php
//usage: php symfony test:unit stock
 
//include(dirname(__FILE__).'/../bootstrap/unit.php');
include(dirname(__FILE__).'/../bootstrap/Doctrine.php');

/* 
// Stub objects and functions for test purposes
class stockTest
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

 
$t->diag('Tests for class Stock');

//test getstockentries()
$stock= Doctrine_Query::create()
  ->from('Stock s')
  ->fetchOne();

$t->diag('Stock ID = '.$stock->getId());

//maintainance
$stockentries=$stock->getstockentries();  
//delete all entries
foreach($stockentries as $entry)
{
  //if($entry->getRefClass()==null)
    $entry->cascadeDelete();
}
$stock->calc();



//fill with new entries
//add entry in the middle with existing date: no problem
$qty=2;
$ref_class=null;
$ref_id=null;
$date='2010-05-01';
$addedentries[]=$stock->addEntry($date, $qty, $ref_class, $ref_id);

//test: add new entry to empty stock
$t->is($resultok=$stock->testEntries(), true , 'adding entry to empty stock');

$addedentries[0]->delete();
$t->is($resultok=$stock->testEntries(), true , 'deleting lone entry');

//reset entry holder
$addedentries=array();

//filling database with entries
$date='2010-05-01';
$stock->addEntry($date, $qty, $ref_class, $ref_id);
$stock->addEntry($date, $qty, $ref_class, $ref_id);
$date='2010-06-01';
$stock->addEntry($date, $qty, $ref_class, $ref_id);
$stock->addEntry($date, $qty, $ref_class, $ref_id);
$date='2010-07-01';
$stock->addEntry($date, $qty, $ref_class, $ref_id);
$stock->addEntry($date, $qty, $ref_class, $ref_id);
$t->is($resultok=$stock->testEntries(), true , 'maintainance phase completed successfully');
//end maintainance

$stockentries=$stock->getstockentries();  

$t->diag('getStockEntries()');
$t->is(get_class($stockentries), "Doctrine_Collection", 'getstockentries() fetches a Doctrine_Collection of Stockentry objects');

if (count($stockentries)==0)
{
  $t->skip('getstockentries() fetches an array of Stockentry objects');
}
else
{
  $t->is(get_class($stockentries[0]), "Stockentry", 'getstockentries() fetches a Doctrine_Collection of Stockentry objects');
}

//test getFirstEntry()
$t->diag('getFirstEntry()');
$first=$stock->getFirstEntry();  
$t->is($first->getId(), $stockentries[0]->getId(), 'getFirstEntry() fetches the first entry');

//test getLastEntry()
$t->diag('getLastEntry()');
$last=$stock->getLastEntry();  
$t->is($last->getId(), $stockentries[count($stockentries)-1]->getId(), 'getLastEntry() fetches the last entry');


//-----------------------------------------------
//this should fix balances of entries, even after being messed up
$t->diag('calcFromStockentry()');

//calcfromstockentry should set balance of first record to qty, if it is null
$first->setBalance(null);
$first->save();

//fix it
$stock->calcFromStockEntry($first);  

$t->is($first["balance"], $first["qty"], 'balance of first entry is set to qty');

//-----------------------------------
$first=$stock->getFirstEntry();  
$last=$stock->getLastEntry();  

//mess up second entry, and use that to calc. calculation should start from first entry.
$second=$stockentries[1];
$second->setBalance(null);
$second->save();

//fix it
$stock->calcFromStockEntry($second);  
$t->is($second["balance"], $first["balance"]+$second["qty"], 'if entry passed to calcFromStockEntry has balance = null, calcFromStockEntry uses balance of previous entry');

//-----------------------------------
//calculate total balance manually, and compare

$stockentries=$stock->getstockentries();  
$finalbalance=0;
foreach($stockentries as $entry)
  $finalbalance+=$entry->getQty();

$last->setBalance(null);
$last->save();

$stock->calcFromStockEntry($first);  

$t->is($last["balance"], $finalbalance, 'last entry\'s balance should be correct');


//---------------------------------------------
//test updateFromLastEntry()
$t->diag('updateFromLastEntry()');
$stock["date"]="2010-01-01";//dummy date
$stock["currentqty"]="-99";//dummy qty
$stock->updateFromLastEntry();  
$t->is($stock["date"], $last->getDate(), 'updateFromLastEntry() copies date of last entry onto stock object');
$t->is($stock["currentqty"], $last->getBalance()==null?0:$last->getBalance(), 'updateFromLastEntry() copies qty of last entry onto stock object');
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
$addedentries[]=$stock->addEntry($date, $qty, $ref_class, $ref_id);
$t->is($resultok=$stock->testEntries(), true , 'addEntry before all records');
}

if($resultok)
{
//add entry to first record date: no problem
//same date
$date='2010-01-01';
$qty=2;
$ref_class=null;
$ref_id=null;
$addedentries[]=$stock->addEntry($date, $qty, $ref_class, $ref_id);
$t->is($resultok=$stock->testEntries(), true , 'add entry same date as first record');

}

if($resultok)
{
//add entry after all records: no problem
$date='2011-01-01';
$qty=2;
$ref_class=null;
$ref_id=null;
$addedentries[]=$stock->addEntry($date, $qty, $ref_class, $ref_id);
$t->is($resultok=$stock->testEntries(), true , 'add entry after all records');

}

if($resultok)
{
//add entry to last record date: no problem
$date='2011-01-01';
$qty=2;
$ref_class=null;
$ref_id=null;
$addedentries[]=$stock->addEntry($date, $qty, $ref_class, $ref_id);
$t->is($resultok=$stock->testEntries(), true , 'add entry same date as last record');

}

if($resultok)
{
//add entry in the middle with existing date: no problem
$date='2010-06-01';
$qty=2;
$ref_class=null;
$ref_id=null;
$addedentries[]=$stock->addEntry($date, $qty, $ref_class, $ref_id);
$t->is($resultok=$stock->testEntries(), true , 'add entry in the middle with existing date');

}

if($resultok)
{
//add entry in the middle with no existing date
$date='2010-06-05';
$qty=2;
$ref_class=null;
$ref_id=null;
$addedentries[]=$stock->addEntry($date, $qty, $ref_class, $ref_id);
$t->is($resultok=$stock->testEntries(), true , 'add entry in the middle with no existing date');
}

//delete added entries
foreach($addedentries as $entry)
{
  if($resultok)
  {
    $previous=$entry->getPrevious();
    $entry->delete();
    $t->is($resultok=$stock->testEntries(), true , 'deleting entry '.($previous?"after ".$previous->getId():"first"));
  }
}

