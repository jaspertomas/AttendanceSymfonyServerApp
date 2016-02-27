<?php

class MyTools
{
  static function link_to($string,$path)
  {
    return "<a href='".$path."'>".$string."</a>";
  }
  //thank you to Jobeet Tutorial for this function
  static public function slugify($text)
  {
    // replace all non letters or digits by -
    $text = preg_replace('/\W+/', '-', $text);
    // trim and lowercase
    $text = strtolower(trim($text, '-'));

    if(!$text)return "n-a";

    return $text;
  }
}

