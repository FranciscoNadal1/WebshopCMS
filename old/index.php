<?php

$rustart = getrusage();
//$timeObject = new timer();


require_once $_SERVER["DOCUMENT_ROOT"].'/autoload.php';
//require_once 'phar://'.$_SERVER["DOCUMENT_ROOT"].'/silex.phar/autoload.php';


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Settings\twigSettings\twig as twigSettings;
use Settings\redirections\redirections as redirections;
use Settings\httpStatusErrors\statusErrors as statusErrors;
use Admin\adminBar\adminBar as adminBar;


$app = new Silex\Application();




$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider());

$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => '127.0.0.1',
    'dbname'   => 'c9',
    'user'     => 'x1zk0',
    'password' => '',
);

$app['orm.proxies_dir'] = __DIR__.'/../cache/doctrine/proxies';
$app['orm.default_cache'] = 'array';
$app['orm.em.options'] = array(
    'mappings' => array(
        array(
            'type' => 'annotation',
            'path' => __DIR__.'/../../src',
            'namespace' => 'Entity\entidad',
        ),
    ),
);


/*
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options'    => array(
    'driver'        => 'pdo_mysql',
    'host'          => 'localhost',
    'dbname'        => 'c9',
    'user'          => 'x1zk0',
    'password'      => '',
    'charset'       => 'utf8',
    'driverOptions' => array(1002 => 'SET NAMES utf8',),
  ),
));

$app->register(new Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider, array(
    "orm.em.options" => array(
         "mappings" => array(
            array(
               "type"      => "yml",
               "namespace" => "Entity",
               "path"      => realpath(__DIR__."/settings/doctrine"),
              ),
            ),
         ),
));
*/

/*

use \Doctrine\Common\Cache\ApcCache;
use \Doctrine\Common\Cache\ArrayCache;
*/
// Register Doctrine DBAL
/*
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    // Doctrine DBAL settings goes here
));*/

// Register Doctrine ORM
/*
$app->register(new Silex\Provider\DoctrineOrmServiceProvider(), array(
    'db.orm.proxies_dir'           => __DIR__ . '/cache/doctrine/proxy',
    'db.orm.proxies_namespace'     => 'DoctrineProxy',
    'db.orm.cache'                 => 
        !$app['debug'] && extension_loaded('apc') ? new ApcCache() : new ArrayCache(),
    'db.orm.auto_generate_proxies' => true,
    'db.orm.entities'              => array(array(
        'type'      => 'annotation',       // entity definition 
        'path'      => __DIR__ . '/src',   // path to your entity classes
        'namespace' => 'MyWebsite\Entity', // your classes namespace
    )),
));
*/







/*
$twig = new Twig_Environment($loader, array(
    'cache' => '/path/to/compilation_cache',
));
*/
/*
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider());

$app['db.options'] = array(
    'driver'   => 'pdo_mysql',
    'charset'  => 'utf8',
    'host'     => '127.0.0.1',
    'dbname'   => '',
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
            'namespace' => 'Entidad',
        ),
    ),
);
*/
/*

$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options'    => array(
    'driver'        => 'pdo_mysql',
    'host'          => 'localhost',
    'dbname'        => 'name',
    'user'          => 'root',
    'password'      => '',
    'charset'       => 'utf8',
    'driverOptions' => array(1002 => 'SET NAMES utf8',),
  ),
));

$app->register(new Dflydev\Silex\Provider\DoctrineOrm\DoctrineOrmServiceProvider, array(
    "orm.em.options" => array(
         "mappings" => array(
            array(
               "type"      => "yml",
               "namespace" => "Entity",
               "path"      => realpath(__DIR__."/config/doctrine"),
              ),
            ),
         ),
));
*/

    $app['debug'] = true;


///////////////////////////////////////////////
//          TWIG SETTINGS

    $app = twigSettings::fullSettings($app);
///////////////////////////////////////////////
//          HTTP ERROR HANDLING

    $app = statusErrors::allErrors($app);
///////////////////////////////////////////////
//          REDIRECTIONS

    $app = redirections::allRedirects($app);
///////////////////////////////////////////////


////////////////////////////////////////////////////////////////////
/*
   for($i;$i!=1000000;$i++)
    $random = rand();
    */
/*
$app->before(function() use ($app){

});

    */
    
///////////////////////////////////////////////////////////////////


    $app->before(function() use ($app){
        adminBar::getBar($rustart);
    });

$app->run();
