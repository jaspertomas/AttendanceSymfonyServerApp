<?php
class MyDate
{
  public static function today() { 
    $today = getdate(); 
    return $today['year']."-".$today['mon']."-".$today['mday'];
  }
}
