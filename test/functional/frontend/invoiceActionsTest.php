<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');
/*
$browser = new sfTestFunctional(new sfBrowser());

$browser->
  get('/invoice/index')->

  with('request')->begin()->
    isParameter('module', 'invoice')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->
    checkElement('body', '!/This is a temporary page/')->
  end()
;
*/
$b = new sfTestBrowser();   
$b->initialize();
$b->get('/customer/new')->
		setField('customer[name]', 'dummy')->
    click('Save')->
  with('response')->begin()->
    isRedirected()->   // Check that request is redirected
    followRedirect()->    // Manually follow the redirection
  end()->
  with('request')->begin()->
//    isParameter('id', '1')->
    isParameter('name', 'dummy')->
    isParameter('module', 'customer')->
    isParameter('action', 'edit')->
  end();

$request  = $b->getRequest();
$context  = $b->getContext();
$response = $b->getResponse();
foreach($request as $key=>$value)
{
	echo $key."=>".$value;
}


/*
//--------------------calling pages--------------------
// Create a new test browser
$b = new sfTestBrowser();
$b->initialize();
 
$b->get('/foobar/show/id/1');                   // GET request
$b->post('/foobar/show', array('id' => 1));     // POST request
 
// The get() and post() methods are shortcuts to the call() method
$b->call('/foobar/show/id/1', 'get');
$b->call('/foobar/show', 'post', array('id' => 1));
 
// The call() method can simulate requests with any method
$b->call('/foobar/show/id/1', 'head');
$b->call('/foobar/add/id/1', 'put');
//$b->call('/foobar/delete/id/1', 'delete');
*/

/*
//--------------------clicking browser buttons--------------------
$b->get('/');                  // Request to the home page
$b->get('/foobar/show/id/1');
$b->back();                    // Back to one page in history
$b->forward();                 // Forward one page in history
$b->reload();                  // Reload current page
$b->click('go');               // Look for a 'go' link or button and click it*/

/*
// --------------------filling a form and posting: 3 ways--------------------

// Example template in modules/foobar/templates/editSuccess.php
<?php echo form_tag('foobar/update') ?>
  <?php echo input_hidden_tag('id', $sf_params->get('id')) ?>
  <?php echo input_tag('name', 'foo') ?>
  <?php echo submit_tag('go') ?>
  <?php echo textarea('text1', 'foo') ?>
  <?php echo textarea('text2', 'bar') ?>
</form>


// Example functional test for this form
$b = new sfTestBrowser();
$b->initialize();
$b->get('/foobar/edit/id/1');
 
// Option 1: POST request
$b->post('/foobar/update', array('id' => 1, 'name' => 'dummy', 'commit' => 'go'));
 
// Option 2: Click the submit button with parameters
$b->click('go', array('name' => 'dummy'));
 
// Option 3: Enter the form values field by field name then click the submit button
$b->setField('name', 'dummy')->
    click('go');
*/

/*
//------------------------How to follow redirects--------------------
// Example action in modules/foobar/actions/actions.class.php
public function executeUpdate()
{
  ...
  $this->redirect('foobar/show?id='.$this->getRequestParameter('id'));
}
 
// Example functional test for this action
$b = new sfTestBrowser();   
$b->initialize();
$b->get('/foobar/edit?id=1')->
    click('go', array('name' => 'dummy'))->
    isRedirected()->   // Check that request is redirected
    followRedirect();    // Manually follow the redirection
*/
/*
//--------------------how to simulate a browser restart: --------------------
$b->restart()

//--------------------how to get vars--------------------
$request  = $b->getRequest();
$context  = $b->getContext();
$response = $b->getResponse();
*/


