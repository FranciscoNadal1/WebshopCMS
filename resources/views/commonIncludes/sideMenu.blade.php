   
        <div class="overlay"></div>
    
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                
             <div class="cabecera">
                 <div>Categor&iacute;as</div>
             </div>
             

            <?php
            $categories = \DBData::getAllCategories();
            ?>

            
            @foreach ($categories as $cat)

                    <li><a href={{ "/categoria/" . DBData::desAccentify($cat->name) . "/" }}> {{ $cat->name }}</a></li>
            
            @endforeach
            
            
            
            
            </ul>
        </nav>
        