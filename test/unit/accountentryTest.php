<?php
//usage: php symfony test:unit accountentry
 
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
$t = new lime_test(12, new lime_output_color());
 
$t->diag('Tests for class Accountentry');

//GetAccount()
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
    $entry->delete();
}
$account->calc();

//fill with new entries
//add entry in the middle with existing date: no problem
$qty=2;
$ref_class=null;
$ref_id=null;
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

$accountentries=Doctrine_Query::create()
  ->from('Accountentry s')
  ->where('account_id='.$account->getId())
  ->orderBy('date, priority')
  ->execute();
$lastentryid=$accountentries[count($accountentries)-1]->getId();
$firstentryid=$accountentries[0]->getId();
$currententryid=$accountentries[2]->getId();
$accountentry= Doctrine_Query::create()
  ->from('Accountentry s')
  ->where('id='.$lastentryid)
  ->fetchOne();

$t->is(get_class($account), "Account", 'getAccount() fetches a accountentrys account object');
$t->is($account->getId(), $accountentry->getAccountId(), 'getAccount() fetches a accountentrys account object');


$t->diag('Test behavior of navigation functions against first entry');
$accountentry= Doctrine_Query::create()
  ->from('Accountentry s')
  ->where('id='.$firstentryid)
  ->fetchOne();
$t->is($accountentry->getPrevious(), null, 'There is no record before the first record');
$t->is($accountentry->getNext()->getId(), $accountentries[1]->getId(), 'The record after the first record has id '.$accountentries[1]->getId());
$t->is($accountentry->getLast()->getId(), $lastentryid, 'The last record = $lastentryid ');

$t->diag('Test behavior of navigation functions against middle entry');
$accountentry= Doctrine_Query::create()
  ->from('Accountentry s')
  ->where('id='.$currententryid)
  ->fetchOne();
$t->is($accountentry->getPrevious()->getId(), $accountentries[1]->getId(), 'The record before the middle record has id '.$accountentries[1]->getId());
$t->is($accountentry->getNext()->getId(), $accountentries[3]->getId(), 'The record after the middle record has id '.$accountentries[3]->getId());
$t->is($accountentry->getLast()->getId(), $lastentryid, 'The last record = $lastentryid ');

$t->diag('Test behavior of navigation functions against last entry');
$accountentry= Doctrine_Query::create()
  ->from('Accountentry s')
  ->where('id='.$lastentryid)
  ->fetchOne();
$t->is($accountentry->getPrevious()->getId(),  $accountentries[count($accountentries)-2]->getId() , 'The record before the last record has id '.$accountentries[count($accountentries)-2]->getId());
$t->is($accountentry->getNext(), null, 'There is no record after the last record');
$t->is($accountentry->getLast()->getId(), $lastentryid, 'The last record = $lastentryid ');


//Delete()
//Insert()



