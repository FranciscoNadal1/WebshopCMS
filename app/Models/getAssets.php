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
   
   
   ///////////////////////////////////
   ///         Libraries
   
   static function getAngularChart(){
       //    return "https://code.jquery.com/jquery-3.1.0.min.js";
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/lib/angular-chart.js/angular-chart.js";
   }
   

   static function getBootstrap(){
      //    return "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css";
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/lib/bootstrap/bootstrap.min.css";
   }   
   
   
   static function getjQuery(){
       //    return "";
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/lib/jQuery/jquery-3.1.0.min.js";
   } 
   
   static function getAngular(){
       //    return "https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js";
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/lib/angular/angular.min.js";
   }    
    static function getChart(){
       //    return "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js";
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/lib/angular-chart.js/chart.js";
   }   
   
}



?>