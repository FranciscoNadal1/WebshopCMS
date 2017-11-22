@extends('mainTemplates/template')
        


       @section('content')
      
            <?php
            
            
            ///////                 Provisional
            if(!isset($categoria)){
                    $categoria = "AMD socket AM4";
                    
                    $results =  \DBData::getAllWhereTituloFamilia($categoria);  
                
            }
            
            ?>


            
<div id="" class="">  
    <div id="container"  class="produContainer container-fluid categoryContainer">
            @include('includes/productList')
            
    
               
    <button id="btn1" class="loadMoreProducts">Cargar mas productos</button>     
       </div>         
            @endsection
</div>