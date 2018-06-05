<?php
    $type = $results[0]->PROVIDER. 'Api'; 
    $field = new $type();
?>


<style>
  .letreroProvisional{
    
    
  }
  .parpadeo{
    border:1px solid red !important;
  }
  .cicloVida{
    display:table;
    text-align:center;
    position:absolute;
    right: 10;/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f2f6f8+0,d8e1e7+50,b5c6d0+51,e0eff9+100;Grey+Gloss+%232 */
background: rgb(242,246,248); /* Old browsers */
background: -moz-linear-gradient(top, rgba(242,246,248,1) 0%, rgba(216,225,231,1) 50%, rgba(181,198,208,1) 51%, rgba(224,239,249,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top, rgba(242,246,248,1) 0%,rgba(216,225,231,1) 50%,rgba(181,198,208,1) 51%,rgba(224,239,249,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom, rgba(242,246,248,1) 0%,rgba(216,225,231,1) 50%,rgba(181,198,208,1) 51%,rgba(224,239,249,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f2f6f8', endColorstr='#e0eff9',GradientType=0 ); /* IE6-9 */
    width:33%;
    top:15px;
    color:#547499;
    padding-top:5px;
    padding-bottom:5px;
    border-radius:16px 0px 0px 16px;
    
    border-top:1px solid #547499;
    border-bottom:1px solid #547499;
    
 
    border-left:1px solid #547499;
       
    z-index:9999;
    font-family: "Times New Roman", Times, serif;
  }
  
  .cicloVida img{
    padding:0px !important;
  }
</style>


<div class="typeGrid ">

           <div class="productWrapper row-eq-height col-xs-12 col-md-4 col-lg-3 article-block">
             
                                          

        <!--
              <div class="typeGrid productWrapper col-xs-4 col-md-3 col-lg-3 article-block">
        -->          
        <a href="/producto/{{ DBData::desAccentify($resu->TITULO) }}">
                  <div class="product">


{{--                    
    @if($resu->STOCK == 0)
                              <div class="progress parpadeo">
                                <div class=" stock-bar progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="{{ "width: " . $resu->STOCK *2 . "%" }}">
                              
                              @else
                              <div class="progress">
                                <div class=" stock-bar progress-bar progress-bar-danger progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="{{ "width: " . $resu->STOCK *2 . "%" }}">
                              @endif  
                              
                              
                            </div>
                    </div>    
  --}}                  
                    
                    
                    
                    
              @if($resu->CICLOVIDA != "")
                          
                        <div class="cicloVida">
                              <div class="letreroProvisional">{{ $resu->CICLOVIDA }}</div>
                              
                          </div>
                          @endif  
                    <div class="imagenProducto">
                        <img width="50%" src={{ $field::getProductMainImage($resu->CODIGOINTERNO) }} />
                    </div>

                    <div class="nombreProducto"> {{ $resu->TITULO }}</div>
                {{--
                    <div class="descProductoInList"> {{  \DBData::getDescriptionForProductList($resu->CODIGOINTERNO, $field) }}</div>
                    
                    
                    --}}
                            <div class="stockProducto"> 
                            
                    <div class="priceAndStock row-eq-height row">        
                      <div class="precioProducto col-sm-8 ">  
                        <div>{{ number_format(round($resu->PRECIO,2) , 2, ',', '.') }} &euro;</div>
                        <div>{{ number_format(round($resu->PRECIO,2) , 2, ',', '.') }} &euro;</div>
                      </div>
                      <div class="stockProducto col-sm-4 ">
                        Stock : {{ $resu->STOCK }}
                        
                      </div>
                          </div>   
  
                        
                            
                            
                            
                            
                            </div>
                        </div>
         </a>                       
                </div>

    
 
</div>

