   <script>
       

   </script>
   
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                
             <div class="cabecera">
                 <div>Categor&iacute;as</div>
             </div>
             
            {{--*/ $results = DBData::getAllCategories() /*--}}
             

            
            @foreach ($results as $resu)
                <li><a href={{ "/categoria/" . DBData::desAccentify($resu->name) . "/" }}> {{ $resu->name }}</a></li>
            @endforeach
            
            
            
            
            </ul>
        </nav>
        