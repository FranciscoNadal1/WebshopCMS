        <?php   
            use Assets\AssetManager as GetAsset; 
        ?>

<style>
  
    #mySidenav{
        display:block !important;
        
    }
    
</style>




<div class="header">
    
    <div class=""> 
            <div id="trigram"  class="col-sm-1 align-middle">

                 <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
        
            </div>
     

 
        
    </div>

        

</div>

<div id="mySidenav" class="sidenav">
  <div id="closeButton"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></div>
  <div class="belowClose">
  
  <div class="separator panel-heading">Estadísticas</div>
      <div class="panel-body">
          <a href="/admin/productCallStatistics">Estadisticas de productos</a>
          <a href="/admin/mail">Notificaciones - {{ \MailData::getNonReadCount() }}</a>
    </div>
    

    
    
    
    
   <div class="separator panel-heading ">PCs Electroaita</div>
      <div class="panel-body">
          <a href="/admin/addpc">Añadir pc</a>
          <a href="/admin/editPCs">Ver listado pcs</a>
    </div>  
    
    
    <div class="separator panel-heading">Layout</div>
      <div class="panel-body">
          <a href="/admin/changeCategories">Cambiar enlace de menu de categorias</a>
        <a href="/admin/orderCategories">Cambiar orden categorias</a>
    </div>   
    
    
  <div class="separator panel-heading ">Administración</div>
      <div class="panel-body">
          
          <a href="/admin/bannerInicial">Banner inicial</a>
          <a href="/admin/updaterBenefits">Cambiar beneficios</a>
          <a href="/admin/updater">Actualizador Automático</a>
          <a href="/admin/updater/filters">Actualizador filtros</a>
          <a href="/admin/settings">settings</a>
<!--          <a href="/admin/settings">Change style</a>
-->

  
          <a href="/admin/cleanLocal">Borrar archivos locales</a>
    </div>  
    
    
  <div class="separator panel-heading">Pruebas</div>
        <div class="panel-body">
             <a href="/admin/testChamber">Tests</a>
         </div>
</div>
    
    
    
</div>

<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
}

openNav();
</script>