@extends('mainTemplates/adminTemplate')

@section('content')


<?php


		
setlocale(LC_ALL, "en_US.utf8"); 

$var_url = "http://api.infortisa.com/api/Tarifa/GetFile?user=EFD79BAA-1882-463D-8B44-168A117D4F32";
$var_url = trim($var_url);

	set_time_limit(500); 


	echo "
	<style>
	
	
	#wrapper{width:740px;margin:0 auto;border-bottom:1px solid #000;border-right:1px solid #000;border-left:1px solid #000;padding:20px;
	    background: linear-gradient(to bottom, rgba(255,255,255,1) 0%,rgba(255,255,255,0) 100%);
	}
	#cabecera{
	
		margin:0 auto;
		margin-bottom:30px;
		margin-top:10px;
		height:30px;
		text-align:center;
		color:white;
		
		padding-top:5px;
		padding-bottom:15px;
		
	    background: linear-gradient(to bottom, rgba(30,87,153,1) 0%,rgba(41,137,216,1) 50%,rgba(32,124,202,1) 51%,rgba(125,185,232,1) 100%) !important;
	}
	#wrapper textarea{margin:0 auto;width:720px;height:300px;}
	#wrapper form, #wrapper a{text-align:center}
	
	.yellow{
	    background-color:yellow;
	}
	</style>

	";
	
echo "
	<div id='total'>
	
	<div id='cabecera'>Actualizador</div>
	";
	
	
function file_get_contents_utf8($fn) {
     $content = file_get_contents($fn);
      return mb_convert_encoding($content, 'UTF-8',
          mb_detect_encoding($content, 'UTF-8, ISO-8859-1', true));
}


$contenido = file_get_contents_utf8("$var_url");

	if($contenido == ""){
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
		echo "Se ha encontrado un problema con la base de datos de infortisa, la web no ha podido actualizarse automáticamente";

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	
	}else{
		
		
		//echo "El contenido ha sido :$contenido:";
	
	

    $var_url = mb_convert_encoding($var_url, "UTF-8");

    file_put_contents("csv.csv", file_get_contents_utf8("$var_url"));
	flush();
  $total = "";  

    $fh = fopen('csv.csv','r');
	
	while ($line = fgets($fh)) {

		$line = str_replace("'", "", $line);		
  
   //echo($line);
   
   

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



//echo $text;




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
	
	//$base_query = "INSERT INTO csv (`REFFABRICANTE`, `TITULO`, `CODIGOINTERNO`, `EAN/UPC`, `CODFAMILIA`, `TITULOFAMILIA`, `CODSUBFAMILIA`, `TITULOSUBFAMILIA`, `CODFABRICANTE`, `NOMFABRICANTE`, `PRECIO`, `STOCK`, `PESO`, `PROXIMA_LLEGADA`, `CICLOVIDA`, `PLAZOENTREGA`, `CANONLPI`, `PRECIOSINCANON`) ";
	// Loop through all csv data rows and generate separate
	// INSERT queries based on base_query + the row information
	set_time_limit(500); 
	
	try{
        $delete = \DB::delete("delete from `csv`;");
    }catch(Exception $e){}
    
    
	try{    
        $drop = \DB::statement("drop table `csv`;");
    }catch(Exception $e){}
    
$create = DB::statement("
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

				// Combine generated queries to generate final query
				$query = $base_query .$value_query .";";
				
			//	echo $query;
				//antiguo <style>form {display:none;}</style>
				/*
				$acentos = array('?, '?,'?,'?,'?','?);
				$substituir = array('a','e','i','o','u','&ntilde;');		
				*/
		//		$substituir = array('&aacute;','&eacute;','&iacute;','&oacute;','&uacute','&ntilde;);
		 
		$text = $query ;
		//$text += ";";
		//echo "$text</br>";
		/*
			$acentos = array('"',',',"&#039;");
			$substituir = array('',".","");
			*/
			
			//$text = str_replace("'", "", $query);
			


		$format = \DB::statement("$text");
		//////////////////////////////////////////////////


		/////////////////////////////////////////////////////
		//echo "$text";

			}
	
	flush();




}



    
        
            $results3 = DBData::getAllSubfamiliaAndCodeBenefit();
            $numberNoBenefit = DBData::getNumberCategoriesNoBenefit();
            
            ?>
            
            
           
<!-- -------------------------------------------------------------------------
------------------------------------------------------------------------------
Warnings and errors                                                         -->


        @if($numberNoBenefit != 0)
        
            <div class="alert alert-warning">
              <strong>Warning!</strong> Hay {{ $numberNoBenefit }} categorías que no tienen beneficio
            </div>
        
        @endif
        
<!-- ------------------------------------------------------------------------- -->
<div class="table-responsive">
    <table class="table table-hover table-responsive">
            <tr>
              <th>Nombre</th>
              <th>Beneficio</th>
              <th>Excluido</th>
              <th>Modificados</th>
            </tr>
            
        @foreach ($results3 as $resule)
        
        

        
        
        
            @if($resule->benefit == 0 and $resule->excluded == 0)
                <tr class="warning">
            @else
                <tr>
            @endif
          
                  <td>{{ $resule->TITULOSUBFAMILIA }}</td>
                  <td>{{ $resule->benefit }}</td>
                  <td>{{ $resule->excluded }}</td>
                  <td>
                    {{
                        \DB::table('csv')
                        ->where('CODSUBFAMILIA', $resule->CODSUBFAMILIA)
                        ->increment('PRECIO', $resule->benefit)
                        
                    }}
                  </td>
                </tr>
        @endforeach
        
    </table>
</div>



</div>




@endsection