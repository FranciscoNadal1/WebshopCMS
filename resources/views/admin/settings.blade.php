
@if(isset($_REQUEST['submit']))
   
 {{ \GetSettings::updateSettings($_REQUEST['theme'], $_REQUEST['listType'], $_REQUEST['eachPage'], $_REQUEST['maintenance'], $_REQUEST['company']) }}
   

@endif





@extends('mainTemplates/adminTemplate')



    @section('content')
    
      <form action="/admin/settings" method="GET">
       
          <div class="apartado"> <label for="comment">Nombre del tema:</label></div>
            <input type="text" class="form-control" name="theme" value='{{ \GetSettings::getTheme() }}'/>
              
          <div class="apartado"> <label for="listType">Tipo muestra productos:</label></div>  
               <input type="text" class="form-control" name="listType" value='{{ \GetSettings::getProductListType() }}'/>
              
          <div class="apartado"> <label for="eachPage">Número de productos por página:</label></div>   
               <input type="text" class="form-control" name="eachPage" value='{{ \GetSettings::getProductEachPage() }}'/>
              
          <div class="apartado"> <label for="maintenance">Modo mantenimiento:</label></div>   
              <input type="text" class="form-control" name="maintenance" value='{{ \GetSettings::isMaintenanceOn() }}'/>
              
          <div class="apartado"> <label for="company">Nombre de la compañía:</label></div>    
              <input type="text" class="form-control" name="company" value='{{ \GetSettings::companyName() }}'/>
              
              
              </br>
              <input type="submit" class="btn btn-default" name="submit" value="Actualizar settings"/>
              
      </form>
    @endsection