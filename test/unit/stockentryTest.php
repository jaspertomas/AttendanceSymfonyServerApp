<?php
//usage: php symfony test:unit stockentry
 
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
$t = new lime_test(12, new lime_output_color());
 
$t->diag('Tests for class Stockentry');

//GetStock()
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
    $entry->delete();
}
$stock->calc();

//fill with new entries
//add entry in the middle with existing date: no problem
$qty=2;
$ref_class=null;
$ref_id=null;
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

$stockentries=Doctrine_Query::create()
  ->from('Stockentry s')
  ->where('stock_id='.$stock->getId())
  ->orderBy('date, priority')
  ->execute();
$lastentryid=$stockentries[count($stockentries)-1]->getId();
$firstentryid=$stockentries[0]->getId();
$currententryid=$stockentries[2]->getId();
$stockentry= Doctrine_Query::create()
  ->from('Stockentry s')
  ->where('id='.$lastentryid)
  ->fetchOne();

$t->is(get_class($stock), "Stock", 'getStock() fetches a stockentrys stock object');
$t->is($stock->getId(), $stockentry->getStockId(), 'getStock() fetches a stockentrys stock object');


$t->diag('Test behavior of navigation functions against first entry');
$stockentry= Doctrine_Query::create()
  ->from('Stockentry s')
  ->where('id='.$firstentryid)
  ->fetchOne();
$t->is($stockentry->getPrevious(), null, 'There is no record before the first record');
$t->is($stockentry->getNext()->getId(), $stockentries[1]->getId(), 'The record after the first record has id '.$stockentries[1]->getId());
$t->is($stockentry->getLast()->getId(), $lastentryid, 'The last record = $lastentryid ');

$t->diag('Test behavior of navigation functions against middle entry');
$stockentry= Doctrine_Query::create()
  ->from('Stockentry s')
  ->where('id='.$currententryid)
  ->fetchOne();
$t->is($stockentry->getPrevious()->getId(), $stockentries[1]->getId(), 'The record before the middle record has id '.$stockentries[1]->getId());
$t->is($stockentry->getNext()->getId(), $stockentries[3]->getId(), 'The record after the middle record has id '.$stockentries[3]->getId());
$t->is($stockentry->getLast()->getId(), $lastentryid, 'The last record = $lastentryid ');

$t->diag('Test behavior of navigation functions against last entry');
$stockentry= Doctrine_Query::create()
  ->from('Stockentry s')
  ->where('id='.$lastentryid)
  ->fetchOne();
$t->is($stockentry->getPrevious()->getId(),  $stockentries[count($stockentries)-2]->getId() , 'The record before the last record has id '.$stockentries[count($stockentries)-2]->getId());
$t->is($stockentry->getNext(), null, 'There is no record after the last record');
$t->is($stockentry->getLast()->getId(), $lastentryid, 'The last record = $lastentryid ');


//Delete()
//Insert()



