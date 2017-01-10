            <?php
            
            
            ///////                 Provisional
            if(!isset($categoria)){
                    $categoria = "AMD socket FM2+";
                    $results = DB::select("SELECT * FROM csv where TITULOSUBFAMILIA = \"$categoria\" group by CODIGOINTERNO");
            }
            
            ?>
<div id="container"  class="">
    
    <div id="CategoryHeader" >{{ $results[0]->TITULOSUBFAMILIA }}</div>
        
    <div id="ProductContainer" class="container">
        
            
        @foreach ($results as $resul)
            @include('includes/singleProduct', array('resu' => $resul))
        @endforeach
    </div>
</div>