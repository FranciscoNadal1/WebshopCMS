@extends('mainTemplates/template')
        
<style>
    
    .loadMoreProducts{
        display:none;
        
    }
    
    #wrapper{
        top:135px !important;
    }
    
    
</style>

       @section('content')
           <div class="owl-item">
   <div class="item">
      <div class="banner-principal slide-ordenadores-pccom default-slide" data-style="background-image: url(https://cdn.pccomponentes.com/img/banners-promociones/slider-home/pccom-redesign/bg-min.jpg);" style="background-image: url(https://cdn.pccomponentes.com/img/banners-promociones/slider-home/pccom-redesign/bg-min.jpg);">
         <div class="container"><a class="GTM-home-slider" href="/pccom" data-idslider="ordenadores pccom"><img src="https://cdn.pccomponentes.com/img/banners-promociones/slider-home/pccom-redesign/hero.png" alt="ordenadores pccom" class="hero-img img-fluid"></a></div>
      </div>
   </div>
</div>    
            <?php

                    $results =  \DBData::GetAllNovedades();  
                
            ?>


            
<div id="" class="">  
    <div id="container"  class="produContainer container-fluid categoryContainer">
            @include('includes/indexProductList')
            
    
               
    <button id="btn1" class="loadMoreProducts">Cargar mas productos</button>     
       </div>         
            @endsection
</div>