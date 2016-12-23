        <?php   
            use Assets\AssetManager as GetAsset; 
        ?>

<div class="header">
    <div class="container"> 
        <a class="logo">
            <img width="250" height="100" src="{{ GetAsset::GetIMG("logo.png") }}">
        </a> 
       <div id="buscador">
            
        buscador
        </div>
        
    </div>
        <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
            <span class="hamb-top"></span>
          	<span class="hamb-middle"></span>
      		<span class="hamb-bottom"></span>
        </button>
        

</div>