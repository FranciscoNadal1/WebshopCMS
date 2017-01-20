<?php

namespace DBQuerys;

class DBData{

   static function getAllWhereTituloFamilia($name){
      
      $name = self::makeFriendlier($name);
      
      $results = \DB::select("SELECT * FROM csv where TITULOSUBFAMILIA like \"$name\" group by CODIGOINTERNO");
      return $results;
   }
   
    static function getProductDBInfo($name){
      
      $name = self::makeFriendlier($name);
      
      $results = \DB::select("SELECT * FROM csv where TITULO like \"$name\" limit 1");
      return $results;
   }  
 
     static function getAllCategoryTitles(){

///      Provisional menu, limit set to 10, have to be reworked     
      $results = \DB::select("SELECT TITULOSUBFAMILIA FROM csv group by TITULOSUBFAMILIA limit 1,10");
      return $results;
   }    
   
                   
   
   
////////////////////////////////////////////////////////////////////////////////
///////              TOOLS
////////////////////////////////////////////////////////////////////////////////
   static function makeFriendlier($name){
      
        $name = str_replace("-", "_", $name);
        $name = str_replace("/", "_", $name);
        $name = str_replace("-", "_", $name);
        
        
        $name = str_replace("a", "_", $name);
        $name = str_replace("e", "_", $name);
        $name = str_replace("i", "_", $name);
        $name = str_replace("o", "_", $name);
        $name = str_replace("u", "_", $name);
        $name = str_replace("ñ", "_", $name);
        
        return $name;
   }
   
   static function desAccentify($name){
        
        $name = str_replace(" ", "-", $name); 
        $name = str_replace("/", "-", $name); 
        
        $name = str_replace("á", "a", $name);
        $name = str_replace("é", "e", $name);
        $name = str_replace("í", "i", $name);
        $name = str_replace("ó", "o", $name);
        $name = str_replace("ú", "u", $name);
        $name = str_replace("ñ", "_", $name);
        


        
        return $name;
   }
   
   
   
}



?>