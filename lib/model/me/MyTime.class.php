<?php
class MyTime
{
  static function totalminutestotime($totalminute)
  {
    $m="AM";
    $minute=$totalminute%60;
    $hour=$totalminute/60;
    if($hour>12)
    {
      $m="PM";
      $hour=$hour-12;
    }
    return array("hour"=>$hour,"minute"=>$minute,"m"=>$m);
  }
  static function timetototalminutes($hour,$minute,$m)
  {
      $total_minute=$hour*60+$minute;
      if($m=="PM")
        $total_minute+=12*60;//afternoon
      return $total_minute;
  }
  
	//this function converts 1330 into "1:30 PM"  
	static function militaryTimeToOrdinary($time)
	{
		return self::timeToString($time);
	}
	static function timeToString($time)
	{
	  $m="AM";
	  $hour=floor($time/100);
	  if($hour==24)
	  {
	    $hour=12;
	    $m="AM";
	  }
	  elseif($hour==12)
	  {
	    $m="PM";
	  }
	  elseif($hour>12)
	  {
	    $hour=$hour-12;
	    $m="PM";
	  }
	  $minute=$time%100;
	  return $hour.":".str_pad($minute, 2, "0", STR_PAD_LEFT)." ".$m;
	}
	
	//this function returns military time
	static function toMilitary($hour,$minute,$m)
	{
		if($hour==12)$hour=0;
		if($m=='PM')$hour+=12;
		return $hour.str_pad($minute, 2, "0", STR_PAD_LEFT);		
	}
	  
	//this function returns number of minutes between 2 times
	static function timeToMinutes($time1,$time2)
	{
	  $hour1=floor($time1/100);
	  $minute1=$time1%100;
	  
	  $hour2=floor($time2/100);
	  $minute2=$time2%100;
	  
	  $time1=$hour1*60+$minute1;
	  $time2=$hour2*60+$minute2;
	  
	  return abs($time1-$time2);
	}
}

