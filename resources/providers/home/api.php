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
}

?>