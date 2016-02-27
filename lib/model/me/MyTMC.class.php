<?php

class MyTMC
{
  public static $code=array("X","S","U","N","F","L","O","W","E","R",);
  public static function encode($value)
  {
    //convert to string
    $value=MyDecimal::format($value,",",".")."";
    $strlen=strlen($value);
    foreach(range(0,$strlen-1) as $count)
    {
      if($value[$count]=="." or $value[$count]==",")continue;
      $value[$count]=self::$code[$value[$count]];
    }
    return $value;
  }
}

