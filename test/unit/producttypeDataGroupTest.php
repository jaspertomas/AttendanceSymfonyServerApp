<?php
 
//include(dirname(__FILE__).'/../bootstrap/unit.php');
//include(dirname(__FILE__).'/../../config/config.php');
//require_once($sf_symfony_lib_dir.'/util/sfCore.class.php');
//sfCore::initSimpleAutoload($sf_symfony_lib_dir.'/util');

//sfCore::initSimpleAutoload(array(
	//SF_ROOT_DIR.'/lib/model', 
	//$sf_symfony_lib_dir.'/vendor/propel'
	//)); 
//set_include_path($sf_symfony_lib_dir.'/vendor'.PATH_SEPARATOR.SF_ROOT_DIR.PATH_SEPARATOR.get_include_path()

 
// Stub objects and functions for test purposes
class producttypeDataGroupTest
{
  public function myMethod()
  {
  }
}
 
function throw_an_exception()
{
  throw new Exception('exception thrown');
}
 
// Initialize the test object
$t = new lime_test(2, new lime_output_color());
 
$t->diag('Tests for MyDateTime');
$t->isa_ok(MyDateTime::today(),"MyDateTime","MyDateTime::today() returns a MyDateTime object");
$t->is(MyDateTime::today()->toprettydate(),"November 16, 2010","MyDateTime::today() returns current date in format of November 16, 2010");

