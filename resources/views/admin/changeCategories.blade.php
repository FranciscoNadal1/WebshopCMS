@extends('mainTemplates/adminTemplate')

@section('content')

<div id="admin">
<?php
    $results = \DBData::getAllFamilyTitles();
?>
<?php
    $results3 = DBData::getAllCategories();
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





<!-- ####################################################################################################### -->
<!-- IN CASE ADD CATEGORY BUTTON PULSED-->


@if(isset($_REQUEST['addCategory']))

    {{ \DBData::insertCategoryName($_REQUEST['add']) }}

@endif

<!-- ####################################################################################################### -->



<!-- ####################################################################################################### -->
<!-- IN CASE RENAME CATEGORY NAME BUTTON PULSED-->


@if(isset($_REQUEST['updateCategoryName']))
    
    @foreach ($results3 as $resul)
    
<?php
            \DB::table('categorias')
            ->where('code', $resul->code)
            ->update(['name' => $_REQUEST["C".$resul->code]])

?>          
                    
    @endforeach

@endif

<!-- ####################################################################################################### -->

<!-- ####################################################################################################### -->
<!-- IN CASE DELETE CATEGORY NAME BUTTON PULSED-->

    
    @foreach ($results3 as $resul)
    
        @if(isset($_REQUEST["D".$resul->code]))
        
<?php
if($resul->code !=1)
            DB::table('categorias')->where('code', '=', $resul->code)->delete()
?>    
        @endif
                    
    @endforeach


<!-- ####################################################################################################### -->


<?php
    $results = \DBData::getAllFamilyTitles();
?>
<?php
    $results3 = DBData::getAllCategories();
?>

        
   <h2>
    Editar categorias existentes
</h2>     
<form method="POST" action="#">
    
<input type="hidden" name="_token" value="{!! csrf_token() !!}">


@foreach ($results3 as $resule)
 
    @if($resule->code == 1)      
        <input type="hidden" value="{{$resule->name}}" name="C{{$resule->code}}"/>
        <input type="hidden" value="delete" name="D{{$resule->code}}"/>   
    @endif
    @if($resule->code != 1)      
        <input type="text" value="{{$resule->name}}" name="C{{$resule->code}}"/>
        <input type="submit" value="delete" name="D{{$resule->code}}"/>
    @endif
    </br>
@endforeach
    
    <input type="submit" name="updateCategoryName" value="Cambiar nombre de todas las categorias"  size="50">
    
    
</form>


<h2>
    Añadir categoria
</h2>

<form method="POST" action="#">
    
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <input type="text" value="" name="add"/>
    <input type="submit" value="Añadir categoria" name="addCategory"/>    
</form>



<h2>
    Construir menús
</h2>

    <form method="POST" action="#">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
    <input type="submit" name="Actualizar" class="btn-primary" style="width:100%;" value="Actualizar"/>
<div class="categoryChooser">
         @foreach ($results as $resul)
                    
             
    <?php
    
        $selectedNumber = \DBData::getCategoryCodeFromName($resul->TITULOFAMILIA);
    ?>
            
<div class="productWrapper col-xs-1 col-md-4 col-lg-4 row-fluid ">

    <div class="eachProductWrapper">   

               </br><strong> {{ "" . $resul->TITULOFAMILIA . "" }} </strong>
               
    <select class="form-control" name="{{ $resul->CODFAMILIA }}">
                 
        

        
            @foreach ($results3 as $resule)
            
                 <option 
                         @if($resule->code == $selectedNumber)
                           selected
                        @endif
                 value='{{ ($resule->code)}}'>  {{ $resule->name}} </option>
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
 </div>
        @endforeach
       
            <input name="Actualizar" type="submit" class="btn-primary" style="width:100%;" value="Actualizar"/>
     </form>           


</div></div>

@endsection