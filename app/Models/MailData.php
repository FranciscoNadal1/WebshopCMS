<?php
namespace MailQueries;
use Illuminate\Database\QueryException;

class MailData{
    
static $mailsTable = "notification";

 static function addMail($subject, $type, $message){
    
    switch ($type) {

    case "Mail":
    case "Routine":
    case "Information":
        break;
    case "Exception":
    default:
       $type = "Exception";
}
        $affected = \DB::insert('insert into notification (subject, type, message, date) values (?, ?, ? , now())', [$subject, $type, $message]);
   return $affected;
 }
 
 static function setMailIsRead($code){
         \DB::table('notification')
            ->where('code', $code)
            ->update(['isRead' => 1]);
 }
    static function populate(){
        
            $result = \DB::select("SELECT * FROM " . self::$mailsTable . " order by date desc");
            return $result;
        }
        
        static function getNonReadCount(){
        
            $result = \DB::select("SELECT count(*) as coun FROM " . self::$mailsTable . " where isRead <> '1'");
            return $result[0]->coun;
        }    
        
        
    static function getMail($code){
        
            $result = \DB::select("SELECT message FROM " . self::$mailsTable . " where code = " . $code . " limit 1");
            return $result[0]->message;
        }
        
       
    static function formatMessage($Object){
        
        
        return $Object->subject . ": <span>". substr($Object->message,0,140) . " ...</span>";
    }     
        
        
        
        
        
        
        
}


?>