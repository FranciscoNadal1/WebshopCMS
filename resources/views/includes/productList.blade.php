            <?php
            
            
            ///////                 Provisional
            if(!isset($categoria)){
                    $categoria = "AMD socket FM2+";
                    
                    $results =  DBData::getAllWhereTituloFamilia($categoria);  
                
            }
            
            ?>
<div id="container"  class="">
    
    
    <!-- SI, ESTO SOBRA, SOLO QUIERO INCLUIRLO DE FORMA SEGURA 
        <link rel="stylesheet" href={{ Assets\AssetManager::GetCSS("baseTheme" . "/style.css") }} type="text/css">
        -->
        
        <link rel="stylesheet" href={{ GetAsset::GetCSS("baseTheme" . "/style.css") }} type="text/css">
        
    <div id="CategoryHeader" >{{ $results[0]->TITULOSUBFAMILIA }}</div>
        
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
</div>