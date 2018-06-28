  <?php
  //$totalNumberProducts = $results[0]->coun;
  
  if(isset($coun))
    $totalNumberProducts = $coun;
  else if(isset($countAllProducts))
    $totalNumberProducts = $countAllProducts;
  else
    $totalNumberProducts = sizeOf($results);
  ?>
  


  @if($totalNumberProducts <= \GetSettings::getProductEachPage())
  <style>
      .loadMoreProducts{
          display:none;
      }
  </style>
  
  @endif




  <script>
  
  
  


        $.fn.parpadear = function()
        {
        	this.each(function parpadear()
        	{
        		$(this).fadeIn(500).delay(250).fadeOut(500, parpadear);
        	});
        }
        
        
    $( document ).ready(function() {
      
        $('.parpadeo').parpadear();
      
        });
        
</script>
      @if(isset($list))
        <div style='display:none' id='filtersJavascript'>{{ $list }}</div>
    @else
        <div style='display:none' id='filtersJavascript'></div>
    @endif
    
    @if(!isset($_REQUEST['order']))
       <?php $_REQUEST['order'] ="barato"; ?>
    @endif


  <div>



<style>
body {
    font-family: "Lato", sans-serif;
}

.sidenavFilters {
    height: 100%;
    width: 0;
    position: fixed;
    z-index: 1;
    
    top: 0;
    
    background-color: white;
    overflow-x: hidden;
    transition: 0.5s;
    padding-top: 60px;
    z-index:9999999999;
    border-left:2px solid silver;
}



    @media only screen and (min-width: 1000px) {
    .sidenavFilters {
    left: 0;
    }
}
    @media only screen and (max-width: 999px) {
    .sidenavFilters {
    right: 0;
    }
}


.sidenavFilters a {
    padding: 8px 8px 8px 32px;
    text-decoration: none;
    font-size: 25px;
    
    display: block;
    transition: 0.3s;
}

.sidenavFilters a:hover {
    color: #f1f1f1;
}

.sidenavFilters .closebtn {
    position: absolute;
    top: 0;
    right: 25px;
    font-size: 36px;
    margin-left: 50px;
}

@media screen and (max-height: 450px) {
  .sidenavFilters {padding-top: 15px;}
  .sidenavFilters a {font-size: 18px;}
}
</style>
</head>
<body>
    
    
<?php

$mainSubFamilia = \DBData::getCodesubfamiliaFromSubfamilia($categoria);
$mainFilters = \DB::select("
    SELECT infortisa_specificationAttribute.SpecificationAttributeName
FROM totalCsv, `infortisa_productSpecification` , infortisa_IdSku, infortisa_specificationAttributeOption, infortisa_specificationAttribute
WHERE totalCsv.CODIGOINTERNO = infortisa_IdSku.SKU
and infortisa_IdSku.ID = infortisa_productSpecification.ProductId
and infortisa_productSpecification.OptionId = infortisa_specificationAttributeOption.OptionId
and
infortisa_specificationAttributeOption.SpecificationAttributeId =
infortisa_specificationAttribute.SpecificationAttributeId
and 
totalCsv.CODSUBFAMILIA =  '". $mainSubFamilia ."' 
group by infortisa_specificationAttribute.SpecificationAttributeName
order by infortisa_specificationAttribute.DisplayOrder
");

?>



<div id="mySidenav" class="sidenavFilters">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

{{--
                     @include('includes/filter', array('subFamilia' => $mainSubFamilia, 'filters' => $mainFilters ))
      --}}
</div>



<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}



</script>
































            <div class="row"> 
                <div class="col-lg-2"></div>
                <div id="filterBar" class="containerdiv hidden-sm hidden-xs hidden-md visible-lg-block col-lg-2">
                    
                     @include('includes/filter', array('subFamilia' => $mainSubFamilia, 'filters' => $mainFilters ))
                     
                     
                     
                </div>
            
        @if(sizeOf($results) > 0) 
        
        
        
                              @if(count($mainFilters) == 0)
                                   <div id="ProductContainer" class="container col-sm-12 col-md-12 col-lg-12 pull-right">  
                              @else
                                   <div id="ProductContainer" class="container col-sm-12 col-md-12 col-lg-10 pull-right">  
                              @endif
               
                   <div id="CategoryAndArticleDiv">
                       <div id="CategoryHeader" class="{{ \DBData::desAccentify($results[0]->TITULOSUBFAMILIA) }}">
                           
                           {{ $results[0]->TITULOSUBFAMILIA }} 
                
                
                              @if(!count($mainFilters) == 0)
                                <span class="hidden-lg" style="font-size:30px;cursor:pointer;float:right" onclick="openNav()">Filtros &#9776; </span>
                              @endif
                       </div>
                       
                        <div id="ArticleNumber">{{ $totalNumberProducts }} articulos
                        
                        <span>
                               <form id="myForm" action="" method="POST">
                               
                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                    <select class="" name="order" onchange="this.form.submit()">
                                        
                                      
                                      @if($_REQUEST['order'] == "caro")
                                          <option selected="selected" value="caro">Precio : Más caros primero</option>
                                      @else
                                          <option value="caro">Precio : Más caros primero</option>
                                      @endif
                                      
                                      
                                      @if($_REQUEST['order'] == "barato")
                                          <option selected="selected" value="barato">Precio : Más baratos primero</option>
                                      @else
                                          <option value="barato">Precio : Más baratos primero</option>
                                      @endif
                                      
                                      
                                      @if($_REQUEST['order'] == "relevancia")
                                          <option  selected="selected" value="relevancia">Relevancia</option>
                                      @else
                                          <option value="relevancia">Relevancia</option>
                                      @endif                                      
                                      
                                      
                                      @if($_REQUEST['order'] == "novedades")
                                          <option  selected="selected" value="novedades">Novedades</option>
                                      @else
                                          <option value="novedades">Novedades</option>
                                      @endif                                      
                                      
                                      
                                      @if($_REQUEST['order'] == "alfa")
                                          <option  selected="selected" value="alfa">Alfabético</option>
                                      @else
                                          <option value="alfa">Alfabético</option>
                                      @endif                                      
                                      
                                    </select> 
                               </form>
                           </span>
                        
                        </div>
                    </div>
                            <div class="productBlock">
                      <!--   <div id="ProductContainer" class="">   -->
                                
                                <?php            $typeList = \GetSettings::getProductListType();            ?>
                                
                                @if($totalNumberProducts > 0)
                                
                                    @foreach ($results as $resul)
                                        
                                            @if ($typeList == "grid")
                                                @include('includes/gridProductList', array('resu' => $resul))
                                            @endif
                                            
                                            @if ($typeList == "list")
                                                @include('includes/listProductList', array('resu' => $resul))
                                            @endif
                                    @endforeach
                               
                                @endif
                        
                            </div>                    
                    
                </div>
        
        @else
                <div id="ProductContainer"><h2>No hay coincidencias</h2></div>
        
        @endif
<div id="cuentaSiguente" style="display:none"></div>

<script>var produ;
$(document).ready(function(){
    
    
    var nameCategory = $('#CategoryHeader').attr('class'); 
    var stuff;
    var pag = 0; 
    var paginationMax = "{{ \GetSettings::getProductEachPage() }}"
    var filtersJavascript = $("#filtersJavascript").text(); 

        
        
    $("#btn1").click(function(){
        
        $('#btn1').html("Cargando...");
         pag++;

                sta = "<div class='expansion" + pag + "'></div>";
                 $("#ProductContainer").append(sta);
                 
                 
                 
                 
                var dataOrder = { 
                    order:"{{ $_REQUEST['order'] }}", 
                    _token:"{{ csrf_token() }}",  
                };
                
                
                var urlToLoad = "/sampleProductList/" + pag + "/"+nameCategory;
                 
                if(filtersJavascript == "")
                    urlToLoad +=  "/order/{{ $_REQUEST['order'] }}";
                else
                    urlToLoad +=  "/filters/" + filtersJavascript;
                    
                    console.log(urlToLoad);
                    $( ".expansion"+pag ).load(urlToLoad, dataOrder, function() {
               
                 


       $('#btn1').html("Cargar mas productos...");
                });
                
               
               
                     


    });
});
</script>




            </div>
        </div>
</head>


