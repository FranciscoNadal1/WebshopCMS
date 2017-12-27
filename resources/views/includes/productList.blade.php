  <?php
  //$totalNumberProducts = $results[0]->coun;
  $totalNumberProducts = $countAllProducts;
  ?>
  
  
  {{--
  {{ \GetSettings::getProductEachPage() }} {{ $countAllProducts }}
  --}}
  @if($totalNumberProducts <= \GetSettings::getProductEachPage())
  <style>
      .loadMoreProducts{
          display:none;
      }
  </style>
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
  @endif
      @if(isset($list))
        <div style='display:none' id='filtersJavascript'>{{ $list }}</div>
    @else
        <div style='display:none' id='filtersJavascript'></div>
    @endif
    
    @if(!isset($_REQUEST['order']))
       <?php $_REQUEST['order'] ="relevancia"; ?>
    @endif


  <div>
            <div class="row">    
                <div id="filterBar" class="containerdiv hidden-sm hidden-xs hidden-md visible-lg-block col-lg-2">
                    
                     @include('includes/filter', array('subFamilia' => $results[0]->CODSUBFAMILIA))
                    
                    
                </div>
            
               <div id="ProductContainer" class="container col-sm-12 col-md-12 col-lg-10">  
               
                       <div id="CategoryHeader" class="{{ \DBData::desAccentify($results[0]->TITULOSUBFAMILIA) }}">{{ $results[0]->TITULOSUBFAMILIA }} ({{ $totalNumberProducts }})
                           <span>
                               <form id="myForm" action="" method="POST">
                               
                                    <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                    <select name="order" onchange="this.form.submit()">
                                        
                                      
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

<script>var produ;
$(document).ready(function(){
    
    
    var nameCategory = $('#CategoryHeader').attr('class'); 
    var stuff;
    var pag = 0; 
    var paginationMax = "{{ \GetSettings::getProductEachPage() }}"
    var filtersJavascript = $("#filtersJavascript").text(); 
    /*
            console.log("/sampleProductList/" + pag + "/" + nameCategory + "/" + filtersJavascript);
            $.ajax(
                "/sampleProductList/" + pag + "/" + nameCategory + "/filters/" + filtersJavascript, 
                
                {"order":"{{ $_REQUEST['order'] }}", "_token": "{{ csrf_token() }}"},  
                
                function( my_var ) {
         type = "POST";
          //  pag++;
            
            stuff = my_var;
        }, 'html');  // or 'text', 'xml', 'more'
        */
        
        
    $("#btn1").click(function(){
        
        $('#btn1').html("Cargando...");
         pag++;
        /*
            console.log("/sampleProductList/" + pag + "/" + nameCategory + "/" + filtersJavascript);
        $.post("/sampleProductList/" + pag + "/" + nameCategory + "/filters/" + filtersJavascript, {"order":"{{ $_REQUEST['order'] }}", "_token": "{{ csrf_token() }}"},  function( my_var ) {
           
            
            stuff = my_var;
        }, 'html');  
        */
        /*
        console.log("wtf " + stuff); //undefined
                console.log("name " + nameCategory); //undefined
                */
                sta = "<div class='expansion" + pag + "'></div>";
                 $("#ProductContainer").append(sta);
                 
                 
                 
                 
            //     $( ".expansion"+pag ).load( "/sampleProductList/" + pag + "/"+nameCategory + "/filters/" + filtersJavascript,{"order":"{{ (isset($_REQUEST['order']) ? $_REQUEST['order'] : "") }}", "_token": "{{ csrf_token() }}"}, function() {
            
            
            //     $( ".expansion"+pag ).load(urlToLoad, {"order":"{{ $_REQUEST['order'] }}", "_token": "{{ csrf_token() }}"}, function() {
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
               
                 

                 // alert( "Load was performed." );
                  
       // $("#btn1").attr('value', 'Cargar mas productos...');
       /*
           $.ajax({
             type: "POST",
             url: urlToLoad,
             data: dataOrder,
             success: function(msg) {
                 $(".expansion"+pag).append(msg);
             }
            });
*/



       $('#btn1').html("Cargar mas productos...");
                });
                
               
               
                     


    });
});
</script>




            </div>
        </div>
</head>


