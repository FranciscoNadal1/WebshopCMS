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
               
               


<iframe src="https://www.google.com/maps/embed?pb=!1m25!1m12!1m3!1d3104.4097010523765!2d-0.5527465018293267!3d38.91461220127114!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m10!1i0!3e2!4m3!3m2!1d38.9145913!2d-0.5502857999999999!4m3!3m2!1d38.9145616!2d-0.5502602!5e0!3m2!1ses!2ses!4v1427481636163" style="border:0"  height="500" frameborder="0"></iframe>

           
                </div>
                  

            </div>
        </div>
</head>





