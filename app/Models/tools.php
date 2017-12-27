<?php

namespace Tools;

class ToolManager{


   static function Test(){
      return "ToolTest";
   }
   
   
   static function cleanLocalFiles(){

      self::cleanFolder("/productImages/infortisa/*");
      self::cleanFolder("/productImages/infortisa/*/*");
      
   //   self::RemoveEmptySubFolders("/productImages/infortisa");
      
   }
   
   static function cleanFolder($folder){
      
            $files = glob($folder); // get all file names
      foreach($files as $file){ // iterate files
        if(is_file($file))
          unlink($file); // delete file
          echo $file . "</br>";
      }
      
   }
   
   static function RemoveEmptySubFolders($path)
         {
           $empty=true;
           foreach (glob($path.DIRECTORY_SEPARATOR."*") as $file)
           {
              $empty &= is_dir($file) && RemoveEmptySubFolders($file);
           }
           return $empty && rmdir($path);
         }


}



?>