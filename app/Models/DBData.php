<?php

namespace DBQuerys;
use Illuminate\Database\QueryException;

class DBData{

    static $productTableName = "csv";
    static $categoryTableName = "categorias";
    static $numberOfProductsByPage;


    static function numberOfProductsByPage()
      {
        return \GetSettings::getProductEachPage();
      }
      
    




    
    static function getAllCategories(){
              $results = \DB::select("SELECT * FROM " . self::$categoryTableName . " where name not like '-%'");
    return $results;
    }
    
        static function getAllSubfamiliaCodes(){
              $results = \DB::select("SELECT CODSUBFAMILIA FROM " . self::$productTableName . "");
    return $results;
    }
    
    static function getNumberCategoriesNoBenefit(){
        
         $results = \DB::select("
            SELECT count( code ) as coun
            FROM `benefits`
            WHERE (benefit =0
            OR benefit = NULL)
and
code not in(SELECT code
FROM `excluded`
WHERE excluded =1)");
             
             return $results[0]->coun;
    }
    
      static function getAllSubfamiliaAndCodeBenefit(){
      




      $results = \DB::select("SELECT csv.TITULOSUBFAMILIA, csv.CODSUBFAMILIA, benefits.benefit, excluded.excluded
FROM csv
LEFT JOIN benefits ON benefits.code = csv.CODSUBFAMILIA
LEFT JOIN excluded ON excluded.code = csv.CODSUBFAMILIA
GROUP BY csv.TITULOSUBFAMILIA");
   
    return $results;
    }
          static function getAllSubfamiliaAndCode(){
      




      $results = \DB::select("SELECT csv.TITULOSUBFAMILIA, csv.CODSUBFAMILIA FROM " . self::$productTableName . " GROUP BY csv.TITULOSUBFAMILIA");
   print_r($results);
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
    static function getAllWhereTituloFamiliaPage($name, $page){
      
      $name = self::makeFriendlier($name);
      $pager = self::numberOfProductsByPage() * $page;
      $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" group by CODIGOINTERNO LIMIT ". $pager .", " . self::numberOfProductsByPage());
      
    return $results;
   }
   
    static function getAllWhereTituloFamiliaPagePlusFilters($name, $page, $filters){
      
      $name = self::makeFriendlier($name);
      $pager = self::numberOfProductsByPage() * $page;
      

      
      $filte = explode("/", $filters);
      
      $ids = join("','",$filte);   

        
        $inVariable = "";
        
        foreach($filte as $value) {
            $inVariable = $inVariable . "'" . $value . "'" . ",";
        }
        $inVariable = rtrim($inVariable, ',');

////////////////////////////////////////////////////////////////////////////////
//////////      SQL INJECTION PROBABLE VULNERABILITY, CHECK

      $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and  NOMFABRICANTE in ($inVariable) group by CODIGOINTERNO LIMIT ". $pager .", " . self::numberOfProductsByPage());
      
      
      
      
      
    return $results;
   } 
   
   
   
   
       
    static function countAllWhereTituloFamiliaPage($name, $page){
          
        $name = self::makeFriendlier($name);
        $pager = self::numberOfProductsByPage() * $page;
        /*
        $results = \DB::select("select count(*)as c FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" LIMIT ". $pager .", " . self::numberOfProductsByPage());
         */
         
         
         
        $results = \DB::select("select count(*) as d FROM (select TITULO as tit from " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" LIMIT ". $pager .", " . self::numberOfProductsByPage().") as c");
         
         
   //     $result = mysqli_query("select count(*) FROM (select TITULO as tit from " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" LIMIT ". $pager .", " . self::numberOfProductsByPage().") as c");

/*        
        (select count(*) from(
SELECT TITULO as tit FROM `csv` WHERE 1 limit 12,12
    ) as c)
      */  
        
     //   $data=mysqli_fetch_assoc($results);
     //   echo $data['c'];
        
     //   print_r($results);
          
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
   
   
   static function deleteBenefits(){
       $deleted = \DB::delete('delete from benefits');
   }
   
   
    static function updateMenuSingleOne($codFamilia, $codCategoria){

                $affected = \DB::insert('insert into menuBuilder (CODSUBCATEGORIA, CODFAMILIA) values (?, ?)', [$codCategoria,$codFamilia]);
    }
    
    static function updateBenefitsSingleOne($code, $benefit){

                $affected = \DB::insert('insert into benefits (code, benefit) values (?, ?)', [$code,$benefit]);
    }    
    

////////////////////////////////////////////////////////////////////////////////
///////              DESCRIPTION
////////////////////////////////////////////////////////////////////////////////


    static function isProductDataSaved($code){
        
         $results = \DB::select("SELECT count(*) as coun FROM `productData` WHERE code like '" . $code . "'");
         
         if($results[0]->coun != 0)
             return true;
         else
             return false;
         
    }
    
        static function isDescriptionDataSaved($code){
        
         $results = \DB::select("SELECT count(description) as coun FROM `productData` WHERE LENGTH(description)=0 and code like '" . $code . "'");
         
         if($results[0]->coun != 0)
             return true;
         else
             return false;
         
    }
    
    
    
        static function isSpecificationsDataSaved($code){
        
         $results = \DB::select("SELECT count(specifications) as coun FROM `productData` WHERE LENGTH(specifications)=0 and code like '" . $code . "'");
         
         if($results[0]->coun != 0)
             return true;
         else
             return false;
         
    }

 //////////////////////////////////////////////////////    
        static function insertProductSpecifications($code, $data){
            
            if(self::isProductDataSaved($code))
                \DB::table('productData')->where('code', $code)->update(['specifications' => $data]);
            else
                \DB::insert('insert into productData (code, description, specifications) values (?, ?, ?)', [$code,"",$data]);
    }    
    
        static function getProductSpecifications($code){
         $results = \DB::select("SELECT specifications FROM `productData` WHERE code like '" . $code . "'");
         return $results[0]->specifications;
    }
    
 //////////////////////////////////////////////////////
 
        static function insertEmptyProductData($code){
                \DB::insert('insert into productData (code, description, specifications) values (?, ?, ?)', [$code,"",""]);
            }
    
        static function insertProductDescription($code, $data){
            
            if(self::isProductDataSaved($code)){
                \DB::table('productData')->where('code', $code)->update(['description' => $data]);
            }
            else{
                \DB::insert('insert into productData (code, description, specifications) values (?, ?, ?)', [$code,$data,""]);
            }
    }    
    
        static function getProductDescription($code){
         $results = \DB::select("SELECT description FROM `productData` WHERE code like '" . $code . "'");
         return $results[0]->description;
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