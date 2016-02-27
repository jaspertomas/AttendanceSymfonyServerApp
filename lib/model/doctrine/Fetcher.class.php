<?php

class Fetcher
{
  public static function fetchById($class,$id)
  {
      return Doctrine_Query::create()
        ->from($class.' s')
      	->where('s.id = '.$id)
      	->fetchOne();
  }
  public static function fetch($class,$array)
  {
      $query= Doctrine_Query::create()
        ->from($class.' s')
    		->where("1");

      foreach($array as $key=>$value)
      	$query->andWhere($key.' = '.$value);

    	return $query->execute();
  }
  public static function fetchOne($class,$array)
  {
      $query= Doctrine_Query::create()
        ->from($class.' s')
    		->where("1");
    		
      foreach($array as $key=>$value)
      	$query->andWhere($key.' = '.$value);

    	return $query->fetchOne();
  }
}
