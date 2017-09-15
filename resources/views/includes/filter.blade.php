<?php
    $results = \DB::select("SELECT NOMFABRICANTE FROM  csv  where CODSUBFAMILIA = '". $subFamilia ."' group by NOMFABRICANTE");
    
    $maxPrice = \DB::select("SELECT PRECIO AS M FROM csv WHERE CODSUBFAMILIA =  '". $subFamilia ."' ORDER BY precio DESC LIMIT 1");  
    $minPrice = \DB::select("SELECT PRECIO AS M FROM csv WHERE CODSUBFAMILIA =  '". $subFamilia ."' ORDER BY precio ASC LIMIT 1");  
    
    
    
?>



    <script>
    /*
        var app = angular.module('filterApp', []);
        app.controller('mainController', function($scope) {
        //  $scope.vm = {};
          $scope.vm.myClick = function($event) {
              
              
              
                alert($scope + " - " + $event + $scope.vm);
          }
        });  
        */
        /*
        var app = angular.module('filterApp', []);   
        app.controller('mainController', ['$scope', function($scope) {
            $scope.count = 0;
            $scope.filter = function() {
            $scope.count++;
            
            
            angular.forEach($scope.test, function (element, name) {
             
            alert("hola");
             
                    // element is a form element!
                
            });
            
            
            
            
            };
    }]);
        */
        
        var myApp = angular.module('filterApp', []);

        function mainController($scope) {
            $scope.filter = function (formId) {
                $('#' + formId).find('input').each(function (idx, input) {
                    // Do your DOM manipulation here
                    console.log($(input).val());
                });
            };
        }
        
        
  </script> 
  
  

<div id="filterBig" ng-app="filterApp" name="filterBig">
    <div ng-controller="mainController">
          <form id="test">
        @foreach ($results as $resul)
    
                <div class="checkbox">
                  <label>
                     <!--
                      <input ng-model="{{ $resul->NOMFABRICANTE }}"  ng-change="vm.myClick({{ $resul->NOMFABRICANTE }})" name="{{ $resul->NOMFABRICANTE }}" type="checkbox" value="">
                     -->
                      <input name="{{ $resul->NOMFABRICANTE }}" type="checkbox" value="">
                     
                          {{ $resul->NOMFABRICANTE }}
                      </label>
                </div>
                
        @endforeach
    
    <button onclick="return false" ng-click="filter()">Filtrar</button>
    


    
    
    
    
    
    
    <!--
<link rel="stylesheet" href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>




    <form method="post" action="/action_page_post.php">
      <div data-role="rangeslider">
      
      -->
      
      
 
 <!--
        <input type="range" name="price-min" id="price-min" value="{{ (int)($minPrice[0]->M) }}" min="{{ (int)($minPrice[0]->M) }}" max="{{ (int)($maxPrice[0]->M) }}">
        <input type="range" name="price-max" id="price-max" value="{{ (int)($maxPrice[0]->M) }}" min="{{ (int)($minPrice[0]->M) }}" max="{{ (int)($maxPrice[0]->M) }}">
        -->
     <!--
      </div>
      
      
        <input type="submit" data-inline="true" value="Submit">


      </form>
      
      -->

 
     {{ (int)($minPrice[0]->M) }}
    
    <br/>
   
    {{ (int)($maxPrice[0]->M) }}
    
    </div>
</div>

</form>
