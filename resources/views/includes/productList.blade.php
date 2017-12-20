  <?php
  $totalNumberProducts = count($results);
  ?>
  
  
  {{--
  {{ \GetSettings::getProductEachPage() }}
  @if($totalNumberProducts <= \GetSettings::getProductEachPage())
  <style>
      .loadMoreProducts{
          display:none;
      }
  </style>
  
  @endif
  --}}
  <div>
            <div class="row">    
                <div id="filterBar" class="containerdiv hidden-sm hidden-xs hidden-md visible-lg-block col-lg-2">
                    
                     @include('includes/filter', array('subFamilia' => $results[0]->CODSUBFAMILIA))
                    
                    
                </div>
            
               <div id="ProductContainer" class="container col-sm-12 col-md-10 col-lg-10">  
               
                       <div id="CategoryHeader" class="{{ \DBData::desAccentify($results[0]->TITULOSUBFAMILIA) }}">{{ $results[0]->TITULOSUBFAMILIA }}</div>
                    
                            <div class="productBlock">
                      <!--   <div id="ProductContainer" class="">   -->
                                
                                <?php            $typeList = \GetSettings::getProductListType();            ?>
                                
                                
                            @foreach ($results as $resul)
                                @if ($typeList == "grid")
                                    @include('includes/gridProductList', array('resu' => $resul))
                                @endif
                                
                                @if ($typeList == "list")
                                    @include('includes/listProductList', array('resu' => $resul))
                                @endif
                            @endforeach
                            </div>                    
                    
                </div>

<div id="cuentaSiguente" style="display:none"></div>

<script>
var produ;
$(document).ready(function(){
    
    
    var nameCategory = $('#CategoryHeader').attr('class'); 
    var stuff;
    var pag = 1; 
    var paginationMax = "{{ \GetSettings::getProductEachPage() }}"
    
            $.get("/sampleProductList/" + pag + "/" + nameCategory, function( my_var ) {
            pag++;
            
            stuff = my_var;
        }, 'html');  // or 'text', 'xml', 'more'
        
        
        
    $("#btn1").click(function(){
        $('#btn1').html("Cargando...");
        
        $.get("/sampleProductList/" + pag + "/" + nameCategory, function( my_var ) {
            pag++;
            
            stuff = my_var;
        }, 'html');  
        
        /*
        console.log("wtf " + stuff); //undefined
                console.log("name " + nameCategory); //undefined
                */
                sta = "<div class='expansion" + pag + "'></div>";
                 $("#ProductContainer").append(sta);
                 
                 $( ".expansion"+pag ).load( "/sampleProductList/" + pag + "/"+nameCategory, function() {
                  //alert( "Load was performed." );
                  
       // $("#btn1").attr('value', 'Cargar mas productos...');
       $('#btn1').html("Cargar mas productos...");
                });
                
               
               
                     
        $("#cuentaSiguente").load( "/countSampleProductList/" + pag + "/" + nameCategory, function() {
            //      alert( "Load was performed." );
            if(document.getElementById("cuentaSiguente").textContent < paginationMax)
                   
                   document.getElementById("btn1").style.display = "none";
                });
    });
});
</script>

            </div>
        </div>
</head>


