<?php

/*
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

*/
//$app = new Silex\Application();
namespace Settings\doctrine;

require_once  $_SERVER["DOCUMENT_ROOT"] . '/autoload.php';



class doctrine{
    
public static function fullSettings(\Silex\Application $app) {

     
        $app['db.options'] = array(
            'driver'   => 'pdo_mysql',
            'charset'  => 'utf8',
            'host'     => 'x1zk0-webshopcms-3726701',
            'dbname'   => 'c9',
            'user'     => '',
            'password' => '',
        );
        
        $app['orm.proxies_dir'] = __DIR__.'/../cache/doctrine/proxies';
        $app['orm.default_cache'] = 'array';
        $app['orm.em.options'] = array(
            'mappings' => array(
                array(
                    'type' => 'annotation',
                    'path' => __DIR__.'/../../src',
                    'namespace' => 'My\\Namespace\\To\\Entity',
                ),
            ),
        );

    
    
    
    
   return $app;
}


}

?>