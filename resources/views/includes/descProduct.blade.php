<!-- Plain page for the description of each product-->



    <!-- Add an increment for each product view on each date, to keep statistic  -->
    
    
        <!-- NOTE : Should add user field on table for the future -->
    
    <?php
        \ProductViewNumber::plusOneView($results[0]->CODIGOINTERNO);
    ?>
    
    <!-- ----------------------------------------------------------------------- -->

<div id="container"  class="">
    
    <div id="CategoryHeader" >{{ $results[0]->TITULO }}</div>
        
    <div id="ProductContainer" class="container">
    
        <style>
            
        </style>
        
        
        <div class="boxes container" id="containerDesc">
            <div class="col1 col-xs-5 col-md-5 col-lg-5 article-block boxes">
                <div class="imagenProducto">
                    <img width="75%" src={{ infortisaApi::getProductMainImage($results[0]->CODIGOINTERNO) }} />
                </div>
                </div>
             <div class="col2 col-xs-7 col-md-7 col-lg-7 article-block boxes">
                
                               

                <div class="categoryName">Precio</div>
                    <div class="categoryText">      {{ $results[0]->PRECIO }}</div>
                <div class="categoryName">Nombre del producto</div>    
                    <div class="categoryText">      {{ $results[0]->TITULO }}</div>
                    
                    <!--
                <div class="categoryName">Precio</div>    
                    <div>      {{ $results[0]->TITULOSUBFAMILIA }} </div>
                    
                <div class="categoryName">Precio</div>  
                    <div>      {{ $results[0]->TITULOFAMILIA }}</div>
                    
                    -->
                <div class="categoryName">C&oacute;digo</div>    
                    <div class="categoryText">      {{ $results[0]->CODIGOINTERNO }}</div>
                <div class="categoryName">Fabricante</div>    
                    <div class="categoryText">      {{ $results[0]->NOMFABRICANTE }}</div>
                <div class="categoryName">Stock</div>    
                    <div class="categoryText">      {{ $results[0]->STOCK }}</div>
                   
                   
                   </div>  
                </div>
                   <div class="boxes" id="fichaProducto">
                       
                       
		<div class="">		
			<div class="">
					<ul id="myTab" class="nav nav-tabs nav_tabs">
						
						<li class="active"><a href="#service-one" data-toggle="tab">DESCRIPCION</a></li>
						<li><a href="#service-two" data-toggle="tab">FICHA TÉCNICA</a></li>
						
						
					</ul>
				<div id="myTabContent" class="tab-content">
						<div class="tab-pane fade in active" id="service-one">
							<section class="container jumbotron productDescriptionBox description">
							    
                                <?php   
                                echo infortisaApi::get_comercial($results[0]->CODIGOINTERNO); 
                                ?>
							</section>
						</div>
					<div class="tab-pane fade" id="service-two">
						
    						<section class="container jumbotron productDescriptionBox specifications">
                                <?php
                                echo infortisaApi::get_tecnica($results[0]->CODIGOINTERNO); 
                                ?>
    						</section>
					</div>
				</div>
				<hr>
			</div>
		</div>
                            <?php 
                          /*  
                            $comDes ="";$tecDes ="";
                           $comDes = infortisaApi::get_comercial($results[0]->CODIGOINTERNO);
                           $tecDes  = infortisaApi::get_tecnica($results[0]->CODIGOINTERNO);
                                                       
                                
                             echo $comDes;    
                             echo $tecDes;
                             */
                            ?>
                            
                    </div>
                    
                    


                
    </div>
</div>