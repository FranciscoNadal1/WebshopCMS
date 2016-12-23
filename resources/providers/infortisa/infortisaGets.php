<?php

namespace Providers\infortisa;
use Providers\infortisa\infortisaGets as infortisaGets;

class infortisaGets{
    
    private static $apiUrl = "http://api.infortisa.com";    
    private static $jsonHeader = array('Accept: application/json', 'Content-Type: application/json',    'Authorization-Token: EFD79BAA-1882-463D-8B44-168A117D4F32');
    
    
    
    
    
    public static function getFullProduct($sku){
      //  echo infortisaGets::getSomething("/api/Product/GetProductBySku?Sku=", $sku);   
        
     //   echo "---------------------------------";
        $json = infortisaGets::getSomething("/api/Product/GetProductBySku?Sku=", $sku);
        $obj = json_decode($json);
        
        print $obj->{'FullDescription'}; // 12345
    }
    
    public static function getStock($sku){
        echo infortisaGets::getSomething("/api/Stock/GetProductStockBySku?Sku=", $sku);   
    }
    
    
    public static function getSomething($whatAmI, $sku){
     
      
    return  '{"Id":22707,"Name":"AMD FX-8350 4 Ghz 16MEG (8L2 + 8L3) Socket AM3+","Published":true,"FullDescription":"<div>\r\n\tDesbloqueado para su placer de overclocking, y sigue siendo el &uacute;nico 8-core procesador de escritorio.</div>\r\n<div>\r\n\tUn rendimiento multitarea n&uacute;cleo puro con una nueva arquitectura.</div><br /><br /><table class=\"tabla_caracteristicas\" width=\"100%\">\r\n\t<tbody>\r\n\t\t<tr>\r\n\t\t\t<td valign=\"top\" width=\"35%\">\r\n\t\t\t\t<b><small><font face=\"Tahoma,Arial, Helvetica, sans-serif\" style=\"font-size: 11px\">Marca</font></small></b></td>\r\n\t\t\t<td valign=\"top\">\r\n\t\t\t\t<font face=\"Tahoma,Arial, Helvetica, sans-serif\" style=\"font-size: 11px\">AMD</font></td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td valign=\"top\" width=\"35%\">\r\n\t\t\t\t<b><small><font face=\"Tahoma,Arial, Helvetica, sans-serif\" style=\"font-size: 11px\">Modelo</font></small></b></td>\r\n\t\t\t<td valign=\"top\">\r\n\t\t\t\t<font face=\"Tahoma,Arial, Helvetica, sans-serif\" style=\"font-size: 11px\">FX-8350 Black Edition (FD8350FRHKBOX)</font></td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td valign=\"top\" width=\"35%\">\r\n\t\t\t\t<b><small><font face=\"Tahoma,Arial, Helvetica, sans-serif\" style=\"font-size: 11px\">Encapsulado</font></small></b></td>\r\n\t\t\t<td valign=\"top\">\r\n\t\t\t\t<font face=\"Tahoma,Arial, Helvetica, sans-serif\" style=\"font-size: 11px\">Socket AM3+</font></td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td valign=\"top\" width=\"35%\">\r\n\t\t\t\t<b><small><font face=\"Tahoma,Arial, Helvetica, sans-serif\" style=\"font-size: 11px\">Frecuencia</font></small></b></td>\r\n\t\t\t<td valign=\"top\">\r\n\t\t\t\t<font face=\"Tahoma,Arial, Helvetica, sans-serif\" style=\"font-size: 11px\">4 GHz</font></td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td valign=\"top\" width=\"35%\">\r\n\t\t\t\t<b><small><font face=\"Tahoma,Arial, Helvetica, sans-serif\" style=\"font-size: 11px\">Cach&eacute; interna</font></small></b></td>\r\n\t\t\t<td valign=\"top\">\r\n\t\t\t\t<font face=\"Tahoma,Arial, Helvetica, sans-serif\" style=\"font-size: 11px\">8.0 MB </font></td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td valign=\"top\" width=\"35%\">\r\n\t\t\t\t<b><small><font face=\"Tahoma,Arial, Helvetica, sans-serif\" style=\"font-size: 11px\">Otras caracter&iacute;sticas</font></small></b></td>\r\n\t\t\t<td valign=\"top\">\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<font face=\"Tahoma,Arial, Helvetica, sans-serif\" style=\"font-size: 11px\">- Normativa CE, RoHS <br />\r\n\t\t\t\t\t- Procesador de 8 n&uacute;cleos.<br />\r\n\t\t\t\t\t- Consumo: 125W. </font></div>\r\n\t\t\t\t<div>\r\n\t\t\t\t\t<font face=\"Tahoma,Arial, Helvetica, sans-serif\" style=\"font-size: 11px\">- Tecnolog&iacute;a Vision de AMD.<br />\r\n\t\t\t\t\t- Soporta AMD Virtualization Tecnology.</font></div>\r\n\t\t\t</td>\r\n\t\t</tr>\r\n\t\t<tr>\r\n\t\t\t<td valign=\"top\">\r\n\t\t\t\t<b><small><font face=\"Tahoma,Arial, Helvetica, sans-serif\" style=\"font-size: 11px\">Fecha Revisi&oacute;n</font></small></b></td>\r\n\t\t\t<td valign=\"top\">\r\n\t\t\t\t<font face=\"Tahoma,Arial, Helvetica, sans-serif\" style=\"font-size: 11px\">13-11-2012 FE4</font></td>\r\n\t\t</tr>\r\n\t</tbody>\r\n</table>","ShortDescription":"Desbloqueado para su placer de overclocking, y sigue siendo el &uacute;nico 8-core procesador de escritorio.\r\n\r\n\tUn rendimiento multitarea...","Price":135.5900,"SKU":"IMIMAB0005","PartNumber":"FD8350FRHKBOX","EANUpc":"730143302517","CreatedOnUtc":"2012-11-02T15:25:50.787","UpdatedOnUtc":"2016-09-20T14:00:04.07","Stock":0.0,"StockPalma":2.0,"Weight":0.4400,"WeightMeasurement":"Kilograms","Length":0.0700,"Width":0.1200,"Height":0.1300,"VolumeMeasurement":"Meters","CategoryId":565,"CategoryName":"Micros AMD AM3+","ManufacturerId":24,"ManufacturerName":"AMD","LifeCycleCode":"P","LifeCycle":"","PictureUrl":"http://recursos.infortisa.com/imimab0005/IMIMAB0005_large.jpg","AdditionalProductPictures":[{"PictureUrl":"http://recursos.infortisa.com/imimab0005/IMIMAB0005_ImgAdi1.jpg","PictureMessage":"","ProductId":22707,"ProductPictureId":-1,"UpdatedOn":"2014-06-01T00:00:00"}],"LastPictureUpdate":"2014-06-01T00:00:00","LastMainPictureUpdate":"2015-03-27T10:39:17.073","AdditionalPictureCount":1}'
      ;

      
/*      
       $c = curl_init();
        curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($c, CURLOPT_HTTPHEADER, infortisaGets::$jsonHeader);
        curl_setopt($c, CURLOPT_URL, infortisaGets::$apiUrl . $whatAmI .$sku);
        curl_setopt($c, CURLOPT_POSTFIELDS, null);
        curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'GET');
        $contentResult = curl_exec($c);
        curl_close($c);
      
     return $contentResult;
  */   
     
     
    }
    
}


?>