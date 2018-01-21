<?php
 //   $results = \DB::select("SELECT NOMFABRICANTE FROM  csv  where CODSUBFAMILIA = '". $subFamilia ."' group by NOMFABRICANTE");
    
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
    <div id ="test" ng-controller="mainController">
          <form>
              <div class="filterHeader">Marcas:</div>
              <div class="checkboxContainer">

        @foreach ($results as $resul)
        
                        <div class="checkbox">
                            
                          <label>
                              
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
    
    {{--
    <button onclick="return false" >Filtrar</button>
    


     {{ (int)($minPrice[0]->M) }}
    
    <br/>
   
    {{ (int)($maxPrice[0]->M) }}
     --}}
    </div>
    
   

</form>

          <form>
              <div class="filterHeader">Disponibilidad:</div>
              <div class="checkboxContainer">
                  




                <div class="checkbox">
                    
                  <label>
                      
                      <input name="stock" id="stock" type="checkbox" value="" 
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
                     
                          En stock
                      </label>
                </div>
                
                
    </div>


    </div>

</form>



