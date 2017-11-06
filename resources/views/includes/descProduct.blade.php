<!-- Plain page for the description of each product-->



    <!-- Add an increment for each product view on each date, to keep statistic  -->
    
    
        <!-- NOTE : Should add user field on table for the future -->
    
    <?php
        \ProductViewNumber::plusOneView($results[0]->CODIGOINTERNO);
    ?>
    
    <!-- ----------------------------------------------------------------------- -->

<div id="container"  class="">
    
    <div id="CategoryHeader" >{{ $results[0]->TITULO }}</div>
        
    <div id="ProductContainer" class="container">
    
        <style>
            
        </style>
        
        
        <div class="boxes container" id="containerDesc">
            <div class="col1 col-xs-5 col-md-5 col-lg-5 article-block boxes">
                <div class="imagenProducto">
                    <img width="75%" src={{ infortisaApi::getProductMainImage($results[0]->CODIGOINTERNO) }} />
                </div>
                </div>
             <div class="col2 col-xs-7 col-md-7 col-lg-7 article-block boxes">
                
                               

                <div class="categoryName">Precio</div>
                    <div class="categoryText">      {{ $results[0]->PRECIO }}</div>
                <div class="categoryName">Nombre del producto</div>    
                    <div class="categoryText">      {{ $results[0]->TITULO }}</div>
                    
                    <!--
                <div class="categoryName">Precio</div>    
                    <div>      {{ $results[0]->TITULOSUBFAMILIA }} </div>
                    
                <div class="categoryName">Precio</div>  
                    <div>      {{ $results[0]->TITULOFAMILIA }}</div>
                    
                    -->
                <div class="categoryName">C&oacute;digo</div>    
                    <div class="categoryText">      {{ $results[0]->CODIGOINTERNO }}</div>
                <div class="categoryName">Fabricante</div>    
                    <div class="categoryText">      {{ $results[0]->NOMFABRICANTE }}</div>
                <div class="categoryName">Stock</div>    
                    <div class="categoryText">      {{ $results[0]->STOCK }}</div>
                   
                   
                   </div>  
                </div>
                   <div class="boxes container" id="fichaProducto">
                       <pre>
                            <?php 
                            $tecDes = infortisaApi::get_tecnica($results[0]->CODIGOINTERNO);
                              //  echo $tecDes; 
                                
                                
                                echo htmlspecialchars($tecDes);
                            ?>
                            </pre>
                    </div>
                    
                    
                    <div id="TestSpace">
                        <h2>Espacio para tests</h2>
                        
                     <?php
                     /*
                        $peliculas = new SimpleXMLElement(html_entity_decode($tecDes));
                    
                 //       print_r($peliculas);
                     $resultado = $peliculas->xpath('//tr/text()');
                        
                         $categories = $peliculas->xpath('//tr[text()]');

                    while ($categorie = current($categories)) {
                        print_r($categorie);
                        echo "<br>-<br>";
                        print_r($categorie->xpath('//strong'));                
                                        
                                        
                                        
                                    $categorieIn = $categorie->xpath('//text()');      
                                    echo $categorieIn[1];
                                    */
                                            //    while ($categor = current($categorieIn)) {               
                                       //       echo next($categor) ? ', ' : null;
                                        //            echo "</br>";
                                                    
                                       //         }
                                        
                                        
                                        
                     //   echo $categorie->xpath("//*[0]/text()")->toString();
                    //    $found = $categorie->xpath('//*');
                    //    echo $found[0];
/*
                        if(next($categories))
                            return ',';
                        else
                            break;
                            */
                            /*
                        echo next($categories) ? ', ' : null;
                        echo "</br>";
                        
                    }
                    echo "---------------------<br>";
                    $xml = simplexml_load_string(html_entity_decode($tecDes));

                    foreach($xml as $SalesInvoice) {
                        print_r($SalesInvoice->tr);
                    }
*/

    /*
                        while(list( , $nodo) = each($resultado)) {
                            echo $nodo,"\n";
                        }
    */
                    
                    /* 
                         libxml_use_internal_errors(true);
                            $dom = new DOMDocument("1.0", "UTF-8");
                            $dom->strictErrorChecking = false;
                            $dom->validateOnParse = false;
                            $dom->recover = true;
                            $dom->loadXML($tecDes);
                            $xml = simplexml_import_dom($dom);
                        
                        
                        $simplexml = simplexml_load_string($tecDes);
                        print_r($simplexml);
                        
                         echo $xml->table;
                        
                            libxml_clear_errors();
                            libxml_use_internal_errors(false);
                     ?>
                       
                       */
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                               
                               /*                
                        
                        $doc = new DOMDocument("1.0", "UTF-8");
                        $doc->loadHTMLFile(html_entity_decode($tecDes));
                        
                        $xpath = new DOMXpath($doc);
                        */
                        // example 1: for everything with an id
                        //$elements = $xpath->query("//*[@id]");
                        
                        // example 2: for node data in a selected id
                        //$elements = $xpath->query("/html/body/div[@id='yourTagIdHere']");
                        
                        // example 3: same as above with wildcard
                        /*
                        $elements = $xpath->query("//tr");
                        
                        if (!is_null($elements)) {
                          foreach ($elements as $element) {
                            echo "<br/>[". $element->nodeName. "]";
                        
                            $nodes = $element->childNodes;
                            foreach ($nodes as $node) {
                              echo $node->nodeValue. "\n";
                            }
                          }
                        }
                       
                       
                       */
                       
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                       ?>
                        
                    </div>
                
    </div>
</div>