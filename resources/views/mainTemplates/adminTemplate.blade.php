<html>
    <head>
        <title>App Name - {{ $name }}</title>


<link rel="stylesheet" href={{ GetAsset::getCSS(\GetSettings::getTheme() . "/style.css") }} type="text/css">
<link rel="stylesheet" href={{ GetAsset::getBootstrap() }} integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<script src={{ GetAsset::getjQuery() }} integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s=" crossorigin="anonymous"></script>
<meta charset="UTF-8" />
<!--
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
-->
<script type="text/javascript" src={{ GetAsset::getAngular() }} ></script>
<script src={{ GetAsset::getChart() }} ></script>

<script src={{ GetAsset::getAngularChart() }} ></script>




    </head>
     
    <body>
        <div id="main">
        @include('admin/minorIncludes/header')

       
    <div id="wrapper">

        
       @yield('content')
        
   </div>     
   </div>

    </body>
</html>