<?
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	date_default_timezone_set("America/Argentina/Buenos_Aires");

	//Agregar un elemento (ej: seccion/noticia/producto);
	function agregarElemento($tipo, $array, $login_id) {
		global $db;

		$insert[$tipo . '_titulo'] = $array[$tipo . '_titulo'];
		$insert[$tipo . '_titulo_corto'] = $array[$tipo . '_titulo_corto'];
		$insert[$tipo . '_categoria'] = $array[$tipo . '_categoria'];
		$insert[$tipo . '_categoria2'] = $array[$tipo . '_categoria2'];
		$insert[$tipo . '_icono'] = $array[$tipo . '_icono'];
		$insert[$tipo . '_copete'] = $array[$tipo . '_copete'];
		$insert[$tipo . '_cuerpo'] = $array[$tipo . '_cuerpo'];
		$insert[$tipo . '_codigo'] = $array[$tipo . '_codigo'];
		$insert[$tipo . '_precio'] = $array[$tipo . '_precio'];
		$insert[$tipo . '_stock'] = $array[$tipo . '_stock'];
		$insert[$tipo . '_fecha_alta'] = $array[$tipo . '_fecha_alta'];
		$insert[$tipo . '_fecha_baja'] = $array[$tipo . '_fecha_baja'];
		$insert[$tipo . '_estado'] = $array[$tipo . '_estado'];
		$insert[$tipo . '_destacado'] = $array[$tipo . '_destacado'];
		$insert[$tipo . '_home'] = $array[$tipo . '_home'];
		$insert[$tipo . '_video_youtube'] = $array[$tipo . '_video_youtube'];
		$insert[$tipo . '_idusuario'] = $login_id;

		$db->INSERTJ('tbl_' . $tipo, $insert);
	}

	//Modificar un elemento (ej: seccion/noticia/producto);
	function modificarElemento($tipo, $id, $array) {
		global $db;

		$w = $tipo . '_id = "' . $id . '"';
		$update[$tipo . '_titulo'] = $array[$tipo . '_titulo'];
		$update[$tipo . '_titulo_corto'] = $array[$tipo . '_titulo_corto'];
		$update[$tipo . '_categoria'] = $array[$tipo . '_categoria'];
		$update[$tipo . '_categoria2'] = $array[$tipo . '_categoria2'];
		$update[$tipo . '_icono'] = $array[$tipo . '_icono'];
		$update[$tipo . '_copete'] = $array[$tipo . '_copete'];
		$update[$tipo . '_cuerpo'] = $array[$tipo . '_cuerpo'];
		$update[$tipo . '_codigo'] = $array[$tipo . '_codigo'];
		$update[$tipo . '_precio'] = $array[$tipo . '_precio'];
		$update[$tipo . '_stock'] = $array[$tipo . '_stock'];
		$update[$tipo . '_fecha_alta'] = $array[$tipo . '_fecha_alta'];
		$update[$tipo . '_fecha_baja'] = $array[$tipo . '_fecha_baja'];
		$update[$tipo . '_estado'] = $array[$tipo . '_estado'];
		$update[$tipo . '_destacado'] = $array[$tipo . '_destacado'];
		$update[$tipo . '_home'] = $array[$tipo . '_home'];
		$update[$tipo . '_video_youtube'] = $array[$tipo . '_video_youtube'];

		$db->UPDATEJ('tbl_' . $tipo, $update, $w);
	}

	//Eliminar un elemento (ej: seccion/noticia/producto); SIRVE TAMBIÉN PARA CLIENTES/PEDIDOS/CONSULTAS
	function eliminarElemento($tipo, $id) {
		global $db;
		
		$sql = 'SELECT ' . $tipo . '_id FROM tbl_' . $tipo . ' WHERE ' . $tipo . '_id = "' . $id . '"';
		$res = $db->QSV($sql);

		if(count($res) > 0) {
			$w = $tipo . '_id = "' . $id . '"';
			$db->DELETEJ('tbl_' . $tipo, $w);
		}
	}

	function subirFotoElemento($campo, $tipo, $id, $refresh, $backdir) {

		//Verifico que la foto sea de un mime correcto
		if($_FILES[$campo]['type'] != 'image/jpeg' AND $_FILES[$campo]['type'] != 'image/gif' AND $_FILES[$campo]['type'] != 'image/png') {
			$error_img = TRUE;
			$msg = 'El formato de imagen no es válido, sólo se aceptan JPG, GIF o PNG';
		}

		//Obtengo las dimensiones de la imagen, si se puede entonces es una imagen de verdad y evito una shell en el server
		$check = getimagesize($_FILES[$campo]['tmp_name']);

		if($check == FALSE) {
			$error_img = TRUE;
			$msg = 'Seleccione una imagen válida';
		}

		//Si no hay ningún error, arranco la subida...
		if($error_img == FALSE) {
			if($_FILES[$campo]['type'] == 'image/jpeg') {
				$extension_img = '.jpg';
			} elseif($_FILES[$campo]['type'] == 'image/gif') {
				$extension_img = '.gif';
			} elseif($_FILES[$campo]['type'] == 'image/png') {
				$extension_img = '.png';
			}

			$directorio_subida = $backdir . '../sitio/fotos/' . $tipo . '/ampl/';
			$directorio_subida_m = $backdir . '../sitio/fotos/' . $tipo . '/';

			if($img = glob($directorio_subida . $id . '.*')) {
				unlink($img[0]);
			}

			if($img = glob($directorio_subida_m . $id . '.*')) {
				unlink($img[0]);
			}

			$sin_punto = explode('.', $_FILES[$campo]['name']);
			move_uploaded_file($_FILES[$campo]['tmp_name'],$directorio_subida . $_FILES[$campo]['name']);
			rename($directorio_subida . $_FILES[$campo]['name'],$directorio_subida . $id . $extension_img);

			$modulo_variable_ancho_imagen_chica = 'modulo_' . $tipo . '_ancho_imagen_chica';
			$modulo_variable_alto_imagen_chica = 'modulo_' . $tipo . '_alto_imagen_chica';
			$modulo_variable_ancho_imagen_grande = 'modulo_' . $tipo . '_ancho_imagen_grande';
			$modulo_variable_alto_imagen_grande = 'modulo_' . $tipo . '_alto_imagen_grande';
			$modulo_variable_tipo_resize = 'modulo_' . $tipo . '_tipo_resize';
			$modulo_variable_watermark = 'modulo_' . $tipo . '_watermark';
			$modulo_variable_watermark_dir = 'modulo_' . $tipo . '_watermark_dir';

			global $$modulo_variable_ancho_imagen_chica;
			global $$modulo_variable_alto_imagen_chica;
			global $$modulo_variable_ancho_imagen_grande;
			global $$modulo_variable_alto_imagen_grande;
			global $$modulo_variable_tipo_resize;
			global $$modulo_variable_watermark;
			global $$modulo_variable_watermark_dir;

			if($_FILES[$campo]['type'] != 'image/gif') {
				require($backdir . 'lib/Simpleimage/SimpleImage.php');

				$img = new \claviska\SimpleImage($directorio_subida . $id . $extension_img);
				$img->toFile($directorio_subida_m . $id . $extension_img);

				$img_thumb = new \claviska\SimpleImage($directorio_subida_m . $id . $extension_img);

				if($$modulo_variable_tipo_resize == 'recortar') { //////////////////////////////////////////////////////////////Si está en modo recorte
					if($$modulo_variable_watermark == 1) { //Verifico si está activa o no la marca de agua
						//Ampliada
						$img
							->bestFit($$modulo_variable_ancho_imagen_grande, $$modulo_variable_alto_imagen_grande)
							->overlay($$modulo_variable_watermark_dir, 'center', '1')
							->toFile($directorio_subida . $id . $extension_img);
						
						//Miniatura
						$img_thumb
							->thumbnail($$modulo_variable_ancho_imagen_chica, $$modulo_variable_alto_imagen_chica, 'center')
							->toFile($directorio_subida_m . $id . $extension_img);

					} else { //Si la marca de agua no está activa, no la pongo...
						//Ampliada
						$img
							->bestFit($$modulo_variable_ancho_imagen_grande, $$modulo_variable_alto_imagen_grande)
							->toFile($directorio_subida . $id . $extension_img);

						//Miniatura
						$img_thumb
							->thumbnail($$modulo_variable_ancho_imagen_chica, $$modulo_variable_alto_imagen_chica, 'center')
							->toFile($directorio_subida_m . $id . $extension_img);
					}
				} else { /////////////////////////////////////////////////////////////////////////////////////////////////////////Si está en modo proporcionar
					if($$modulo_variable_watermark == 1) { //Verifico si está activa o no la marca de agua
						//Ampliada
						$img
							->bestFit($$modulo_variable_ancho_imagen_grande, $$modulo_variable_alto_imagen_grande)
							->overlay($$modulo_variable_watermark_dir, 'center', '1')
							->toFile($directorio_subida . $id . $extension_img);
						
						//Miniatura
						$img_thumb
							->bestFit($$modulo_variable_ancho_imagen_chica, $$modulo_variable_alto_imagen_chica, 'center')
							->toFile($directorio_subida_m . $id . $extension_img);

					} else { //Si la marca de agua no está activa, no la pongo...
						//Ampliada
						$img
							->bestFit($$modulo_variable_ancho_imagen_grande, $$modulo_variable_alto_imagen_grande)
							->toFile($directorio_subida . $id . $extension_img);

						//Miniatura
						$img_thumb
							->bestFit($$modulo_variable_ancho_imagen_chica, $$modulo_variable_alto_imagen_chica, 'center')
							->toFile($directorio_subida_m . $id . $extension_img);
					}
				}
			}

			if($refresh == TRUE) {
				echo refresh();
			}
		} else {
			echo '<br><div class="alert alert-danger"><strong>Error</strong> ' . $msg . '</div>';
		}
	}

	//Agregar una categoría;
	function agregarCategoria($tipo, $array, $num_cat) {
		global $db;

		$insert['cat' . $num_cat . '_' . $tipo . '_titulo'] = 		$array['cat' . $num_cat . '_' . $tipo . '_titulo'];
		$insert['cat' . $num_cat . '_' . $tipo . '_titulo_corto'] = $array['cat' . $num_cat . '_' . $tipo . '_titulo_corto'];
		$insert['cat' . $num_cat . '_' . $tipo . '_padre'] = $array['cat' . $num_cat . '_' . $tipo . '_padre'];
		$insert['cat' . $num_cat . '_' . $tipo . '_copete'] = 		$array['cat' . $num_cat . '_' . $tipo . '_copete'];
		$insert['cat' . $num_cat . '_' . $tipo . '_estado'] = 		$array['cat' . $num_cat . '_' . $tipo . '_estado'];
		$insert['cat' . $num_cat . '_' . $tipo . '_destacado'] = 	$array['cat' . $num_cat . '_' . $tipo . '_destacado'];

		$db->INSERTJ('tbl_cat' . $num_cat . '_' . $tipo, $insert);
	}

	//Modificar una categoria;
	function modificarCategoria($tipo, $id, $array, $num_cat) {
		global $db;

		$w = 'cat' . $num_cat . '_' . $tipo . '_id = "' . $id . '"';
		$update['cat' . $num_cat . '_' . $tipo . '_titulo'] = $array['cat' . $num_cat . '_' . $tipo . '_titulo'];
		$update['cat' . $num_cat . '_' . $tipo . '_titulo_corto'] = $array['cat' . $num_cat . '_' . $tipo . '_titulo_corto'];
		$update['cat' . $num_cat . '_' . $tipo . '_padre'] = $array['cat' . $num_cat . '_' . $tipo . '_padre'];
		$update['cat' . $num_cat . '_' . $tipo . '_copete'] = $array['cat' . $num_cat . '_' . $tipo . '_copete'];
		$update['cat' . $num_cat . '_' . $tipo . '_estado'] = $array['cat' . $num_cat . '_' . $tipo . '_estado'];
		$update['cat' . $num_cat . '_' . $tipo . '_destacado'] = $array['cat' . $num_cat . '_' . $tipo . '_destacado'];

		$db->UPDATEJ('tbl_cat' . $num_cat . '_' . $tipo, $update, $w);
	}

	//Eliminar una categoria;
	function eliminarCategoria($tipo, $id, $num_cat) {
		global $db;
		
		$sql = 'SELECT cat' . $num_cat . '_' . $tipo . '_id FROM tbl_cat' . $num_cat . '_' . $tipo . ' WHERE cat' . $num_cat . '_' . $tipo . '_id = "' . $id . '"';
		$res = $db->QSV($sql);

		if(count($res) > 0) {
			$w = 'cat' . $num_cat . '_' . $tipo . '_id = "' . $id . '"';
			$db->DELETEJ('tbl_cat' . $num_cat . '_' . $tipo, $w);
		}
	}

	//Traer consulta;
	function traerConsulta($tipo, $id) {
		global $db;
		global $contacto_muestra_nombre;
		global $contacto_muestra_email;
		global $contacto_muestra_telefono;
		global $contacto_muestra_asunto;
		global $contacto_muestra_empresa;
		global $contacto_muestra_pais;
		global $contacto_muestra_provincia;
		global $contacto_muestra_cpostal;
		global $contacto_muestra_direccion;

		$sql = 'SELECT * FROM tbl_consultas WHERE consultas_id = "' . $id . '"';
		$r = $db->QSRA($sql);

		if(count($r) > 0) {
?>
		<table class="table">
<?
		if($contacto_muestra_nombre == 1) {
			echo '<tr><th>Nombre</th><td>' . $r['consultas_nombre'] . '</td></tr>';
		}

		if($contacto_muestra_email == 1) {
			echo '<tr><th>Email</th><td>' . $r['consultas_email'] . '</td></tr>';
		}

		if($contacto_muestra_telefono == 1) {
			echo '<tr><th>Teléfono</th><td>' . $r['consultas_telefono'] . '</td></tr>';
		}

		if($contacto_muestra_empresa == 1) {
			echo '<tr><th>Empresa</th><td>' . $r['consultas_empresa'] . '</td></tr>';
		}

		if($contacto_muestra_pais == 1) {
			echo '<tr><th>Pais</th><td>' . $r['consultas_pais'] . '</td></tr>';
		}

		if($contacto_muestra_provincia == 1) {
			$sql = 'SELECT provincias_provincia FROM tbl_provincias WHERE provincias_cod_prov = "' . $r['consultas_provincia'] . '"';
			$p = $db->QSV($sql);
			echo '<tr><th>Provincia</th><td>' . $p . '</td></tr>';
		}

		if($contacto_muestra_cpostal == 1) {
			echo '<tr><th>Cód. postal</th><td>' . $r['consultas_codigo_postal'] . '</td></tr>';
		}

		if($contacto_muestra_direccion == 1) {
			echo '<tr><th>Dirección</th><td>' . $r['consultas_direccion'] . '</td></tr>';
		}

		if($contacto_muestra_asunto == 1) {
			echo '<tr><th>Asunto</th><td>' . $r['consultas_asunto'] . '</td></tr>';
		}

		echo '<tr><td colspan="2"><div style="font-size: 14pt; padding-top: 20px; width: 100%;">' . $r['consultas_consulta'] . '<div></td></tr>';
?>
		</table>
<?
		}
	}

	//Agregar un cliente
	function agregarCliente($tipo, $array) {
		global $db;

		$insert[$tipo . '_nombre'] = $array[$tipo . '_nombre'];
		$insert[$tipo . '_apellido'] = $array[$tipo . '_apellido'];
		$insert[$tipo . '_email'] = $array[$tipo . '_email'];
		$insert[$tipo . '_usuario'] = $array[$tipo . '_usuario'];
		$insert[$tipo . '_razon_social'] = $array[$tipo . '_razon_social'];
		$insert[$tipo . '_domicilio'] = $array[$tipo . '_domicilio'];
		$insert[$tipo . '_cp'] = $array[$tipo . '_cp'];
		$insert[$tipo . '_localidad'] = $array[$tipo . '_localidad'];
		$insert[$tipo . '_provincia'] = $array[$tipo . '_provincia'];
		$insert[$tipo . '_pais'] = $array[$tipo . '_pais'];
		$insert[$tipo . '_cuit'] = $array[$tipo . '_cuit'];
		$insert[$tipo . '_telefono'] = $array[$tipo . '_telefono'];
		$insert[$tipo . '_fecha_alta'] = date('Y-m-d');
		$insert[$tipo . '_clave'] = md5($array[$tipo . '_clave']);
		$insert[$tipo . '_estado'] = $array[$tipo . '_estado'];

		$db->INSERTJ('tbl_' . $tipo, $insert);
	}

	//Modificar un cliente
	function modificarCliente($tipo, $id, $array) {
		global $db;

		$w = $tipo . '_id = "' . $id . '"';
		$update[$tipo . '_nombre'] = $array[$tipo . '_nombre'];
		$update[$tipo . '_apellido'] = $array[$tipo . '_apellido'];
		$update[$tipo . '_email'] = $array[$tipo . '_email'];
		$update[$tipo . '_usuario'] = $array[$tipo . '_usuario'];
		$update[$tipo . '_razon_social'] = $array[$tipo . '_razon_social'];
		$update[$tipo . '_domicilio'] = $array[$tipo . '_domicilio'];
		$update[$tipo . '_cp'] = $array[$tipo . '_cp'];
		$update[$tipo . '_localidad'] = $array[$tipo . '_localidad'];
		$update[$tipo . '_provincia'] = $array[$tipo . '_provincia'];
		$update[$tipo . '_pais'] = $array[$tipo . '_pais'];
		$update[$tipo . '_cuit'] = $array[$tipo . '_cuit'];
		$update[$tipo . '_telefono'] = $array[$tipo . '_telefono'];
		if(trim($array[$tipo . '_nueva_clave']) != '') {
			$update[$tipo . '_clave'] = md5($array[$tipo . '_nueva_clave']);
		}
		$update[$tipo . '_estado'] = $array[$tipo . '_estado'];

		$db->UPDATEJ('tbl_' . $tipo, $update, $w);
	}
?>