<?
	$dbserver = "localhost";
	$dbuser   = 'entrepetal_1';
	$dbpass = 'fj7vmhqI';
	$dbname   = 'entrepetal_1';
		$pathSiteAdm = "http://vistapreviainterneg.com/menu/";
		$pathSiteHome = "http://vistapreviainterneg.com/";
	$pagItems = 20;
	
	$db = new MysqliDb($dbserver, $dbuser, $dbpass, $dbname);

	$sql = 'SELECT * FROM tbl_webinfo ORDER BY info_id DESC LIMIT 1';

	$i = $db->QSRA($sql);
	$info_titulo = $i['info_titulo'];
	$info_slogan = $i['info_slogan'];
	$info_descripcion = $i['info_descripcion'];
	$info_email = $i['info_email'];

	# ############################
	# CONNFIGURACIONES GENERALES #
	# ############################
	#
	$debug = 0; // 0=no / 1=si
	
	define("VERSIONCMS", "V7.0");
	define("RESPONSIVE", 1);
	define("PRODUCCION", 1); // dejala, puede llegar a servir
	define("PAGINA_MULTIIDIOMA", 0); // dejala, puede llegar a servir
	define("CMS_MULTIUSUARIO", 0); // 0=no - 1=si 

	define("PREFIJODDBB", 1); // 0=no - 1=si 

	# ############################
	# MODULOS                    #
	# ############################
	#
	// constantes anidadas significa que se controlan sólo si su nivel superior está activado

	define("MODULO_CONFIGURAR_PORTADA", 0);
		define("MODULO_CONFIGURAR_PORTADA_SECCIONES_HABILITADAS", 'productos|noticias|banners|galerias|extras');
		define("MODULO_CONFIGURAR_PORTADA_ITEMS_COL1",2);
		define("MODULO_CONFIGURAR_PORTADA_ITEMS_COL2",2);
		define("MODULO_CONFIGURAR_PORTADA_ITEMS_COL3",2);

	define("MODULO_SECCIONES", 1);
		$modulo_cat_secciones = 1;
		$modulo_cat2_secciones = 0;
		
	define("MODULO_CONSULTAS", 1);

	define("MODULO_NOTICIAS", 1);
		$modulo_cat_noticias = 0;
		$modulo_cat2_noticias = 0;
		
	define("MODULO_AGENDA", 0);
		define("MODULO_CAT_AGENDA", 0);
		define("MODULO_CAT2_AGENDA", 0);
		
	define("MODULO_BANNERS", 0);
		define("MODULO_CAT_BANNERS", 0);
		define("MODULO_CAT2_BANNERS", 0);
		
	define("MODULO_DIRECTORIO", 0);
		define("MODULO_CAT_DIRECTORIO", 0);
		define("MODULO_CAT2_DIRECTORIO", 0);
		
	define("MODULO_SUSCRIPTOS", 0);
		define("MODULO_CAT_SUSCRIPTOS", 0);
		define("MODULO_CAT2_SUSCRIPTOS", 0);

	define("MODULO_PRODUCTOS", 0);
		$modulo_cat_productos = 1;
		$modulo_cat2_productos = 0;
		define("MODULO_PROMOCIONES_HOME", 0);
		define("MODULO_PRODUCTOS_IMPORTACION", 0);
		define('MODULO_PRODUCTOS_LLEVA_CARRITO', 0); // 0=no, sólo catálogo / 1=si
			define("MODULO_HISTORIAL_VENTAS", 0);
			define("CARRITO_LLEVA_CARGO_ENVIO", 0); // 0=no / 1=si
			define("MODULO_VENDEDORES", 0);

	define("MODULO_CLIENTES", 1);
		define("MODULO_CAT_CLIENTES", 0);
		define("MODULO_CAT2_CLIENTES", 0);

	# REPOSITORIOS DE ARCHIVOS#

	// Tipo de archivos aceptado en repositorios
	$ARCHIVOS_PERMITIDOS_REPOSITORIO = 'pdf|PDF|doc|DOC|docx|DOCX|xls|XLS|xlsx|XLSX|zip|ZIP|rar|RAR|ppt|PPT|pps|PPS|pptx|PPTX|ppsx|PPSX|txt|TXT|png|PNG';
	$MIMES_PERMITIDOS_REPOSITORIO[0] = 'application/pdf'; //PDF
	$MIMES_PERMITIDOS_REPOSITORIO[1] = 'application/msword'; //DOC
	$MIMES_PERMITIDOS_REPOSITORIO[2] = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'; //DOCX
	$MIMES_PERMITIDOS_REPOSITORIO[3] = 'application/vnd.ms-excel'; //XLS
	$MIMES_PERMITIDOS_REPOSITORIO[4] = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'; //XLSX
	$MIMES_PERMITIDOS_REPOSITORIO[5] = 'application/zip'; //ZIP
	$MIMES_PERMITIDOS_REPOSITORIO[6] = 'application/x-rar-compressed'; //RAR
	$MIMES_PERMITIDOS_REPOSITORIO[7] = 'application/vnd.ms-powerpoint'; //PPT Y PPS
	$MIMES_PERMITIDOS_REPOSITORIO[8] = 'application/vnd.openxmlformats-officedocument.presentationml.presentation'; //PPTX
	$MIMES_PERMITIDOS_REPOSITORIO[9] = 'text/plain'; //TXT
	$MIMES_PERMITIDOS_REPOSITORIO[10] = 'application/octet-stream'; //RAR / ZIP (otra manera)
	$MIMES_PERMITIDOS_REPOSITORIO[11] = 'audio/mpeg'; //MP3

	define("ARCHIVOS_PERMITIDOS_REPOSITORIO", 'pdf, doc, docx, xls, xlsx, zip, rar, ppt, pptx, pps, ppsx, txt');
	define("ARCHIVOS_PERMITIDOS_REPOSITORIO_SUBIDA_MULTIPLE_TEXTO", 'Archivos varios');
	define("SUBIDA_MULTIPLE_REPOSITORIO_AUTOMATICA", true); // false:no - true:si

	// Tipo de archivos aceptado en galerías
	define("ARCHIVOS_PERMITIDOS_GALERIAS_SUBIDA_MULTIPLE", '*.jpg;*.png'); // upload múltiple - NO permite texto descriptivo por imagen
	define("ARCHIVOS_PERMITIDOS_GALERIAS_SUBIDA_MULTIPLE_TEXTO", 'Imágenes para web');
	define("SUBIDA_MULTIPLE_GALERIA_AUTOMATICA", true); // false:no - true:si
	$ARCHIVOS_PERMITIDOS_GALERIAS = 'jpg|JPG|gif|GIF|png|PNG|bmp|BMP|tiff|TIFF';

	# CONFIGURACION DE FORM DE CONTACTO #

	$redireccion_al_entrar = 'descargas';

	$contacto_muestra_captcha = 1; // 0=no / 1=si
	$captcha_sitekey = '6LfrHyEUAAAAAGshLmwGejxvZAVFUQWcHmUGSJvz';
	$captcha_secret = '6LfrHyEUAAAAACnrUODXUMEwf4i-XYBI0bCKsMm4';

	$contacto_muestra_nombre = 1; // 0=no / 1=si
		$contacto_requiere_nombre = 0; // 0=no / 1=si
	$contacto_muestra_email = 1; // 0=no / 1=si
		$contacto_requiere_email = 1; // 0=no / 1=si
	$contacto_muestra_telefono = 1; // 0=no / 1=si
		$contacto_requiere_telefono = 0; // 0=no / 1=si
	$contacto_muestra_asunto = 0; // 0=no / 1=si
		$contacto_requiere_asunto = 1; // 0=no / 1=si
	$contacto_muestra_empresa = 0; // 0=no / 1=si
		$contacto_requiere_empresa = 0; // 0=no / 1=si
	$contacto_muestra_pais = 0; // 0=no / 1=si
		$contacto_requiere_pais = 0; // 0=no / 1=si
	$contacto_muestra_provincia = 1; // 0=no / 1=si
		$contacto_requiere_provincia = 0; // 0=no / 1=si
	$contacto_muestra_cpostal = 1; // 0=no / 1=si
		$contacto_requiere_cpostal = 0; // 0=no / 1=si
	$contacto_muestra_direccion = 1; // 0=no / 1=si
		$contacto_requiere_direccion = 0; // 0=no / 1=si
	$contacto_destinatario1 = 'info@amurrioperfumerias.com.ar';
	$contacto_destinatario2 = '';
	$contacto_destinatario3 = '';
	$contacto_destinatario4 = '';
	$contacto_destinatario5 = '';
	$contacto_copia_control_1 = 'mkt@inter-neg.com';
	$contacto_copia_control_2 = '';
	$contacto_nombre_archivo = 'contacto.php';
	$contacto_ok_nombre_archivo = 'secciones.php?id=6';
	$consulta_x_prod_ok_nombre_archivo = 'secciones.php?id=6';

	
?>
