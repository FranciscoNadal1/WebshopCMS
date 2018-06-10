@extends('mainTemplates/adminTemplate')

    @section('content')

            
        </div>

        <?php
            $results = \DB::select("SELECT * FROM home");
        ?>
        
        <div id="mostViewedTopDiv" class=" panel panel-default">
      <div class="panel-heading">Listado PCs electroaita</div>
      <div id="mostViewedPanel" class="chart panel-body">
      

    

        
    <div id="ProductStatisticcontainer">
        @foreach ($results as $resul)
        <div class="col-sm-4">
            <?php
                $type = "home". 'Api'; 
                $field = new $type();  
            ?>
            <a href="../producto/{{ DBData::desAccentify($resul->TITULO) }}">
                
            <div class="productStatistic panel panel-default">
                    
                    <div class="imagenProducto">
                        <img width="50%" src={{ $field::getProductMainImage($resul->CODIGOINTERNO) }} />
                    </div>
                    
                    <div style="height:50px" class="number panel-body">{{ $resul->TITULO }}</div>    
                    
                    
                    <div class="number panel-body"><a href="/admin/modifypc/{{ $resul->CODIGOINTERNO }} ">Editar</a></div>
                    <div class="number panel-body"><a href="/admin/deletepc/{{ $resul->CODIGOINTERNO }} ">Borrar</a></div>
            </div> 
            
            
            </a>
            
            </div>
        @endforeach 
        
          </div>
    </div>    
        
        
        
    </div>
    
    
    
    
    
    @endsection
