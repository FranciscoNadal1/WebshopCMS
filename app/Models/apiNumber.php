<?php

namespace ApiCallNumber;

class ApiNumber{
    static  $disabled = "yes";
 
    static function getApiOfToday(){
        if(self::$disabled == "no"){
       $results =  \DB::table('apiCalls')->where('Date', date("d-m-y"))->first();  
      
      return $results->Number; 
        }
   }    
   
    static function plusOneApi(){
        
        if(self::$disabled == "no"){
      $results =  \DB::table('apiCalls')->where('Date', date("d-m-y"))->first();  
     

          if(is_null($results))
          {
            \DB::table('apiCalls')->insert([
                ['Number' => 1, 'Date' => date("d-m-y")]
            ]);
          }else{
            \DB::table('apiCalls')->increment('Number', 1, ['Date' => date("d-m-y")]);
          }
          

   } 
    }
}



?>