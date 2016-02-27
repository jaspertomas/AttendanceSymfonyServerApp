<?php
class MyDecimal
{
  public static function format($amount)
  {
    $amount=str_replace(",","",$amount);
    return number_format($amount,2,".",",");
  }
}
