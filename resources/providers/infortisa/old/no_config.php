<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<meta name="author" content="Francisco Nadal Rodriguez">
<script src="java.js" type="text/javascript"></script>
<?php


# La url de la base de datos #
	$url="localhost";
# El nombre de la base de datos#
	$nombre="x1zk0";
# La contrase�a de la base de datos
	$pass="";
# La base de datos
	$bd="c9";
$conexion = mysql_connect("$url","$nombre","$pass");


$paginacion = 12;
$cont_admin="aitabai";


$CODIGO = "aitabai";
?>


<?php
// Desactivar toda notificaci�n de error
error_reporting(0);


?>