        <?php   
            use Assets\AssetManager as GetAsset; 
        ?>

<style>
  
    
    
</style>


<div class="header">
    
    <div class="container"> 
            <div id="trigram"  class="col-sm-1 align-middle">

                 <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
        
            </div>
     
  <div class="col-sm-11">   
                <div id="logoContainer">
                    <a class="logo" href="/">
                        <img width="250" height="100" src="{{ GetAsset::getLogo() }}">
                    </a> 
                </div>
</div>
        
    </div>

        

</div>

<div id="mySidenav" class="sidenav">
  <div id="closeButton"><a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a></div>
  <div class="belowClose">
  
  <div class="separator">Estadísticas</div>
  <a href="/admin/productCallStatistics">Estadisticas de productos</a>

  
  <div class="separator">Administración</div>
  
  <a href="/admin/changeCategories">Cambiar enlace de menu de categorias</a>
  
  <a href="/admin/settings">settings</a>
  
  <div class="separator">Pruebas</div>

    <a href="/admin/testChamber">Tests</a>
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
</script>