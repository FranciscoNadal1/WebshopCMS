<style>
        
.row {
  display: -webkit-box;
  display: -webkit-flex;
  display: -ms-flexbox;
  display:         flex;
  flex-wrap: wrap;
  min-height: 100px;
}
.row > [class*='col-'] {
  display: flex;
  flex-direction: column;
}
    
</style>
<div id=""  class="">
    
    

        
    <link rel="stylesheet" href={{ GetAsset::GetCSS("baseTheme" . "/style.css") }} type="text/css">
        
    <div id="CategoryHeader" >{{ $categoria }}</div>
        
    <div id="" class="container-fluid categoryContainer">
        
            
    {{--*/ $results = \DBData::getFamilyFromCategoryName($categoria) /*--}}


<div class="row row-eq-height">
          @foreach ($results as $resul)
              <div class="col-xs-4 category"> 
                <div class="category2">
                    <div class="title">{{ $resul->TITULOFAMILIA }}</div>

    {{--*/ $results2 = \DBData::getSubFamiliaFromTitulo($resul->TITULOFAMILIA) /*--}}
                    <ul>
                          @foreach ($results2 as $resul2)
                              <a href="/listado/{{ \DBData::desAccentify($resul2->TITULOSUBFAMILIA) }}"><li>{{ $resul2->TITULOSUBFAMILIA }}</li></a>
                          
                          @endforeach    
                    </ul>                  
                </div>
            </div>
            <div class="clearfix visible-xs-block"></div>
            @endforeach   
            </div>
    </div>
</div>