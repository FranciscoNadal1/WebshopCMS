@extends('mainTemplates/adminTemplate')

<?php
    $results = \DBData::getAllCategories();
?>

    @section('content')



      <div id="scriptDiv"></div>

      <script>
         function myFunction(codfamilia){
              $('#scriptDiv').load("/admin/changeOrder/"+codfamilia.name+"/"+codfamilia.value, function() {
                              $("#wrapper").load(location.href + " #wrapper");
                });
            }
      </script>
      
<form action="" method="POST">
    @foreach ($results as $resul)
          <div id="" class=" panel panel-default">          
                    <?php
                        if($resul->name == "sincategoria")
                            continue;
                    ?>
             <div class="panel-heading">{{ $resul->name }}</div>
                 <?php
                    $resul = \DBData::getFamilyFromCategoryName($resul->name);
                 ?>
                 
                  <div id="mostViewedPanel" class="chart panel-body">
              @foreach ($resul as $cat)
              
                      <div class="col-sm-3">
                          <div class="form-group mb-2">
                              <input  size="3" onfocusout="myFunction({{ $cat->CODFAMILIA }})" type="text" name="{{ $cat->CODFAMILIA }}"  id="{{ $cat->CODFAMILIA }}" value="{{ $cat->ORDER }}"/>
                              <label for="{{ $cat->CODFAMILIA }}" class="">{{ $cat->TITULOFAMILIA }}</label>
                          </div>
                      </div>
              @endforeach
              
                    </div>
    </div>
    @endforeach
</form>



{{--    \MailData::addMail("Subject","","This is a message") --}}
    @endsection