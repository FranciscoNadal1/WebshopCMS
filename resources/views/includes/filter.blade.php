<?php
    $results = \DB::select("SELECT NOMFABRICANTE FROM  csv  where CODSUBFAMILIA = '". $subFamilia ."' group by NOMFABRICANTE");
    
    $maxPrice = \DB::select("SELECT PRECIO AS M FROM csv WHERE CODSUBFAMILIA =  '". $subFamilia ."' ORDER BY precio DESC LIMIT 1");  
    $minPrice = \DB::select("SELECT PRECIO AS M FROM csv WHERE CODSUBFAMILIA =  '". $subFamilia ."' ORDER BY precio ASC LIMIT 1");  
    
    
    
?>

<script>


    $( document ).ready(function() {
        
         $(".filterHeader").click(function(){
            $(".checkboxContainer").slideToggle();
        });
    
    
        var urlArray = window.location.href.split("/");
        
        
            urlArray.forEach(function(entry) {
                
                       success =  entry.replace(' ', '-');   
                if(document.getElementById(success)){
                    
                    
                    
                console.log(success);
                    document.getElementById(success).checked = true;
                }
                
            
            });
            
    });
    
</script>



<div id="filterBig" ng-app="filterApp" name="filterBig">
    <div ng-controller="mainController">
          <form id="test">
              <div class="filterHeader">Marcas:</div>
              <div class="checkboxContainer">
        @foreach ($results as $resul)




                <div class="checkbox">
                    
                  <label>
                     <!--
                      <input ng-model="{{ $resul->NOMFABRICANTE }}"  ng-change="vm.myClick({{ $resul->NOMFABRICANTE }})" name="{{ $resul->NOMFABRICANTE }}" type="checkbox" value="">
                     -->
                      <input name="{{ $resul->NOMFABRICANTE }}" id="{{ str_replace(' ', '-', $resul->NOMFABRICANTE)  }}" type="checkbox" value="" 
                      onClick="
                      if (this.checked) 
                      {     
                          window.location = window.location.href  + '/' + this.name; 
                      
                      }else if(!this.checked)
                      {
                          var myString = null;
                          var myString = window.location.href;
                          
                          var success = myString.replace(this.name, '');

                           success = success.replace(' ', '_');                          
                          
                        
                        window.location.replace(success);
                      }
                      
                      
                      ">
                     
                          {{ $resul->NOMFABRICANTE }}
                      </label>
                </div>
                
        @endforeach
    </div>
    <button onclick="return false" >Filtrar</button>
    



    
    
    
    
    
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
