  <?php
use Providers\infortisa\infortisaApi as infortisaApi;
?>
          <div class="producto col-xs-9 col-md-3 col-lg-3 article-block">
                <div class="imagenProducto">
                    <img width="85%" src=https://www.infortisa.com/images/product/large/{{ $resu->CODIGOINTERNO }}_1.jpg />
                </div>
                <div class="nombreProducto"><a href="/producto/{{ $resu->TITULO }}"> {{ $resu->TITULO }}</a></div>
                <div class="precioProducto"> {{ $resu->PRECIO }} &euro;</div>
                <div class="stockProducto"> {{ $resu->STOCK }}</div>
                
                
                <?php 
                //    echo infortisaApi::get_tecnica($resu->CODIGOINTERNO); 
                ?>
                
            </div>