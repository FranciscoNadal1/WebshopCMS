<?php

require_once __DIR__.'/vendor/autoload.php';


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


$app = new Silex\Application();

$errorHandlers = 'web/errorHandlers/public';
$publicRoute = 'web/views/public/';

$app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__. '/' . $publicRoute,
        'twig.path' => __DIR__. '/' . $errorHandlers,
    ));
    


 
$app->error(function (Exception $e, $code) use($app, $errorHandlers){
   
    switch($code){
        case 404:
  //          include($errorHandlers . '/public/404.html');
       return $app['twig']->render('404.html', array(
            'name' => $name,
        ));            
            break;
        default:
            $message = 'tampoco va';
            return $e;
            break;
    }
    
    return new Response($message);
    
}
);



$app->get('/hello', function () {
    return 'Hello!';
    
});


 //   $app->get('twig.loader')->addPath($publicRoute);
 
    
    
$app->get('/test', function () use($app, $publicRoute, $errorHandlers) {
    
       return $app['twig']->render('index.html', array(
            'name' => $name,
        ));
        
        
          //  include($errorHandlers  . '404.twig');
          //  include($publicRoute    . 'index.html');
            
});


$app->run();
