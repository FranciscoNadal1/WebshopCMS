<?php

namespace ApiCallNumber;

class ApiNumber{
    static  $disabled = "no";

    static function getActualDate(){
        
        $dt = new \DateTime();
        $actual = $dt->format('Y-m-d');
        return $actual;
    }
    
    static function getApiOfToday(){
        if(self::$disabled == "no"){
       $results =  \DB::table('apiCalls')->where('Date', self::getActualDate())->first();  
      
      return $results->Number; 
        }
   }    
   
    static function plusOneApi(){
        
        if(self::$disabled == "no"){
            $results =  \DB::table('apiCalls')->where('Date', self::getActualDate())->first();  
     
///////////////////////////////////////////////////////////////////////////////////////////////
////////////        Checks if the api is called that day, if not, create the day and adds one

        if (!count($results)) {
            \DB::table('apiCalls')->insert([
                ['Number' => 1, 'Date' => self::getActualDate()]
            ]);
          }
          
          
        if (count($results)) {
            
            \DB::table('apiCalls')->where('Date', self::getActualDate())->increment('Number', 1);
          }
///////////////////////////////////////////////////////////////////////////////////////////////          
          
          
          
        } 
    }
}



?>