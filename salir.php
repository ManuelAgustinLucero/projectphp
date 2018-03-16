<?
	session_start();
	include_once("include/MysqliDb.php");
	include('menu/include/config.php');
	unset($_SESSION['cliente_id']);
	unset($_SESSION['cliente_email']);
	unset($_SESSION['cliente_nombre']);
	unset($_SESSION['cliente_apellido']);
	unset($_SESSION['cliente_logeado']);

	header('Location:' . $pathSiteHome);
?>