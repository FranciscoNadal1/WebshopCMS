<?php

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

$app = new Illuminate\Foundation\Application(
    realpath(__DIR__.'/../')
);

/*
|--------------------------------------------------------------------------
| Bind Important Interfaces
|--------------------------------------------------------------------------
|
| Next, we need to bind some important interfaces into the container so
| we will be able to resolve them when needed. The kernels serve the
| incoming requests to this application from both the web and CLI.
|
*/

$app->singleton(
    Illuminate\Contracts\Http\Kernel::class,
    App\Http\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Console\Kernel::class,
    App\Console\Kernel::class
);

$app->singleton(
    Illuminate\Contracts\Debug\ExceptionHandler::class,
    App\Exceptions\Handler::class
);

/*
|--------------------------------------------------------------------------
| Return The Application
|--------------------------------------------------------------------------
|
| This script returns the application instance. The instance is given to
| the calling script so we can separate the building of the instances
| from the actual running of the application and sending responses.
|
*/






/*
|--------------------------------------------------------------------------
| Load provider classes
|--------------------------------------------------------------------------
|
| This will load all php files on the folder providers, might change how
| this works if i don't like the performance 
|
*/


include(__DIR__.'/../resources/providers/ProvidersApiInterface.php');

$dir = new RecursiveDirectoryIterator( __DIR__.'/../resources/providers');
foreach (new RecursiveIteratorIterator($dir) as $file) {
    if (!is_dir($file)) {
        if( fnmatch('*api.php', $file) )
                        if (strpos($file, 'no_') == false ) 
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
class_alias('Providers\home\homeApi', 'homeApi');
class_alias('DBQueries\DBData', 'DBData');
class_alias('ApiCallNumber\ApiNumber', 'ApiCount');
class_alias('ProductViewNumber\ProductViewNumber', 'ProductViewNumber');
class_alias('tools\ToolManager', 'Tools');
class_alias('MailQueries\MailData', 'MailData');

//|--------------------------------------------------------------------------



																						////////
////////////////////////////////////////////////////////////////////////////////////////////////
return $app;
