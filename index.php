<?php

require_once __DIR__.'/vendor/autoload.php';


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


$app = new Silex\Application();

$errorHandlers = '/errorHandlers';
$publicRoute = '/views';

$app->register(new Silex\Provider\TwigServiceProvider(), array(

        'twig.path' => 
            [
            __DIR__. '/web' . $publicRoute . '/public', 
            __DIR__. '/web' . $publicRoute . '/common',
            __DIR__. '/web' . $errorHandlers . '/public',
            __DIR__. '/web' . $errorHandlers . '/common',
            ],
    ));
    
$app['debug'] = true;
 
$app->error(function (Exception $e, $code) use($app, $errorHandlers){
   
    switch($code){
        case 404:
            
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

$app->get('/', function () use ($app){
 return $app['twig']->render('index.html', array(
            'name' => $name,
        ));
    
});

$app->get('/foo', function () {
    return 'Hello!';
    
});

$app->get('/hello', function () {
    return 'Hello!';
    
});

    
$app->get('/test', function () use($app, $publicRoute, $errorHandlers) {
    
       return $app['twig']->render('index.html', array(
            'name' => $name,
        ));
   
});


$app->run();
