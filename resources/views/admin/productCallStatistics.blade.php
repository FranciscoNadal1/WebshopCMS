@extends('mainTemplates/adminTemplate')

    @section('content')

<!--
        <div id="canvasHolder" ng-controller="PieCtrl">
            
            
            <canvas id="pie" class="chart chart-pie"
              chart-data="data" chart-labels="labels" chart-options="options">
            </canvas> 
            
            
            -->
            <canvas id="radar" class="chart chart-radar"
      chart-data="data" chart-options="options" chart-labels="labels">
    </canvas> 
    
    <script>
        angular.module("app", ["chart.js"]).controller("RadarCtrl", function ($scope) {
  $scope.labels =["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"];

  $scope.data = [
    [65, 59, 90, 81, 56, 55, 40],
    [28, 48, 40, 19, 96, 27, 100]
  ];
});
       
    </script>

            
                <div class="col-lg-6 col-sm-12 ng-scope" id="pie-chart" ng-controller="PieCtrl">
                  <div class="panel panel-default">
                    <div class="panel-heading">Pie Chart</div>
                    <div class="panel-body"><iframe class="chartjs-hidden-iframe" tabindex="-1" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                      
                      <canvas id="pie" class="chart chart-pie chart-xs ng-isolate-scope" 
                      chart-data="data" 
                      chart-labels="labels" 
                      chart-options="options" 
                      height="376" 
                      width="753" 
                      style="display: block;width: 603px;height: 301px;">
                      </canvas>
                      
                    </div>
                  </div>
                </div>

        
            

            
            
        </div>




                    <script>
                    
                    
                     (function () {
        
                        angular.module("myModule", ["chart.js"]).controller("PieCtrl", function ($scope) {
                          $scope.labels = ["Download Sales", "In-Store Sales", "Mail-Order Sales"];
                          $scope.data = [350, 500, 50];
                        });
                        
                     }); 
                    </script>




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
