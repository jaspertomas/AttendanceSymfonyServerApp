<?php

class MyModel
{
	public static function create($class,$array)
	{
  	$object=new $class();
  	foreach($array as $key=>$value)
  		$object[$key]=$value;
  	$object->save();
  	return $object;
	}
  public static function fetchById($class,$id)
  {
      return Doctrine_Query::create()
        ->from($class.' s')
      	->where('s.id = '.$id)
      	->fetchOne();
  }
  public static function fetch($class,$array=array())
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
	public static function update($array)
	{
		$needsave=false;
		foreach($array as $key=>$value)
			if($this[$key]!=$value)
				$needsave=true;

		if($needsave)
		{
			foreach($array as $key=>$value)
				$this[$key]=$value;
			$this->save();
		}
	}
}

