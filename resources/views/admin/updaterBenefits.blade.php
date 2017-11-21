@extends('mainTemplates/adminTemplate')

@section('content')

<div id="admin">
<?php
    $results = \DBData::getAllSubfamiliaCodes();
?>

<!-- ####################################################################################################### -->
<!-- IN CASE OF BUTTON PULSED-->

@if(isset($_REQUEST['Actualizar']))
    
    
    
    @foreach ($results as $resul)
    
        @if(isset($_REQUEST[$resul->CODSUBFAMILIA]))

      
          <?php
       \DB::table('benefits')
            ->where('code', $resul->CODSUBFAMILIA)
            ->update(['benefit' => $_REQUEST[$resul->CODSUBFAMILIA]])
       ?>
       
       
        @endif
        
        @if(isset($_REQUEST[$resul->CODSUBFAMILIA . "Excluded"]))
            
            <?php
        \DB::table('excluded')
            ->where('code', $resul->CODSUBFAMILIA)
            ->update(['excluded' => 1]);
            
            ?>
        @else
                        
            <?php
        \DB::table('excluded')
            ->where('code', $resul->CODSUBFAMILIA)
            ->update(['excluded' => 0]);
            
            ?>
            
            
        @endif
        
                    
    @endforeach     

@endif

<!-- ####################################################################################################### -->


    <form method="GET" action="">
       
    <input type="submit"  name="Actualizar"  class="btn-primary" style="width:100%;" value="Actualizar"/>
<div class="categoryChooser container-fluid">
    
    
    
    
      <?php
        
            $results3 = DBData::getAllSubfamiliaAndCodeBenefit();
        
        ?>
        
        <style>
            
            #benefitUpdater {
                border-bottom:1px solid black;
                padding-bottom:10px;
            }
            
            
        </style>
            
            
            
            @foreach ($results3 as $resule)
            <?php
            
            try{
                \DB::insert('insert into benefits (code, benefit) values (?, ?)', [$resule->CODSUBFAMILIA,0]);
            
            }catch(Exception $e){}
            
            try{
                \DB::insert('insert into excluded (code, excluded) values (?, ?)', [$resule->CODSUBFAMILIA,0]);
            
            }catch(Exception $e){}
            
            //DB::table('benefits')->where('code', $resule->CODSUBFAMILIA)->update(['benefit' => 0]);
            ?>
            <div class="form-horizontal">
                <div id="benefitUpdater" class="form-group">
                    <label for="inputEmail" class="control-label col-xs-6">{{ $resule->TITULOSUBFAMILIA }}</label>
                    <div class="col-xs-3">
                        <input type="text"  class="form-control" name="{{ $resule->CODSUBFAMILIA }}" id="{{ $resule->CODSUBFAMILIA }}" value="{{ $resule->benefit }}">
                        
                @if ($resule->excluded == 0)
                        <input type="checkbox" name="{{ $resule->CODSUBFAMILIA }}Excluded" value="{{ $resule->CODSUBFAMILIA }}"> Excluded
                @else
                        <input  type="checkbox" name="{{ $resule->CODSUBFAMILIA }}Excluded" value="{{ $resule->CODSUBFAMILIA }}" checked> Excluded
                @endif
                        
                        
                    
                    </div>
                </div>
            </div>  
    
            @endforeach    
      
      
      
      
      
      
            <input name="Actualizar" type="submit" class="btn-primary" style="width:100%;" value="Actualizar"/>
     </form>           
</div>

</div>

@endsection