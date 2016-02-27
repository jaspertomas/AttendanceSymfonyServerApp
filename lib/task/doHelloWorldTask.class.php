<?php

class doHelloWorldTask extends sfBaseTask
{
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = '';
    $this->name             = 'doHelloWorld';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [doHelloWorld|INFO] task does things.
Call it with:

  [php symfony doHelloWorld|INFO]
EOF;

$this->addArgument('verb', sfCommandArgument::OPTIONAL, 'Customize the verb used to say hello', 'hello');
    $this->addOption('name', null, sfCommandOption::PARAMETER_OPTIONAL, 'Customize the person to say hello to', 'world');
 
    $this->namespace        = 'project';
    $this->name             = 'hello-world';
    $this->briefDescription = 'Spread the (hello) world';
 
    $this->detailedDescription = <<<EOF
Runs an evolved hello world display, with customisable name and word.
EOF;

$myOtherTask = new doNothingTask($this->dispatcher, $this->formatter);
$myOtherTask->run();
//$myOtherTask->run($arguments = array('foo' => 'bar'), $options = array('far' => 'boo'));
  }

  protected function execute($arguments = array(), $options = array())
  {
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    // add your code here
    $this->logSection('do', ucfirst($arguments['verb']).' '.ucfirst($options['name']));
  }
}
