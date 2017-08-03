<?php

require_once __DIR__.'/../vendor/autoload.php';


use Providers\infortisa\infortisaGets as infortisaGets;




/*
|--------------------------------------------------------------------------
| Load provider classes
|--------------------------------------------------------------------------
|
| This will load all php files on the folder providers, might change how
| this works if i don't like the performance 
|
*/

$dir = new RecursiveDirectoryIterator( __DIR__.'/../resources/providers');
foreach (new RecursiveIteratorIterator($dir) as $file) {
    if (!is_dir($file)) {
        if( fnmatch('*.php', $file) )
                        if (strpos($file, 'no_') == false) 
            include $file;
    }
}


/*
|--------------------------------------------------------------------------
| Load model classes
|--------------------------------------------------------------------------
|
| Same as before, but it will load all model classes on the folder app/Models
|
*/

$dir2 = new RecursiveDirectoryIterator( __DIR__.'/../app/Models');
foreach (new RecursiveIteratorIterator($dir2) as $file) {
    if (!is_dir($file)) {
        if( fnmatch('*.php', $file) )
                        if (strpos($file, 'no_') == false) 
            include $file;
    }
}




//|--------------------------------------------------------------------------




try {
    (new Dotenv\Dotenv(__DIR__.'/../'))->load();
} catch (Dotenv\Exception\InvalidPathException $e) {
    //
}

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| Here we will load the environment and create the application instance
| that serves as the central piece of this framework. We'll use this
| application as an "IoC" container and router for this framework.
|
*/

$app = new Laravel\Lumen\Application(
    realpath(__DIR__.'/../')
);

 $app->withFacades();
 
/*
|--------------------------------------------------------------------------
| Register Model Alias
|--------------------------------------------------------------------------
|
| Now we will register a few alias for the used models
|
*/


class_alias('Settings\getSettings', 'GetSettings');
class_alias('Assets\AssetManager', 'GetAsset');
class_alias('Providers\infortisa\infortisaApi', 'infortisaApi');
class_alias('DBQuerys\DBData', 'DBData');
class_alias('ApiCallNumber\ApiNumber', 'ApiCount');
class_alias('ProductViewNumber\ProductViewNumber', 'ProductViewNumber');

// $app->withEloquent();

/*
|--------------------------------------------------------------------------
| Register Container Bindings
|--------------------------------------------------------------------------
|
| Now we will register a few bindings in the service container. We will
| register the exception handler and the console kernel. You may add
| your own bindings here if you like or you can make another file.
|
*/


$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

$app->singleton(
    
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    
    Assets\AssetManager::class,
    GetAsset::class
);

/*
|--------------------------------------------------------------------------
| Register Middleware
|--------------------------------------------------------------------------
|
| Next, we will register the middleware with the application. These can
| be global middleware that run before and after each request into a
| route or middleware that'll be assigned to some specific routes.
|
*/

 $app->middleware([
    App\Http\Middleware\ExampleMiddleware::class
 ]);

 $app->routeMiddleware([
     'auth' => App\Http\Middleware\Authenticate::class,
 ]);

/*
|--------------------------------------------------------------------------
| Register Service Providers
|--------------------------------------------------------------------------
|
| Here we will register all of the application's service providers which
| are used to bind services into the container. Service providers are
| totally optional, so you are not required to uncomment this line.
|
*/

// $app->register(App\Providers\AppServiceProvider::class);
// $app->register(App\Providers\AuthServiceProvider::class);
// $app->register(App\Providers\EventServiceProvider::class);

/*
|--------------------------------------------------------------------------
| Load The Application Routes
|--------------------------------------------------------------------------
|
| Next we will include the routes file so that they can all be added to
| the application. This will provide all of the URLs the application
| can respond to, as well as the controllers that may handle them.
|
*/

$app->group(['namespace' => 'App\Http\Controllers'], function ($app) {
    require __DIR__.'/../app/Http/routes.php';
});

return $app;
