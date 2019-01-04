<!-- Plain page for the description of each product-->

<?php
    $type = $results[0]->PROVIDER. 'Api'; 
    $field = new $type();
?>

    <!-- Add an increment for each product view on each date, to keep statistic  -->
    
    
        <!-- NOTE : Should add user field on table for the future -->
    
    <?php
        \ProductViewNumber::plusOneView($results[0]->CODIGOINTERNO);
    ?>
    
    <!-- ----------------------------------------------------------------------- -->

  <link rel="stylesheet" href="../lib/lightbox/lightbox.min.css">
  
  <script src="../lib/lightbox/lightbox.min.js"></script>
<div id="container"  class="">
    
        
    <div id="ProductContainer" class="container">
    
    
        <div id="DescriptionCategory" class="panel-body">{{ $results[0]->TITULOFAMILIA }} > 
            <a href="/listado/{{  DBData::desAccentify($results[0]->TITULOSUBFAMILIA) }}">
                {{ $results[0]->TITULOSUBFAMILIA }}
            </a>
        </div>
        
        
        <div class="boxes container row row-eq-height " id="containerDesc">
            
            
            <div class="imagenProductoContainer">
                <div class="imagenProducto img-responsive">

                    <a href="{{ $field::get_imagenesLarge($results[0]->CODIGOINTERNO) }} " data-lightbox="gallery" ><img class="" width="65%" src={{ $field::getProductMainImage($results[0]->CODIGOINTERNO) }} /></a>
                </div>
                </div>
             <div class="productDataContainer">
                 
                <div id="DescriptionHeader" >{{ $results[0]->TITULO }}</div>
                 <div class="productData">
                
                               

                <div class="categoryName">Precio
                    <span class="categoryText">      {{ $results[0]->PRECIO }} €</span>
                    </div>
                    <!--
                <div class="categoryName">Nombre del producto</div>    
                    <div class="categoryText">      {{ $results[0]->TITULO }}</div>
                    -->
                    
                    
                    <!--
                <div class="categoryName">Precio</div>    
                    <div>      {{ $results[0]->TITULOSUBFAMILIA }} </div>
                    
                <div class="categoryName">Precio</div>  
                    <div>      {{ $results[0]->TITULOFAMILIA }}</div>
                    
                    -->
                <div class="categoryName">C&oacute;digo   
                    <span class="categoryText">      {{ $results[0]->CODIGOINTERNO }}</span>
                    </div> 
                <div class="categoryName">Fabricante    
                    <span class="categoryText">      {{ $results[0]->NOMFABRICANTE }}</span>
                    </div>
                <div class="categoryName">Stock   
                    <span class="categoryText">      {{ $results[0]->STOCK }}</span>
                    </div> 
                   
                   <div class="addToLaterButton description"> <button onclick="addToLater('{{ $results[0]->CODIGOINTERNO }}','{{ $results[0]->PROVIDER }}','{{ number_format(round($results[0]->PRECIO,2) , 2, ',', '.') }}','{{ DBData::desAccentify($results[0]->TITULO) }}')"                     >Guardar para luego</button></div>

                   </div>
                   
                   
                       <div class="altImages">
                       <?php
                       
                           $array = $field::get_imagenes_alternativas($results[0]->CODIGOINTERNO);
                           $i = 0;
                           
                           for($i=1;$i<count($array);$i++)
                                echo "<a href=\"$array[$i]\" data-lightbox=\"gallery\" ><img src=\"$array[$i]\" class=\"altImg\"></a>";
                            
                       ?>



                       
                       </div>
                   
                   
                   
                   </div>  
                   
                   
                   
                   
                </div>
                   <div class="boxes" id="fichaProducto">
                       <?php
                       
                       
                       
                                $fichaComercial = $field::get_comercial($results[0]->CODIGOINTERNO); 
                                $fichaTecnica = $field::get_tecnica($results[0]->CODIGOINTERNO); 
                                
                       ?>
		<div class="">		
			<div class="">
					<ul id="myTab" class="nav nav-tabs nav_tabs">
						
						@if(strlen($fichaComercial) > 20)
						    <li class="active"><a href="#service-one" data-toggle="tab">DESCRIPCION</a></li>
						@endif
						
						@if(strlen($fichaTecnica) > 20)
						    <li><a href="#service-two" data-toggle="tab">FICHA TÉCNICA</a></li>
						@endif
						
					</ul>
				<div id="myTabContent" class="tab-content">
				    
						@if(strlen($fichaComercial) > 20)
    						<div class="tab-pane fade in active" id="service-one">
    							<section class="container jumbotron productDescriptionBox description">
                                    {!! $fichaComercial !!}
    							</section>
    						</div>
						@endif
						
						
						@if(strlen($fichaTecnica) > 20 and strlen($fichaComercial) > 20)
    					    <div class="tab-pane fade" id="service-two">
        						<section class="container jumbotron productDescriptionBox specifications">
                                    {!! $fichaTecnica !!}
        						</section>
    					    </div>
    					@else
     					    <div class="tab-pane fade in active" id="service-two">
        						<section class="container jumbotron productDescriptionBox specifications">
                                    {!! $fichaTecnica !!}
        						</section>
    					    </div> 
					    @endif
					    
				</div>
				<hr>
			</div>
		</div>
                            <?php 
                          /*  
                            $comDes ="";$tecDes ="";
                           $comDes = $field::get_comercial($results[0]->CODIGOINTERNO);
                           $tecDes  = $field::get_tecnica($results[0]->CODIGOINTERNO);
                                                       
                                
                             echo $comDes;    
                             echo $tecDes;
                             */
                            ?>
                            
                    </div>
                    
                    


                
    </div>
</div>