<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return view('routes/productBrowser', ['name' => 'index']
    
    );
});


$app->get('/categoria', function () use ($app) {
    return view('routes/productBrowser', ['name' => 'index']
    
    );
});


////////////////////////////////////////////////////////////////////////////////
//////              Ver productos de determinada categoria
$app->get('/categoria/{id}', function ($id) use ($app) {

     $results =  DBData::getAllWhereTituloFamilia($id);  
   
    return view('routes/productBrowser', [
        'name' => 'index',
        'categoria' => $id,
        'results' => $results,
    
        ]);
    });
                                                                          //////
////////////////////////////////////////////////////////////////////////////////



$app->get('/producto/{id}', function ($id) use ($app) {
    

    $results =  DBData::getProductDBInfo($id);  
     
    return view('routes/productDescription', [
        'results' => $results,
        'name' => DBData::desAccentify($id)
        
        ]);
});

