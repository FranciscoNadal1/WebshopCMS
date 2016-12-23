<?php

/*
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

*/
//$app = new Silex\Application();
namespace Settings\twigSettings;

require_once  $_SERVER["DOCUMENT_ROOT"] . '/autoload.php';



class twig{
    
public static function fullSettings(\Silex\Application $app) {

     
    $app->register(new \Silex\Provider\TwigServiceProvider(), array(

        'twig.path' => 
            [
            $_SERVER["DOCUMENT_ROOT"] .  publicRoute . '/public', 
            $_SERVER["DOCUMENT_ROOT"] .  publicRoute . '/common',
            $_SERVER["DOCUMENT_ROOT"] .  errorHandlers . '/public',
            $_SERVER["DOCUMENT_ROOT"] .  errorHandlers . '/common',
            ],
    ));
    
    
    
    
   return $app;
}


}

?>