<html>
    <head>
        <title>App Name - {{ $name }}</title>


        <link rel="stylesheet" href={{ GetAsset::GetCSS(\GetSettings::getTheme() . "/style.css") }} type="text/css">

        
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <script	type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js" integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="			  crossorigin="anonymous"></script>
       

<script type="text/javascript" src={{ GetAsset::GetJS("hamburger.js") }} ></script>
    </head>
    
    <body>
        
        @include('commonIncludes/header')




 
        
    <div id="wrapper">
        @section('sidebar')
            @include('commonIncludes/sideMenu')
        @show
        
        
          @include('commonIncludes/dropDown')
          
       @yield('content')
      
        
               
        @section('footer')
            @include('commonIncludes/footer')
        @show  

        
   </div>     


    </body>
</html>