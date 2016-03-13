<?php

date_default_timezone_set( 'Asia/Manila' );
require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'prod', false);
sfContext::createInstance($configuration)->dispatch();
