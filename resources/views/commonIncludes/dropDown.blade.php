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
	    
	    
	      <div class="col-sm-3" style="height: 100%;">
	        {{--
	        
      	    <div class="col-sm-1 navbar-header">
      	      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".js-navbar-collapse">
      	        <span class="sr-only">Toggle navigation</span>
      	        <span class="icon-bar"></span>
      	        <span class="icon-bar"></span>
      	        <span class="icon-bar"></span>
      	      </button>
	       </div>
	      
	      --}}
	      
	        <a class="logo" href="/">
	           <img {{-- width="250" height="100" --}} src="{{ GetAsset::getLogo() }}">
	         </a> 
	         </div>
	    
        <div id="searchArea"  class=" col-sm-6">
                @section('search')
                    @include('commonIncludes/searchBar')
                @show
            </div>
            
            
        <div id="savedProducts"  class="col-sm-3">
               <ul id="savedProductsUl" class="nav navbar-nav ">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"> 
          <span class="glyphicon glyphicon-shopping-cart">
            
          </span> {{  
          sizeOf(Session::get('cart'))
                  }} - Productos guardados<span class="caret"></span>
          </a>
          <ul class="dropdown-menu dropdown-cart" role="menu">
            
            @if( ! empty(Session::get('cart') ))
            
                @foreach(Session::get('cart') as $test)
               
               <?php
                    $type = $test['provider']. 'Api'; 
                    $field = new $type();
                ?>
                
              <li>
                  <span class="item">
                    <span class="item-left">
                        
                            <div class="col-sm-2">
                                <img width='50px' src={{ $field::getProductMainImage($test['id']) }} alt="" />
                            </div>
                            
                            <div class="col-sm-10">
                                <span class="item-info">
                                    <div class="col-sm-9">
                                        <a href="/producto/{{ DBData::desAccentify($test['name']) }}">
                                          <span>{{$test['name']}}</span>
                                        </a>
                                    </div>
                                    <div class="col-sm-1">
                                        <span>{{$test['price']}}€</span>
                                    </div>
                                
                        </span>
                        </div>
                    </span>
                    <span class="item-right">
                        <button class="btn btn-xs btn-danger pull-right">x</button>
                    </span>
                </span>
              </li>
              
                
                @endforeach 
              
              @endif
              <li class="divider"></li>
              <li><a  onclick="forget()" class="text-center">Borrar todos</a></li>
          </ul>
        </li>
      </ul> 
                
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





<script>
                   function forget(){
                       
                        $('#scriptDiv').load("/forget", function() {
                            $("#forLater").fadeOut("slow");
                                        
                                  $("#savedProducts").fadeOut("fast");
                                        $("#savedProducts").load(location.href + " #savedProductsUl");
                                  $("#savedProducts").fadeOut("fast");
                          });
                          
                      }
                      
                    function addToLater(codigoInterno,provider,precio,titulo){
                        $('#scriptDiv').load("/put/"+codigoInterno+"/"+provider+"/"+precio+"/"+titulo, function() {

                                  $("#savedProducts").fadeOut("fast");
                                     $("#savedProducts").load(location.href + " #savedProductsUl");
                                  $("#savedProducts").fadeOut("fast");
                        
                                        
                          });
                          
                      }
                      
                </script>