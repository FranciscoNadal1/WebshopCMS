<?php

/*
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

*/
//$app = new Silex\Application();
namespace Settings\redirections;

require_once  $_SERVER["DOCUMENT_ROOT"] . '/autoload.php';



class redirections{
    
public static function allRedirects(\Silex\Application $app) {

     
    $app->get('/test', function () use ($app){
     return $app['twig']->render('index.html', array(
                'name' => $name,
            ));
    });           
    
    $app->get('/', function () use ($app){
     return $app['twig']->render('index.html', array(
                'name' => $name,
            ));
    });
    


    
   return $app;
}


}

?>