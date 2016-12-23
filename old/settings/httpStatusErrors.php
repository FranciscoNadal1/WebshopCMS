<?php

/*
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

*/
//$app = new Silex\Application();
namespace Settings\httpStatusErrors;

require_once  $_SERVER["DOCUMENT_ROOT"] . '/autoload.php';



class statusErrors{
    
public static function allErrors(\Silex\Application $app) {

     
    $app->error(function (\Exception $e, $code) use($app, $errorHandlers){
       
        switch($code){
            
            case 500:
                return $app['twig']->render('500.html', array(
                'errorText' => $e,
                ));
                break;
                
            case 404:
                return $app['twig']->render('404.html', array(
                'errorText' => $e,
                ));
                break;
                
            default:
                $message = 'tampoco va';
                return $e;
                break;
                
        }
        
        return new Response($message);
        
    });
    
   return $app;
}


}

?>