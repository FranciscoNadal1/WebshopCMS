<div class="typeList">
          <div class="typeList productWrapper col-xs-12 col-md-12 col-lg-12 ">imma list
              <div class="product">
                <div class="imagenProducto">
                    <img width="75%" src=https://www.infortisa.com/images/product/large/{{ $resu->CODIGOINTERNO }}_1.jpg />
                </div>
                <?php
                $nombreEnlace = $resu->TITULO;
                $nombreEnlace = str_replace(" ", "-", $nombreEnlace);
                            $nombreEnlace = str_replace("á", "a", $nombreEnlace);
                            $nombreEnlace = str_replace("é", "e", $nombreEnlace);
                            $nombreEnlace = str_replace("í", "i", $nombreEnlace);
                            $nombreEnlace = str_replace("ó", "o", $nombreEnlace);
                            $nombreEnlace = str_replace("ú", "u", $nombreEnlace);
                            
                            $nombreEnlace = str_replace("/", "-", $nombreEnlace);
                   
                                   ?>
                <div class="nombreProducto"><a href="/producto/{{ $nombreEnlace }}"> {{ $resu->TITULO }}</a></div>
                <div class="precioProducto"> {{ $resu->PRECIO }} &euro;</div>
                <div class="stockProducto"> {{ $resu->STOCK }}</div>
                
                

                </div>
            </div>
</div>