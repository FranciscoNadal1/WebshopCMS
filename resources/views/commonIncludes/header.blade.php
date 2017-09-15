        <?php   
            use Assets\AssetManager as GetAsset; 
        ?>

<div class="header">
    <div class=""> 
        <div id="logoContainer">
            <a class="logo" href="/">
                <img width="250" height="100" src="{{ GetAsset::getLogo() }}">
            </a> 
        </div>
        <div id="searchAnduser">
           <div id="searchArea"  class=".col-sm-6">
                
        @section('search')
            @include('commonIncludes/searchBar')
        @show
        
        
        
            </div>
            
            <div id="userLoginBox" class=".col-sm-6">
                
        @section('userCart')
            @include('commonIncludes/userCart')
        @show
        </div>
        </div>
        
    </div>
        <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
            <span class="hamb-top"></span>
          	<span class="hamb-middle"></span>
      		<span class="hamb-bottom"></span>
        </button>
        

</div>