        <div>
            <div class="row">    

            
               <div id="ProductContainer" class="container col-sm-10 col-md-10 col-lg-10">  
               
                       <div id="CategoryHeader">Novedades</div>

              <!--   <div id="ProductContainer" class="">   -->
                        
                        <?php            $typeList = \GetSettings::getProductListType();            ?>
                        
                        
                    @foreach ($results as $resul)
                        @if ($typeList == "grid")
                            @include('includes/gridProductList', array('resu' => $resul))
                        @endif
                        
                        @if ($typeList == "list")
                            @include('includes/listProductList', array('resu' => $resul))
                        @endif
                    @endforeach
                    
                    
                </div>
               <div id="" class="container col-sm-2 col-md-2 col-lg-2">  
               
               


<iframe width="100%" height="500" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;coord=38.914536, -0.550173&amp;q=Calle%20Isabel%20la%20Cat%C3%B3lica%2C%2012%2C%2046850%20Oller%C3%ADa%2C%20Valencia+(Electroaita)&amp;ie=UTF8&amp;t=&amp;z=16&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/create-google-map/">Google map generator</a></iframe>

           
                </div>
                  

            </div>
        </div>
</head>





