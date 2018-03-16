<?
	$dbserver = "localhost";
	$dbuser   = 'entrepetal_1';
	$dbpass = 'fj7vmhqI';
	$dbname   = 'entrepetal_1';	
	$pathSite = "http://vistapreviainterneg.com/";
	$pathSiteAdm = "http://vistapreviainterneg/menu/";
	$pagItems = 20;	

	$db = new MysqliDb($dbserver, $dbuser, $dbpass, $dbname);

	$info_titulo = 'Pagina Base';
	$info_descripcion = '';
	$info_email = 'info@entrepetalos.com.ar';
	$info_mantenimiento = 0;

	//SMPT
	/*$_PARAMETROS = array();
	$_PARAMETROS['SMTP_TYPE'] = "";
	$_PARAMETROS['SMTP_HOST'] = "";
	$_PARAMETROS['SMTP_PORT'] = 26;
	$_PARAMETROS['SMTP_USER'] = "";
	$_PARAMETROS['SMTP_PASS'] = "";*/
?>
