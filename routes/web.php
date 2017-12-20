<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
    
});

Route::get('/info', function () {
    phpinfo();
});



Route::get('/listado/{id}', function ($id) {
    
   //  $results =  DBData::getAllWhereTituloFamilia($id);  
     	$results =  DBData::getAllWhereTituloFamiliaPage($id, 0);  
     
	    return view('routes/productBrowser', [
		    'name' => 'index', 
		    'categoria' => $id,
		    'results' => $results
	    ]
    );
});



Route::get('/listado/{id}/{category}', function ($id, $category) {
    
   //  $results =  DBData::getAllWhereTituloFamilia($id);  
   
     	$results =  DBData::getAllWhereTituloFamiliaPagePlusFilters($id, 0, $category);  
     
     
	    return view('routes/productBrowser', [
		    'name' => 'index', 
		    'categoria' => $id,
		    'results' => $results
	    ]
    );
})->where('category', '.+');





//////////////////////////////////////////
/////		Imported from lumen




Route::get('/', function (){

    return view('routes/index', ['name' => 'index']
    
    );
     
     
});

Route::get('/login', function (){
    
    return view('layouts/app', ['name' => 'login']
    
    );
});

Route::get('/listado/{id}', function ($id){
    
   //  $results =  DBData::getAllWhereTituloFamilia($id);  
     $results =  DBData::getAllWhereTituloFamiliaPage($id, 0);  
     
    return view('routes/productBrowser', ['name' => 'index', 
    'categoria' => $id,
    'results' => $results]
    
    );
    
    
});


////////////////////////////////////////////////////////////////////////////////
//////              Ver productos de determinada categoria
Route::get('/categoria/{id}', function ($id){

     $results =  DBData::getAllWhereTituloFamilia($id);  
   
    return view('routes/categoryBrowser', [
        'name' => 'index',
        'categoria' => $id,
        'results' => $results,
    
        ]);
    });
                                                                          //////
////////////////////////////////////////////////////////////////////////////////



Route::get('/producto/{id}', function ($id){
    

     $results =  DBData::getProductDBInfo($id);  
     
    return view('routes/productDescription', [
        'results' => $results,
        'name' => DBData::desAccentify($id)
        
        ]);
});
Route::get('/test', function (){
    return view('admin/testChamber', ['name' => 'testts']
    
    );
});







Route::group(['prefix' => '/test/test'], function ($app) {


    return "hola k ase";


});






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////// ROUTES TO RAW INCLUDES, TO BE USED BY SCRIPTS

Route::get('/sampleProductList', function (){
    
     $results =  DBData::getAllWhereTituloFamilia("Minitorre y Microtorre");  
    return view('includes/gridProductListPage', ['name' => 'sample', 'resu' => $results[0]]
    );
});

Route::get('/sampleProductList/{page}/{name}', function ($page, $name){
    
     $results =  DBData::getAllWhereTituloFamiliaPage($name, $page);  
    return view('includes/gridProductListPage', ['name' => 'sample', 'results' => $results]
    );
});

Route::get('/countSampleProductList/{page}/{name}', function ($page, $name){
    
    $results =  DBData::countAllWhereTituloFamiliaPage($name, $page);  
   // return $results[0]->c;
 
 
   return $results[0]->d;
});






////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// MUST ADD PERMISSION THINGS //////////////////////////////////////////////////////////////////////////////////////////////////////////



Route::get('/admin', function (){
    return view('admin/productCallStatistics', ['name' => 'adminDashboard']
    );
});

Route::get('/admin/settings', function (){
    return view('admin/settings', ['name' => 'adminDashboard']
    );
});

Route::get('/admin/mail', function (){
    return view('admin/mailPanel', ['name' => 'adminDashboard']
    );
});
Route::post('/admin/settings', function (){
    return view('admin/settings', ['name' => 'adminDashboard']
    );
});



Route::get('/dropDownTest', function (){
    return view('commonIncludes/dropDown', ['name' => 'adminDashboard']
    );
});


Route::get('/admin/changeCategories', function (){
    return view('admin/changeCategories', ['name' => 'adminDashboard']
    );
});

Route::post('/admin/changeCategories', function (){
    return view('admin/changeCategories', ['name' => 'adminDashboard']
    );
});

Route::get('/admin/updaterBenefits', function (){
    return view('admin/updaterBenefits', ['name' => 'updaterBenefits']
    );
});






Route::get('/admin/productCallStatistics', function (){
    return view('admin/productCallStatistics', ['name' => 'Product Call Statistics']
    );
});

Route::get('/admin/updater', function (){
    return view('admin/automaticUpdater', ['name' => 'Updater']
    );
});

Route::get('/admin/testChamber', function (){
    return view('admin/testChamber', ['name' => 'Product Call Statistics']
    );
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
