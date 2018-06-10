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
     	$count =  DBData::countAllWhereTituloFamiliaPage($id, 0);  
     	
     	
	    return view('routes/productBrowser', [
		    'name' => 'index', 
		    'categoria' => $id,
		    'countAllProducts' => $count,
		    'results' => $results
	    ]
    );
});



Route::get('/listado/{id}/{category}', function ($id, $category) {
    
   //  $results =  DBData::getAllWhereTituloFamilia($id);  
   
     	$results =  DBData::getAllWhereTituloFamiliaPagePlusFilters($id, 0, $category);  
     	$count =  DBData::countAllWhereTituloFamiliaPagePlusFilters($id, 0, $category);  
     	
     
	    return view('routes/productBrowser', [
		    'name' => 'index', 
		    'categoria' => $id,
		    'list' => $category,
		    'countAllProducts' => $count,
		    'results' => $results
	    ]
    );
})->where('category', '.+');

Route::post('/listado/{id}/{category}', function ($id, $category) {
    
   //  $results =  DBData::getAllWhereTituloFamilia($id);  
   
     	$results =  DBData::getAllWhereTituloFamiliaPagePlusFiltersOrder($id, 0, $category, $_REQUEST['order']);  
     	$count =  DBData::countAllWhereTituloFamiliaPagePlusFilters($id, 0, $category);  
     	
     
	    return view('routes/productBrowser', [
		    'name' => 'index', 
		    'categoria' => $id,
		    'list' => $category,
		    'countAllProducts' => $count,
		    'results' => $results
	    ]
    );
})->where('category', '.+');


//////////////////////////////////////////
/////       Custom pages web

Route::get('/condicionesEmpresa', function (){
    return view('routes/businessCondition', ['name' => 'index']
    );
});

Route::get('/contacto', function (){
    return view('routes/contact', ['name' => 'index']
    );
});

Route::get('/politicaPrivacidad', function (){
    return view('routes/privacyPolicy', ['name' => 'index']
    );
});

Route::get('/condicionesVenta', function (){
    return view('routes/sellConditions', ['name' => 'index']
    );
});

Route::get('/entregaTransporte', function (){
    return view('routes/transportAndDelivery', ['name' => 'index']
    );
});











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
     $count     =  DBData::countAllWhereTituloFamiliaPage($id, 0);  
     
    return view('routes/productBrowser', ['name' => 'index', 
    'categoria' => $id,
    'countAllProducts' => $count,
    'results' => $results]
    
    );
    
    
});
Route::post('/search/{id}', function ($id){
    
   //  $results =  DBData::getAllWhereTituloFamilia($id);  
     $results   =  DBData::getSearchData($id, 0);  
     $count     =  DBData::countSearchData($id);  
     
     if(!empty($results)){
    return view('includes/search', ['name' => 'index', 
    'categoria' => $id,
    'countAllProducts' => $count,
    'results' => $results
    ]
    
    );
     }
     else{
         return("No se han encontrado resultados");
     }
    
});
Route::get('/search/{id}', function ($id){
    
   //  $results =  DBData::getAllWhereTituloFamilia($id);  
     $results =  DBData::getSearchData($id, 0);  
     $count     =  DBData::countSearchData($id);  
     
     
     if(!empty($results)){
    return view('includes/search', ['name' => 'index', 
    'categoria' => $id,
    'countAllProducts' => $count,
    'results' => $results
    ]
    
    );
     }
     else{
         return("No se han encontrado resultados");
     }
    
});

Route::get('/buscador/{id}', function ($id){
    
   //  $results =  DBData::getAllWhereTituloFamilia($id);  
     $results =  DBData::getSearchData($id, 0);  
     $count     =  DBData::countSearchData($id);  
     
     
     
     if(!empty($results)){
    return view('routes/productSearcher', ['name' => 'index', 
    'categoria' => $id,
    'countAllProducts' => $count,
    'results' => $results]
    
    );
     }
     else{
         return("No se han encontrado resultados");
     }
    
});

Route::get('/buscador', function (){
    
    $id = $_REQUEST['query'];
   //  $results =  DBData::getAllWhereTituloFamilia($id);  
     $results =  DBData::getSearchData($id, 0);  
     $count     =  DBData::countSearchData($id);  
     
     
     
     if(!empty($results)){
    return view('routes/productSearcher', ['name' => 'index', 
    'categoria' => $id,
    'countAllProducts' => $count,
    'results' => $results]
    
    );
     }
     else{
         return("No se han encontrado resultados");
     }
    
});

Route::post('/buscador', function (){
    
    $id = $_REQUEST['query'];
   //  $results =  DBData::getAllWhereTituloFamilia($id);  
     $results =  DBData::getSearchData($id, 0);  
     $count     =  DBData::countSearchData($id);  
     
     
     
     if(!empty($results)){
    return view('routes/productSearcher', ['name' => 'index', 
    'categoria' => $id,
    'countAllProducts' => $count,
    'results' => $results]
    
    );
     }
     else{
         return("No se han encontrado resultados");
     }
    
});






Route::get('/buscador/{id}/{filters}', function ($id, $filters){
    
   //  $results =  DBData::getAllWhereTituloFamilia($id);  
     $results =  DBData::getSearchDataPlusFilters($id, 0, $filters);  
     $count     =  DBData::countSearchDataPlusFilters($id,$filters);  
     
     
     if(!empty($results)){
        return view('routes/productSearcher', ['name' => 'index', 
        'categoria' => $id,
        'countAllProducts' => $count,
        'results' => $results]    );
     }
     else{
         return("No se han encontrado resultados");
     }
    
})->where('filters', '.+');







Route::get('/sampleProductList/{page}/{name}/filters/{category}', function ($page, $name, $category){
    
     $results =  DBData::getAllWhereTituloFamiliaPagePlusFilters($name, $page, $category);  
    return view('includes/gridProductListPage', ['name' => 'sample', 'results' => $results]
    );
})->where('category', '.+');

















Route::post('/listado/{id}', function ($id){
    
   //  $results =  DBData::getAllWhereTituloFamilia($id);  
     $results   =  DBData::getAllWhereTituloFamiliaPageOrder($id, 0, $_REQUEST['order']);  
     $count     =  DBData::countAllWhereTituloFamiliaPage($id, 0, "");  
    return view('routes/productBrowser', ['name' => 'postListado', 
    'categoria' => $id,
    'countAllProducts' => $count,
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




Route::get('/sampleProductList/{page}/{name}/order/{order}', function ($page, $name, $order){

     $results =  DBData::getAllWhereTituloFamiliaPageOrder($name, $page,$order);  
    return view('includes/gridProductListPage', ['name' => 'sample', 'results' => $results]
    );
});

Route::post('/sampleProductList/{page}/{name}/order/{order}', function ($page, $name, $order){
    
     $results =  DBData::getAllWhereTituloFamiliaPageOrder($name, $page,$order);  
    return view('includes/gridProductListPage', ['name' => 'sample', 'results' => $results]
    );
});
/*
Route::post('/sampleProductList/{page}/{name}/filters', function ($page, $name){


     $results =  DBData::getAllWhereTituloFamiliaPagePlusFiltersOrder($name, $page,"",$_REQUEST['order']);  
    return view('includes/gridProductListPage', ['name' => 'sample', 'results' => $results]
    );
});
*/

Route::get('/sampleProductList/{page}/{name}/filters/{category}', function ($page, $name, $category){
    
     $results =  DBData::getAllWhereTituloFamiliaPagePlusFilters($name, $page, $category);  
    return view('includes/gridProductListPage', ['name' => 'sample', 'results' => $results]
    );
})->where('category', '.+');

Route::post('/sampleProductList/{page}/{name}/filters/{category}', function ($page, $name, $category){
    


     $results =  DBData::getAllWhereTituloFamiliaPagePlusFiltersOrder($name, $page, $category, $_REQUEST['order']);  
    return view('includes/gridProductListPage', ['name' => 'sample', 'results' => $results]
    );
})->where('category', '.+');



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

Route::get('/admin/editPCs', function (){
    return view('admin/editPCs', ['name' => 'adminDashboard']
    );
});

Route::get('/admin/addpc', function (){
    return view('admin/addPCElectroaita', ['name' => 'adminDashboard']
    );
});

Route::post('/admin/addpc', function (){
    return view('admin/addPCElectroaita', ['name' => 'adminDashboard']
    );
});



Route::get('/admin/modifypc/{code}', function ($code){
    return view('admin/modifyPCElectroaita', ['name' => 'adminDashboard', 'code' => $code]
    );
});


Route::get('/admin/changeOrder/{code}/{order}', function ($code, $order){
    \DB::table('menuBuilder')
            ->where('CODFAMILIA', $code)
            ->update(['order' => $order]);
});

Route::get('/admin/deletepc/{code}', function ($code){
    return view('admin/deletePCElectroaita', ['name' => 'adminDashboard', 'code' => $code]
    );
});

Route::get('/admin/orderCategories', function (){
    return view('admin/orderCategories', ['name' => 'adminDashboard']
    );
});

Route::post('/admin/modifypc/{code}', function ($code){
    return view('admin/modifyPCElectroaita', ['name' => 'adminDashboard', 'code' => $code]
    );
});

Route::post('/admin/modifypc', function (){
    return view('admin/modifyPCElectroaita', ['name' => 'adminDashboard']
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
Route::get('/admin/mail/{id}', function ($id){
    
   //  $results =  DBData::getAllWhereTituloFamilia($id);  
   //  $results =  DBData::getAllWhereTituloFamiliaPage($id, 0);  
     /*
    return view('routes/productBrowser', ['name' => 'index', 
    'categoria' => $id,
    'results' => $results]
    
    );
    */
    \MailData::setMailIsRead($id); 
    
    return((string)MailData::getMail($id));
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

Route::get('/admin/cleanLocal', function (){
    \Tools::cleanLocalFiles();

});

Route::get('/admin/testChamber', function (){
    return view('admin/testChamber', ['name' => 'Product Call Statistics']
    );
});





Route::get('/forget', function (){
    
    
    


Session::forget('cart');



    
});





Route::get('/put/{id}/{provider}/{price}/{name}', function ($id, $provider, $price, $name){
    //  https://learninglaravel.net/how-to-use-session-in-laravel
    
    

$item = [
  'id' => $id,
  'provider' => $provider,
  'price' => $price,
  'name' => $name,
  
];

Session::push('cart', $item);



    
});


Route::get('/get', function (){
   // print_r(Session::get('key'));
    
    for($i = 0; $i != sizeOf(Session::get('cart')); $i++){
        print_r( Session::get('cart')[$i] ['id']);
    echo "<br>";
}
    
});
/*
Route::get('session/get','SessionController@accessAllSessionData');
Route::get('session/set','SessionController@storeSessionData');
Route::get('session/remove','SessionController@deleteSessionData');



Route::get('/session/set/{data}', ['uses' =>'SessionController@storeSessionData2', 'as'=>'routeName']);

*/






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
