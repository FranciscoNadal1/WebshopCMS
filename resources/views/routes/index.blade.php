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

      <?php     
            $results = \DB::select("SELECT * from initialBanner");
            $active = "active";
       ?>
   
   
   
    <div id ="myCarousel" class=" carousel slide"  data-ride="carousel">


    <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php $i = 0;$active1 = "active";?>
               @foreach ($results as $resul)
          <li data-target="#myCarousel" data-slide-to="{{ $i++ }}" class="{{ $active1 }}"></li>
          <?php $active1 = "";?>
               @endforeach
        </ol>
    
    
    
    
   <div class="carousel-inner" >

   @foreach ($results as $resul)
       
      <div class="item {{ $active }}" data-style="background-image: url(data:image/jpg;base64,{{ $resul->Background}})" style="background-image: url(data:image/jpg;base64,{{ $resul->Background}})">
         <div class="container">
                 <a class="" href="{{ $resul->URL}}" data-idslider="{{ $resul->URL}}">
                     <div class="hero-img img-fluid"  style="height:300px;background-size: 100% 100%; background-image: url(data:image/jpg;base64,{{ $resul->MainImage}})">
                         {{--
                         <img src=src="data:image/png;base64,{{ $resul->MainImage}}" alt="ordenadores pccom" class="hero-img img-fluid">
                         --}}
                     </div>
                 </a>
             </div>
      </div>
   
   <?php
   $active = "";
   ?>
   @endforeach
   
   
   
   </div>
       <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class=""></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class=""></span>
      <span class="sr-only">Next</span>
    </a>
    
    
    
</div>    
            <?php

                    $results =  \DBData::GetAllNovedades(8);  
                
            ?>


            
<div id="" class="">  
    <div id="container"  class="produContainer container-fluid categoryContainer">
            @include('includes/indexProductList')
            
    
               
    <button id="btn1" class="loadMoreProducts">Cargar mas productos</button>     
       </div>         
            @endsection
</div>