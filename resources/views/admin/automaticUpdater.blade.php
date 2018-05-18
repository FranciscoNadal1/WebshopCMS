
@extends('mainTemplates/adminTemplate')

@section('content')


<?php

		
setlocale(LC_ALL, "en_US.utf8"); 



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
	
ob_start();
echo "
	<div id='total'>
	
	<div id='cabecera'>Actualizador</div>
	";
	
	
	
$dir = "../resources/providers/";
$success = 1;
	// Open a known directory, and proceed to read its contents
	if (is_dir($dir)) 
	{
		if ($dh = opendir($dir)) 
		{
			while (($file = readdir($dh)) !== false) 
			{
				if(filetype($dir . $file) == "dir" && strlen($file) > 2){
					
					    $type = $file. 'Api'; 
    					$field = new $type();
    					
    					try{
    						$field::updateDatabase();
    					}catch(\Exception $e){
            				\MailData::addMail("Api Error","","Error update ". $file ." provider database : " . __FUNCTION__ . " in ".__FILE__." at ".__LINE__ . " : </br>". $e); 
            				$success = 0;
    					}
					//echo "filename: $file : filetype: " . filetype($dir . $file) . "\n<br>";
					
				}
				
			}
			closedir($dh);
		}
	
	}


     
     if($success == 1){

	
	
////////////////////////////////////////////////////////////////////////////////
//////				CREATE TOTAL CSV DATABASE
$totalCsv = "totalCsv";


  
try{
$createTotal = DB::statement("
CREATE TABLE `totalCsv` (
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
  `PROVIDER` char(131) collate utf8_bin default NULL,
  PRIMARY KEY  (`CODIGOINTERNO`)
) ENGINE=innoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=17801 ;
	")  or die("e".mysql_error());
}catch(\Exception $e){
	
}

$deleteTotal = DB::statement("DELETE FROM ".$totalCsv."");
$createTotal = DB::statement("
	INSERT INTO totalCsv
    SELECT `REFFABRICANTE`, `TITULO`, `CODIGOINTERNO`, `EAN/UPC`, `CODFAMILIA`, `TITULOFAMILIA`, `CODSUBFAMILIA`, `TITULOSUBFAMILIA`, `CODFABRICANTE`, `NOMFABRICANTE`, `PRECIO`, `STOCK`, `PESO`, `PROXIMA_LLEGADA`, `CICLOVIDA`, `PLAZOENTREGA`, 'infortisa'
    FROM csv
    ");
 $createTotal = DB::statement("
	INSERT INTO totalCsv
    SELECT `REFFABRICANTE`, `TITULO`, `CODIGOINTERNO`, `EAN/UPC`, `CODFAMILIA`, `TITULOFAMILIA`, `CODSUBFAMILIA`, `TITULOSUBFAMILIA`, `CODFABRICANTE`, `NOMFABRICANTE`, `PRECIO`, `STOCK`, `PESO`, `PROXIMA_LLEGADA`, `CICLOVIDA`, `PLAZOENTREGA`, 'home'
    FROM home
    ");   
    
    

    
////////////////////////////////////////////////////////////////////////////////        
            $results3 = DBData::getAllSubfamiliaAndCodeBenefit();
            $excludedList = DBData::getAllExcludedCategories();
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
	<h2>Borrados</h2>
            <tr>
              <th>Nombre</th>
              <th>Productos borrados</th>
            </tr>
            
        @foreach ($excludedList as $resule)
        
        
			@if($resule->excluded == 1)
	            
	                <tr>
	          
	                  <td>{{ $resule->name }}</td>
	                  
	                  <td>
	                    {{
	                    
	                        \DB::table('csv')
	                        ->where('CODSUBFAMILIA', $resule->code)
	                        ->delete()
	                        
	                    }}
	                  </td>
	                </tr>
	        @endif
        @endforeach



<!--
//////////////////////////////////////////////
-->
<div class="table-responsive">
    <table class="table table-hover table-responsive">
	<h2>Modificados</h2>
            <tr>
              <th>Nombre</th>
              <th>Beneficio</th>
              <th>Modificados</th>
            </tr>
            
        @foreach ($results3 as $resule)
        
	                <tr>
	          
	                  <td>{{ $resule->TITULOSUBFAMILIA }}</td>
	                  <td>{{ $resule->benefit }}</td>
	                  <td>
	                  <?php
	                  	
                			\DB::table('benefits')->where('benefit', '')->update(['benefit' => 0]);
                			if($resule->benefit == ""){
                				$resule->benefit =0;
                			}
	                  	?>
	                    {{
                
	                        \DB::table('totalCsv')
	                        ->where('CODSUBFAMILIA', $resule->CODSUBFAMILIA)
	                        ->increment('PRECIO', $resule->benefit)
	                        
	                    }}
	                  </td>
	                </tr>
        @endforeach
        
    </table>
</div>

</div>

<?php
	$contenido = ob_get_contents();
	echo $contenido;
    \MailData::addMail("Update","Routine",$contenido);
    
    }
?>

@endsection