<?php
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	ini_set('error_reporting', E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	ini_set('display_errors',1);
	date_default_timezone_set("America/Argentina/Buenos_Aires");
	error_reporting(0);
	include_once("include/start.php");
	include_once("include/MysqliDb.php");
	include_once("menu/include/config.php");
	include_once("include/functions.php");
	include_once("include/procesos.php");
    include_once('menu/config.php');

	$parametros = LV($_GET['accion']);
	$parametros = explode('/', $parametros);
	$accion = $parametros[0];

	/*$parametros = LV($_SERVER['PATH_INFO']);
	$parametros = preg_replace('/^(\/)/','',$parametros);
	$parametros = explode('/',$parametros);
	$accion = strlen($parametros[0]) > 0 ? $parametros[0] : "home";*/

	if($_SESSION['cliente_id'] != '' AND $_SESSION['cliente_logeado'] == TRUE) {
		$sql = 'SELECT clientes_nombre as cliente_nombre, clientes_apellido as cliente_apellido, clientes_email as cliente_email, clientes_telefono as cliente_telefono, clientes_domicilio as cliente_domicilio, clientes_cp as cliente_cp, clientes_localidad as cliente_localidad, clientes_provincia as cliente_provincia, clientes_pais as cliente_pais FROM tbl_clientes WHERE clientes_id = "' . $_SESSION['cliente_id'] . '"';
		$c = $db->QSRA($sql);
	}

	switch($accion) {
		case "inicio":
			$inc = "inicio.php";
			$titulo_pag = "Inicio";
			break;
		case "seccion":
			$inc = "seccion.php";
			$titulo_pag = "Seccion";
			break;
		case "productos":
			$inc = "productos.php";
			$titulo_pag = "Productos";
			break;
		case "producto":
			$inc = "producto.php";
			$titulo_pag = "Producto";
			break;
		case "noticia":
			$inc = "noticia.php";
			$titulo_pag = "Noticia";
			break;
		case "noticias":
			$inc = "noticias.php";
			$titulo_pag = "Noticias";
			break;
		case "contacto":
			$inc = "contacto.php";
			$titulo_pag = "Contacto";
			break;
		case "comprar":
			$inc = "comprar.php";
			$titulo_pag = "Realizar compra";
			break;
		case "entrar":
			$inc = "entrar.php";
			$titulo_pag = "Entrar";
			break;
		case "olvide-clave":
			$inc = "olvide-clave.php";
			$titulo_pag = "Olvidé mi clave";
			break;
		case "mi-cuenta":
			$inc = "mi-cuenta.php";
			$titulo_pag = "Mi cuenta";
			break;
		case "descargas":
			$inc = "descargas.php";
			$titulo_pag = "Descargas";
			break;
		default:
			$inc = "inicio.php";
			$titulo_pag = "Inicio";
	}
	include('header.php');
	include($inc);
	include('footer.php');
?>
