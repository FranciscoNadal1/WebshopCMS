<script>
$( document ).ready(function() {
	jQuery(document).on('click', '.mega-dropdown', function(e) {
	  e.stopPropagation()
	})
});

	
</script>
<?php
			$categories = DBData::getAllCategories();
?>


	<nav class=" header">
	  <div id="TopHeader">
	    
	    
	      <div class="col-md-3">
      	    <div class="col-sm-1 navbar-header">
      	      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
      	        <span class="sr-only">Toggle navigation</span>
      	        <span class="icon-bar"></span>
      	        <span class="icon-bar"></span>
      	        <span class="icon-bar"></span>
      	      </button>
	       </div>
	      
	      
	      <div class="col-md-3">
	        <a class="logo navbar-brand" href="/">
	           <img width="250" height="100" src="{{ GetAsset::getLogo() }}">
	         </a> 
	         </div>
	    </div>
	    
           <div id="searchArea"  class="col-md-6">
                @section('search')
                    @include('commonIncludes/searchBar')
                @show
            </div>
            
            
              <div id="searchArea"  class="col-md-3">
            </div>         
            
            
            
	  </div><div id="BotHeader">
	    
	    
<div class="menuLinks">
  
  @foreach ($categories as $cat)
        @if($cat->code != 1)
          	
              <ul class="nav navbar-nav">
                        	
           <style>.rowy{float:left;}</style>             	    
                        	        <li class="dropdown mega-dropdown container-fluid">
                        	          <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{$cat->name}} {{--<span class="glyphicon glyphicon-chevron-down pull-right"></span>--}}</a>
              
                        	          <ul class="dropdown-menu mega-dropdown-menu">
<!--------------------------------------------------------------------
                      Novedades
---------------------------------------------------------------------->
                        	              <div class="novedadesMenu col-sm-2 hidden-xs ">
                        	              <ul>
                        	                <li class="dropdown-header">Novedades</li>
                        	                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        	                  <div class="carousel-inner">
                        	                    
                        	                    <?php
                                              			$randomProduct = \DBData::getRandomProductByCategory($cat->name);
                                                                  			        
                                              $count = 1;    
                                               ?>
                                                     
                        	@foreach ($randomProduct as $ran)
                        	
                        	                    <div class="item {{ $count == 1 ? ' active' : '' }}">
                        	                      
                        	{{$ran->TITULO}}
                        	                      <a href="/producto/{{ DBData::desAccentify($ran->TITULO) }}"><img src={{ infortisaApi::getProductMainImage($ran->CODIGOINTERNO) }} class="img-responsive" alt="product"></a>
                        	                      <h4><small{{ $ran->TITULO }}</small></h4>
                        	                      <div class="price col-sm-6">{{ $ran->PRECIO }}€</div>
                        	                      <div class="stock col-sm-6">Stock : {{ $ran->STOCK }}</div>
                        	                    </div>
                        	                    
                        	                    <?php
                        	                    ++$count;
                        	                    ?>
                        	@endforeach
                        	                    
                        	                    
                        	                    
                        	                    {{--
                        	                    <!-- End Item -->
                        	                    <div class="item">
                        	                      <a href="#"><img src="http://placehold.it/254x150/ef5e55/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 2"></a>
                        	                      <h4><small>-----------------</small></h4>
                        	                      <button class="btn btn-primary" type="button">9,99 €</button>
                        	                      <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Comprar</button>
                        	                    </div>
                        	                    <!-- End Item -->
                        	                    <div class="item">
                        	                      <a href="#"><img src="http://placehold.it/254x150/2ecc71/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 3"></a>
                        	                      <h4><small>-----------------</small></h4>
                        	                      <button class="btn btn-primary" type="button">49,99 €</button>
                        	                      <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Comprar</button>
                        	                    </div>
                        	                    
                        	                    --}}
                        	                    <!-- End Item -->
                        	                  </div>
                        	                  <!-- End Carousel Inner -->
                        	                </div>
                        	                <!-- /.carousel -->
                        	                <li class="divider"></li>
                        	            {{--    <li><a href="#">View all Collection <span class="glyphicon glyphicon-chevron-right pull-right"></span></a></li> --}}
                        	              </ul>
                        	            </div>
<!--------------------------------------------------------->                      	            
                        	            
                        	<?php
                        		  $results = \DBData::getFamilyFromCategoryName($cat->name);
                              $contador = 0;                      	
                        	?>
                            
<!--------------------------------------------------------------------
                      Menu
---------------------------------------------------------------------->       
                        
                                  <div class="categoriesMenu col-sm-10">
                                    <div class="row">
                          		@foreach ($results as $resul)	
                                  <?php 
                                  $contador++; 
                                  ?>
                                     
                          		             <li class=" col-lg-3 col-md-4 individualMenuCategory">
                          		               
                          		               
                          		               
                          	              <ul>
                          	                <li class="dropdown-header">{{ $resul->TITULOFAMILIA }}</li>
                          	                
                          <?php
                          	$results2 = \DBData::getSubFamiliaFromTitulo($resul->TITULOFAMILIA);
                          ?>
                                        @foreach ($results2 as $resul2)
                                                        
                          
                          										<li class="subCategoriesMenu"><a class="subCategoriesMenuLink" href="/listado/{{ \DBData::desAccentify($resul2->TITULOSUBFAMILIA) }}">{{ $resul2->TITULOSUBFAMILIA }}</a>        </li>    
                          										
                                        @endforeach
                                        


                          	                
                          	              </ul>
                          	            </li>
                          	            
                          	                <div class="divider"></div>
                          		@endforeach
                              </div>
                         
                         </div>
 <!--------------------------------------------------------->                  	            
              	          </ul>
              
              	        </li>
              
              	
              	    
              	    
              		      </ul>
        @endif
	@endforeach	
	</div>
	    
	  </div>
	  
	  
	  </nav>


{{--

 <nav class=" header">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
        <a class="logo navbar-brand" href="/">
           <img width="250" height="100" src="{{ GetAsset::getLogo() }}">
         </a> 
    </div>


    <div class="collapse navbar-collapse js-navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="dropdown mega-dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Collection <span class="glyphicon glyphicon-chevron-down pull-right"></span></a>

          <ul class="dropdown-menu mega-dropdown-menu row">
            <li class="col-lg-2 col-md-3">
              <ul>
                <li class="dropdown-header">New in Stores</li>
                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                  <div class="carousel-inner">
                    <div class="item active">
                      <a href="#"><img src="http://placehold.it/254x150/3498db/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 1"></a>
                      <h4><small>Summer dress floral prints</small></h4>
                      <button class="btn btn-primary" type="button">49,99 €</button>
                      <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>
                    </div>
                    <!-- End Item -->
                    <div class="item">
                      <a href="#"><img src="http://placehold.it/254x150/ef5e55/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 2"></a>
                      <h4><small>Gold sandals with shiny touch</small></h4>
                      <button class="btn btn-primary" type="button">9,99 €</button>
                      <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>
                    </div>
                    <!-- End Item -->
                    <div class="item">
                      <a href="#"><img src="http://placehold.it/254x150/2ecc71/f5f5f5/&text=New+Collection" class="img-responsive" alt="product 3"></a>
                      <h4><small>Denin jacket stamped</small></h4>
                      <button class="btn btn-primary" type="button">49,99 €</button>
                      <button href="#" class="btn btn-default" type="button"><span class="glyphicon glyphicon-heart"></span> Add to Wishlist</button>
                    </div>
                    <!-- End Item -->
                  </div>
                  <!-- End Carousel Inner -->
                </div>
                <!-- /.carousel -->
                <li class="divider"></li>
                <li><a href="#">View all Collection <span class="glyphicon glyphicon-chevron-right pull-right"></span></a></li>
              </ul>
            </li>
            <li class="col-lg-2 col-md-3">
              <ul>
                <li class="dropdown-header">Dresses</li>
                <li><a href="#">Unique Features</a></li>
                <li><a href="#">Image Responsive</a></li>
                <li><a href="#">Auto Carousel</a></li>
                <li><a href="#">Newsletter Form</a></li>
                <li><a href="#">Four columns</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Tops</li>
                <li><a href="#">Good Typography</a></li>
              </ul>
            </li>
            <li class="col-lg-2 col-md-3">
              <ul>
                <li class="dropdown-header">Jackets</li>
                <li><a href="#">Easy to customize</a></li>
                <li><a href="#">Glyphicons</a></li>
                <li><a href="#">Pull Right Elements</a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Pants</li>
                <li><a href="#">Coloured Headers</a></li>
                <li><a href="#">Primary Buttons & Default</a></li>
                <li><a href="#">Calls to action</a></li>
              </ul>
            </li>
            <li class="col-lg-2 col-md-3">
              <ul>
                <li class="dropdown-header">Accessories</li>
                <li><a href="#">Default Navbar</a></li>
                <li><a href="#">Lovely Fonts</a></li>
                <li><a href="#">Responsive Dropdown </a></li>
                <li class="divider"></li>
                <li class="dropdown-header">Newsletter</li>
                <form class="form" role="form">
                  <div class="form-group">
                    <label class="sr-only" for="email">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email">
                  </div>
                  <button type="submit" class="btn btn-primary btn-block">Sign in</button>
                </form>
              </ul>
            </li>
          </ul>

        </li>
      </ul>

    </div>
    <!-- /.nav-collapse -->
  </nav>

--}}