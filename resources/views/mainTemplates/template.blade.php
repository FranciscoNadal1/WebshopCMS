<html>
    <head>
        <title>App Name - {{ $name }}</title>

<?php
//// Provisional configuration things

$dropdownYesOrSideBar = "dropdown";
?>

<link rel="stylesheet" href={{ GetAsset::getCSS(\GetSettings::getTheme() . "/style.css") }} type="text/css">
<script	type="text/javascript" src={{ GetAsset::getjQuery() }} integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="			  crossorigin="anonymous"></script>

<link rel="stylesheet" href={{ GetAsset::getBootstrap() }} integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

@if($dropdownYesOrSideBar == "dropdown")
{{

GetAsset::getDropDownAssets()

}}
@endif
<script>

// When the user scrolls down 20px from the top of the document, show the button
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
    } else {
        document.getElementById("myBtn").style.display = "none";
    }
}

// When the user clicks on the button, scroll to the top of the document
function topFunction() {
    /*
    document.body.scrollTop = 0; // For Safari
    document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    
    */
     $('html, body').animate({scrollTop:0}, 'slow');
}



$(document).ready(function(){
    
    
    
    
    $(function() {
    while( $('.resize').height() > $('.resize').height() ) {
        $('.resize').css('font-size', (parseInt($('.resize').css('font-size')) - 1) + "px" );
    }
});
    
    
    
    
    
    
    
    
    
  var scrollTop = 0;
  $(window).scroll(function(){
    scrollTop = $(window).scrollTop();
     $('.counter').html(scrollTop);
    
    if (scrollTop >= 100) {
      $('.header').addClass('scrolled-nav');
    } else if (scrollTop < 200) {
      $('.header').removeClass('scrolled-nav');
    } 
    
  }); 
  
});


</script>

<script type="text/javascript" src={{ GetAsset::getJS("hamburger.js") }} ></script>

  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    
    <body>
        <div id="loading"></div>
        @include('commonIncludes/dropDown')




        
    <div id="wrapper">
        @section('sidebar')
        
        @if(!$dropdownYesOrSideBar == "dropdown")
            
        @endif
        @include('commonIncludes/sideMenu')
        @show
        
        
          
       @yield('content')
      
               
        @section('footer')
            @include('commonIncludes/footer')
        @show  

        
   </div>     




<button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fa fa-angle-up "></i></button>

 {{--  @include('commonIncludes/forLater')    --}}

<div id="scriptDiv"></div>
    </body>
</html>