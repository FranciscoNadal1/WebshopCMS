<?php

namespace Settings;

class getSettings{

   static function getTheme(){
            $results = \DB::select("SELECT theme FROM settings ");
            return $results[0]->theme;
   }
   
   static function getProductListType(){
            $results = \DB::select("SELECT typeList FROM settings ");
            return $results[0]->typeList;
   }
   
   static function getProductEachPage(){
            $results = \DB::select("SELECT productsEachPage FROM settings ");
            return $results[0]->productsEachPage;
   }
   
   static function isMaintenanceOn(){
            $results = \DB::select("SELECT maintenanceMode FROM settings ");
            return $results[0]->maintenanceMode;
   }
   
   static function companyName(){
            $results = \DB::select("SELECT companyName FROM settings ");
            return $results[0]->companyName;
    }
    
   static function getContactPhone(){
            return "2349234234";
    }
   
   static function getStreet(){
            return "9 Calle Isabel la Católica";
    }   
   static function getTownAndCountry(){
            return "Olleria, Valencia";
    }    
       static function getContactMail (){
            return "info@electroaita.com";
    }    
    
    
    
    
    
    static function updateSettings($theme, $listType, $eachPage, $maintenance, $company){
       
          
       \DB::update('update settings  set theme = ? ', [$theme]);
       \DB::update('update settings  set typelist = ? ', [$listType]);
       \DB::update('update settings  set productsEachPage = ? ', [$eachPage]);
       \DB::update('update settings  set maintenanceMode = ? ', [$maintenance]);
       \DB::update('update settings  set companyName = ? ', [$company]);
          
    }
   
   static function Test(){
      return "aaaaa";
   }
}



?>