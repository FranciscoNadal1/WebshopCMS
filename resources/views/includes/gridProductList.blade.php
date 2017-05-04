<div class="typeGrid">
    
       <div class="typeGrid productWrapper col-xs-4 col-md-4 col-lg-4 article-block">
    <!--
          <div class="typeGrid productWrapper col-xs-4 col-md-3 col-lg-3 article-block">
    -->          
              <div class="product">
                <div class="imagenProducto">
                    <img width="75%" src=https://www.infortisa.com/images/product/large/{{ $resu->CODIGOINTERNO }}_1.jpg />
                </div>
                <div class="nombreProducto"><a href="/producto/{{ DBData::desAccentify($resu->TITULO) }}"> {{ $resu->TITULO }}</a></div>
                <div class="precioProducto"> {{ $resu->PRECIO }} &euro;</div>
                <div class="stockProducto"> {{ $resu->STOCK }}</div>
                    </div>
            </div>
</div>

