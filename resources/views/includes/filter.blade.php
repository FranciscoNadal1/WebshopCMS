<?php
    $results = \DB::select("SELECT NOMFABRICANTE FROM  csv  where CODSUBFAMILIA = '". $subFamilia ."' group by NOMFABRICANTE");
    
    $maxPrice = \DB::select("SELECT PRECIO AS M FROM csv WHERE CODSUBFAMILIA =  '". $subFamilia ."' ORDER BY precio DESC LIMIT 1");  
    $minPrice = \DB::select("SELECT PRECIO AS M FROM csv WHERE CODSUBFAMILIA =  '". $subFamilia ."' ORDER BY precio ASC LIMIT 1");  
    
    
    
?>




    <div class="filterPan " ng-controller="mainController">
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
                  
        @foreach ($filters as $fil)
        
    <div class="filterPan " ng-controller="mainController">
              <div class="filterHeader">{{ $fil->SpecificationAttributeName }}:</div>
            
            <?php
            
                    $subFilters = \DB::select("
    SELECT infortisa_specificationAttributeOption.OptionName, infortisa_specificationAttributeOption.OptionId,  count(infortisa_IdSku.SKU) as coun
    
    
FROM totalCsv, 
`infortisa_productSpecification` , 
infortisa_IdSku, 
infortisa_specificationAttributeOption, 
infortisa_specificationAttribute
WHERE totalCsv.CODIGOINTERNO = infortisa_IdSku.SKU
and infortisa_IdSku.ID = infortisa_productSpecification.ProductId
and infortisa_productSpecification.OptionId = infortisa_specificationAttributeOption.OptionId
and infortisa_specificationAttributeOption.SpecificationAttributeId =
infortisa_specificationAttribute.SpecificationAttributeId
and totalCsv.CODSUBFAMILIA =  '". $subFamilia ."' 
and infortisa_specificationAttribute.SpecificationAttributeName =  '".  $fil->SpecificationAttributeName  ."' 
group by infortisa_specificationAttributeOption.OptionName");


?>

              <div class="checkboxContainer">
                  

                  
                  
        @foreach ($subFilters as $fil2)
        
            <div class="checkbox">
                <label>
                <input name="{{ $fil2->OptionId }}" id="{{ $fil2->OptionId }}" type="checkbox" value="" 
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
                
                {{ $fil2->OptionName }} {{--     1fil2->coun    --}}
            
                      </label></div>
        @endforeach
            </div>
            
            
            
            
            
             </div>
        @endforeach
         
         


  <script>

    $( document ).ready(function() {
        

        
         $(".filterHeader").click(function(){
            $(".checkboxContainer").slideToggle();
        });
    

        
        var urlArray = window.location.href.split("/");
        
        
            urlArray.forEach(function(entry) {
                
                       success =  entry.replace(' ', '-');   
                       
                       success =  success.replace('%20', '-');   
                       
                console.log(success);
                if(document.getElementById(success)){
                    
                    
                    
                    document.getElementById(success).checked = true;
                }
                
            
            });
            
    });
    
</script>
 <div style="height:100px;"></div>
 
 
 