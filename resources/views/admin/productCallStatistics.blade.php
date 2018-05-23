@extends('mainTemplates/adminTemplate')

    @section('content')
<style>
    .chart{
        height:200px;
    }
</style>
<div class="row">
    <div class="col-sm-6">
        <div class="chartPanel panel panel-default">
      <div class="panel-heading">Número llamadas al api</div>
      <div id="ApiCallsChart" class="chart panel-body">
      
      </div>
    </div>
    </div>
    <div class="col-sm-6">
        <div class="chartPanel panel panel-default">
      <div class="panel-heading">Llamadas a producto</div>
      <div id="ProductsToday" class="chart panel-body">
      
      </div>
    </div>
    </div>
</div>

        <div class="chartPanel panel panel-default">
      <div class="panel-heading">Llamadas por categorias</div>
      <div id="ProductsToday2" class="chart panel-body">
      
      </div>
    </div>
<?php
    Charts::apiCalls("ApiCallsChart");
    Charts::productsToday("ProductsToday");
    
    Charts::CategoriesToday("ProductsToday2");
?>  
            
        </div>

        <?php
            $results = \DB::select("SELECT * FROM ProductCalls, totalCsv  where   ProductCalls.Id = totalCsv.CODIGOINTERNO and Date = '" . date("d-m-y")."' order by Calls desc");
        ?>
        
        <div id="mostViewedTopDiv" class=" panel panel-default">
      <div class="panel-heading">Most viewed products of today</div>
      <div id="mostViewedPanel" class="chart panel-body">
      

    

        
    <div id="ProductStatisticcontainer">
        @foreach ($results as $resul)
        <div class="col-sm-4">
            <?php
                $type = $resul->PROVIDER. 'Api'; 
                $field = new $type();  
            ?>
            <a href="../producto/{{ DBData::desAccentify($resul->TITULO) }}">
                
            <div class="productStatistic panel panel-default">
                    
                    <div class="imagenProducto">
                        <img width="50%" src={{ $field::getProductMainImage($resul->Id) }} />
                    </div>
                    
                    <div style="height:50px" class="number panel-body">{{ $resul->TITULO }}</div>     
                    <div class="number panel-body">{{ $resul->PROVIDER }}</div>     
                    <div class="number panel-body">Calls : {{ $resul->Calls }}</div>            
            </div> 
            
            
            </a>
            
            </div>
        @endforeach 
        
          </div>
    </div>    
        
        
        
    </div>
    
    
    
    
    
    @endsection
