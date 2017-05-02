<?php

namespace ApiCallNumber;

class ApiNumber{
    static  $disabled = "no";
 
    static function getApiOfToday(){
        if(self::$disabled == "no"){
       $results =  \DB::table('apiCalls')->where('Date', date("d-m-y"))->first();  
      
      return $results->Number; 
        }
   }    
   
    static function plusOneApi(){
        
        if(self::$disabled == "no"){
            $results =  \DB::table('apiCalls')->where('Date', date("d-m-y"))->first();  
     
///////////////////////////////////////////////////////////////////////////////////////////////
////////////        Checks if the api is called that day, if not, create the day and adds one
        if (!count($results)) {
            \DB::table('apiCalls')->insert([
                ['Number' => 1, 'Date' => date("d-m-y")]
            ]);
          }
          
          
        if (count($results)) {
            
            \DB::table('apiCalls')->where('Date', date("d-m-y"))->increment('Number', 1);
          }
///////////////////////////////////////////////////////////////////////////////////////////////          
          
          
          
        } 
    }
}



?>