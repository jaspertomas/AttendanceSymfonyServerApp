<?php
class MyDateTime
{
  /*
  Usage:
    echo MyDateTime::fromdatetime("2003-10-10 20:12:13");
    echo MyDateTime::frommysql("2003-10-10");
    echo MyDateTime::today();
    echo new MyDateTime(2001,2,3,4,5,6);

  */
  private $timestamp=0;
  function __construct($year,$month,$day,$hour,$minute,$second) {$this->timestamp=mktime($hour, $minute, $second, $month, $day, $year);}

  function isvalid() { if($this->timestamp==0)return false;else return true; } 
  static function emptydate() { $date = new MyDateTime(0,0,0,0,0,0);$date->timestamp=0; return $date;} 
  static function today() { $today = getdate(); return new MyDateTime($today['year'],$today['mon'],$today['mday'],$today['hours'],$today['minutes'],$today['seconds']); 
  /* [year] => 2003 [mon] => 6 [month] => June [yday] => 167 [mday] => 17 [wday] => 2 [weekday] => Tuesday [hours] => 21 [minutes] => 58 [seconds] => 40 [0] => 1055901520 $this->year=$today['year']; //2003 $this->month=$today['mon']; //6 $this->yearday=$today['yday']; //167 $this->mday=$today['mday']; //17 $this->weekday=$today['wday']; //2 $this->hour=; //21 $this->minute=; //68 $this->second=; //40 $this->timestamp=$today['0']; //1055901520 return $this; */ } 

  static function frommysql($string) { if(MyTools::slugify($string)=="" or MyTools::slugify($string)=="n-a") return self::emptydate(); $array=explode("-",$string); return new MyDateTime($array[0],$array[1],$array[2],0,0,0); } 
  static function fromymd($year,$month,$day) { return new MyDateTime($year,$month,$day,0,0,0); } 
  static function frommdy($month,$day,$year) { return new MyDateTime($year,$month,$day,0,0,0); } 
  static function fromdatetime($string) 
  { 
    if(MyTools::slugify($string)=="" or MyTools::slugify($string)=="n-a") 
      return self::emptydate(); 
    
    $array=explode(" ",$string); 
    $datearray=explode("-",$array[0]);
    
    //if there is an $array[1]], continue
    if(count($array)>1)
      $timearray=explode(":",$array[1]);
    else
      $timearray=array(0,0,0);  
       
    return new MyDateTime($datearray[0],$datearray[1],$datearray[2],$timearray[0],$timearray[1],$timearray[2]); 
  } 
  static function fromdate($string)
  {
    if(MyTools::slugify($string)=="" or MyTools::slugify($string)=="n-a") 
      return self::emptydate(); 

    $array=explode(" ",$string); 
    $datearray=explode("-",$array[0]);

    return new MyDateTime($datearray[0],$datearray[1],$datearray[2],0,0,0); 
  } 
  static function fromtimestamp($timestamp) {$date=self::emptydate();$date->timestamp=$timestamp;return $date;}

  function totimestamp() { return $this->timestamp; }
  function __toString() 
  {
    if($this->timestamp==0)
      return "00-00-00 00:00:00"; 
    return date("F d, Y h:i:s a", $this->timestamp); 
  }

  function getampm() { return date("a", $this->timestamp); }
  function gethour() { return date("h", $this->timestamp); }
  function getminute() { return date("i", $this->timestamp); }
  function getsecond() { return date("s", $this->timestamp); }
  function getyear() { return date("Y", $this->timestamp); }
  function getmonth() { return date("m", $this->timestamp); }
  function getday() { return date("d", $this->timestamp); }

  function get24hour() { return date("H", $this->timestamp); }
  function get12hour() { return date("h", $this->timestamp); }

  function getlongmonth() { return date("F", $this->timestamp); }
  function getshortmonth() { return date("M", $this->timestamp); }
  
  function getweek() { return date("w", $this->timestamp); }
  function getshortweek() { return date("D", $this->timestamp); }
  function getlongweek() { return date("l", $this->timestamp); }

  function getisleapyear() { return date("L", $this->timestamp); }
  function getdaysofmonth() { return date("t", $this->timestamp); }

  function tomysql() { return $this->todate(); }
  function todate() { return $this->getyear()."-".$this->getmonth()."-".$this->getday(); }
  function totime() { return $this->gethour().":".$this->getminute().":".$this->getsecond(); }
  function todatetime() { return $this->todate()." ".$this->totime(); }
  function toprettydate() { return date("F d, Y", $this->timestamp); }
  function toshortdate() { return date("M d, Y", $this->timestamp); }
  function toprettytime() { return date("h:i:s a", $this->timestamp); }

  function getstartofmonth() { return new MyDateTime($this->getyear(), $this->getmonth(), 1, 0,0,0); }
  function getendofmonth() { $date= new MyDateTime($this->getyear(), $this->getmonth()+1, 1, 0,0,0); $date->timestamp-=1;return $date;}
  function getstartofquarter() 
  {
    $quarterstartmonth=0;
    switch($this->getmonth())
    {
      case 1: case 2: case 3: $quarterstartmonth=1;break; 
      case 4: case 5: case 6: $quarterstartmonth=4;break; 
      case 7: case 8: case 9: $quarterstartmonth=7;break; 
      case 10: case 11: case 12: $quarterstartmonth=10;break; 
    }
    return new MyDateTime($this->getyear(), $quarterstartmonth, 1, 0,0,0); 
  }
  function getendofquarter()
  {
    $quarterendmonth=0;
    switch($this->getmonth())
    {
      case 1: case 2: case 3: $quarterendmonth=3;break; 
      case 4: case 5: case 6: $quarterendmonth=6;break; 
      case 7: case 8: case 9: $quarterendmonth=9;break; 
      case 10: case 11: case 12: $quarterendmonth=12;break; 
    }
    $date= new MyDateTime($this->getyear(), $quarterendmonth+1, 1, 0,0,0); $date->timestamp-=1;return $date;
  }
  function getstartofyear() { return new MyDateTime($this->getyear(), 1, 1, 0,0,0); }
  function getendofyear() { $date= new MyDateTime($this->getyear()+1, 1, 1, 0,0,0); $date->timestamp-=1;return $date;}

  function addyears($num)  {return new MyDateTime($this->getyear()+$num, $this->getmonth(), $this->getday(), $this->gethour(),$this->getminute(),$this->getsecond());}
  function addmonths($num) {return new MyDateTime($this->getyear()+floor($num/12), $this->getmonth()+floor($num%12), $this->getday(), $this->gethour(),$this->getminute(),$this->getsecond());}
  function addweeks($num) { $this->timestamp+=($num*60*60*24*7);return $this; }
  function adddays($num) { $this->timestamp+=($num*60*60*24);return $this; }
  function addhours($num) { $this->timestamp+=($num*60*60);return $this; }
  function addminutes($num) { $this->timestamp+=($num*60);return $this; }
  function addseconds($num) { $this->timestamp+=$num;return $this; }

  function isearlierthan($date){return $this->timestamp < $date->totimestamp();}
  function islaterthan($date){return $this->timestamp > $date->totimestamp();}
  function isequalto($date){return $this->timestamp == $date->totimestamp();}
  function isearlierthanorequalto($date){return $this->timestamp <= $date->totimestamp();}
  function islaterthanorequalto($date){return $this->timestamp >= $date->totimestamp();}

  function isbefore($date){return $this->timestamp < $date->totimestamp();}
  function isafter($date){return $this->timestamp > $date->totimestamp();}
  function ison($date){return $this->timestamp == $date->totimestamp();}
  function isonorbefore($date){return $this->timestamp <= $date->totimestamp();}
  function isonorafter($date){return $this->timestamp >= $date->totimestamp();}
}

