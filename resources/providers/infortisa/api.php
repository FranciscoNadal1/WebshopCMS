<?php


namespace Providers\infortisa;
use Providers\infortisa\infortisaApi as infortisaApi;
use Providers\ProvidersApi\ProvidersApiInterface as ProvidersApiInterface;


class infortisaApi implements ProvidersApiInterface
{
    
    static $downloadImage = 1;
    
    static function file_get_contents_utf8($fn) {
        $content = file_get_contents($fn);
        return mb_convert_encoding($content, 'UTF-8',
        mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
    }
    
    
        static function getStock(){
            
             $apiUrl     = "http://recursos.infortisa.com";
        $jsonHeader = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization-Token:EFD79BAA-1882-463D-8B44-168A117D4F32'
        );
        
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($c, CURLOPT_HTTPHEADER, $jsonHeader);
        
        curl_setopt($c, CURLOPT_URL, $apiUrl . "/api/Stock/Get");

        
        
        
        
        
        curl_setopt($c, CURLOPT_POSTFIELDS, null);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'GET');
        $contentResult = curl_exec($c);
        curl_close($c);
        print_R($contentResult);
        $obj = json_decode($contentResult);
        
        $stock = $obj;
        
        self::calledApi();
        print_r($stock);
    }
    
    
    
    private static function add_consulta()
    {
        
        
        include('config.php');
        $fecha_actual = date("d-m-y");
        $seleccion = mysql_select_db($bd, $conexion) or die("No se pudo seleccionar la bd $conexion");
        $seleccion;
        $insertintro = mysql_query("Insert into consultas (fecha,numero) values('$fecha_actual',0)");
        mysql_query("UPDATE consultas SET numero=numero+1 where fecha='$fecha_actual' ") or die($insertintro);
        
        self::calledApi();
    }
    
    
    
    
    
    
    
    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    
    static function get_imagenes($cod_prod)
    {
        
        try{
        if (!file_exists("./productImages/infortisa/" . $cod_prod . ".jpg")) {
            $image = file_get_contents("http://recursos.infortisa.com/" . strtolower($cod_prod) . "/" . $cod_prod . "_normal.jpg");
            
            
            file_put_contents("./productImages/infortisa/" . $cod_prod . ".jpg", $image);
        }
        
        return \GetAsset::getProductImg($cod_prod, "infortisa");
        }catch(\Exception $e){
            
            \MailData::addMail("Api Error","","Error api infortisa : " . __FUNCTION__ . " in ".__FILE__." at ".__LINE__ . " : ". $e); 
        }
        
    }
    
    static function get_imagenesLarge($cod_prod)
    {
        
        try{
              
        if (!file_exists("./productImages/infortisa/" . $cod_prod . "_large.jpg")) {
            $image = file_get_contents("http://recursos.infortisa.com/" . strtolower($cod_prod) . "/" . $cod_prod . "_large.jpg");
            
            
            file_put_contents("./productImages/infortisa/" . $cod_prod . "_large.jpg", $image);
        }
        
        return \GetAsset::getProductLargeImg($cod_prod, "infortisa");
        }catch(\Exception $e){
            
            \MailData::addMail("Api Error","","Error api infortisa : " . __FUNCTION__ . " in ".__FILE__." at ".__LINE__ . " : ". $e); 
        }
        
    }
    
    
    
    
    /*
    static function buscador($cod_prod, $numero)
    {
        
        $ia      = 0;
        $s       = "";
        $general = 0;
        
        
        $jsonHeader = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization-Token:EFD79BAA-1882-463D-8B44-168A117D4F32'
        );
        $apiUrl     = "api.infortisa.com";
        
        while ($numero <> 3) {
            
            
            $c = curl_init();
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            
            curl_setopt($c, CURLOPT_HTTPHEADER, $jsonHeader);
            
            
            $cod_prod = str_replace(' ', '%20', $cod_prod);
            
            
            
            
            $acentos_de_mierda = "áéíóú";
            
            
            $acentos_de_mierda = utf8_decode($acentos_de_mierda);
            $text              = str_replace($acentos_de_mierda[0], "%C3%A1", $text);
            
            
            $cod_prod = str_replace($acentos_de_mierda[0], '%C3%A1', $cod_prod);
            $cod_prod = str_replace($acentos_de_mierda[1], '%C3%A9', $cod_prod);
            $cod_prod = str_replace($acentos_de_mierda[2], '%C3%AD', $cod_prod);
            $cod_prod = str_replace($acentos_de_mierda[3], '%C3%B3', $cod_prod);
            $cod_prod = str_replace($acentos_de_mierda[4], '%C3%BA', $cod_prod);
            
            $cod_prod = $cod_prod . "%20";
            
            curl_setopt($c, CURLOPT_URL, $apiUrl . "/api/Product/SearchProducts?searchString=" . $cod_prod . "&pageNumber=" . $numero);
            add_consulta();
            
            
            curl_setopt($c, CURLOPT_POSTFIELDS, null);
            curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'GET');
            $contentResult = curl_exec($c);
            curl_close($c);
            
            $obj = json_decode($contentResult);
            if ($contentResult == "[]") {
                $s = "flag";
                return;
            }
            
            
            
            
            
            $ia = 0;
            while ($ia != count($obj)) {
                $general++;
                $abc = $obj[$ia]->SKU;
                if ($abc == "")
                    return;
                
                
                
                
                
                $_SESSION['buscador_codigos'][$general] = $abc;
                $ia++;
            }
            $stock = $ia;
            
            
            
            
            $numero = $numero + 1;
        }
        
        self::calledApi();
        return $stock;
    }
    */
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    static function get_imagenes_alternativas($cod_prod)
    {
        $imageList = array("");
        $path = "./productImages/infortisa/$cod_prod/";
                        if(!is_dir($path)){
                          mkdir($path);
                        }
                        
                        
                        
        $tok   = "EFD79BAA-1882-463D-8B44-168A117D4F32";
        $token = "Authorization-Token:$tok";
        
        $apiUrl     = "http://api.infortisa.com";
        $jsonHeader = array(
            'Accept: application/json',
            'Content-Type: application/json',
            $token
        );
        $c          = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($c, CURLOPT_HTTPHEADER, $jsonHeader);
        
        
        
        curl_setopt($c, CURLOPT_URL, $apiUrl . "/api/Stock/GetProductStockBySku?Sku=" . $cod_prod);
     //   $self::add_consulta();
        
        
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'GET');
        $contentResult = curl_exec($c);
        curl_close($c);
        
        
        $obj   = json_decode($contentResult);
        $stock = $obj->ProductId;
        
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_HTTPHEADER, $jsonHeader);
        
        
        
        curl_setopt($c, CURLOPT_URL, $apiUrl . "/api/Product/GetAdditionalPicturesByProduct?ProductId=" . $stock);

        self::calledApi();
        
        
        
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'GET');
        $contentResult = curl_exec($c);
        curl_close($c);
        
        $obj = json_decode($contentResult);
        $i   = 0;
        
        
        while ($i != count($obj)) {
            
            foreach ($obj[$i] as $child)
                if ($child != "") {
                    
                    if (0 === strpos($child, 'http')) {
                        
                        $image = file_get_contents("$child");
                        
                        


                    $currentIMG = $path . "$i.jpg";
                    try{
                        file_put_contents($currentIMG, $image);
                        
                        $currentIMG=substr($currentIMG,1);
                        array_push($imageList,$currentIMG);
                    }catch(\Exception $e){
                        echo $e;
                    }
                    }
                    
                    
                    
                    
                    
                    
                    /////////////////////////////////////////////////////////////////
                }
            $i++;
        }
        
        self::calledApi();
        
        return $imageList;
    }
    
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    static function get_tecnica($cod_prod)
    {
        
        $contenido ="";
        
        if(!\DBData::isProductDataSaved($cod_prod))
            \DBData::insertEmptyProductData($cod_prod);
            
            
            
        if(\DBData::isSpecificationsDataSaved($cod_prod)){
            $ch      = curl_init();
            $timeout = 5;
            
            
            
            $numero2 = $cod_prod;
            $numero1 = strtolower($cod_prod);
                try{    
                    $variable = "http://recursos.infortisa.com/" . $numero1 . "/" . $numero2 . "_FichaTec.html";
                    curl_setopt($ch, CURLOPT_URL, $variable);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);

                    $contenido = curl_exec($ch);
                }catch(Exception $e){
                    return "";
                }finally{
                    curl_close($ch);
                }
        
            
            
        
        $contenido = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/i",'<$1$2>', $contenido);
        $contenido = str_replace("<table","<table class=\" table table-bordered table-responsive table-striped\"",$contenido);
        $contenido = str_replace("width=\"65%\"","width=\"100%\"",$contenido);
        $contenido = str_replace("<tr","<tr class=\"specificationsTr\"",$contenido);


        \DBData::insertProductSpecifications($cod_prod, $contenido);
        
        
        }else{
        $contenido = \DBData::getProductSpecifications($cod_prod);
        
        
        }
        return $contenido;
        
        
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    static function get_comercial($cod_prod)
    {
        $contenido ="";
        
        
        if(!\DBData::isProductDataSaved($cod_prod))
            \DBData::insertEmptyProductData($cod_prod);
        
        if(\DBData::isDescriptionDataSaved($cod_prod)){
            
            $ch      = curl_init();
            $timeout = 5;
            
            
            
            $numero2 = $cod_prod;
            $numero1 = strtolower($cod_prod);
            
                     try{               
                        $variable = "http://recursos.infortisa.com/" . $numero1 . "/" . $numero2 . "_FichaCom.html";
                        curl_setopt($ch, CURLOPT_URL, $variable);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    
                        $contenido = curl_exec($ch);
                    }catch(Exception $e){
                        return "";
                    }finally{
                        curl_close($ch);
                    }
            
        
        
        
        
        \DBData::insertProductDescription($cod_prod, $contenido);
        }else{
       $contenido = \DBData::getProductDescription($cod_prod);

        
        }
        return $contenido;
        
        
        
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    
    ///////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////
    /*
    static function get_image($cod_prod)
    {
        $apiUrl     = "http://api.infortisa.com";
        $jsonHeader = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization-Token:EFD79BAA-1882-463D-8B44-168A117D4F32'
        );
        $c          = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($c, CURLOPT_HTTPHEADER, $jsonHeader);
        
        curl_setopt($c, CURLOPT_URL, $apiUrl . "/api/Ficha/GetPicture?code=" . $cod_prod . "&action=thumb");
        add_consulta();
        
        
        
        
        
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'GET');
        $image = curl_exec($c);
        curl_close($c);
        ob_clean();
        echo $image;
        imagedestroy($image);
        
        self::calledApi();
        
    }
    */
    //////////////////////////////////////////////////////////////////////////////////////////////
    /*
    static function get_stock($cod_prod)
    {
        $apiUrl     = "http://recursos.infortisa.com";
        $jsonHeader = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization-Token:EFD79BAA-1882-463D-8B44-168A117D4F32'
        );
        
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($c, CURLOPT_HTTPHEADER, $jsonHeader);
        
        curl_setopt($c, CURLOPT_URL, $apiUrl . "/api/Stock/GetProductStockBySku?Sku=" . $cod_prod);
        add_consulta();
        
        
        
        
        
        curl_setopt($c, CURLOPT_POSTFIELDS, null);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'GET');
        $contentResult = curl_exec($c);
        curl_close($c);
        
        $obj = json_decode($contentResult);
        
        $stock = $obj->Stock;
        
        self::calledApi();
        return $stock;
        
    }
    */
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   /*
    static function get_images($cod_prod)
    {
        $apiUrl     = "http://api.infortisa.com";
        $jsonHeader = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization-Token:EFD79BAA-1882-463D-8B44-168A117D4F32'
        );
        
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($c, CURLOPT_HTTPHEADER, $jsonHeader);
        
        curl_setopt($c, CURLOPT_URL, $apiUrl . "/api/Product/GetAdditionalPicturesByProduct?ProductId=" . $cod_prod);
        add_consulta();
        
        
        
        
        curl_setopt($c, CURLOPT_POSTFIELDS, null);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'GET');
        $contentResult = curl_exec($c);
        curl_close($c);
        
        
        $obj = json_decode($contentResult);
        
        $stock = $obj->Stock;
        self::calledApi();
        return $stock;
        
    }
    */
    static function getProductMainImage($code)
    {
        
        
        if (self::$downloadImage == 1)
            return self::get_imagenes($code);
        else
            return "http://recursos.infortisa.com/" . strtolower($code) . "/" . $code . "_normal.jpg";
        
    }
    
    static function calledApi()
    {
        
        \ApiCount::plusOneApi();
        
    }
    
    
    
    static function getIdFromSku($cod){
            
             $apiUrl     = "http://api.infortisa.com";
        $jsonHeader = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization-Token:EFD79BAA-1882-463D-8B44-168A117D4F32'
        );
        
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($c, CURLOPT_HTTPHEADER, $jsonHeader);
        
        curl_setopt($c, CURLOPT_URL, $apiUrl . "/api/Product/GetProductBySku?Sku=" . $cod);

        
        
        
        
        
        curl_setopt($c, CURLOPT_POSTFIELDS, null);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'GET');
        $contentResult = curl_exec($c);
        curl_close($c);
        
        $obj = json_decode($contentResult);
        
        $stock = $obj;
        
        self::calledApi();
        
        
        
        return $obj->Id;
    }
    
    
    
    
    
    
    
    static function updateDatabase(){
          
            $var_url = "http://api.infortisa.com/api/Tarifa/GetFile?user=EFD79BAA-1882-463D-8B44-168A117D4F32";
            $var_url = trim($var_url);
            $contenido = self::file_get_contents_utf8("$var_url");
        
        	if($contenido == ""){
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
        		echo "Se ha encontrado un problema con la base de datos de infortisa, la web no ha podido actualizarse automáticamente";
        
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
        	}else{
        		
        		
        	
        	
        
            $var_url = mb_convert_encoding($var_url, "UTF-8");
        
            file_put_contents("csv.csv", self::file_get_contents_utf8("$var_url"));
        	flush();
          $total = "";  
        
            $fh = fopen('csv.csv','r');
        	
        	while ($line = fgets($fh)) {
        
        		$line = str_replace("'", "", $line);		
          
        
        $total = $total . $line;
        
        
        					}
        					
        	flush();					
        	$acentos = array('"',',',"&#039;");
        	$substituir = array('',".","");
        	$text = str_replace($acentos, $substituir, $total);
        
           
        		$text = str_replace("'", "", $text);		
        		$text = str_replace("''", "", $text);		
        		$text = str_replace("\\'", "", $text);
        		
        		   $fp = fopen("csv_bueno.csv","wb");
        			fwrite($fp,$text);
        			fclose($fp);
        		fclose($fh);
        
        
        
        	// Get information from form & prepare it for parsing
        	$table_name = "csv";
        	$csv_data   = $text;
        	$csv_array    = explode("\n",$csv_data);
        	$column_names = explode(";",$csv_array[0]);
        
        	// Generate base query
        	$base_query = "INSERT INTO csv (";
        	$first      = true;
        	
        	$titleCounter = 0;
        
        		foreach($column_names as $column_name)	
        		{
        			if($titleCounter != count($column_names)-1  || !(preg_match('/;/', $csv_array[0]))){
        			$titleCounter++;
        				if(!$first)
        					$base_query .= ", ";	
        				$column_name = trim($column_name);
        				$base_query .= "`$column_name`"; 
        				$first = false;
        			}
        		}
        		$base_query .= ") ";
        
        	set_time_limit(500); 
        	
        	try{
                $delete = \DB::delete("delete from csv");
            }catch(\Exception $e){}
            
            
        	try{    
                $drop = \DB::statement("drop table csv");
            }catch(\Exception $e){}
            
        $create = \DB::statement("
        CREATE TABLE `csv` (
          `REFFABRICANTE` char(27) collate utf8_bin default NULL,
        
          `TITULO` char(50) collate utf8_bin default NULL,
          `CODIGOINTERNO` char(50) collate utf8_bin default NULL,
        
          `EAN/UPC` char(15) collate utf8_bin default NULL,
          `CODFAMILIA` char(50) collate utf8_bin default NULL,
          `TITULOFAMILIA` char(28) collate utf8_bin default NULL,
          `CODSUBFAMILIA` char(10) collate utf8_bin default NULL,
          `TITULOSUBFAMILIA` char(30) collate utf8_bin default NULL,
          `CODFABRICANTE` char(70) collate utf8_bin default NULL,
          `NOMFABRICANTE` char(21) collate utf8_bin default NULL,  
          
          `PRECIO` double collate utf8_bin default NULL,
          
          `STOCK` char(7) collate utf8_bin default NULL,
          `PESO` char(8) collate utf8_bin default NULL,
          `PROXIMA_LLEGADA` char(90) collate utf8_bin default NULL,
          `CICLOVIDA` char(131) collate utf8_bin default NULL,
          `PLAZOENTREGA` char(131) collate utf8_bin default NULL,  
          `CANONLPI` char(131) collate utf8_bin default NULL,  
          `PRECIOSINCANON` char(131) collate utf8_bin default NULL,  
          
          PRIMARY KEY  (`CODIGOINTERNO`)
        ) ENGINE=innoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17801 ;
        	")  or die("e".mysql_error());
        	
        	
        	$last_data_row = count($csv_array) - 1;
        	
        		$csv_array = str_replace("'", "", $csv_array);
        			for($counter = 1; $counter < $last_data_row; $counter++)
        			{
        				$value_query = "VALUES (";
        				$first = true;
        				$data_row = explode(";",$csv_array[$counter]);
        					if(empty($data_row[count($data_row)-1])) {
        						unset($data_row[count($data_row)-1]);
        					}
        				$value_counter = 0;
        				
        					foreach($data_row as $data_value)	
        					{
        						if($value_counter != count($data_row)-1 || (preg_match('/;/', $counter)) ){
        							$value_counter++;
        							
        							if(!$first)
        								$value_query .= ", ";	
        							$data_value = trim($data_value);
        							$value_query .= "'$data_value'";
        							
        							$first = false;
        						}
        					}
        				$value_query .= ")";
        
        				$query = $base_query .$value_query .";";
        				
        
        		$text = $query ;
        
        			
        
        
        		$format = \DB::statement("$text");
        
        
        			}
        	
        	flush();
        
$results = \DB::select(\DB::raw("UPDATE csv SET PRECIO = PRECIO * 1.22") );





$results = \DB::select(\DB::raw("UPDATE csv SET PRECIO = PRECIO * 1.22") );

$IdToSku = \DB::select("SELECT CODIGOINTERNO
FROM csv
WHERE CODIGOINTERNO NOT
IN (

SELECT SKU
FROM infortisa_IdSku
)");
     
     
     $countNewId = 0;
 foreach ($IdToSku as $var) {
     //print_r($var);
     
     $sku = $var->CODIGOINTERNO;
     $id = self::getIdFromSku($sku);
        
     
      $affected = \DB::insert('insert into infortisa_IdSku (ID, SKU) values (?, ?)', [$id,$sku]);
         
    $countNewId++;
     
 }
 echo $countNewId;
}
     



     }
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
         /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        static function getSpecifications()    {
            
            $contenido ="";
            
        $tok   = "EFD79BAA-1882-463D-8B44-168A117D4F32";
        $token = "Authorization-Token:$tok";
        
        $apiUrl     = "http://api.infortisa.com";
        $jsonHeader = array(
            'Accept: application/json',
            'Content-Type: application/json',
            $token
        );
                    try{   
                
                $ch      = curl_init();
                $timeout = 500000;
                
                 
                        $variable = "http://api.infortisa.com/api/ProductSpecification/Get";
                        curl_setopt($ch, CURLOPT_URL, $variable);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $jsonHeader);
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    
                        $contenido = curl_exec($ch);
                        
                        
                $fp = fopen("productSpecification.txt", "wa+");
                        fwrite($fp, $contenido);
    
                            fclose($fp);
                    }catch(\Exception $e){
                        return "";
                    }finally{
                        curl_close($ch);
                        
                    }
            
            
  // PRODUCT SPECIFICATIONS
  $someArray = json_decode(file_get_contents('productSpecification.txt'), true);
  foreach($someArray as $item) { 
        
        
        try{
     $results = \DB::select("SELECT count(*) as coun FROM `infortisa_productSpecification` 
     WHERE Id like '" . $item['Id'] . "' and
      OptionId like '" . $item['OptionId'] . "' and
      ProductId like '" . $item['ProductId'] . "'" );
     
   //  if($results[0]->coun == 0){}
     
     
        $affected = \DB::insert('insert into infortisa_productSpecification (Id, OptionId, ProductId) values (?, ?, ?)', [$item['Id'], $item['OptionId'], $item['ProductId']]);
        
        
        }catch(\Exception $e){}
   
    }
  
  
  
  
  
    }
          /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        static function getSpecificationAttribute()    {
            
            $contenido ="";
            
        $tok   = "EFD79BAA-1882-463D-8B44-168A117D4F32";
        $token = "Authorization-Token:$tok";
        
        $apiUrl     = "http://api.infortisa.com";
        $jsonHeader = array(
            'Accept: application/json',
            'Content-Type: application/json',
            $token
        );
                    try{   
                
                $ch      = curl_init();
                $timeout = 500000;
                
                 
                        $variable = "http://api.infortisa.com/api/SpecificationAttribute/Get";
                        curl_setopt($ch, CURLOPT_URL, $variable);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $jsonHeader);
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    
                        $contenido = curl_exec($ch);
                        
                $fp = fopen("specificationAtribute.txt", "wa+");
                        fwrite($fp, $contenido);
    
                            fclose($fp);
                    }catch(\Exception $e){
                        return "";
                    }finally{
                        curl_close($ch);
                        
                    }
                    
// Specification Atributes
  $someArray = json_decode(file_get_contents('specificationAtribute.txt'), true);
  foreach($someArray as $item) { 
        
     $results = \DB::select("SELECT count(*) as coun FROM `infortisa_specificationAttribute` 
     WHERE SpecificationAttributeId like '" . $item['SpecificationAttributeId'] . "' and
       SpecificationAttributeName  like '" . $item['SpecificationAttributeName'] . "' and
      DisplayOrder like '" . $item['DisplayOrder'] . "'" );
     
     if($results[0]->coun == 0)
        $affected = \DB::insert('insert into infortisa_specificationAttribute (SpecificationAttributeId, SpecificationAttributeName, DisplayOrder) values (?, ?, ?)', 
        [$item['SpecificationAttributeId'], $item['SpecificationAttributeName'], $item['DisplayOrder']]);
           
    }




            
    }
          /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        
        static function getAttributeOption()    {
            
            $contenido ="";
            
        $tok   = "EFD79BAA-1882-463D-8B44-168A117D4F32";
        $token = "Authorization-Token:$tok";
        
        $apiUrl     = "http://api.infortisa.com";
        $jsonHeader = array(
            'Accept: application/json',
            'Content-Type: application/json',
            $token
        );
                    try{   
                
                $ch      = curl_init();
                $timeout = 500000;
                
                 
                        $variable = "http://api.infortisa.com/api/SpecificationAttributeOption/Get";
                        curl_setopt($ch, CURLOPT_URL, $variable);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $jsonHeader);
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    
                        $contenido = curl_exec($ch);
                        
                $fp = fopen("specificationAttributeOption.txt", "wa+");
                        fwrite($fp, $contenido);
    
                            fclose($fp);
                    }catch(\Exception $e){
                        return "";
                    }finally{
                        curl_close($ch);
                        
                    }
                    
                    
  
// Specification Atributes Options
  $someArray = json_decode(file_get_contents('specificationAttributeOption.txt'), true);
  foreach($someArray as $item) { 
        
     $results = \DB::select("SELECT count(*) as coun FROM `infortisa_specificationAttributeOption` 
     WHERE OptionId  like '" . $item['OptionId'] . "' and
       SpecificationAttributeId  like '" . $item['SpecificationAttributeId'] . "' and
      DisplayOrder like '" . $item['DisplayOrder'] . "'" );
     
     if($results[0]->coun == 0)
        $affected = \DB::insert('insert into infortisa_specificationAttributeOption (OptionId, SpecificationAttributeId, OptionName, DisplayOrder) values (?, ?, ?, ?)', 
        [$item['OptionId'], $item['SpecificationAttributeId'], $item['OptionName'], $item['DisplayOrder']]);
           
    }


            
    }
          /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        static function getProduct()    {
            
            $contenido ="";
            
        $tok   = "EFD79BAA-1882-463D-8B44-168A117D4F32";
        $token = "Authorization-Token:$tok";
        
        $apiUrl     = "http://api.infortisa.com";
        $jsonHeader = array(
            'Accept: application/json',
            'Content-Type: application/json',
            $token
        );
                    try{   
                
                $ch      = curl_init();
                $timeout = 500000;
                
                 
                        $variable = "http://api.infortisa.com/api/Product/Get";
                        curl_setopt($ch, CURLOPT_URL, $variable);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        
                        curl_setopt($ch, CURLOPT_HTTPHEADER, $jsonHeader);
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    
                        $contenido = curl_exec($ch);
                        
                $fp = fopen("productGet.txt", "w");
                        fwrite($fp, $contenido);
    
                    }catch(\Exception $e){
                        return "";
                    }finally{
                        curl_close($ch);
                        
                            fclose($fp);
                    }
            
    }   
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
}
?>