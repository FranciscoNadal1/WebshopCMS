@extends('mainTemplates/adminTemplate')

@section('content')

<div id="admin">
<?php
    $results = \DBData::getAllFamilyTitles();
?>

<!-- ####################################################################################################### -->
<!-- IN CASE OF BUTTON PULSED-->

@if(isset($_REQUEST['Actualizar']))
    
    {{ \DBData::deleteMenus() }}
    
    @foreach ($results as $resul)
    
        @if(isset($_REQUEST[$resul->CODFAMILIA]))

            {{ \DBData::updateMenuSingleOne($resul->CODFAMILIA,$_REQUEST[$resul->CODFAMILIA]) }}
        
        @endif
                    
    @endforeach     

@endif

<!-- ####################################################################################################### -->

    <form method="POST" action="#">
       
    <input type="submit"  name="Actualizar"  class="btn-primary" style="width:100%;" value="Actualizar"/>
<div class="categoryChooser container-fluid">
         @foreach ($results as $resul)
                       
             
    <?php
    
        $selectedNumber = \DBData::getCategoryCodeFromName($resul->TITULOFAMILIA);
    ?>
            
<div class="productWrapper col-xs-3 col-md-3 col-lg-3 row-fluid ">

               </br><strong> {{ "" . $resul->TITULOFAMILIA . "" }} </strong>
               
    <select class="form-control" name="{{ $resul->CODFAMILIA }}">
                 
        
        <?php
        
            $results3 = DBData::getAllCategories();
        
        ?>
        
            @foreach ($results3 as $resule)
                 <option 
                         @if($resule->index == $selectedNumber)
                           selected
                        @endif
                 value='{{ ($resule->index)}}'>  {{ $resule->name}} </option>
            @endforeach     
    </select>
               
               </br>
                
                    
                    <?php 
                        $results2 = \DBData::getAllCategoryTitlesWhere($resul->TITULOFAMILIA);
                    ?>
                            @foreach ($results2 as $resul2)
                            
                            
                                           
                                            <blockquote>{!! "\t -- ". nl2br(e($resul2->TITULOSUBFAMILIA)) !!}</blockquote>
                            @endforeach        
</div>                           
        @endforeach
            <input name="Actualizar" type="submit" class="btn-primary" style="width:100%;" value="Actualizar"/>
     </form>           
</div>

</div>

@endsection