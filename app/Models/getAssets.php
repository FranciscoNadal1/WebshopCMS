<?php

namespace Assets;

class AssetManager{

   static function getCSS($name){
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/css/" . $name;
   }
   
   static function getJS($name){
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/js/" . $name;
   }
   
   static function getIMG($name){
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/img/" . $name;
   }
   
   static function Test(){
      return "aaaaa";
   }
}



?>