<?php

# ///////////////////////////
# secciones CONFIGURACION
# ///////////////////////////
$modulo_secciones_precio = 0; // 0=no / 1=si
$modulo_secciones_stock = 0; // 0=no / 1=si
$modulo_secciones_muestra_codigo = 0; // 0=no / 1=si
$modulo_secciones_muestra_destacado = 1; // 0=no / 1=si
$modulo_secciones_muestra_home = 0; // 0=no / 1=si
$modulo_secciones_muestra_home_superusuario = 1; // 0=no / 1=si
$modulo_secciones_tit_corto = 0; // 0=no / 1=si
	$modulo_secciones_tit_corto_cant_caract = 30; // cantidad de caracteres permitidos
$modulo_secciones_grabar_como_visible = 1; // 0=no / 1=si / es la valor predeterminado pero se puede cambiar desde el form de alta
$modulo_secciones_permitir_restringido = 0; // 0=no / 1=si // activa o no esta funcionalidad
	$modulo_secciones_restringido = 0; // 0=no / 1=si // valor default del campo. solo funciona si el parámetro anterior está en 1
$modulo_secciones_copete = 1; // 0=no / 1=si
	$modulo_secciones_copete_ckeditor = 1; // 0=no / 1=si
$modulo_secciones_mostrar_descr_breve = 0; // 0=no / 1=si
$modulo_secciones_falta = 0; // fecha de alta. 0=no / 1=si / 2=automatica
$modulo_secciones_fbaja = 0; // fecha de baja. 0=no / 1=si
$modulo_secciones_imagen = 1; // imagen principal. 0=no / 1=si
$modulo_secciones_icono = 0; // icono de fontsawesome. 0=no / 1=si
$modulo_secciones_video_youtube = 0; // 0=no / 1=si
$modulo_secciones_pdf = 0; // 0=no / 1=si
$modulo_secciones_flyer = 0; // 0=no / 1=si
	$modulo_secciones_etiqueta_flyer = 'Rotador'; 
	$modulo_secciones_flyer_etiqueta_anchoyalto = 'tamaño predefinido'; 
$modulo_secciones_galeria = 1; // 0=no / 1=si
	$modulo_secciones_galeria_titulo = 'Galer&iacute;a';  
$modulo_secciones_repositorio = 0; // 0=no / 1=si
	$modulo_secciones_repositorio_titulo = 'Archivo';

define("MODULO_SECCIONES_GALERIAS", 'grilla'); // slideshow / grilla // por ahora no lo vamos a  usar pero dejalo

# ///////////////////////////
# TAMAÑOS IMAGENES
# ///////////////////////////
$modulo_secciones_ancho_imagen_chica = '200';
$modulo_secciones_alto_imagen_chica = '200';

$modulo_secciones_ancho_imagen_grande = '800';
$modulo_secciones_alto_imagen_grande = '600';

$modulo_secciones_ancho_imagen_galeria_chica = '220';
$modulo_secciones_alto_imagen_galeria_chica = '220';

$modulo_secciones_ancho_imagen_galeria_grande = '800';
$modulo_secciones_alto_imagen_galeria_grande = '600';

$modulo_secciones_tipo_resize = 'recortar'; //proporcional / recortar
$modulo_secciones_watermark = 0; // 0=no / 1=si
$modulo_secciones_watermark_dir = ''; //Esto se toma desde el directorio del archivo ajax.php (menu/include/ajax)

# ///////////////////////////
# CONFIGURACION PAGINA
# ///////////////////////////

$modulo_secciones_compartir_redessociales = 0; // 0=no / 1=si

$modulo_front_secciones_ordenamiento_1 = 'fecha_alta'; // pueden ser: titulo, titulo_corto, codigo, precio, stock, fechaalta, destacado, vistas
	$modulo_front_secciones_sentido_ordenamiento_1 = 'desc'; // 'asc' o 'desc'
$modulo_front_secciones_ordenamiento_2 = ''; // pueden ser: titulo, titulo_corto, codigo, precio, stock, fechaalta, destacado, vistas
	$modulo_front_secciones_sentido_ordenamiento_2 = ''; // 'asc' o 'desc'

# ///////////////////////////
# CATEGORIA DE secciones
# ///////////////////////////

$modulo_secciones_cat_imagen = 1; // 0=no / 1=si
$modulo_secciones_cat_copete = 1; // 0=no / 1=si
$modulo_secciones_cat_muestra_destacado = 1; // 0=no / 1=si
$modulo_secciones_cat_grabar_como_visible = 1; // 0=no / 1=si / es la configuración predeterminada pero se puede cambiar desde el form de alta
$modulo_secciones_cat_tit_corto = 1; // 0=no / 1=si
	$modulo_secciones_cat_tit_corto_cant_caract = 20; // cantidad de caracteres permitidos
$modulo_secciones_cat_etiqueta = 'Ubicaci&oacute;n';

# ///////////////////////////
# CATEGORIA 2 DE secciones
# ///////////////////////////

$modulo_secciones_cat2_imagen = 1; // 0=no / 1=si
$modulo_secciones_cat2_copete = 1; // 0=no / 1=si
$modulo_secciones_cat2_muestra_destacado = 1; // 0=no / 1=si
$modulo_secciones_cat2_grabar_como_visible = 1; // 0=no / 1=si / es la configuración predeterminada pero se puede cambiar desde el form de alta
$modulo_secciones_cat2_tit_corto = 1; // 0=no / 1=si
	$modulo_secciones_cat2_tit_corto_cant_caract = 20; // cantidad de caracteres permitidos
$modulo_secciones_cat2_etiqueta = 'Ubicaci&oacute;n 2';


// *************************************************
// *************************************************
// dejado por compatibilidad
// *************************************************
// *************************************************

$modulo_secciones_items_x_pag = 3; 
$modulo_secciones_items_x_pag = 30; 
$modulo_secciones_ancho_imagen_media = '300';
$modulo_secciones_alto_imagen_media = '300';
$modulo_front_secciones_cantidad_columnas_galerias = 3; // 
$modulo_secciones_mostrar_boton_ampliar = 1; // 0=no / 1=si
$modulo_secciones_admite_comentarios = 0; // 0=no / 1=si
$modulo_secciones_ubicacion_comentarios = 0; // 0=debajo / 1=lwindows
$modulo_front_secciones_ordenamiento_porrubro = 1; // 1 = no busca rubros 
$modulo_front_secciones_items_x_pag = 25; 
$modulo_front_secciones_home_items_x_pag = '3';
$modulo_front_secciones_cant_columnas_listado_secciones = 1; 
$modulo_front_secciones_alto_columnas_listado_secciones = 0; // valor numérico en px. valor en cero representa alto por defecto.
$modulo_front_secciones_lista_mostrar_descr_breve = 1; // 0=no / 1=si
$modulo_front_secciones_detalle_mostrar_descr_breve = 1; // 0=no / 1=si

?>