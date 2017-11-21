<?php

namespace Assets;

class AssetManager{

  static $urlIsSecured = true;


   static function getCSS($name){

    if(self::$urlIsSecured)
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/css/" . $name . "?v=". rand() ."";
    else      
      return $rutaCss =  "http://" . $_SERVER['HTTP_HOST'] . "/public/css/" . $name . "?v=". rand() ."";
   }
   
   static function getJS($name){

    if(self::$urlIsSecured)
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/js/" . $name;
     else      
      return $rutaCss =  "http://" . $_SERVER['HTTP_HOST'] . "/public/js/" . $name;
    
   }
   
   static function getIMG($name){

    if(self::$urlIsSecured)
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/img/" . $name;
     else      
      return $rutaCss =  "http://" . $_SERVER['HTTP_HOST'] . "/public/img/" . $name;
     
   }
   
    static function getProductImg($code,$brand){

        if(self::$urlIsSecured)
          return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/productImages/" . $brand . "/" . $code . ".jpg";
         else      
          return $rutaCss =  "http://" . $_SERVER['HTTP_HOST'] . "/productImages/" . $brand . "/" . $code . ".jpg";
     
   }
   
   static function Test(){
      return "aaaaa";
   }
   
      static function getLogo(){

    if(self::$urlIsSecured)
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/img/logoplaceholder.png";
     else      
      return $rutaCss =  "http://" . $_SERVER['HTTP_HOST'] . "/public/img/logoplaceholder.png";
    
   }
   
   ///////////////////////////////////
   ///         Libraries
   
   static function getAngularChart(){
       //    return "https://code.jquery.com/jquery-3.1.0.min.js";

    if(self::$urlIsSecured)
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/lib/angular-chart.js/angular-chart.js";
     else      
      return $rutaCss =  "http://" . $_SERVER['HTTP_HOST'] . "/public/lib/angular-chart.js/angular-chart.js";
    
   }
   

   static function getBootstrap(){

      //    return "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css";

    if(self::$urlIsSecured)
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/lib/bootstrap/bootstrap.min.css";
     else      
      return $rutaCss =  "http://" . $_SERVER['HTTP_HOST'] . "/public/lib/bootstrap/bootstrap.min.css";
    
   }   
   
   
   static function getjQuery(){
       //    return "";

    if(self::$urlIsSecured)
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/lib/jQuery/jquery-3.1.0.min.js";
     else   
      return $rutaCss =  "http://" . $_SERVER['HTTP_HOST'] . "/public/lib/jQuery/jquery-3.1.0.min.js";
     
   } 
   
    static function getDropDownAssets(){
        
        
       $ruta1 =  "https://" . $_SERVER['HTTP_HOST'] . "/css/reset.css";
       $ruta2 =  "https://" . $_SERVER['HTTP_HOST'] . "/css/style.css";
       $ruta3 =  "https://" . $_SERVER['HTTP_HOST'] . "/js/modernizr.js";
       $ruta4 =  "https://" . $_SERVER['HTTP_HOST'] . "/js/jquery.menu-aim.js";
       $ruta5 =  "https://" . $_SERVER['HTTP_HOST'] . "/js/main.js";
       
echo "
	<link rel='stylesheet' href=$ruta1/>
	<link rel='stylesheet' href=$ruta2/>
	<script src=$ruta3></script> 
	<script src=$ruta4></script> 
	<script src=$ruta5></script> 
	";
	


       //    return "";



     
   } 
   
   
   static function getAngular(){
       //    return "https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js";

    if(self::$urlIsSecured)
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/lib/angular/angular.min.js";
     else    
     return $rutaCss =  "http://" . $_SERVER['HTTP_HOST'] . "/public/lib/angular/angular.min.js";
    
   }    
    static function getChart(){
       //    return "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js";

    if(self::$urlIsSecured)
      return $rutaCss =  "https://" . $_SERVER['HTTP_HOST'] . "/public/lib/angular-chart.js/chart.js";
     else      
 return $rutaCss =  "http://" . $_SERVER['HTTP_HOST'] . "/public/lib/angular-chart.js/chart.js";
     
   }   
   
}



?>