
                
        @section('forLater')
        
            @if( ! empty(Session::get('cart') ))
            
            
                <script>
                   function forget(){
                       
                        $('#scriptDiv').load("/forget", function() {
                            $("#forLater").fadeOut("slow");
                                        $("#forLater").load(location.href + " #forLater");
                                        
                                        
                          });
                          
                      }
                </script>
                
                
                
                
                
            <div id="forLater">
               @foreach(Session::get('cart') as $test)
               
               <?php
                    $type = $test['provider']. 'Api'; 
                    $field = new $type();
                ?>
                
                
                
                
                
                
                
                <div class="col-sm-2">
                
                
                    
                     <div class="imagenProducto">
                             <a href="/producto/{{ DBData::desAccentify($test['name']) }}">
                            <img width=100% src={{ $field::getProductMainImage($test['id']) }} />
                            </a>
                        </div>
                        
                    
                    
                </div>
                    
                @endforeach   
                <a onclick="forget()">forget</a>
                
        </div>
                @endif

    
        @show
        