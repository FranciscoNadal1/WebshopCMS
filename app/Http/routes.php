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
    //echo "asdf";
   // return $app->version();
    // return $app->make('view')->make('master');
    return view('routes/productBrowser', ['name' => 'index']
    
    );
});


$app->get('/categoria', function () use ($app) {
    //echo "asdf";
   // return $app->version();
    // return $app->make('view')->make('master');
    return view('routes/productBrowser', ['name' => 'index']
    
    );
});


////////////////////////////////////////////////////////////////////////////////
//////              Ver productos de determinada categoria
$app->get('/categoria/{id}', function ($id) use ($app) {


// use Providers\infortisa\infortisaGets as infortisaGets;
        $onlyconsonants = str_replace("-", "_", $id);
        $onlyconsonants = str_replace("/", "_", $onlyconsonants);
        $onlyconsonants = str_replace("-", "_", $onlyconsonants);
        
        
        $onlyconsonants = str_replace("a", "_", $onlyconsonants);
        $onlyconsonants = str_replace("e", "_", $onlyconsonants);
        $onlyconsonants = str_replace("i", "_", $onlyconsonants);
        $onlyconsonants = str_replace("o", "_", $onlyconsonants);
        $onlyconsonants = str_replace("u", "_", $onlyconsonants);
                
                
     //   echo $onlyconsonants;
        
    $results = DB::select("SELECT * FROM csv where TITULOSUBFAMILIA like \"$onlyconsonants\" group by CODIGOINTERNO");

    return view('routes/productBrowser', [
        'name' => 'index',
        'categoria' => $id,
        'results' => $results,
    
    ]);
});
                                                                          //////
////////////////////////////////////////////////////////////////////////////////



$app->get('categorias/{id}', function ($id) use ($app) {
    return view('routes/productBrowser', ['name' => 'index']);
});


$app->get('/producto/{id}', function ($id) use ($app) {
    
            $onlyconsonants = str_replace("-", "_", $id);
        $onlyconsonants = str_replace("/", "_", $onlyconsonants);
        $onlyconsonants = str_replace("-", "_", $onlyconsonants);
        
        
        $onlyconsonants = str_replace("a", "_", $onlyconsonants);
        $onlyconsonants = str_replace("e", "_", $onlyconsonants);
        $onlyconsonants = str_replace("i", "_", $onlyconsonants);
        $onlyconsonants = str_replace("o", "_", $onlyconsonants);
        $onlyconsonants = str_replace("u", "_", $onlyconsonants);
                
                
     //   echo $onlyconsonants;
        
    $results = DB::select("SELECT * FROM csv where TITULO like \"$onlyconsonants\" limit 1");
    return view('routes/productDescription', [
        'results' => $results,
        'name' => "$id"
        
        ]);
});

