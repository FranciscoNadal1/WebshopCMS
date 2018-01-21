<?php


namespace Providers\infortisa;
use Providers\infortisa\infortisaApi as infortisaApi;
use Providers\ProvidersApi\ProvidersApiInterface as ProvidersApiInterface;


class infortisaApi implements ProvidersApiInterface
{
    
    static $downloadImage = 0;
    
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
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>