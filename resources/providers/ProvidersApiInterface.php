<?php


namespace Providers\ProvidersApi;


interface ProvidersApiInterface
{
    
     static function getProductMainImage($cod_prod);
     static function get_imagenesLarge($cod_prod);
     static function get_imagenes_alternativas($cod_prod);
     static function get_tecnica($var);
     static function get_comercial($cod_prod);
     
     static function updateDatabase();
}

?>