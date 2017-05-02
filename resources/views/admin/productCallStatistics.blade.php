@extends('mainTemplates/adminTemplate')

    @section('content')


    <h1>Most viewed products of today</h1>
        <?php
        
            
            $results = \DB::select("SELECT * FROM ProductCalls  where Date = '" . date("d-m-y")."' order by Calls desc");
           // return $results;
            
        
        ?>
        
        
    <div id="ProductStatisticcontainer">
        @foreach ($results as $resul)
            <div class="productStatistic panel panel-default col-sm-4">
                    <div class="image panel-heading "><img height="50%" src='{{  "https://www.infortisa.com/images/product/large/" .  $resul->Id . "_1.jpg" }}'/></div>
                    <div class="number panel-body">{{ $resul->Calls }}</div>            
            </div>          
        @endforeach 
    </div>
    
    
    
    
    
    @endsection
