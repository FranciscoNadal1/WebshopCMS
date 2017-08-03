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


$app->get('/listado/{id}', function ($id) use ($app) {
    
   //  $results =  DBData::getAllWhereTituloFamilia($id);  
     $results =  DBData::getAllWhereTituloFamiliaPage($id, 0);  
     
    return view('routes/productBrowser', ['name' => 'index', 
    'categoria' => $id,
    'results' => $results]
    
    );
    
    
});


////////////////////////////////////////////////////////////////////////////////
//////              Ver productos de determinada categoria
$app->get('/categoria/{id}', function ($id) use ($app) {

     $results =  DBData::getAllWhereTituloFamilia($id);  
   
    return view('routes/categoryBrowser', [
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
$app->get('/test', function () use ($app) {
    return view('routes/testChamber', ['name' => 'testts']
    
    );
});




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////// ROUTES TO RAW INCLUDES, TO BE USED BY SCRIPTS

$app->get('/sampleProductList', function () use ($app) {
    
     $results =  DBData::getAllWhereTituloFamilia("Minitorre y Microtorre");  
    return view('includes/gridProductListPage', ['name' => 'sample', 'resu' => $results[0]]
    );
});

$app->get('/sampleProductList/{page}/{name}', function ($page, $name) use ($app) {
    
     $results =  DBData::getAllWhereTituloFamiliaPage($name, $page);  
    return view('includes/gridProductListPage', ['name' => 'sample', 'results' => $results]
    );
});

$app->get('/countSampleProductList/{page}/{name}', function ($page, $name) use ($app) {
    
    $results =  DBData::countAllWhereTituloFamiliaPage($name, $page);  
   // return $results[0]->c;
 
 
   return $results[0]->d;
});






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// MUST ADD PERMISSION THINGS //////////////////////////////////////////////////////////////////////////////////////////////////////////

$app->post('/admin', function () use ($app) {
    return view('admin/adminDashboard', ['name' => 'adminDashboard']
    );
});
$app->get('/admin', function () use ($app) {
    return view('admin/adminDashboard', ['name' => 'adminDashboard']
    );
});
$app->get('/admin/productStatistics', function () use ($app) {
    return view('admin/productCallStatistics', ['name' => 'Product Call Statistics']
    );
});

$app->get('/admin/testChamber', function () use ($app) {
    return view('admin/testChamber', ['name' => 'Product Call Statistics']
    );
});

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
