<?php


namespace Providers\home;
use Providers\home\homeApi as homeApi;
use Providers\ProvidersApi\ProvidersApiInterface as ProvidersApiInterface;


class homeApi implements ProvidersApiInterface{
     static function getProductMainImage($cod_prod){
         
         
         
        return \GetAsset::getProductImg($cod_prod, "home");
     }
     static function get_imagenesLarge($cod_prod){
          return self::getProductMainImage($cod_prod);
        //  return "http://rossmillfarm.com/rossmill3/wp-content/uploads/2017/03/Testing.jpg";
         
     }
     static function get_imagenes_alternativas($cod_prod){
         
     }
     static function get_tecnica($cod_prod){
          
            $contenido = \DBData::getProductSpecifications($cod_prod);
        $contenido = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $contenido);
        $contenido = str_replace("<table","<table class=\" table table-bordered table-responsive table-striped\"",$contenido);
        $contenido = str_replace("width=\"65%\"","width=\"100%\"",$contenido);
        $contenido = str_replace("<tr","<tr class=\"specificationsTr\"",$contenido);

return $contenido;
       
       
     }
     static function get_comercial($cod_prod){
         return \DBData::getProductDescription($cod_prod);
     }
     
     
     
     
     static function updateDatabase(){
          
          ////////////////////////////////////////////////////////////////////////////////
//////				CREATE HOME DATABASE

          try{
          $create = \DB::statement("
          CREATE TABLE `home` (
            `REFFABRICANTE` char(27) collate utf8_bin default NULL,
          
            `TITULO` char(50) collate utf8_bin default NULL,
            `CODIGOINTERNO` char(50) collate utf8_bin default NULL,
          
            `EAN/UPC` char(15) collate utf8_bin default NULL,
            `CODFAMILIA` char(50) collate utf8_bin default NULL,
            `TITULOFAMILIA` char(28) collate utf8_bin default NULL,
            `CODSUBFAMILIA` char(10) collate utf8_bin default NULL,
            `TITULOSUBFAMILIA` char(30) collate utf8_bin default NULL,
            `CODFABRICANTE` char(70) collate utf8_bin default NULL,
            `NOMFABRICANTE` char(21) collate utf8_bin default NULL,  
            
            `PRECIO` double collate utf8_bin default NULL,
            
            `STOCK` char(7) collate utf8_bin default NULL,
            `PESO` char(8) collate utf8_bin default NULL,
            `PROXIMA_LLEGADA` char(90) collate utf8_bin default NULL,
            `CICLOVIDA` char(131) collate utf8_bin default NULL,
            `PLAZOENTREGA` char(131) collate utf8_bin default NULL,  
            
            PRIMARY KEY  (`CODIGOINTERNO`)
          ) ENGINE=innoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17801 ;
          	")  or die("e".mysql_error());
          }catch(\Exception $e){
          	
          }
          
     }
}

?>