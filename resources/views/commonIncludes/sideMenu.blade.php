   <script>
       

   </script>
   
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
         
            <?php
                $results = DB::select("SELECT TITULOSUBFAMILIA FROM csv group by TITULOSUBFAMILIA limit 1,10");
            ?>
            
            @foreach ($results as $resu)
            
                    <?php 
                    $onlyconsonants = str_replace(" ", "-", $resu->TITULOSUBFAMILIA); 
                    $onlyconsonants = str_replace("/", "-", $onlyconsonants); 
                    $onlyconsonants = str_replace("á", "a", $onlyconsonants);
                    $onlyconsonants = str_replace("é", "e", $onlyconsonants);
                    $onlyconsonants = str_replace("í", "i", $onlyconsonants);
                    $onlyconsonants = str_replace("ó", "o", $onlyconsonants);
                    $onlyconsonants = str_replace("ú", "u", $onlyconsonants);
                    
                    ?>
                <li><a href={{ "/categoria/" . "$onlyconsonants" . "/" }}> {{ $resu->TITULOSUBFAMILIA }}</a></li>
            @endforeach
            
            
            
            
            </ul>
        </nav>
        