<?php

namespace DBQuerys;
use Illuminate\Database\QueryException;

class DBData{

    static $productTableName = "csv";
    static $categoryTableName = "categorias";
    
    static function getAllCategories(){
              $results = \DB::select("SELECT * FROM " . self::$categoryTableName . " where name not like '-%'");
    return $results;
    }
    
    static function getSubFamiliaFromTitulo($str){
    $name = self::makeFriendlier($str);
      
      $results = \DB::select("SELECT TITULOSUBFAMILIA FROM " . self::$productTableName . " where TITULOFAMILIA like \"$str\" group by TITULOSUBFAMILIA");
    return $results;
    }
    static function getAllWhereTituloFamilia($name){
      
      $name = self::makeFriendlier($name);
      
      $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" group by CODIGOINTERNO");
    return $results;
   }
   
    static function getProductDBInfo($name){
      $name = self::makeFriendlier($name);
      
      $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULO like \"$name\" limit 1");
      return $results;
   }  
 
    static function getAllFamilyTitles(){
              $results = \DB::select("SELECT * FROM " . self::$productTableName . " group by TITULOFAMILIA");
    return $results;
    }
    
    
    static function getAllCategoryTitles(){

///      Provisional menu, limit set to 10, have to be reworked     
            $results = \DB::select("SELECT TITULOSUBFAMILIA FROM " . self::$productTableName . " group by TITULOSUBFAMILIA");
    return $results;
   }    
   
    static function getAllCategoryTitlesWhere($str){
            $results = \DB::select("SELECT TITULOSUBFAMILIA FROM " . self::$productTableName . " where TITULOFAMILIA = '". $str ."' group by TITULOSUBFAMILIA");
    return $results;
   }                  
   
   
    static function getCategoryCodeFromName($str){
            $results = \DB::select("

SELECT CODSUBCATEGORIA
FROM `menuBuilder` , `csv`
WHERE `csv`.CODFAMILIA = `menuBuilder`.CODFAMILIA
AND `csv`.TITULOFAMILIA = \"$str\"
GROUP BY CODSUBCATEGORIA
   ");
    return $results[0]->CODSUBCATEGORIA;
   }  
   
   
    static function getFamilyFromCategoryName($str){
              $str = self::makeFriendlier($str);
              
            $results = \DB::select("

                SELECT csv.TITULOFAMILIA FROM categorias,menuBuilder,csv 
                where categorias.index = menuBuilder.CODSUBCATEGORIA and
                menuBuilder.CODFAMILIA = csv.CODFAMILIA 
                and categorias.name like \"$str\" 
                group by csv.TITULOFAMILIA
                                
   ");
    return $results;
   }  
   

   
   
   static function deleteMenus(){
       $deleted = \DB::delete('delete from menuBuilder');
   }
   
    static function updateMenuSingleOne($codFamilia, $codCategoria){
          //  
          /*
            try{
                */
                $affected = \DB::insert('insert into menuBuilder (CODSUBCATEGORIA, CODFAMILIA) values (?, ?)', [$codCategoria,$codFamilia]);
                /*
            }
            catch (\ErrorException  $e){
                
                $affected = \DB::update('update menuBuilder set CODSUBCATEGORIA = ? where CODFAMILIA = ?', [$codCategoria,$codFamilia]);
            }
            */
       //     echo $affected;
    //return $results;
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