<?php

class MyBarcode
{
  public static function standardize($str)
  {
    $str=str_pad($str,12,"0",STR_PAD_LEFT);

  	$sum=($str[1]+$str[3]+$str[5]+$str[7]+$str[9]+$str[11])*3+
        	$str[0]+$str[2]+$str[4]+$str[6]+$str[8]+$str[10];
  	$checksum=10-($sum%10);
  	if($checksum==10)$checksum=0;
  	return $str.$checksum;
  }
}

