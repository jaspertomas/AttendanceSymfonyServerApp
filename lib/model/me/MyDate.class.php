<?php
class MyDate
{
  public static function today() { 
    $today = getdate(); 
    return $today['year']."-".str_pad($today['mon'],2,"0",STR_PAD_LEFT)."-".str_pad($today['mday'],2,"0",STR_PAD_LEFT);
  }
}
