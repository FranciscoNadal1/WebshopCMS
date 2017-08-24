<?php


include('no_config.php');
$seleccion = mysql_select_db($bd, $conexion) or die("No se pudo seleccionar la bd $conexion");
$seleccion;
    	flush();

$var_url = "http://api.infortisa.com/api/Tarifa/GetFile?user=EFD79BAA-1882-463D-8B44-168A117D4F32";
$var_url = trim($var_url);

	set_time_limit(500); 

	echo "
	<style>
	
	body{background-image: url('../images_texturas/amarillo.jpg') !important;}
	
	#wrapper{width:740px;margin:0 auto;border-bottom:1px solid #000;border-right:1px solid #000;border-left:1px solid #000;padding:20px;
	    background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%);
	}
	#cabecera{border:1px solid #000;
		width:740px;margin:0 auto;height:20px;text-align:center;color:white;font-size:15px;padding-left:20px;padding-right:20px;padding-top:5px;padding-bottom:5px;border-radius:16px 16px 0px 0px;
	    background: linear-gradient(to bottom, rgba(30,87,153,1) 0%,rgba(41,137,216,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%) !important;
	}
	#wrapper textarea{margin:0 auto;width:720px;height:300px;}
	#wrapper form, #wrapper a{text-align:center}
	
	</style>
	<div id='total'>
	<div id='cabecera'>Actualizador</div>
	<div id='wrapper'>
	";

$contenido = file_get_contents("$var_url");
	//echo $contenido;
	if($contenido == ""){
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		echo "Se ha encontrado un problema con la base de datos de infortisa, la web no ha podido actualizarse automáticamente";
	




		echo "<br><br>Actualización manual:<br>";
		include('csv.php');


































////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	}else{
		
		
		//echo "El contenido ha sido :$contenido:";
	
	



    file_put_contents("csv.csv", file_get_contents("$var_url"));
	flush();
  $total = "";  

    $fh = fopen('csv.csv','r');
	while ($line = fgets($fh)) {

  
   //echo($line);
   
   

$total = $total . $line;




					}
					
	flush();					
	$acentos = array('"',',',"'");
	$substituir = array('',".","");
	$text = str_replace($acentos, $substituir, $total);

   
   $fp = fopen("csv_bueno.csv","wb");
	fwrite($fp,$text);
	fclose($fp);
fclose($fh);



//echo $text;




	// Get information from form & prepare it for parsing
	$table_name = "csv";
	$csv_data   = $text;
	$csv_array    = explode("\n",$csv_data);
	$column_names = explode(";",$csv_array[0]);

	// Generate base query
	$base_query = "INSERT INTO csv (";
	$first      = true;
	foreach($column_names as $column_name)	
	{
		if(!$first)
			$base_query .= ", ";	
		$column_name = trim($column_name);
		$base_query .= "`$column_name`";
		$first = false;
	}
	$base_query .= ") " or die("a1".mysql_error());;

	// Loop through all csv data rows and generate separate
	// INSERT queries based on base_query + the row information
	set_time_limit(500); 
mysql_query("delete from `csv`;") or die("a2".mysql_error());
mysql_query("drop table `csv`;") or die("a3".mysql_error());
mysql_query("
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
  PRIMARY KEY  (`CODIGOINTERNO`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17801 ;
	")  or die("e".mysql_error());
	
	
	$last_data_row = count($csv_array) - 1;
	for($counter = 1; $counter < $last_data_row; $counter++)
	{
		$value_query = "VALUES (";
		$first = true;
		$data_row = explode(";",$csv_array[$counter]);
		$value_counter = 0;
		foreach($data_row as $data_value)	
		{
			if(!$first)
				$value_query .= ", ";	
			$data_value = trim($data_value);
			$value_query .= "'$data_value'";
			$first = false;
		}
		$value_query .= ")";

		// Combine generated queries to generate final query
		$query = $base_query .$value_query .";";
		//antiguo <style>form {display:none;}</style>
		$acentos = array('�', '�','�','�','�','�');
		$substituir = array('a','e','i','o','u','n');		
//		$substituir = array('&aacute;','&eacute;','&iacute;','&oacute;','&uacute','&ntilde;);

$text = $query ;

	//$text = str_replace($acentos, $substituir, $query);
	

mysql_query("$text") or die("asdf".mysql_error());
//////////////////////////////////////////////////


/////////////////////////////////////////////////////
//echo "$text";

	}
	
	flush();
echo "---------------------------------------------------------------------------------------------------------------------------------------------------------------------";
echo "<br>Borrados<br>";
echo "---------------------------------------------------------------------------------------------------------------------------------------------------------------------";
echo "<br>";

mysql_query('delete from csv where titulofamilia = "Accesorios Telefon�a"');echo " Accesorios telefonia ";
echo mysql_affected_rows();echo "<br>";
//mysql_query('delete from csv where titulofamilia = "Alarmas"');


mysql_query('delete from csv where titulofamilia = "Peque�o electrodomestico"');echo " Pequeno electrodomestico ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Proteccion perimetral"');echo " Proteccion perimetral ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Robots"');echo " Robots ";
echo mysql_affected_rows();echo "<br>";
/*
mysql_query('delete from csv where titulofamilia = "Telefon�a y fax"');echo " Telefonia y fax ";
echo mysql_affected_rows();echo "<br>";*/
mysql_query('delete from csv where titulofamilia = "Accesorios Rob�tica"');echo " Accesorios Rob�tica ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Accesorios Consumibles"');echo " Accesorios Consumibles ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Cables y Accesorios"');echo " Cables y Accesorios ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Extensi�n Garant�a Port�til"');echo " Extensi�n Garant�a Port�til ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Accesorios SAI"');echo " Accesorios SAI ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Accesorios Videovigilancia"');echo " Accesorios Videovigilancia ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Accesorios Proyectores"');echo " Accesorios Proyectores ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Accesorios Gaming"');echo " Accesorios Gaming ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Accesorios Impresora/Escaner"');echo " Accesorios Impresora/Escaner ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Accesorios Imagen y Sonido"');echo " Accesorios Imagen y Sonido ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Accesorios Redes"');echo " Accesorios Redes ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Extension Garant�a PC"');echo " Extension Garant�a PC ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Cables y Accesorios PC"');echo " Cables y Accesorios PC ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Visores para TPV"');echo " Visores para TPV ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Bobinas"');echo " Bobinas ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Cintas"');echo " cintas ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Cartuchos tinta reciclado"');echo " Cartuchos tinta reciclado ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Papel"');echo " papel ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Tambor/Fotoconductor"');echo " Tambor/Fotoconductor ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Toner compatible"');echo " Toner compatible ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Toner reciclado"');echo " Toner reciclado ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Complementos Deportivos"');echo " Complementos Deportivos ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Iluminaci�n"');echo " Iluminaci�n ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Peque�o electrodom�stico"');echo " Peque�o electrodom�stico ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "V�deo externo"');echo " V�deo externo ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Unidad central"');echo " Unidad central ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Videovigilancia"');echo " Videovigilancia ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Videojuegos"');echo " Videojuegos ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Libros"');echo " Libros ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Pizarras Interactivas"');echo " Pizarras Interactivas ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Radio"');echo " Radio ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Sintonizadores"');echo " Sintonizadores ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Powerline"');echo " Powerline ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "GPS"');echo " GPS ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Proteccion perimetral"');echo " Proteccion perimetral ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Modems 3G y anal�gicos"');echo " Modems 3G y anal�gicos ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Switches armario"');echo " Switches armario ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Semiensamblados"');echo " Semiensamblados ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Servidores Rack"');echo " Servidores Rack ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Robots"');echo " Robots ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Licencias"');echo " Licencias ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Antivirus empresa"');echo " Antivirus empresa ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulofamilia = "Piezas Port�tiles" and titulosubfamilia = "Pantallas"');echo " Pantallas ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "AMD socket FM2"');echo " AMD socket FM2 ";
echo mysql_affected_rows();echo "<br>";
mysql_query('delete from csv where titulosubfamilia = "Intel Socket 1151"');echo " Intel Socket 1151 ";
echo mysql_affected_rows();echo "<br>";
echo "---------------------------------------------------------------------------------------------------------------------------------------------------------------------";
echo "<br>Modificados<br>";
echo "---------------------------------------------------------------------------------------------------------------------------------------------------------------------";
echo "<br>";




	mysql_query('UPDATE csv SET PRECIO=PRECIO*1.22');
	
	
	
mysql_query('UPDATE csv SET PRECIO=(PRECIO + 8) where titulosubfamilia="Cajas Externas Multimedia"');
 

echo "Cajas Externas Multimedia"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO + 8) where titulosubfamilia="Cajas Externas/Extraibles HD"');
echo "Cajas Externas/Extraibles HD"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+12) where titulosubfamilia="Bolsas Transporte"');
echo "Bolsas Transporte"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+12) where titulosubfamilia="Cargador para Port�til"');
echo "Cargador para Port�til"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+12) where titulosubfamilia="Refrigeraci�n para Port�til"');
echo "Refrigeraci�n para Port�til"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+8)  where titulosubfamilia="Accesorios Tablet e iPad"');
echo "Accesorios Tablet e iPad"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+8)  where titulosubfamilia="Dispositivos USB"');
echo "Dispositivos USB"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+5)  where titulosubfamilia="Limpieza Ordenador"');
echo "Limpieza Ordenador"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+25) where titulosubfamilia="Caj�n portamonedas"');
echo "Caj�n portamonedas"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+8)  where titulosubfamilia="Panel Lector Tarjetas"');
echo "Panel Lector Tarjetas"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+6)  where titulosubfamilia="Blu-ray"');
echo "Blu-ray"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+6)  where titulosubfamilia="CD-R/RW"');
echo "CD-R/RW"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+6)  where titulosubfamilia="DVD R/RW"');
echo "DVD R/RW"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+6)  where titulosubfamilia="Cartuchos tinta original"');
echo "Cartuchos tinta original"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+15)  where titulosubfamilia="Toner original"');
echo "Toner original"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+25) where titulosubfamilia="Discos duros externos"');
echo "Discos duros externos"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+6)  where titulosubfamilia="L�piz USB"');
echo "L�piz USB"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+30) where titulosubfamilia="Multifunci�n inyecci�n sin fax"');
echo "Multifunci�n inyecci�n sin fax"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+30) where titulosubfamilia="Multifunci�n inyecci�n con fax"');
echo "Multifunci�n inyecci�n con fax"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";



mysql_query('UPDATE csv SET PRECIO=(PRECIO+30) where titulosubfamilia="Multifunci�n l�ser sin fax"');
echo "Multifunci�n l�ser sin fax"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+30) where titulosubfamilia="Multifunci�n l�ser con fax"');
echo "Multifunci�n l�ser con fax"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+25) where titulosubfamilia="Sobremesa"');
echo "Sobremesa"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Lectores billetes"');
echo "Lectores billetes"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+25) where titulosubfamilia="Lectores c�digo barras"');
echo "Lectores c�digo barras"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";


mysql_query('UPDATE csv SET PRECIO=(PRECIO+25) where titulosubfamilia="Impresoras inyecci�n"');
echo "Impresoras inyecci�n"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+50) where titulosubfamilia="Impresoras laser Color"');
echo "Impresoras laser Color"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+40) where titulosubfamilia="Impresoras l�ser monocromo"');
echo "Impresoras l�ser monocromo"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+40) where titulosubfamilia="Impresoras matriciales"');
echo "Impresoras matriciales"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+35) where titulosubfamilia="Impresoras t�rmicas"');
echo "Impresoras t�rmicas"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";




mysql_query('UPDATE csv SET PRECIO=(PRECIO+8)  where titulosubfamilia="Lector tarjetas chip"');
echo "Lector tarjetas chip"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+8)  where titulosubfamilia="Lector tarjetas flash"');
echo "Lector tarjetas flash"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+8)  where titulosubfamilia="Lector tarjetas magn�ticas"');
echo "Lector tarjetas magn�ticas"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+40) where titulosubfamilia="TFT/T�ctil hasta 15"');
echo "TFT/T�ctil hasta 15"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+40) where titulosubfamilia="TFT/T�ctil desde 17"');
echo "TFT/T�ctil desde 17"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+30) where titulosubfamilia="Monitor LED"');
echo "Monitor LED"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+50) where titulosubfamilia="Monitor TV"');
echo "Monitor TV"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Regrabadoras DVD externas"');
echo "Regrabadoras DVD externas"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+30) where titulosubfamilia="SAI off line"');
echo "SAI off line"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+90) where titulosubfamilia="SAI on line"');
echo "SAI on line"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Teclado m�s rat�n"');
echo "Teclado m�s rat�n"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+6)  where titulosubfamilia="Ratones con cable"');
echo "Ratones con cable"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+6)  where titulosubfamilia="Ratones inal�mbricos"');
echo "Ratones inal�mbricos"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+12)  where titulosubfamilia="Teclados PS/2"');
echo "Teclados PS/2"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+12)  where titulosubfamilia="Teclados USB"');
echo "Teclados USB"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+8)  where titulosubfamilia="C�maras web"');
echo "C�maras web"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Discos magn�ticos"');
echo "Discos magn�ticos"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+25) where titulosubfamilia="Discos s�lidos"');
echo "Discos s�lidos"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+30) where titulosubfamilia="Minitorre y Microtorre"');
echo "Minitorre y Microtorre"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+30) where titulosubfamilia="Semitorre y Miditorre"');
echo "Semitorre y Miditorre"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+15) where titulosubfamilia="Fuentes hasta 300W"');
echo "Fuentes hasta 300W"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+15) where titulosubfamilia="Fuentes 300..400W"');
echo "Fuentes 300..400W"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+15) where titulosubfamilia="Fuentes 400..600W"');
echo "Fuentes 400..600W"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Fuentes desde 600W"');
echo "Fuentes desde 600W"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+15) where titulosubfamilia="Memorias DDR2"');
echo "Memorias DDR2"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+15) where titulosubfamilia="Memorias DDR3"');
echo "Memorias DDR3"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+15) where titulosubfamilia="Memorias DDR"');
echo "Memorias DDR"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Micros AMD AM3+"');
echo "Micros AMD AM3+"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Micros AMD FM2"');
echo "Micros AMD FM2"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Micros Intel Socket 1150"');
echo "Micros Intel Socket 1150"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Micros Intel Socket 2011"');
echo "Micros Intel Socket 2011"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Micros Intel Socket 1155"');
echo "Micros Intel Socket 1155"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Micros Intel Socket 1356"');
echo "Micros Intel Socket 1356"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+6)  where titulosubfamilia="Refrigeraci�n"');
echo "Refrigeraci�n"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+12) where titulosubfamilia="Lectores DVD"');
echo "Lectores DVD"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+12) where titulosubfamilia="Regrabadoras DVD"');
echo "Regrabadoras DVD"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="AMD socket FM2+"');
echo "AMD socket FM2+"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="AMD socket AM3"');
echo "AMD socket AM3"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="AMD socket AM3+"');
echo "AMD socket AM3+"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="CPU integrada"');
echo "CPU integrada"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="AMD socket FM2"');
echo "AMD socket FM2"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Intel socket 1150"');
echo "Intel socket 1150"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Intel socket 2011"');
echo "Intel socket 2011"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Intel socket 478"');
echo "Intel socket 478"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Intel socket 1155"');
echo "Intel socket 1155"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Intel socket 775"');
echo "Intel socket 775"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+15) where titulosubfamilia="Tarjetas Controladoras"');
echo "Tarjetas Controladoras"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";


mysql_query('UPDATE csv SET PRECIO=(PRECIO+8) where titulosubfamilia="Micr�fonos"');
echo "Micr�fonos"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+30) where titulosubfamilia="C�maras reflex"');
echo "C�maras reflex"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";


mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="PCI Express DDR3"');
echo "PCI Express DDR3"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+25) where titulosubfamilia="PCI Express DDR5"');
echo "PCI Express DDR5"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";





mysql_query('UPDATE csv SET PRECIO=(PRECIO+65) where titulosubfamilia="Notebooks"');
echo "Notebooks"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+15) where titulosubfamilia="AGP"');
echo "AGP"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";





mysql_query('UPDATE csv SET PRECIO=(PRECIO+15) where titulosubfamilia="Consolas Sobremesa"');
echo "Consolas Sobremesa"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";


mysql_query('UPDATE csv SET PRECIO=(PRECIO+15)  where titulosubfamilia="Altavoces 2.0"');
echo "Altavoces 2.0"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Altavoces 2.1"');
echo "Altavoces 2.1"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+8)  where titulosubfamilia="Auricular con micr�fono"');
echo "Auricular con micr�fono"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+15)  where titulosubfamilia="Altavoces Dock y port�til"');
echo "Altavoces Dock y port�til"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+12)  where titulosubfamilia="Auriculares sin micr�fono"');
echo "Auriculares sin micr�fono"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+16) where titulosubfamilia="C�maras compactas"');
echo "C�maras compactas"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+28) where titulosubfamilia="Pantallas"');
echo "Pantallas"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+45) where titulosubfamilia="Proyectores"');
echo "Proyectores"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Libros electr�nicos"');
echo "Libros electr�nicos"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+6)  where titulosubfamilia="MP3. MP4 y MP5"');
echo "MP3. MP4 y MP5"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";


/*mysql_query('UPDATE csv SET PRECIO=(PRECIO+6)  where titulosubfamilia="MP3, MP4 y MP5"');
echo "MP3, MP4 y MP5"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";*/



mysql_query('UPDATE csv SET PRECIO=(PRECIO+16) where titulosubfamilia="Reproductor port�til"');
echo "Reproductor port�til"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+16) where titulosubfamilia="Reproductor sobremesa"');
echo "Reproductor sobremesa"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+6)  where titulosubfamilia="Compact Flash"');
echo "Compact Flash"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+6)  where titulosubfamilia="Secure Digital"');
echo "Secure Digital"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+6)  where titulosubfamilia="Memory Stick"');
echo "Memory Stick"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+65) where titulosubfamilia="Led"');
echo "Led"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+16) where titulosubfamilia="C�maras de v�deo"');
echo "C�maras de v�deo"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";



mysql_query('UPDATE csv SET PRECIO=(PRECIO+12) where titulosubfamilia="Red cableada"');
echo "Red cableada"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+12) where titulosubfamilia="Red inal�mbrica"');
echo "Red inal�mbrica"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+16) where titulosubfamilia="Powerline"');
echo "Powerline"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO*1.36) where titulosubfamilia="Almacenamiento Sobremesa"');
echo "Almacenamiento Sobremesa"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";


mysql_query('UPDATE csv SET PRECIO=(PRECIO+16) where titulosubfamilia="Routers redes con cable"');
echo "Routers cable"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
/////////////////////////
mysql_query('UPDATE csv SET PRECIO=(PRECIO+65) where titulosubfamilia="PC de sobremesa"');
echo "PC de sobremesa"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+95) where titulosubfamilia="Servidores Torre"');
echo "Servidores Torre"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+65) where titulosubfamilia="Todo en uno"');
echo "Todo en uno"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+25) where titulosubfamilia="Tablet "');
echo "Tablet"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Tel�fonos Fijos"');
echo "Tel�fonos fijos"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="M�viles"');
echo "M�viles"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Inal�mbricos DECT"');
echo "Inal�mbricos DECT"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+40) where titulosubfamilia="Faxes"');
echo "Faxes"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+12) where titulosubfamilia="Routers ADSL"');
echo "Routers ADSL"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+8) where titulosubfamilia="Routers inal�mbricos"');
echo "Routers inal�mbricos"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+8) where titulosubfamilia="Switches sobremesa"');
echo "Switches sobremesa"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+12) where titulosubfamilia="Puntos de acceso"');
echo "Puntos de acceso"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+12) where titulosubfamilia="Impresi�n redes cableadas"');
echo "Impresi�n redes cableadas"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+50) where titulosubfamilia="Software Gesti�n"');
echo "Software Gesti�n"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+25) where titulosubfamilia="Software Ofim�tica"');
echo "Software Ofim�tica"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+25) where titulosubfamilia="Sistemas de 32 bits"');
echo "Sistemas de 32 bits"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+25) where titulosubfamilia="Sistemas de 64 bits"');
echo "Sistemas de 64 bits"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=(PRECIO+18) where titulosubfamilia="Antivirus hogar"');
echo "Antivirus hogar"; echo "-";if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";


/*
mysql_query('UPDATE csv SET PRECIO=PRECIO+2 where titulosubfamilia="Cajas Externas Multimedia"'); echo "Cajas Externas Multimedia: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2 where titulosubfamilia="Cajas Externas/Extraibles HD"');echo "Cajas Externas/Extraibles HD: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Bolsas Transporte"');echo "Bolsas Transporte: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Cargador para Port�til"');echo "Cargador para Port�til: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Refrigeraci�n para Port�til"');echo "Refrigeraci�n para Port�til: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3  where titulosubfamilia="Accesorios Tablet e iPad"');echo "Accesorios Tablet e iPad: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3  where titulosubfamilia="Dispositivos USB"');echo "Dispositivos USB: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=PRECIO+3  where titulosubfamilia="Limpieza Ordenador"');echo "Limpieza Ordenador: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Caj�n portamonedas"');echo "Caj�n portamonedas: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3  where titulosubfamilia="Panel Lector Tarjetas"');echo "Panel Lector Tarjetas: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2  where titulosubfamilia="Blu-ray"');echo "Blu-ray: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2  where titulosubfamilia="CD-R/RW"');echo "CD-R/RW: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2  where titulosubfamilia="DVD R/RW"');echo "CD-R/RW: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2  where titulosubfamilia="Cartuchos tinta original"');echo "Cartuchos tinta original: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+4  where titulosubfamilia="Toner original"');echo "Toner original: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Discos duros externos"');echo "Discos duros externos: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+1.5  where titulosubfamilia="L�piz USB"');echo "L�piz USB: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Multifunci�n inyecci�n sin fax"');echo "Multifunci�n inyecci�n sin fax: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Multifunci�n inyecci�n con fax"');echo "Multifunci�n inyecci�n con fax: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Multifunci�n l�ser sin fax"');echo "Multifunci�n l�ser sin fax: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Multifunci�n l�ser con fax"');echo "Multifunci�n l�ser con fax: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Impresoras inyecci�n"');echo "Impresoras inyecci�n: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";


mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Impresoras laser Color"');echo "Impresoras laser Color: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Impresoras l�ser monocromo"');echo "Impresoras l�ser monocromo: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Impresoras matriciales"');echo "Impresoras matriciales: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Impresoras t�rmicas"');echo "Impresoras t�rmicas: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Lectores billetes"');echo "Lectores billetes: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Sobremesa"');echo "Sobremesa: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Lectores c�digo barras"');echo "Lectores c�digo barras: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=PRECIO+2  where titulosubfamilia="Lector tarjetas chip"');echo "Lector tarjetas chip: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2  where titulosubfamilia="Lector tarjetas flash"');echo "Lector tarjetas flash: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2  where titulosubfamilia="Lector tarjetas magn�ticas"');echo "Lector tarjetas magn�ticas: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="TFT/T�ctil hasta 15"');echo "TFT/T�ctil hasta 15: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="TFT/T�ctil desde 17"');echo "TFT/T�ctil desde 17: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Monitor LED"');echo "Monitor LED: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Monitor TV"');echo "Monitor TV: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Regrabadoras DVD externas"');echo "Regrabadoras DVD externas: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="SAI off line"');echo "SAI off line: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="SAI on line"');echo "SAI on line: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Teclado m�s rat�n"');echo "Teclado m�s rat�n: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2  where titulosubfamilia="Ratones con cable"');echo "Ratones con cable: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2  where titulosubfamilia="Ratones inal�mbricos"');echo "Ratones inal�mbricos: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2  where titulosubfamilia="Teclados PS/2"');echo "Teclados PS/2: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2  where titulosubfamilia="Teclados USB"');echo "Teclados USB: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2  where titulosubfamilia="C�maras web"');echo "C�maras web: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Discos magn�ticos"');echo "Discos magn�ticos: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Discos s�lidos"');echo "Discos s�lidos: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+6 where titulosubfamilia="Minitorre y Microtorre"');echo "Minitorre y Microtorre: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+6 where titulosubfamilia="Semitorre y Miditorre"');echo "Semitorre y Miditorre: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Fuentes hasta 300W"');echo "Fuentes hasta 300W: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";



mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Fuentes 300..400W"');echo "Fuentes 300..400W: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Fuentes 400..600W"');echo "Fuentes 400..600W: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Fuentes desde 600W"');echo "Fuentes desde 600W: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Memorias DDR2"');echo "Memorias DDR2: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Memorias DDR3"');echo "Memorias DDR3: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Memorias DDR"');echo "Memorias DDR: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Micros AMD AM3+"');echo "Micros AMD AM3: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Micros AMD FM2"');echo "Micros AMD FM2: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Micros Intel Socket 1150"');echo "Micros Intel Socket 1150: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Micros Intel Socket 2011"');echo "Micros Intel Socket 2011: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Micros Intel Socket 1155"');echo "Micros Intel Socket 1155: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Micros Intel Socket 1356"');echo "Micros Intel Socket 1356: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2  where titulosubfamilia="Refrigeraci�n"');echo "Refrigeraci�n: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Lectores DVD"');echo "Lectores DVD: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Regrabadoras DVD"');echo "Regrabadoras DVD: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="AMD socket FM2+"');echo "AMD socket FM2: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="AMD socket AM3"');echo "AMD socket AM3: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";


mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="AMD socket AM3+"');echo "AMD socket AM3: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="CPU integrada"');echo "CPU integrada: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="AMD socket FM2"');echo "AMD socket FM2: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Intel socket 1150"');echo "Intel socket 1150: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Intel socket 2011"');echo "Intel socket 2011: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Intel socket 478"');echo "Intel socket 478: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Intel socket 1155"');echo "Intel socket 1155: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Intel socket 775"');echo "Intel socket 775: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2 where titulosubfamilia="Tarjetas Controladoras"');echo "Tarjetas Controladoras: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";


mysql_query('UPDATE csv SET PRECIO=PRECIO+2 where titulosubfamilia="Micr�fonos"');echo "Micr�fonos: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="C�maras reflex"');echo "C�maras reflex: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";


mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="PCI Express DDR3"');echo "PCI Express DDR3: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="PCI Express DDR5"');echo "PCI Express DDR5: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";






mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Port�tiles"');echo "Port�tiles: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Consolas Sobremesa"');echo "Consolas Sobremesa: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2  where titulosubfamilia="Altavoces 2.0"');echo "Altavoces 2.0: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Altavoces 2.1"');echo "Altavoces 2.1: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2  where titulosubfamilia="Auricular con micr�fono"');echo "Auricular con micr�fono: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2 where titulosubfamilia="Altavoces Dock y port�til"');echo "Altavoces Dock y port�til: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+2  where titulosubfamilia="Auriculares sin micr�fono"');echo "Auriculares sin micr�fono: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="C�maras compactas"');echo "C�maras compactas: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Pantallas"');echo "Pantallas: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Proyectores"');echo "Proyectores: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Libros electr�nicos"');echo "Libros electr�nicos: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3  where titulosubfamilia="MP3, MP4 y MP5"');echo "MP3, MP4 y MP5: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3  where titulosubfamilia="MP3. MP4 y MP5"');echo "MP3. MP4 y MP5: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";


mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Reproductor port�til"');echo "Reproductor port�til: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Reproductor sobremesa"');echo "Reproductor sobremesa: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+1.5  where titulosubfamilia="Compact Flash"');echo "Compact Flash: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+1.5  where titulosubfamilia="Secure Digital"');echo "Secure Digital: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+1.5  where titulosubfamilia="Memory Stick"');echo "Memory Stick: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+9 where titulosubfamilia="Led"');echo "Led: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="C�maras de v�deo"');echo "C�maras de v�deo: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Red cableada"');echo "Red cableada: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Red inal�mbrica"');echo "Red inal�mbrica: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Powerline"');echo "Powerline: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Almacenamiento Sobremesa"');echo "Almacenamiento Sobremesa: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Routers redes con cable"');echo "Routers redes con cable: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Routers ADSL"');echo "Routers ADSL: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";


mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Routers inal�mbricos"');echo "Routers inal�mbricos: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Impresi�n redes cableadas"');echo "Impresi�n redes cableadas: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Puntos de acceso"');echo "Puntos de acceso: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+5 where titulosubfamilia="Switches sobremesa"');echo "Switches sobremesa: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Faxes"');echo "Faxes: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Tel�fonos Fijos"');echo "Tel�fonos fijos: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Inal�mbricos DECT"');echo "Inal�mbricos DECT: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="M�viles"');echo "M�viles: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Destructoras papel"');echo "Destructoras papel: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="PC de sobremesa"');echo "PC de sobremesa: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Todo en uno"');echo "Todo en uno: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";


mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Netbooks"');echo "Netbooks: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Ultrabooks"');echo "Ultrabooks: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Notebooks"');echo "Notebooks: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Tablet"');echo "Tablet: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

mysql_query('UPDATE csv SET PRECIO=PRECIO+12 where titulosubfamilia="Servidores Torre"');echo "Servidores Torre: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+8 where titulosubfamilia="Software Gesti�n"');echo "Software Gesti�n: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+6 where titulosubfamilia="Software Ofim�tica"');echo "Software Ofim�tica: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+6 where titulosubfamilia="Sistemas de 32 bits"');echo "Sistemas de 32 bits: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+6 where titulosubfamilia="Sistemas de 64 bits"');echo "Sistemas de 64 bits: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";
mysql_query('UPDATE csv SET PRECIO=PRECIO+3 where titulosubfamilia="Antivirus hogar"');echo "Antivirus hogar: "; flush(); usleep(10);
if(mysql_affected_rows() ==0){echo "<style>#red{color:red;}</style>";echo "<div id=red>-----------------------------------------------</div>";}echo mysql_affected_rows();print "<br>";

*/
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





}
echo "</div></div>";
?>