<?php

namespace ProductViewNumber;

class ProductViewNumber{
    static  $disabled = "no";
 
    static function getProductiOfToday($id){
        if(self::$disabled == "no"){
            $results =  \DB::table('ProductCalls')->where('Id', $id)->where('Date', date("d-m-y"))->first();  
      
      return $results->Number; 
        }
   }    
   
    static function plusOneView($id){
        
        if(self::$disabled == "no"){
            $results =  \DB::table('ProductCalls')->where('Id', $id)->where('Date', date("d-m-y"))->first();  
     
///////////////////////////////////////////////////////////////////////////////////////////////
////////////        Checks if the api is called that day, if not, create the day and adds one

        if (!count($results)) {
            \DB::table('ProductCalls')->insert([
                ['Calls' => 1, 'Date' => date("d-m-y"), 'Id' => $id]
            ]);
          }
          
          
        if (count($results)) {
            
            \DB::table('ProductCalls')->where('Date', date("d-m-y"))->where('Id', $id)->increment('Calls', 1);
          }
///////////////////////////////////////////////////////////////////////////////////////////////          
          
          
          
        } 
    }
}



?>