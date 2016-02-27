<?php

class myUser extends sfGuardSecurityUser
{
  public function initialize(sfEventDispatcher $dispatcher, sfStorage $storage, $options = array())
  {
    // disable timeout
    $options['timeout'] = false;
    parent::initialize($dispatcher, $storage, $options);
  }
}
