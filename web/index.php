<?php

require_once __DIR__.'/../vendor/autoload.php';


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


$app = new Silex\Application();





 
$app->error(function (Exception $e, $code) use($app){
   
    switch($code){
        case 404:
            $message = 'no va';
            break;
        default:
            $message = 'tampoco va';
    }
    
    return new Response($message);
    
}
);



$app->get('/hello', function () {
    return 'Hello!';
});

$app->get('/hello', function () {
    return 'Hello!';
});

$app->run();
