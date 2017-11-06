<?php


namespace Providers\infortisa;
use Providers\infortisa\infortisaApi as infortisaApi;


class infortisaApi
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
        
        
        if (!file_exists("./productImages/electroaita/" . $cod_prod . ".jpg")) {
            $image = file_get_contents("http://recursos.infortisa.com/" . strtolower($cod_prod) . "/" . $cod_prod . "_normal.jpg");
            
            
            file_put_contents("./productImages/electroaita/" . $cod_prod . ".jpg", $image);
        }
        
        return \GetAsset::getProductImg($cod_prod, "infortisa");
        
    }
    
    static function get_imagenesLarge($cod_prod)
    {
        
        
              
        if (!file_exists("./productImages/electroaita/" . $cod_prod . ".jpg")) {
            $image = file_get_contents("http://recursos.infortisa.com/" . strtolower($cod_prod) . "/" . $cod_prod . "_large.jpg");
            
            
            file_put_contents("./productImages/electroaita/" . $cod_prod . "_large.jpg", $image);
        }
        
        return \GetAsset::getProductImg($cod_prod, "infortisa");
        
        
    }
    
    
    
    
    
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
    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    static function get_imagenes_alternativas($cod_prod)
    {
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
        add_consulta();
        
        
        
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'GET');
        $contentResult = curl_exec($c);
        curl_close($c);
        
        
        $obj   = json_decode($contentResult);
        $stock = $obj->ProductId;
        
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_HTTPHEADER, $jsonHeader);
        
        
        
        curl_setopt($c, CURLOPT_URL, $apiUrl . "/api/Product/GetAdditionalPicturesByProduct?ProductId=" . $stock);
        add_consulta();
        
        
        
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
                        file_put_contents("./productos/$cod_prod/images/$i.jpg", $image);
                        
                        
                        
                    }
                    
                    
                    
                    
                    
                    
                    /////////////////////////////////////////////////////////////////
                }
            $i++;
        }
        
        self::calledApi();
    }
    
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    static function get_tecnica($cod_prod)
    {
        
        $ch      = curl_init();
        $timeout = 5;
        
        
        
        $numero2 = $cod_prod;
        $numero1 = strtolower($cod_prod);
        
        $variable = "http://recursos.infortisa.com/" . $numero1 . "/" . $numero2 . "_FichaTec.html";
        curl_setopt($ch, CURLOPT_URL, $variable);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $contenido = curl_exec($ch);
        curl_close($ch);
        
        
        self::calledApi();
        return $contenido;
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    static function get_comercial($cod_prod)
    {
        
        $ch      = curl_init();
        $timeout = 5;
        
        
        
        $numero2 = $cod_prod;
        $numero1 = strtolower($cod_prod);
        
        $variable = "http://recursos.infortisa.com/" . $numero1 . "/" . $numero2 . "_FichaCom.html";
        curl_setopt($ch, CURLOPT_URL, $variable);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $contenido = curl_exec($ch);
        curl_close($ch);
        
        
        
        self::calledApi();
        return $contenido;
        
        
        
    }
    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////

    static function get_tecnica_comercial($cod_prod)
    {
        echo "
	<script>

static function muestra_oculta_comercial(id){
if (document.getElementById){ 

var el = document.getElementById(id); 
var ele = document.getElementById('desc'); 
el.style.display = 'block'; 
 
ele.style.display = 'none'; 
}
}
static function muestra_oculta_desc(id){
if (document.getElementById){ 

var el = document.getElementById(id); 
var ele = document.getElementById('comercial'); 

el.style.display = 'block'; 
ele.style.display = 'none'; 
}
}





window.onload = function(){
	
muestra_oculta('comercial');

}
</script>
<style>
#desc{
display:none;	
}
</style>
";
        
        
        $apiUrl     = "http://api.infortisa.com";
        $jsonHeader = array(
            'Accept: application/json',
            'Content-Type: application/json',
            'Authorization-Token:EFD79BAA-1882-463D-8B44-168A117D4F32'
        );
        $xmlHeader  = array(
            'Accept: application/xml',
            'Content-T
ype: application/xml',
            'Authorization-Token:EFD79BAA-1882-463D-8B44-168A117D4F32'
        );
        
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($c, CURLOPT_HTTPHEADER, $jsonHeader);
        
        curl_setopt($c, CURLOPT_URL, $apiUrl . "/api/Ficha/GetFichaComercial?code=" . $cod_prod);
        add_consulta();
        
        
        
        
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'GET');
        $contentResult = curl_exec($c);
        curl_close($c);
        
        $flag = 0;
        
        $obj = json_decode($contentResult);
        
        $stock = $obj->Message;
        
        if ($stock == "An error has occurred." or $contentResult == "Sin información") {
            
            echo "<style>
#comercial{display:none !important;}
#desc{display:block !important;}
.com{display:none !important;}
.tec{display:inline !important;margin:0px auto;width:200px;}
#boton_ficha a{width:200px;padding-left:100px;padding-right:100px;}
</style>";
        }
        if ($stock != "An error has occurred.") {
            $flag = 1;
            
            
            
            echo "<div id=\"boton_ficha\">

<a class='com' style=\"cursor: pointer;\" onclick=\"muestra_oculta_comercial('comercial')\">Ficha comercial</a>

";
            echo "

<a class='tec' style=\"cursor: pointer;\" onclick=\"muestra_oculta_desc('desc')\">Ficha t&eacute;cnica</a>



</div>";
            echo "<div id='comercial'>";
            echo $contentResult;
            echo "</div>";
        }
        $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        
        curl_setopt($c, CURLOPT_HTTPHEADER, $jsonHeader);
        
        curl_setopt($c, CURLOPT_URL, $apiUrl . "/api/Ficha/GetFichaTecnica?code=" . $cod_prod);
        add_consulta();
        
        
        
        
        
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'GET');
        $contentResult = curl_exec($c);
        curl_close($c);
        
        $obj = json_decode($contentResult);
        if ($contentResult == "" or $contentResult == "Sin información") {
            $flag = 2;
        }
        if ($flag == 0) {
            echo "<style>.tec{margin:0px auto !important; width:400px;}</style>";
            echo "<div id=\"boton_ficha\">

<a class='tec' \">Ficha t&eacute;cnica</a>
</div>
";
        }
        
        $stock = $obj->Message;
        
        if ($stock != "An error has occurred.") {
            echo "<div  itemprop='description' id='desc'>";
            
            
            $acentos    = array(
                'bgcolor="#ffffff"'
            );
            $substituir = array(
                ""
            );
            $content    = str_replace($acentos, $substituir, $contentResult);
            
            
            
            echo $content;
            
            self::calledApi();
            
            echo "</div>";
        }
        
        
        
        if ($flag == 2) {
            echo "
<style>
.tec{
display:none;
}
.com{width:400px;display: block !important;margin:0 auto !important;}
</style>";
        }
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    ///////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////
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
    //////////////////////////////////////////////////////////////////////////////////////////////
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
    ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
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