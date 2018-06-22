
                
        @section('forLater')

            <div id="forLater">
            @if( ! empty(Session::get('cart') ))
            
            
                <script>
                   function forget(){
                       
                        $('#scriptDiv').load("/forget", function() {
                            $("#forLater").fadeOut("slow");
                                        $("#forLater").load(location.href + " #forLater");
                                        
                                        
                          });
                          
                      }
                </script>
                
                
                
                
                
               @foreach(Session::get('cart') as $test)
               
               <?php
                    $type = $test['provider']. 'Api'; 
                    $field = new $type();
                ?>
                
                
                
                
                
                
                
                <div class="col-sm-1">
                
                
                    
                     <div class="imagenProducto">
                         
                         
                             <a href="/producto/{{ DBData::desAccentify($test['name']) }}">
                            <img width=100% src={{ $field::getProductMainImage($test['id']) }} />
                            </a>
                        </div>
                        
                    
                    
                </div>
                    
                @endforeach   
                <a onclick="forget()">forget</a>
                
                @endif

        </div>
    
        @show
        