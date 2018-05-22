@extends('mainTemplates/adminTemplate')

    @section('content')
<style>
    .chart{
        height:200px;
    }
</style>
<div class="row">
    
    <div class="panel panel-default col-sm-6">
      <div class="panel-heading">Número llamadas al api</div>
      <div id="ApiCallsChart" class="chart panel-body">
      
      </div>
    </div>
    
    <div class="panel panel-default col-sm-6">
      <div class="panel-heading">Llamadas a producto</div>
      <div id="ProductsToday" class="chart panel-body">
      
      </div>
    </div>

</div>
<?php
    Charts::apiCalls("ApiCallsChart");
    Charts::productsToday("ProductsToday");
?>  
            
        </div>


    <h1>Most viewed products of today</h1>
        <?php
        
            
            $results = \DB::select("SELECT * FROM ProductCalls, totalCsv  where   ProductCalls.Id = totalCsv.CODIGOINTERNO and Date = '" . date("d-m-y")."' order by Calls desc");
            
            
            
           // return $results;
            
            
        ?>
        
        
        

        
        
        
    <div id="ProductStatisticcontainer">
        @foreach ($results as $resul)
            <?php
                $type = $resul->PROVIDER. 'Api'; 
                $field = new $type();  
            ?>
            <a href="../producto/{{ DBData::desAccentify($resul->TITULO) }}">
            <div class="productStatistic panel panel-default col-sm-4">
                    <div class="image panel-heading "><img height="50%" src='{{   $field::getProductMainImage($resul->Id)   }}'/></div>
                    <div class="number panel-body">{{ $resul->TITULO }}</div>     
                    <div class="number panel-body">{{ $resul->PROVIDER }}</div>     
                    <div class="number panel-body">Calls : {{ $resul->Calls }}</div>            
            </div>    
            </a>
        @endforeach 
        
        
        
        
        
    </div>
    
    
    
    
    
    @endsection
