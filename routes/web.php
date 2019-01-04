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
		    'coun' => $count,
		    'results' => $results
	    ]
    );
});


Route::post('/form', function () {
    
    $email;$comment;$captcha;
        if(isset($_POST['email'])){
          $email=$_POST['email'];
        }if(isset($_POST['comment'])){
          $email=$_POST['comment'];
        }if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          echo '<h2>Please check the the captcha form.</h2>';
          exit;
        }
        $secretKey = "6Lc7HWIUAAAAANVoDtPLWzDDm9NueBxNxTMDxHvy";
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);
        $mailSent = 0;
        if(intval($responseKeys["success"]) !== 1) {
          $mailSent = 'Has enviado demasiados mensajes';
        } else {
          $mailSent =  'Se ha enviado el mail';
        }
        
        
    return view('routes/contact', ['name' => 'index', 'mailSent' => $mailSent]);
        
});



Route::get('/image', function () {
    
    header("Content-type: image/png");
    //$string = $_GET['text'];
    $im     = imagecreatefrompng();
    $orange = imagecolorallocate($im, 220, 210, 60);
    $px     = (imagesx($im) - 7.5 * strlen($string)) / 2;
    imagestring($im, 3, $px, 9, $string, $orange);
    imagepng($im);
    imagedestroy($im);
    
});



Route::get('/listado/{id}/{category}', function ($id, $category) {
    
   //  $results =  DBData::getAllWhereTituloFamilia($id);  
   
     	$results =  DBData::getAllWhereTituloFamiliaPagePlusFiltersNew($id, 0, $category);  
     	$count =  DBData::countAllWhereTituloFamiliaPagePlusFiltersNew($id, 0, $category);  
     	
	    return view('routes/productBrowser', [
		    'name' => 'index', 
		    'categoria' => $id,
		    'list' => $category,
		    'coun' => $count,
		    'results' => $results
	    ]
    );
})->where('category', '.+');





Route::post('/listado/{id}/{category}', function ($id, $category) {
    
   //  $results =  DBData::getAllWhereTituloFamilia($id);  
   
     	$results =  DBData::getAllWhereTituloFamiliaPagePlusFiltersOrderNew($id, 0, $category, $_REQUEST['order']);  
     	$count =  DBData::countAllWhereTituloFamiliaPagePlusFiltersNew($id, 0, $category);  
     	
	    return view('routes/productBrowser', [
		    'name' => 'index', 
		    'categoria' => $id,
		    'list' => $category,
		    'coun' => $count,
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


Route::get('/hello', function (){
    echo "how do you do";
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
    
     $results =  DBData::getAllWhereTituloFamiliaPagePlusFiltersNew($name, $page, $category);  
    return view('includes/gridProductListPage', ['name' => 'sample', 'results' => $results]
    );
})->where('category', '.+');

Route::post('/sampleProductList/{page}/{name}/filters/{category}', function ($page, $name, $category){
    


     $results =  DBData::getAllWhereTituloFamiliaPagePlusFiltersOrderNew($name, $page, $category, $_REQUEST['order']);  
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



Route::get('/admin/bannerInicial', function (){
    return view('admin/bannerInicial', ['name' => 'adminDashboard']
    );
});

Route::post('/admin/bannerInicial', function (){
    return view('admin/bannerInicial', ['name' => 'adminDashboard']
    );
});

Route::get('/borrarBanner/{id}', function($id){
    

    
       $deleted = \DB::delete("delete from initialBanner where Code = $id");
           return redirect('/admin/bannerInicial');
    
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
    
    return(MailData::getMail($id));
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



Route::get('/admin/updater/filters', function (){
    
    ini_set('max_execution_time', 0);
 
            $time_start = microtime(true); 
        try{
       //     infortisaApi::getSpecifications();
            infortisaApi::getSpecificationAttribute();
            infortisaApi::getAttributeOption();
            
        }catch(\Exception $e){
            echo $e;    
        }
        
        try{
          //  infortisaApi::getSpecificationsLimitedNumber(0,180000);
          
        echo "<meta http-equiv='refresh' content=\"0; url=/admin/updater/filters/0/30000\" />";
        //    infortisaApi::getSpecificationAttribute();
        //    infortisaApi::getAttributeOption();
            
        }catch(\Exception $e){
            echo $e;    
        }
        
            echo "</br>Total number" .  infortisaApi::getSpecificationsNumberOfItems();
        
            $time_end = microtime(true);
        
        //dividing with 60 will give the execution time in minutes otherwise seconds
        $execution_time = ($time_end - $time_start)/60;
        
        //execution time of the script
        echo '<b>Total Execution Time:</b> '.$execution_time.' Mins';



});

Route::get('/admin/updater/filters/{startNumber}/{cuantity}', function ($startNumber, $cuantity){
    
 infortisaApi::getSpecificationsLimitedNumber($startNumber,$cuantity);
 $startPlusCuantity = $startNumber+$cuantity;
 if(($startNumber) < infortisaApi::getSpecificationsNumberOfItems())
echo "<meta http-equiv='refresh' content=\"0; url=/admin/updater/filters/$startPlusCuantity/$cuantity\" />";

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



Route::get('/deleteOne/{id}', function($id){
    

        $cola = array();
        
        
    for($i = 0; $i != sizeOf(Session::get('cart')); $i++){
        
        if(!(Session::get('cart')[$i] ['id'] == $id)){
            
            
                     $item = [
                  'id' => Session::get('cart')[$i] ['id'],
                  'provider' => Session::get('cart')[$i] ['provider'],
                  'price' => Session::get('cart')[$i] ['price'],
                  'name' => Session::get('cart')[$i] ['name'],
                ];
        
                array_push($cola, $item);
            }
    }
    
    Session::forget('cart');
        
        foreach ($cola as $valor){
            Session::push('cart', $valor);
        }
    
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
