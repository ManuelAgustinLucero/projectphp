<?php
# ///////////////////////////
# noticias CONFIGURACION
# ///////////////////////////

$modulo_banners_precio = 0; // 0=no / 1=si
$modulo_banners_stock = 0; // 0=no / 1=si
$modulo_banners_muestra_codigo = 0; // 0=no / 1=si
$modulo_banners_muestra_destacado = 0; // 0=no / 1=si
$modulo_banners_muestra_home = 0; // 0=no / 1=si
$modulo_banners_muestra_home_superusuario = 0; // 0=no / 1=si
$modulo_banners_tit_corto = 0; // 0=no / 1=si
	$modulo_banners_tit_corto_cant_caract = 30; // cantidad de caracteres permitidos
$modulo_banners_grabar_como_visible = 0; // 0=no / 1=si / es la valor predeterminado pero se puede cambiar desde el form de alta
$modulo_banners_permitir_restringido = 0; // 0=no / 1=si // activa o no esta funcionalidad
	$modulo_banners_restringido = 0; // 0=no / 1=si // valor default del campo. solo funciona si el parámetro anterior está en 1
$modulo_banners_copete = 0; // 0=no / 1=si
$modulo_banners_mostrar_descr_breve = 0; // 0=no / 1=si
$modulo_banners_falta = 0; // fecha de alta. 0=no / 1=si / 2=automatica
$modulo_banners_fbaja = 0; // fecha de baja. 0=no / 1=si
$modulo_banners_imagen = 1; // imagen principal. 0=no / 1=si
$modulo_banners_icono = 0; // icono de fontsawesome. 0=no / 1=si
$modulo_banners_video_youtube = 0; // 0=no / 1=si
$modulo_banners_pdf = 0; // 0=no / 1=si
$modulo_banners_flyer = 0; // 0=no / 1=si
	$modulo_banners_etiqueta_flyer = 'Rotador'; 
	$modulo_banners_flyer_etiqueta_anchoyalto = 'tamaño predefinido'; 
$modulo_banners_galeria = 0; // 0=no / 1=si
	$modulo_banners_galeria_titulo = 'Galer&iacute;a';  
$modulo_banners_repositorio = 0; // 0=no / 1=si
	$modulo_banners_repositorio_titulo = 'Repositorio';

define("MODULO_BANNERS_GALERIAS", 'grilla'); // slideshow / grilla // por ahora no lo vamos a  usar pero dejalo

# ///////////////////////////
# TAMAÑOS IMAGENES
# ///////////////////////////
$modulo_banners_ancho_imagen_chica = '200';
$modulo_banners_alto_imagen_chica = '100';

$modulo_banners_ancho_imagen_grande = '1400';
$modulo_banners_alto_imagen_grande = '100';

$modulo_banners_ancho_imagen_galeria_chica = '220';
$modulo_banners_alto_imagen_galeria_chica = '220';

$modulo_banners_ancho_imagen_galeria_grande = '800';
$modulo_banners_alto_imagen_galeria_grande = '600';

$modulo_banners_tipo_resize = 'recortar'; //proporcional / recortar
$modulo_banners_watermark = 0; // 0=no / 1=si
$modulo_banners_watermark_dir = ''; //Esto se toma desde el directorio del archivo ajax.php (menu/include/ajax)

# ///////////////////////////
# CONFIGURACION PAGINA
# ///////////////////////////

$modulo_banners_compartir_redessociales = 0; // 0=no / 1=si

$modulo_front_banners_ordenamiento_1 = 'banners_fecha_alta'; // pueden ser: titulo, titulo_corto, codigo, precio, stock, fechaalta, destacado, vistas
	$modulo_front_banners_sentido_ordenamiento_1 = 'desc'; // 'asc' o 'desc'
$modulo_front_banners_ordenamiento_2 = ''; // pueden ser: titulo, titulo_corto, codigo, precio, stock, fechaalta, destacado, vistas
	$modulo_front_banners_sentido_ordenamiento_2 = ''; // 'asc' o 'desc'

# ///////////////////////////
# CATEGORIA DE noticias
# ///////////////////////////

$modulo_banners_cat_imagen = 1; // 0=no / 1=si
$modulo_banners_cat_copete = 1; // 0=no / 1=si
$modulo_banners_cat_muestra_destacado = 1; // 0=no / 1=si
$modulo_banners_cat_grabar_como_visible = 1; // 0=no / 1=si / es la configuración predeterminada pero se puede cambiar desde el form de alta
$modulo_banners_cat_tit_corto = 1; // 0=no / 1=si
	$modulo_banners_cat_tit_corto_cant_caract = 20; // cantidad de caracteres permitidos
$modulo_banners_cat_etiqueta = 'Categor&iacute;a';

# ///////////////////////////
# CATEGORIA 2 DE noticias
# ///////////////////////////

$modulo_banners_cat2_imagen = 1; // 0=no / 1=si
$modulo_banners_cat2_copete = 1; // 0=no / 1=si
$modulo_banners_cat2_muestra_destacado = 1; // 0=no / 1=si
$modulo_banners_cat2_grabar_como_visible = 1; // 0=no / 1=si / es la configuración predeterminada pero se puede cambiar desde el form de alta
$modulo_banners_cat2_tit_corto = 1; // 0=no / 1=si
	$modulo_banners_cat2_tit_corto_cant_caract = 20; // cantidad de caracteres permitidos
$modulo_banners_cat2_etiqueta = 'Ubicaci&oacute;n 2';


// *************************************************
// *************************************************
// dejado por compatibilidad
// *************************************************
// *************************************************

$modulo_banners_items_x_pag = 3; 
$modulo_banners_items_x_pag = 30; 
$modulo_banners_ancho_imagen_media = '300';
$modulo_banners_alto_imagen_media = '300';
$modulo_front_banners_cantidad_columnas_galerias = 3; // 
$modulo_banners_mostrar_boton_ampliar = 1; // 0=no / 1=si
$modulo_banners_admite_comentarios = 0; // 0=no / 1=si
$modulo_banners_ubicacion_comentarios = 0; // 0=debajo / 1=lwindows
$modulo_front_banners_ordenamiento_porrubro = 1; // 1 = no busca rubros 
$modulo_front_banners_items_x_pag = 25; 
$modulo_front_banners_home_items_x_pag = '3';
$modulo_front_banners_cant_columnas_listado_noticias = 1; 
$modulo_front_banners_alto_columnas_listado_noticias = 0; // valor numérico en px. valor en cero representa alto por defecto.
$modulo_front_banners_lista_mostrar_descr_breve = 1; // 0=no / 1=si
$modulo_front_banners_detalle_mostrar_descr_breve = 1; // 0=no / 1=si

?>