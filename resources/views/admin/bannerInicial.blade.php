
@if(isset($_REQUEST['submit']))


   


<?php
               
        
        if ($_FILES['productImage']['error'] == UPLOAD_ERR_OK               //checks for errors
              && is_uploaded_file($_FILES['productImage']['tmp_name'])) { //checks that file is uploaded
              
              
          $dataBackground =  file_get_contents($_FILES['background']['tmp_name']); 
          $data64Background = base64_encode($dataBackground);
          
          
          $dataProductImage =  file_get_contents($_FILES['productImage']['tmp_name']); 
          $data64ProductImage= base64_encode($dataProductImage);    
          
          
        //  echo $data64;
    $affected = \DB::insert('insert into initialBanner (Background, MainImage, URL) values (?, ?, ?)', [$data64Background, $data64ProductImage, $_REQUEST['url']]);
    
    
    
    
    
        }



?>


{{--
 <img src="data:image/png;base64, {{ $data64 }}" alt="Red dot" />
 --}}
 
 
@endif





@extends('mainTemplates/adminTemplate')



    @section('content')
    
      <form action="/admin/bannerInicial" method="POST"  enctype="multipart/form-data">
       
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
          <div class="apartado"> <label for="url">Url:</label></div>
            <input type="text" class="form-control" name="url" />
       
       


              
              
              </br>
              
          <div class="apartado"> <label for="background">Imagen de fondo:</label></div>
        <input type="file" name="background" id="background">
        
        
        
          <div class="apartado"> <label for="productImage">Imagen de producto:</label></div>
        <input type="file" name="productImage" id="productImage">
        
              <input type="submit" class="btn btn-default" name="submit" value="Actualizar settings"/>
              
      </form>
      
      
      
      
      </br></br></br>
        <?php     
            $results = \DB::select("SELECT * from initialBanner");
       ?>
      
          @foreach ($results as $resul)
          
          <div ><a href="/borrarBanner/{{ $resul->Code}}">Borrar</a></div>
      <div class="" data-style="background-image: url(data:image/jpg;base64,{{ $resul->Background}})" style="background-image: url(data:image/jpg;base64,{{ $resul->Background}})">
         <div class="container">
                 <a class="" href="{{ $resul->URL}}" data-idslider="{{ $resul->URL}}">
                     <div class="hero-img img-fluid"  style="height:300px; background-image: url(data:image/jpg;base64,{{ $resul->MainImage}})">
                     </div>
                 </a>
             </div>
      </div>
   @endforeach
      
      
      
      
      
      
      
      
      
      
      
    @endsection