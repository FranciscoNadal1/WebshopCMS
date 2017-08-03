        <?php   

            $activeTheme = "baseTheme";
          //  $activeTheme = "electroaita";
        ?>


<html>
    <head>
        <title>App Name - {{ $name }}</title>


<link rel="stylesheet" href={{ GetAsset::getCSS(\GetSettings::getTheme() . "/style.css") }} type="text/css">
<link rel="stylesheet" href={{ GetAsset::getBootstrap() }} integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src={{ GetAsset::getjQuery() }} integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>

<!--
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
-->
<script type="text/javascript" src={{ GetAsset::getAngular() }} ></script>
<script src={{ GetAsset::getChart() }} ></script>

<script src={{ GetAsset::getAngularChart() }} ></script>


       <script>
           angular.module('myModule', ['chart.js']);
        
        (function (ChartJsProvider) {
          ChartJsProvider.setOptions({ colors : [ '#803690', '#00ADF9', '#DCDCDC', '#46BFBD', '#FDB45C', '#949FB1', '#4D5360'] });
        }); 
       </script>
    
    <script>
    
      angular.module("app", ["chart.js"]).controller("PieCtrl", function ($scope) {
      $scope.labels = ["Download Sales", "In-Store Sales", "Mail-Order Sales"];
      $scope.data = [300, 500, 100];
    });    
      
    </script>



    </head>
    
    <body>
        

        
        
        
        
        @include('commonIncludes/header')




 
        
    <div id="wrapper">

        
       @yield('content')
      


        
   </div>     


    </body>
</html>