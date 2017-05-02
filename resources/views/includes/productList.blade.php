
    


        
        
    <div id="ProductContainer" class="container">
        
            
            <?php            $typeList = "grid";            ?>
            
            
        @foreach ($results as $resul)
            @if ($typeList == "grid")
                @include('includes/gridProductList', array('resu' => $resul))
            @endif
            
            @if ($typeList == "list")
                @include('includes/listProductList', array('resu' => $resul))
            @endif
                      
            
        @endforeach
        
        
    </div>

<div id="cuentaSiguente"></div>

<script>
var produ;



$(document).ready(function(){
    
    
    var nameCategory = $('#CategoryHeader').attr('class'); 
    var stuff;
    var pag = 1; 
    
            $.get("/sampleProductList/"+pag+"/"+nameCategory, function( my_var ) {
            pag++;
            
            stuff = my_var;
        }, 'html');  // or 'text', 'xml', 'more'
        
        
        
    $("#btn1").click(function(){
        $('#btn1').html("Cargando...");
        
        $.get("/sampleProductList/"+pag+"/"+nameCategory, function( my_var ) {
            pag++;
            
            stuff = my_var;
        }, 'html');  
        
        /*
        console.log("wtf " + stuff); //undefined
                console.log("name " + nameCategory); //undefined
                */
                sta = "<div class='expansion"+pag+"'></div>";
                 $("#ProductContainer").append(sta);
                 
                 $( ".expansion"+pag ).load( "/sampleProductList/"+pag+"/"+nameCategory, function() {
                  //alert( "Load was performed." );
                  
       // $("#btn1").attr('value', 'Cargar mas productos...');
       $('#btn1').html("Cargar mas productos...");
                });
                
               
               
                     
        $("#cuentaSiguente").load( "/countSampleProductList/" + pag + "/" + nameCategory, function() {
                  alert( "Load was performed." );

                });
                

    });
});


</script>


</head>





