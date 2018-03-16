<?php
# ///////////////////////////
# noticias CONFIGURACION
# ///////////////////////////

$modulo_noticias_precio = 0; // 0=no / 1=si
$modulo_noticias_stock = 0; // 0=no / 1=si
$modulo_noticias_muestra_codigo = 0; // 0=no / 1=si
$modulo_noticias_muestra_destacado = 1; // 0=no / 1=si
$modulo_noticias_muestra_home = 1; // 0=no / 1=si
$modulo_noticias_muestra_home_superusuario = 0; // 0=no / 1=si
$modulo_noticias_tit_corto = 0; // 0=no / 1=si
	$modulo_noticias_tit_corto_cant_caract = 30; // cantidad de caracteres permitidos
$modulo_noticias_grabar_como_visible = 1; // 0=no / 1=si / es la valor predeterminado pero se puede cambiar desde el form de alta
$modulo_noticias_permitir_restringido = 0; // 0=no / 1=si // activa o no esta funcionalidad
	$modulo_noticias_restringido = 0; // 0=no / 1=si // valor default del campo. solo funciona si el parámetro anterior está en 1
$modulo_noticias_copete = 1; // 0=no / 1=si
$modulo_noticias_mostrar_descr_breve = 0; // 0=no / 1=si
$modulo_noticias_falta = 1; // fecha de alta. 0=no / 1=si / 2=automatica
$modulo_noticias_fbaja = 0; // fecha de baja. 0=no / 1=si
$modulo_noticias_imagen = 1; // imagen principal. 0=no / 1=si
$modulo_noticias_icono = 0; // icono de fontsawesome. 0=no / 1=si
$modulo_noticias_video_youtube = 0; // 0=no / 1=si
$modulo_noticias_pdf = 0; // 0=no / 1=si
$modulo_noticias_flyer = 0; // 0=no / 1=si
	$modulo_noticias_etiqueta_flyer = 'Rotador'; 
	$modulo_noticias_flyer_etiqueta_anchoyalto = 'tamaño predefinido'; 
$modulo_noticias_galeria = 0; // 0=no / 1=si
	$modulo_noticias_galeria_titulo = 'Galer&iacute;a';  
$modulo_noticias_repositorio = 0; // 0=no / 1=si
	$modulo_noticias_repositorio_titulo = 'Repositorio';

define("MODULO_NOTICIAS_GALERIAS", 'grilla'); // slideshow / grilla // por ahora no lo vamos a  usar pero dejalo

# ///////////////////////////
# TAMAÑOS IMAGENES
# ///////////////////////////
$modulo_noticias_ancho_imagen_chica = '200';
$modulo_noticias_alto_imagen_chica = '200';

$modulo_noticias_ancho_imagen_grande = '800';
$modulo_noticias_alto_imagen_grande = '600';

$modulo_noticias_ancho_imagen_galeria_chica = '220';
$modulo_noticias_alto_imagen_galeria_chica = '220';

$modulo_noticias_ancho_imagen_galeria_grande = '800';
$modulo_noticias_alto_imagen_galeria_grande = '600';

$modulo_noticias_tipo_resize = 'recortar'; //proporcional / recortar
$modulo_noticias_watermark = 0; // 0=no / 1=si
$modulo_noticias_watermark_dir = ''; //Esto se toma desde el directorio del archivo ajax.php (menu/include/ajax)

# ///////////////////////////
# CONFIGURACION PAGINA
# ///////////////////////////

$modulo_noticias_compartir_redessociales = 0; // 0=no / 1=si

$modulo_front_noticias_ordenamiento_1 = 'noticias_fecha_alta'; // pueden ser: titulo, titulo_corto, codigo, precio, stock, fechaalta, destacado, vistas
	$modulo_front_noticias_sentido_ordenamiento_1 = 'desc'; // 'asc' o 'desc'
$modulo_front_noticias_ordenamiento_2 = ''; // pueden ser: titulo, titulo_corto, codigo, precio, stock, fechaalta, destacado, vistas
	$modulo_front_noticias_sentido_ordenamiento_2 = ''; // 'asc' o 'desc'

# ///////////////////////////
# CATEGORIA DE noticias
# ///////////////////////////

$modulo_noticias_cat_imagen = 1; // 0=no / 1=si
$modulo_noticias_cat_copete = 1; // 0=no / 1=si
$modulo_noticias_cat_muestra_destacado = 1; // 0=no / 1=si
$modulo_noticias_cat_grabar_como_visible = 1; // 0=no / 1=si / es la configuración predeterminada pero se puede cambiar desde el form de alta
$modulo_noticias_cat_tit_corto = 1; // 0=no / 1=si
	$modulo_noticias_cat_tit_corto_cant_caract = 20; // cantidad de caracteres permitidos
$modulo_noticias_cat_etiqueta = 'Categor&iacute;a';

# ///////////////////////////
# CATEGORIA 2 DE noticias
# ///////////////////////////

$modulo_noticias_cat2_imagen = 1; // 0=no / 1=si
$modulo_noticias_cat2_copete = 1; // 0=no / 1=si
$modulo_noticias_cat2_muestra_destacado = 1; // 0=no / 1=si
$modulo_noticias_cat2_grabar_como_visible = 1; // 0=no / 1=si / es la configuración predeterminada pero se puede cambiar desde el form de alta
$modulo_noticias_cat2_tit_corto = 1; // 0=no / 1=si
	$modulo_noticias_cat2_tit_corto_cant_caract = 20; // cantidad de caracteres permitidos
$modulo_noticias_cat2_etiqueta = 'Ubicaci&oacute;n 2';


// *************************************************
// *************************************************
// dejado por compatibilidad
// *************************************************
// *************************************************

$modulo_noticias_items_x_pag = 3; 
$modulo_noticias_items_x_pag = 30; 
$modulo_noticias_ancho_imagen_media = '300';
$modulo_noticias_alto_imagen_media = '300';
$modulo_front_noticias_cantidad_columnas_galerias = 3; // 
$modulo_noticias_mostrar_boton_ampliar = 1; // 0=no / 1=si
$modulo_noticias_admite_comentarios = 0; // 0=no / 1=si
$modulo_noticias_ubicacion_comentarios = 0; // 0=debajo / 1=lwindows
$modulo_front_noticias_ordenamiento_porrubro = 1; // 1 = no busca rubros 
$modulo_front_noticias_items_x_pag = 25; 
$modulo_front_noticias_home_items_x_pag = '3';
$modulo_front_noticias_cant_columnas_listado_noticias = 1; 
$modulo_front_noticias_alto_columnas_listado_noticias = 0; // valor numérico en px. valor en cero representa alto por defecto.
$modulo_front_noticias_lista_mostrar_descr_breve = 1; // 0=no / 1=si
$modulo_front_noticias_detalle_mostrar_descr_breve = 1; // 0=no / 1=si

?>