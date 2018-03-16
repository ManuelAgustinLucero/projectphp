<?php
# ///////////////////////////
# productos CONFIGURACION
# ///////////////////////////

$modulo_productos_muestra_precio = 0; // 0=no / 1=si
$modulo_productos_muestra_stock = 0; // 0=no / 1=si
$modulo_productos_muestra_codigo = 0; // 0=no / 1=si
$modulo_productos_muestra_destacado = 0; // 0=no / 1=si
$modulo_productos_muestra_home = 1; // 0=no / 1=si
$modulo_productos_muestra_home_superusuario = 0; // 0=no / 1=si
$modulo_productos_tit_corto = 0; // 0=no / 1=si
	$modulo_productos_tit_corto_cant_caract = 30; // cantidad de caracteres permitidos
$modulo_productos_grabar_como_visible = 1; // 0=no / 1=si / es la valor predeterminado pero se puede cambiar desde el form de alta
$modulo_productos_permitir_restringido = 0; // 0=no / 1=si // activa o no esta funcionalidad
	$modulo_productos_restringido = 0; // 0=no / 1=si // valor default del campo. solo funciona si el parámetro anterior está en 1
$modulo_productos_copete = 0; // 0=no / 1=si
$modulo_productos_mostrar_descr_breve = 0; // 0=no / 1=si
$modulo_productos_falta = 0; // fecha de alta. 0=no / 1=si / 2=automatica
$modulo_productos_fbaja = 0; // fecha de baja. 0=no / 1=si
$modulo_productos_imagen = 1; // imagen principal. 0=no / 1=si
$modulo_productos_icono = 0; // icono de fontsawesome. 0=no / 1=si
$modulo_productos_video_youtube = 0; // 0=no / 1=si
$modulo_productos_pdf = 0; // 0=no / 1=si
$modulo_productos_flyer = 0; // 0=no / 1=si
	$modulo_productos_etiqueta_flyer = 'Rotador'; 
	$modulo_productos_flyer_etiqueta_anchoyalto = 'tamaño predefinido'; 
$modulo_productos_galeria = 0; // 0=no / 1=si
	$modulo_productos_galeria_titulo = 'Galer&iacute;a';  
$modulo_productos_repositorio = 0; // 0=no / 1=si
	$modulo_productos_repositorio_titulo = 'Repositorio';

define("MODULO_PRODUCTOS_GALERIAS", 'grilla'); // slideshow / grilla // por ahora no lo vamos a  usar pero dejalo

# ///////////////////////////
# TAMAÑOS IMAGENES
# ///////////////////////////
$modulo_productos_ancho_imagen_chica = '250';
$modulo_productos_alto_imagen_chica = '250';

$modulo_productos_ancho_imagen_grande = '800';
$modulo_productos_alto_imagen_grande = '600';

$modulo_productos_ancho_imagen_galeria_chica = '220';
$modulo_productos_alto_imagen_galeria_chica = '220';

$modulo_productos_ancho_imagen_galeria_grande = '800';
$modulo_productos_alto_imagen_galeria_grande = '600';

$modulo_productos_tipo_resize = 'recortar'; //proporcional / recortar
$modulo_productos_watermark = 0; // 0=no / 1=si
$modulo_productos_watermark_dir = ''; //Esto se toma desde el directorio del archivo ajax.php (menu/include/ajax)

# ///////////////////////////
# CONFIGURACION PAGINA
# ///////////////////////////

$modulo_productos_compartir_redessociales = 0; // 0=no / 1=si

$modulo_front_productos_ordenamiento_1 = 'productos_fecha_alta'; // pueden ser: titulo, titulo_corto, codigo, precio, stock, fechaalta, destacado, vistas
	$modulo_front_productos_sentido_ordenamiento_1 = 'desc'; // 'asc' o 'desc'
$modulo_front_productos_ordenamiento_2 = ''; // pueden ser: titulo, titulo_corto, codigo, precio, stock, fechaalta, destacado, vistas
	$modulo_front_productos_sentido_ordenamiento_2 = ''; // 'asc' o 'desc'

# ///////////////////////////
# CATEGORIA DE productos
# ///////////////////////////

$modulo_productos_cat_imagen = 1; // 0=no / 1=si
$modulo_productos_cat_copete = 1; // 0=no / 1=si
$modulo_productos_cat_muestra_destacado = 1; // 0=no / 1=si
$modulo_productos_cat_grabar_como_visible = 1; // 0=no / 1=si / es la configuración predeterminada pero se puede cambiar desde el form de alta
$modulo_productos_cat_tit_corto = 1; // 0=no / 1=si
	$modulo_productos_cat_tit_corto_cant_caract = 20; // cantidad de caracteres permitidos
$modulo_productos_cat_etiqueta = 'Marca';

# ///////////////////////////
# CATEGORIA 2 DE productos
# ///////////////////////////

$modulo_productos_cat2_imagen = 1; // 0=no / 1=si
$modulo_productos_cat2_copete = 1; // 0=no / 1=si
$modulo_productos_cat2_muestra_destacado = 1; // 0=no / 1=si
$modulo_productos_cat2_grabar_como_visible = 1; // 0=no / 1=si / es la configuración predeterminada pero se puede cambiar desde el form de alta
$modulo_productos_cat2_tit_corto = 1; // 0=no / 1=si
	$modulo_productos_cat2_tit_corto_cant_caract = 20; // cantidad de caracteres permitidos
$modulo_productos_cat2_etiqueta = 'Categor&iacute;a';


// *************************************************
// *************************************************
// dejado por compatibilidad
// *************************************************
// *************************************************

$modulo_productos_items_x_pag = 3; 
$modulo_productos_items_x_pag = 30; 
$modulo_productos_ancho_imagen_media = '300';
$modulo_productos_alto_imagen_media = '300';
$modulo_front_productos_cantidad_columnas_galerias = 3; // 
$modulo_productos_mostrar_boton_ampliar = 1; // 0=no / 1=si
$modulo_productos_admite_comentarios = 0; // 0=no / 1=si
$modulo_productos_ubicacion_comentarios = 0; // 0=debajo / 1=lwindows
$modulo_front_productos_ordenamiento_porrubro = 1; // 1 = no busca rubros 
$modulo_front_productos_items_x_pag = 25; 
$modulo_front_productos_home_items_x_pag = '3';
$modulo_front_productos_cant_columnas_listado_productos = 1; 
$modulo_front_productos_alto_columnas_listado_productos = 0; // valor numérico en px. valor en cero representa alto por defecto.
$modulo_front_productos_lista_mostrar_descr_breve = 1; // 0=no / 1=si
$modulo_front_productos_detalle_mostrar_descr_breve = 1; // 0=no / 1=si

?>