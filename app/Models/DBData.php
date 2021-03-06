<?php

namespace DBQueries;
use Illuminate\Database\QueryException;

class DBData{

    static $productTableName = "totalCsv";
    static $categoryTableName = "categorias";
    static $numberOfProductsByPage;


    static function numberOfProductsByPage()
      {
        return \GetSettings::getProductEachPage();
      }
      
    


    static function getDescriptionForProductList($cod, $field){
        
        $limitCharacters = 100;
        
        if(($data = $field::get_comercial($cod)) == "Sin información"){
            
            $data ="";
            
        }
        else{
            $count = strlen($data);
            $data = substr(strip_tags($field::get_comercial($cod)),0,$limitCharacters);
            
            if($count > $limitCharacters)
                $data = $data . "...";
            
        }
       
       return $data;
    }

    
    static function getAllCategories(){
            //  $results = \DB::select("SELECT * FROM " . self::$categoryTableName . " where name not like '-%'");
             $results = \DB::select("SELECT * FROM " . self::$categoryTableName . " where name not like '%sincategoria%' order by code");
    
    return $results;
    }
    
        static function getAllSubfamiliaCodes(){
              $results = \DB::select("SELECT CODSUBFAMILIA, TITULOSUBFAMILIA FROM " . self::$productTableName . "");
    return $results;
    }
    
    static function getCodesubfamiliaFromSubfamilia($subfamilia){
        
        
      $subfamilia = self::makeFriendlier($subfamilia);
      
      
         $results = \DB::select("SELECT CODSUBFAMILIA FROM " . self::$productTableName . "
         where TITULOSUBFAMILIA like '". $subfamilia."' ");
    return $results[0]->CODSUBFAMILIA;
        
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
    
    
    static function getAllExcludedCategories(){
        $results = \DB::select("
        select * from excluded");
   
    return $results;
    }
      static function getAllSubfamiliaAndCodeBenefit(){
      


 

      $results = \DB::select(" SELECT csv.TITULOFAMILIA, csv.TITULOSUBFAMILIA, csv.CODSUBFAMILIA, benefits.benefit, excluded.excluded
FROM " . self::$productTableName . " as csv
LEFT JOIN benefits ON benefits.code = csv.CODSUBFAMILIA
LEFT JOIN excluded ON excluded.code = csv.CODSUBFAMILIA
GROUP BY csv.TITULOSUBFAMILIA
ORDER BY csv.TITULOFAMILIA
");
   
    return $results;
    }
          static function getAllSubfamiliaAndCode(){
      




      $results = \DB::select("SELECT csv.TITULOSUBFAMILIA, csv.CODSUBFAMILIA FROM " . self::$productTableName . " as csv GROUP BY csv.TITULOSUBFAMILIA");
//   print_r($results);
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
   
      static function getAllNovedades($limit){
          
      $results = \DB::select("SELECT * FROM " . self::$productTableName . " where CICLOVIDA like \"Novedad\" group by CODIGOINTERNO order by rand() limit " . $limit);
    return $results;
   } 
   
    static function getAllWhereTituloFamiliaPage($name, $page){
      
      $name = self::makeFriendlier($name);
      $pager = self::numberOfProductsByPage() * $page;
      $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" group by CODIGOINTERNO order by precio asc LIMIT ". $pager .", " . self::numberOfProductsByPage());
      
    return $results;
   }
    static function getAllWhereTituloFamiliaPageStock($name, $page){
      
      $name = self::makeFriendlier($name);
      $pager = self::numberOfProductsByPage() * $page;
      $results = \DB::select("SELECT * FROM " . self::$productTableName . " where STOCK > 0 and TITULOSUBFAMILIA like \"$name\" group by CODIGOINTERNO order by precio asc LIMIT ". $pager .", " . self::numberOfProductsByPage());
      
    return $results;
   }
   
   
   
     static function getSearchData($name, $page){
      /*
      $name = self::makeFriendlier($name);
      */
      $pager = self::numberOfProductsByPage() * $page;
      
      $name = str_replace(" ", "%", $name);$name=strtolower($name);
      
      /*
      $results = \DB::select("
      SELECT *
        FROM " . self::$productTableName . " 
        WHERE MATCH(column) AGAINST('" . $name . " ')
      LIMIT ". $pager .", " . self::numberOfProductsByPage());
      */
          $results = \DB::select("
      SELECT *
        FROM " . self::$productTableName . " 
        WHERE LOWER(TITULO) like '%" . $name ."%' 
      LIMIT ". $pager .", " . self::numberOfProductsByPage());  
      
    return $results;
   }
   
        static function getFilterSearchData($name){
              
              $name = str_replace(" ", "%", $name);
              $name = strtolower($name);
              
        
            $results = \DB::select("SELECT NOMFABRICANTE 
                FROM " . self::$productTableName . " 
                WHERE LOWER(TITULO) like '%" . $name ."%' 
                GROUP BY NOMFABRICANTE
              ");  
    return $results;
   }
   
       static function countSearchDataPlusFilters($name, $filters){
      /*
      $name = self::makeFriendlier($name);
      */
      $name = str_replace(" ", "%", $name);$name=strtolower($name);
    $stock = 0;
      
      $filte = explode("/", $filters);
      
      $ids = join("','",$filte);   

        
        $inVariable = "";
        
        foreach($filte as $value) {
            if($value != "stock")
                $inVariable = $inVariable . "'" . $value . "'" . ",";
            else
                $stock = 1;
                
        }
        $inVariable = rtrim($inVariable, ',');

////////////////////////////////////////////////////////////////////////////////
//////////      SQL INJECTION PROBABLE VULNERABILITY, CHECK

    if($stock == 0)
      
                $results = \DB::select("
      SELECT count(*) as coun 
        FROM " . self::$productTableName . " 
        WHERE LOWER(TITULO) like '%" . $name ."%' 
        and  NOMFABRICANTE in ($inVariable)
      ");  
      
      
    if($stock == 1){  
     if($inVariable=="")
     
            
                            $results = \DB::select("
      SELECT count(*) as coun 
        FROM " . self::$productTableName . " 
        WHERE LOWER(TITULO) like '%" . $name ."%' 
        and STOCK > '0'");  
            
            
            
     else

                                    $results = \DB::select("
      SELECT count(*) as coun 
        FROM " . self::$productTableName . " 
        WHERE LOWER(TITULO) like '%" . $name ."%' 
        and  NOMFABRICANTE in ($inVariable)
        and STOCK > '0' 
      ");  
        
        
        
        
    }
    return $results[0]->coun;
   } 








       static function getSearchDataPlusFilters($name, $page, $filters){
      /*
      $name = self::makeFriendlier($name);
      */
      $pager = self::numberOfProductsByPage() * $page;
      
    $stock = 0;
      
      $filte = explode("/", $filters);
      
      $ids = join("','",$filte);   

        
        $inVariable = "";
        
        foreach($filte as $value) {
            if($value != "stock")
                $inVariable = $inVariable . "'" . $value . "'" . ",";
            else
                $stock = 1;
                
        }
        $inVariable = rtrim($inVariable, ',');

////////////////////////////////////////////////////////////////////////////////
//////////      SQL INJECTION PROBABLE VULNERABILITY, CHECK

    if($stock == 0)
      
                $results = \DB::select("
      SELECT *
        FROM " . self::$productTableName . " 
        WHERE LOWER(TITULO)  like '%" . $name ."%' 
        and  NOMFABRICANTE in ($inVariable) 
      LIMIT ". $pager .", " . self::numberOfProductsByPage());  
      
     
    if($stock == 1){  
     if($inVariable=="")
     
            
                            $results = \DB::select("
      SELECT *
        FROM " . self::$productTableName . " 
        WHERE LOWER(TITULO)  like '%" . $name ."%' 
        
        and STOCK > '0' 
      LIMIT ". $pager .", " . self::numberOfProductsByPage());  
            
            
            
     else

                                    $results = \DB::select("
      SELECT *
        FROM " . self::$productTableName . " 
        WHERE LOWER(TITULO)  like '%" . $name ."%' 
        and  NOMFABRICANTE in ($inVariable)
        and STOCK > '0' 
        
      LIMIT ". $pager .", " . self::numberOfProductsByPage());  
        
        
        
        
    }
    return $results;
   } 
   
   
   
   
   
   
   
   
   
        static function countSearchData($name){
      /*
      $name = self::makeFriendlier($name);
      */

      $name = str_replace(" ", "%", $name);$name=strtolower($name);
          $results = \DB::select("
      SELECT count(*) as coun 
        FROM " . self::$productTableName . " 
        WHERE LOWER(TITULO) like '%" . $name ."%' 
        ");  
      
    return $results[0]->coun;
   }
   
   
   
   
   
   
    static function countAllWhereTituloFamiliaPage($name, $page){
      
      $name = self::makeFriendlier($name);
      $pager = self::numberOfProductsByPage() * $page;
      $results = \DB::select("SELECT count(*) as coun FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\"");
      
    return $results[0]->coun;
   }
   
    static function countAllWhereTituloFamiliaPageStock($name, $page){
      
      $name = self::makeFriendlier($name);
      $pager = self::numberOfProductsByPage() * $page;
      $results = \DB::select("SELECT count(*) as coun FROM " . self::$productTableName . " where STOCK > 0 and TITULOSUBFAMILIA like \"$name\"");
      
    return $results[0]->coun;
   }
   
   
    static function getAllWhereTituloFamiliaPageOrder($name, $page, $order){
      
      
      $name = self::makeFriendlier($name);
      $pager = self::numberOfProductsByPage() * $page;
      
      switch ($order) {
            case "caro":
                $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" group by CODIGOINTERNO order by PRECIO DESC LIMIT ". $pager .", " . self::numberOfProductsByPage());
                break;
            case "barato":
                $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" group by CODIGOINTERNO order by PRECIO ASC LIMIT ". $pager .", " . self::numberOfProductsByPage());
                break;            
            case "alfa":
                $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" group by CODIGOINTERNO order by TITULO ASC LIMIT ". $pager .", " . self::numberOfProductsByPage());
                break;
                 
            case "novedades":
                $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" group by CODIGOINTERNO 
                
                order by 
                case when CICLOVIDA like 'Nove%' then 0 else 1 end, CICLOVIDA desc
                LIMIT
                ". $pager .", " . self::numberOfProductsByPage());
                break;
            default:
                $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" group by CODIGOINTERNO LIMIT ". $pager .", " . self::numberOfProductsByPage());
                break;
}
      
       
      
      
      
      
    return $results;
   }


    static function getAllWhereTituloFamiliaPageOrderStock($name, $page, $order){
      
      
      $name = self::makeFriendlier($name);
      $pager = self::numberOfProductsByPage() * $page;
      
      switch ($order) {
            case "caro":
                $results = \DB::select("SELECT * FROM " . self::$productTableName . " where STOCK > 0 and TITULOSUBFAMILIA like \"$name\" group by CODIGOINTERNO order by PRECIO DESC LIMIT ". $pager .", " . self::numberOfProductsByPage());
                break;
            case "barato":
                $results = \DB::select("SELECT * FROM " . self::$productTableName . " where STOCK > 0 and  TITULOSUBFAMILIA like \"$name\" group by CODIGOINTERNO order by PRECIO ASC LIMIT ". $pager .", " . self::numberOfProductsByPage());
                break;            
            case "alfa":
                $results = \DB::select("SELECT * FROM " . self::$productTableName . " where STOCK > 0 and TITULOSUBFAMILIA like \"$name\" group by CODIGOINTERNO order by TITULO ASC LIMIT ". $pager .", " . self::numberOfProductsByPage());
                break;
                 
            case "novedades":
                $results = \DB::select("SELECT * FROM " . self::$productTableName . " where STOCK > 0 and  TITULOSUBFAMILIA like \"$name\" group by CODIGOINTERNO 
                
                order by 
                case when CICLOVIDA like 'Nove%' then 0 else 1 end, CICLOVIDA desc
                LIMIT
                ". $pager .", " . self::numberOfProductsByPage());
                break;
            default:
                $results = \DB::select("SELECT * FROM " . self::$productTableName . " where  STOCK > 0 and TITULOSUBFAMILIA like \"$name\" group by CODIGOINTERNO LIMIT ". $pager .", " . self::numberOfProductsByPage());
                break;
}
      
       
      
      
      
      
    return $results;
   }
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////                  Filtros nuevos                        //////////////////////////////////////////////////////////////////

    static function getAllWhereTituloFamiliaPagePlusFiltersNew($name, $page, $filters){
      
      $name = self::makeFriendlier($name);
      $pager = self::numberOfProductsByPage() * $page;
      
    $stock = 0;
    $StringStock ="";
      
      $filte = explode("/", $filters);
      
      $ids = join("','",$filte);   

        
        $inVariable = "";
        
        foreach($filte as $value) {
            if($value != "stock")
                $inVariable = $inVariable . "'" . $value . "'" . ",";
            else{
                $stock = 1;
                $StringStock = " and ".self::$productTableName . ".STOCK > 0  ";   
            }
                
        }
        $inVariable = rtrim($inVariable, ',');
        
        if(strlen($inVariable) == 0){
            return self::getAllWhereTituloFamiliaPageStock($name, $page); 
        }
 
$results = \DB::select("SELECT infortisa_specificationAttribute.SpecificationAttributeId from infortisa_specificationAttribute, infortisa_specificationAttributeOption 

 where infortisa_specificationAttribute.SpecificationAttributeId = infortisa_specificationAttributeOption.SpecificationAttributeId
 and infortisa_specificationAttributeOption.OptionId in ($inVariable)
 group by infortisa_specificationAttribute.SpecificationAttributeId
");

if(sizeOf($results) == 0)
return;

$dinamicQuery = "";

    foreach($results as $value){
        
        
        $results2 = \DB::select("SELECT infortisa_specificationAttributeOption.OptionId from infortisa_specificationAttribute, infortisa_specificationAttributeOption 
 where infortisa_specificationAttribute.SpecificationAttributeId = infortisa_specificationAttributeOption.SpecificationAttributeId
 and infortisa_specificationAttributeOption.SpecificationAttributeId in ($value->SpecificationAttributeId)
 and infortisa_specificationAttributeOption.OptionId in ($inVariable)
");




$dinamicQuery = $dinamicQuery .  "CODIGOINTERNO IN (";

                $dinamicQuery = $dinamicQuery . 
                "SELECT infortisa_IdSku.SKU FROM infortisa_IdSku 
                INNER JOIN infortisa_productSpecification ON infortisa_productSpecification.ProductId = infortisa_IdSku.ID
INNER JOIN infortisa_specificationAttributeOption ON infortisa_specificationAttributeOption.OptionId = infortisa_productSpecification.OptionId
                WHERE (";
        for($i = 0; $i != sizeof($results2);$i++){
            
            
            
            
                $dinamicQuery = $dinamicQuery .  "infortisa_specificationAttributeOption.OptionId ='" . $results2[$i]->OptionId . "'";
               
                if($i == sizeof($results2)-1)
                {
                
                    $dinamicQuery = $dinamicQuery . ") group by infortisa_IdSku.SKU";

                    $dinamicQuery = $dinamicQuery .  ")";
                    break;
                }
                    
                else{
                    
                    $dinamicQuery = $dinamicQuery .  " or ";
            }
        }
            if ($value === end($results)){}
            
            else
                $dinamicQuery = $dinamicQuery .  " and ";
    }
         
     $results = \DB::select("SELECT " . self::$productTableName . ".*
 FROM " . self::$productTableName . ", infortisa_IdSku
 where TITULOSUBFAMILIA like \"$name\" 
 and infortisa_IdSku.SKU =  " . self::$productTableName . ".CODIGOINTERNO
   " . $StringStock  . " 
 and " . $dinamicQuery . "
 group by CODIGOINTERNO  
 order by precio asc LIMIT ". $pager .", " . self::numberOfProductsByPage());
 
 
 
 
    return $results;
   } 
                        ///////////////////////////////////////////////
    static function getAllWhereTituloFamiliaPagePlusFiltersOrderNew($name, $page, $filters, $order){
          
      $name = self::makeFriendlier($name);
      $pager = self::numberOfProductsByPage() * $page;
      
    $stock = 0;
    $StringStock = "";
    
      $filte = explode("/", $filters);
      
      $ids = join("','",$filte);   

        
        $inVariable = "";
        
        foreach($filte as $value) {
            if($value != "stock")
                $inVariable = $inVariable . "'" . $value . "'" . ",";
            else{
                $stock = 1;
                $StringStock = " and ".self::$productTableName . ".STOCK > 0  ";   
            }
                
        }
        $inVariable = rtrim($inVariable, ',');
        
        if(strlen($inVariable) == 0){
            return self::getAllWhereTituloFamiliaPageOrderStock($name, $page, $order); 
        }
        
        
$results = \DB::select("SELECT infortisa_specificationAttribute.SpecificationAttributeId from infortisa_specificationAttribute, infortisa_specificationAttributeOption 

 where infortisa_specificationAttribute.SpecificationAttributeId = infortisa_specificationAttributeOption.SpecificationAttributeId
 and infortisa_specificationAttributeOption.OptionId in ($inVariable)
 group by infortisa_specificationAttribute.SpecificationAttributeId
");

if(sizeOf($results) == 0)
return;

$dinamicQuery = "";

    foreach($results as $value){
        
        
        $results2 = \DB::select("SELECT infortisa_specificationAttributeOption.OptionId from infortisa_specificationAttribute, infortisa_specificationAttributeOption 
 where infortisa_specificationAttribute.SpecificationAttributeId = infortisa_specificationAttributeOption.SpecificationAttributeId
 and infortisa_specificationAttributeOption.SpecificationAttributeId in ($value->SpecificationAttributeId)
 and infortisa_specificationAttributeOption.OptionId in ($inVariable)
");




$dinamicQuery = $dinamicQuery .  "CODIGOINTERNO IN (";

                $dinamicQuery = $dinamicQuery . 
                "SELECT infortisa_IdSku.SKU FROM infortisa_IdSku 
                INNER JOIN infortisa_productSpecification ON infortisa_productSpecification.ProductId = infortisa_IdSku.ID
INNER JOIN infortisa_specificationAttributeOption ON infortisa_specificationAttributeOption.OptionId = infortisa_productSpecification.OptionId
                WHERE (";
        for($i = 0; $i != sizeof($results2);$i++){
            
            
            
            
                $dinamicQuery = $dinamicQuery .  "infortisa_specificationAttributeOption.OptionId ='" . $results2[$i]->OptionId . "'";
               
                if($i == sizeof($results2)-1)
                {
                
                    $dinamicQuery = $dinamicQuery . ") group by infortisa_IdSku.SKU";

                    $dinamicQuery = $dinamicQuery .  ")";
                    break;
                }
                    
                else{
                    
                    $dinamicQuery = $dinamicQuery .  " or ";
            }
        }
            if ($value === end($results)){}
            
            else
                $dinamicQuery = $dinamicQuery .  " and ";
    }
         
     $resultsString = "SELECT " . self::$productTableName . ".*
 FROM " . self::$productTableName . ", infortisa_IdSku
 where TITULOSUBFAMILIA like \"$name\" 
 and infortisa_IdSku.SKU =  " . self::$productTableName . ".CODIGOINTERNO
 " . $StringStock . "
 and " . $dinamicQuery . "
  group by CODIGOINTERNO 
";
 










////////////////////////////////////////////////////////////////////////////////
//////////      SQL INJECTION PROBABLE VULNERABILITY, CHECK

     switch ($order) {
            case "caro":
                
                
$resultsString = $resultsString . " order by ". self::$productTableName . ".PRECIO DESC LIMIT ". $pager .", " . self::numberOfProductsByPage();

                break;
            case "barato":


$resultsString = $resultsString . "  order by ". self::$productTableName . ".PRECIO ASC LIMIT ". $pager .", " . self::numberOfProductsByPage();



                     break;            
                
            case "alfa":
       
$resultsString = $resultsString . "  order by ". self::$productTableName . ".TITULO ASC LIMIT ". $pager .", " . self::numberOfProductsByPage();
 
 
                break;
                 
            case "novedades":
                
$resultsString = $resultsString . "   order by  case when ". self::$productTableName . ".CICLOVIDA like 'Nove%' then 0 else 1 end, ". self::$productTableName . ".CICLOVIDA desc LIMIT ". $pager .", " . self::numberOfProductsByPage();
                break;
            default:
                 echo $resultsString;  
                
                break;

    }
    
        $results = \DB::select($resultsString);
      
    return $results;
   } 
                        ///////////////////////////////////////////////
    static function countAllWhereTituloFamiliaPagePlusFiltersNew($name, $page, $filters){
      
      $name = self::makeFriendlier($name);
      $pager = self::numberOfProductsByPage() * $page;
      
    $stock = false;
    $StringStock ="";
            
      $filte = explode("/", $filters);
      
      $ids = join("','",$filte);   

        
        $inVariable = "";
        
        foreach($filte as $value) {
            if($value != "stock")
                $inVariable = $inVariable . "'" . $value . "'" . ",";
            else{
                $stock = true;
                $StringStock = " and ".self::$productTableName . ".STOCK > 0 ";   
                
            }
                
        }
        $inVariable = rtrim($inVariable, ',');
        
        if(strlen($inVariable) == 0){
            return self::countAllWhereTituloFamiliaPageStock($name, $page); 
        }

$results = \DB::select("SELECT infortisa_specificationAttribute.SpecificationAttributeId from infortisa_specificationAttribute, infortisa_specificationAttributeOption 

 where infortisa_specificationAttribute.SpecificationAttributeId = infortisa_specificationAttributeOption.SpecificationAttributeId
 and infortisa_specificationAttributeOption.OptionId in ($inVariable)
 group by infortisa_specificationAttribute.SpecificationAttributeId
");

if(sizeOf($results) == 0)
return;

$dinamicQuery = "";

    foreach($results as $value){
        
        
        $results2 = \DB::select("SELECT infortisa_specificationAttributeOption.OptionId from infortisa_specificationAttribute, infortisa_specificationAttributeOption 
 where infortisa_specificationAttribute.SpecificationAttributeId = infortisa_specificationAttributeOption.SpecificationAttributeId
 and infortisa_specificationAttributeOption.SpecificationAttributeId in ($value->SpecificationAttributeId)
 and infortisa_specificationAttributeOption.OptionId in ($inVariable)
");




$dinamicQuery = $dinamicQuery .  "CODIGOINTERNO IN (";

                $dinamicQuery = $dinamicQuery . 
                "SELECT infortisa_IdSku.SKU FROM infortisa_IdSku 
                INNER JOIN infortisa_productSpecification ON infortisa_productSpecification.ProductId = infortisa_IdSku.ID
INNER JOIN infortisa_specificationAttributeOption ON infortisa_specificationAttributeOption.OptionId = infortisa_productSpecification.OptionId
                WHERE (";
        for($i = 0; $i != sizeof($results2);$i++){
            
            
            
            
                $dinamicQuery = $dinamicQuery .  "infortisa_specificationAttributeOption.OptionId ='" . $results2[$i]->OptionId . "'";
               
                if($i == sizeof($results2)-1)
                {
                
                    $dinamicQuery = $dinamicQuery . ") group by infortisa_IdSku.SKU";

                    $dinamicQuery = $dinamicQuery .  ")";
                    break;
                }
                    
                else{
                    
                    $dinamicQuery = $dinamicQuery .  " or ";
            }
        }
            if ($value === end($results)){}
            
            else
                $dinamicQuery = $dinamicQuery .  " and ";
    }
         
     $results = \DB::select("SELECT count(*) as coun 
 FROM " . self::$productTableName . ", infortisa_IdSku
 where TITULOSUBFAMILIA like \"$name\" 
 and infortisa_IdSku.SKU =  " . self::$productTableName . ".CODIGOINTERNO
  " . $StringStock . " 
 and " . $dinamicQuery . "
 order by precio asc");
      
      
      
      
 
 
 
 
    return $results[0]->coun;
   } 
                                                                                                    //////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





   
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////                  Filtros antiguos                        //////////////////////////////////////////////////////////////////

    static function getAllWhereTituloFamiliaPagePlusFilters($name, $page, $filters){
      
      $name = self::makeFriendlier($name);
      $pager = self::numberOfProductsByPage() * $page;
      
    $stock = 0;
      
      $filte = explode("/", $filters);
      
      $ids = join("','",$filte);   

        
        $inVariable = "";
        
        foreach($filte as $value) {
            if($value != "stock")
                $inVariable = $inVariable . "'" . $value . "'" . ",";
            else
                $stock = 1;
                
        }
        $inVariable = rtrim($inVariable, ',');

////////////////////////////////////////////////////////////////////////////////
//////////      SQL INJECTION PROBABLE VULNERABILITY, CHECK

    if($stock == 0)
      $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and  NOMFABRICANTE in ($inVariable) group by CODIGOINTERNO order by precio asc LIMIT ". $pager .", " . self::numberOfProductsByPage());
    if($stock == 1){  
     if($inVariable=="")
            $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and STOCK > '0' group by CODIGOINTERNO  order by precio asc LIMIT ". $pager .", " . self::numberOfProductsByPage());
     else
            $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and  NOMFABRICANTE in ($inVariable) and STOCK > '0' group by CODIGOINTERNO  order by precio asc LIMIT ". $pager .", " . self::numberOfProductsByPage());
    
      
    }
      
    return $results;
   } 
                        ///////////////////////////////////////////////
    static function getAllWhereTituloFamiliaPagePlusFiltersOrder($name, $page, $filters, $order){
      
      $name = self::makeFriendlier($name);
      $pager = self::numberOfProductsByPage() * $page;
      
    $stock = 0;
      
      $filte = explode("/", $filters);
      
      $ids = join("','",$filte);   

        
        $inVariable = "";
        
        foreach($filte as $value) {
            if($value != "stock")
                $inVariable = $inVariable . "'" . $value . "'" . ",";
            else
                $stock = 1;
                
        }
        $inVariable = rtrim($inVariable, ',');

////////////////////////////////////////////////////////////////////////////////
//////////      SQL INJECTION PROBABLE VULNERABILITY, CHECK

     switch ($order) {
            case "caro":
                
                    if($stock == 0)
                          $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and  NOMFABRICANTE in ($inVariable) group by CODIGOINTERNO order by PRECIO DESC LIMIT ". $pager .", " . self::numberOfProductsByPage());
                    if($stock == 1)  
                         if($inVariable=="")
                                $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and STOCK > '0' group by CODIGOINTERNO order by PRECIO DESC LIMIT ". $pager .", " . self::numberOfProductsByPage());
                         else
                                $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and  NOMFABRICANTE in ($inVariable) and STOCK > '0' group by CODIGOINTERNO order by PRECIO DESC LIMIT ". $pager .", " . self::numberOfProductsByPage());
                break;
                
            case "barato":

                if($stock == 0)
                      $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and  NOMFABRICANTE in ($inVariable) group by CODIGOINTERNO order by PRECIO ASC LIMIT ". $pager .", " . self::numberOfProductsByPage());
                if($stock == 1)
                     if($inVariable=="")
                            $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and STOCK > '0' group by CODIGOINTERNO order by PRECIO ASC LIMIT ". $pager .", " . self::numberOfProductsByPage());
                     else
                            $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and  NOMFABRICANTE in ($inVariable) and STOCK > '0' group by CODIGOINTERNO order by PRECIO ASC LIMIT ". $pager .", " . self::numberOfProductsByPage());
                break;            
                
            case "alfa":
                    
                if($stock == 0)
                      $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and  NOMFABRICANTE in ($inVariable) group by CODIGOINTERNO order by TITULO ASC LIMIT ". $pager .", " . self::numberOfProductsByPage());
                if($stock == 1) 
                    if($inVariable=="")
                            $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and STOCK > '0' group by CODIGOINTERNO order by TITULO ASC LIMIT ". $pager .", " . self::numberOfProductsByPage());
                    else
                            $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and  NOMFABRICANTE in ($inVariable) and STOCK > '0' group by CODIGOINTERNO order by TITULO ASC LIMIT ". $pager .", " . self::numberOfProductsByPage());
                    
                
                break;
                 
            case "novedades":
                
                
                if($stock == 0)
                      $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and  NOMFABRICANTE in ($inVariable) group by CODIGOINTERNO order by 
                case when CICLOVIDA like 'Nove%' then 0 else 1 end, CICLOVIDA desc LIMIT ". $pager .", " . self::numberOfProductsByPage());
                if($stock == 1)  
                    if($inVariable=="")
                            $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and STOCK > '0' group by CODIGOINTERNO order by 
                case when CICLOVIDA like 'Nove%' then 0 else 1 end, CICLOVIDA desc LIMIT ". $pager .", " . self::numberOfProductsByPage());
                    else
                            $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and  NOMFABRICANTE in ($inVariable) and STOCK > '0' group by CODIGOINTERNO order by 
                case when CICLOVIDA like 'Nove%' then 0 else 1 end, CICLOVIDA desc LIMIT ". $pager .", " . self::numberOfProductsByPage());
                    
                break;
            default:
                    
                if($stock == 0)
                      $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and  NOMFABRICANTE in ($inVariable) group by CODIGOINTERNO LIMIT ". $pager .", " . self::numberOfProductsByPage());
                if($stock == 1)  
                     if($inVariable=="")
                            $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and STOCK > '0' group by CODIGOINTERNO LIMIT ". $pager .", " . self::numberOfProductsByPage());
                     else
                            $results = \DB::select("SELECT * FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and  NOMFABRICANTE in ($inVariable) and STOCK > '0' group by CODIGOINTERNO LIMIT ". $pager .", " . self::numberOfProductsByPage());
                    
             
                
                
                break;

    }
      
    return $results;
   } 
                        ///////////////////////////////////////////////
    static function countAllWhereTituloFamiliaPagePlusFilters($name, $page, $filters){
      
      $name = self::makeFriendlier($name);
      $pager = self::numberOfProductsByPage() * $page;
      
    $stock = 0;
      
      $filte = explode("/", $filters);
      
      $ids = join("','",$filte);   

        
        $inVariable = "";
        
        foreach($filte as $value) {
            if($value != "stock")
                $inVariable = $inVariable . "'" . $value . "'" . ",";
            else
                $stock = 1;
                
        }
        $inVariable = rtrim($inVariable, ',');

////////////////////////////////////////////////////////////////////////////////
//////////      SQL INJECTION PROBABLE VULNERABILITY, CHECK

    if($stock == 0)
      $results = \DB::select("SELECT count(*) as coun FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and  NOMFABRICANTE in ($inVariable)");
    if($stock == 1){  
     if($inVariable=="")
            $results = \DB::select("SELECT count(*) as coun FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and STOCK > '0'");
     else
            $results = \DB::select("SELECT count(*) as coun FROM " . self::$productTableName . " where TITULOSUBFAMILIA like \"$name\" and  NOMFABRICANTE in ($inVariable) and STOCK > '0'");
    
      
    }
      
    return $results[0]->coun;
   } 
                                                                                                    //////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
   
       
    static function countAllWhereTituloFamiliaPage2($name, $page){
          
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
FROM `menuBuilder` , `" . self::$productTableName . "` as csv
WHERE `csv`.CODFAMILIA = `menuBuilder`.CODFAMILIA
AND `csv`.TITULOFAMILIA = \"$str\"
GROUP BY CODSUBCATEGORIA
ORDER BY CODSUBCATEGORIA DESC
   ");
   /*
   try{
   print_r($results[0]);
   return $results[0]->CODSUBCATEGORIA;
   }catch(\Exception $e){
       echo "FAIL";
   }
   */
   
   if (!empty($results[0])){
       
    return $results[0]->CODSUBCATEGORIA;
    echo $results[0]->CODSUBCATEGORIA;
   }
}

   
/*
    if($results[0]->CODSUBCATEGORIA == 0)
       echo "wtf";
    else
        return $results[0]->CODSUBCATEGORIA;
        */
     
   
   
    static function getFamilyFromCategoryName($str){
              $str = self::makeFriendlier($str);
              
              
    //          SELECT count(TITULOSUBFAMILIA) FROM csv where TITULOFAMILIA like 'R' group by TITULOSUBFAMILIA
              
              
              
            $results = \DB::select("

                SELECT csv.TITULOFAMILIA, csv.TITULOFAMILIA as R,  menuBuilder.CODFAMILIA, menuBuilder.ORDER   FROM categorias,menuBuilder," . self::$productTableName . " as csv
                where categorias.code = menuBuilder.CODSUBCATEGORIA and
                menuBuilder.CODFAMILIA = csv.CODFAMILIA 
                and categorias.name like \"$str\" 
                group by csv.TITULOFAMILIA
                ORDER BY IF(ISNULL(menuBuilder.ORDER),1,0),menuBuilder.ORDER 
                
                                
   ");
   //print_r($results);
    return $results;
   }  
   
   
   static function getRandomProductByCategory($str){
                     $str = self::makeFriendlier($str);
              /*
            $results = \DB::select("

                SELECT * FROM csv
                where titulofamilia in(
                SELECT csv.TITULOFAMILIA FROM categorias,menuBuilder,csv 
                where categorias.index = menuBuilder.CODSUBCATEGORIA and
                menuBuilder.CODFAMILIA = csv.CODFAMILIA 
                and categorias.name like \"$str\" 
                group by csv.TITULOFAMILIA )
ORDER BY RAND()
LIMIT 1

                                
   ");*/
     $results = \DB::select("

                SELECT * FROM " . self::$productTableName . "
                order by rand()
                limit 4
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
    
    static function insertCategoryName($codCategoria){

                $affected = \DB::insert('insert into categorias (name) values (?)', [$codCategoria]);
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