<?
	/*error_reporting(E_ALL);
	ini_set('error_reporting', E_ALL);
	ini_set('display_errors',1);*/
	date_default_timezone_set("America/Argentina/Buenos_Aires");
	include_once("start.php");
	include_once("MysqliDb.php");
	include_once("../config.php");
	include_once("config.php");
	include_once("functions.php");
	include_once("procesos.php");

	//Cuando se hace click en un "destacado-0"
	if(isset($_POST['destacado_0'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		$sql = 'SELECT ' . $tipo . '_id FROM tbl_' . $tipo . ' WHERE ' . $tipo . '_id = ' . $id;
		$r = $db->QSRA($sql);

		if(count($r) > 0) {
			$w = $tipo . '_id = "' . $id . '"';
			$update[$tipo . '_destacado'] = '1';
			$upd = $db->UPDATEJ('tbl_' . $tipo, $update, $w);
		}
	}

	//Cuando se hace click en un "destacado-1"
	if(isset($_POST['destacado_1'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		$sql = 'SELECT ' . $tipo . '_id FROM tbl_' . $tipo . ' WHERE ' . $tipo . '_id = ' . $id;
		$r = $db->QSRA($sql);

		if(count($r) > 0) {
			$w = $tipo . '_id = "' . $id . '"';
			$update[$tipo . '_destacado'] = '00';
			$upd = $db->UPDATEJ('tbl_' . $tipo, $update, $w);
		}
	}

	//Cuando se hace click en un "home-0"
	if(isset($_POST['home_0'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		$sql = 'SELECT ' . $tipo . '_id FROM tbl_' . $tipo . ' WHERE ' . $tipo . '_id = ' . $id;
		$r = $db->QSRA($sql);

		if(count($r) > 0) {
			$w = $tipo . '_id = "' . $id . '"';
			$update[$tipo . '_home'] = '1';
			$upd = $db->UPDATEJ('tbl_' . $tipo, $update, $w);
		}
	}

	//Cuando se hace click en un "home-1"
	if(isset($_POST['home_1'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		$sql = 'SELECT ' . $tipo . '_id FROM tbl_' . $tipo . ' WHERE ' . $tipo . '_id = ' . $id;
		$r = $db->QSRA($sql);

		if(count($r) > 0) {
			$w = $tipo . '_id = "' . $id . '"';
			$update[$tipo . '_home'] = '00';
			$upd = $db->UPDATEJ('tbl_' . $tipo, $update, $w);
		}
	}

	//Cuando se hace click en un "estado-0"
	if(isset($_POST['estado_0'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		$sql = 'SELECT ' . $tipo . '_id FROM tbl_' . $tipo . ' WHERE ' . $tipo . '_id = ' . $id;
		$r = $db->QSRA($sql);

		if(count($r) > 0) {
			$w = $tipo . '_id = "' . $id . '"';
			$update[$tipo . '_estado'] = '1';
			$upd = $db->UPDATEJ('tbl_' . $tipo, $update, $w);
		}
	}

	//Cuando se hace click en un "estado-1"
	if(isset($_POST['estado_1'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		$sql = 'SELECT ' . $tipo . '_id FROM tbl_' . $tipo . ' WHERE ' . $tipo . '_id = ' . $id;
		$r = $db->QSRA($sql);

		if(count($r) > 0) {
			$w = $tipo . '_id = "' . $id . '"';
			$update[$tipo . '_estado'] = '00';
			$upd = $db->UPDATEJ('tbl_' . $tipo, $update, $w);
		}
	}

	//Cuando se sube una foto por el form de listar.php
	if(isset($_POST['subir_foto'])) {
		$_FILES['foto']['name'] = LV($_FILES['foto']['name']);
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		subirFotoElemento('foto', $tipo, $id, true, '../');
	}


	if(isset($_POST['image-data'])) {
		$directorio = $_POST['directorio'];

		function decode($code) {
			global $directorio;
			global $id;
			global $fullname;
			list($type, $code) = explode(';', $code);
			list(, $code)      = explode(',', $code);
			$code = base64_decode($code);

			file_put_contents('../' . $directorio, $code);
		}

		decode($_POST['image-data']);
	}

	//Cuando se elimina una foto desde el modal del listar.php
	if(isset($_POST['eliminar_foto'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		if($eliminar = glob('../../sitio/fotos/' . $tipo . '/' . $id . '.*')) {
			unlink($eliminar[0]);
		}

		if($eliminar = glob('../../sitio/fotos/' . $tipo . '/ampl/' . $id . '.*')) {
			unlink($eliminar[0]);
		}

		echo refresh();
	}

	//Cuando se sube un pdf por el form de listar.php
	if(isset($_POST['subir_pdf'])) {
		$_FILES['pdf']['name'] = LV($_FILES['pdf']['name']);
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		if($_FILES['pdf']['type'] != 'application/pdf') {
			$error = TRUE;
			$msg = 'El formato no es válido, sólo se aceptan PDF';
		}

		if($error == FALSE) {
			$extension_pdf = '.pdf';

			$directorio_subida = '../../sitio/archivos/pdf/' . $tipo . '/';
			$sin_punto = explode('.', $_FILES['pdf']['name']);
			copy($_FILES['pdf']['tmp_name'],$directorio_subida . $_FILES['pdf']['name']);
			rename($directorio_subida . $_FILES['pdf']['name'],$directorio_subida . $id . $extension_pdf);
			echo refresh();
		} else {
			echo '<br><div class="alert alert-danger"><strong>Error</strong> ' . $msg . '</div>';
		}
	}

	//Cuando se elimina un pdf desde el modal del listar.php
	if(isset($_POST['eliminar_pdf'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		if($eliminar = glob('../../sitio/archivos/pdf/' . $tipo . '/' . $id . '.pdf')) {
			unlink($eliminar[0]);
		}

		echo refresh();
	}

	//Cuando se sube un flyer por el form de listar.php
	if(isset($_POST['subir_flyer'])) {
		$_FILES['flyer']['name'] = LV($_FILES['flyer']['name']);
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		if($_FILES['flyer']['type'] != 'image/jpeg' AND $_FILES['flyer']['type'] != 'image/gif' AND $_FILES['flyer']['type'] != 'image/png') {
			$error = TRUE;
			$msg = 'El formato de imagen no es válido, sólo se aceptan JPG, GIF o PNG';
		}

		$check = getimagesize($_FILES['flyer']['tmp_name']);

		if($check == FALSE) {
			$error = TRUE;
			$msg = 'Seleccione una imagen válida';
		}

		if($error == FALSE) {
			if($_FILES['flyer']['type'] == 'image/jpeg') {
				$extension_img = '.jpg';
			} elseif($_FILES['flyer']['type'] == 'image/gif') {
				$extension_img = '.gif';
			} elseif($_FILES['flyer']['type'] == 'image/png') {
				$extension_img = '.png';
			}

			$directorio_subida = '../../sitio/fotos/flyers/' . $tipo . '/';
			$sin_punto = explode('.', $_FILES['flyer']['name']);
			copy($_FILES['flyer']['tmp_name'],$directorio_subida . $_FILES['flyer']['name']);
			rename($directorio_subida . $_FILES['flyer']['name'],$directorio_subida . $id . $extension_img);

			echo refresh();
		} else {
			echo '<br><div class="alert alert-danger"><strong>Error</strong> ' . $msg . '</div>';
		}
	}

	//Cuando se elimina un flyer desde el modal del listar.php
	if(isset($_POST['eliminar_flyer'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		if($eliminar = glob('../../sitio/fotos/flyers/' . $tipo . '/' . $id . '.*')) {
			unlink($eliminar[0]);
		}

		echo refresh();
	}

	//Cuando se elimina una galeria desde el modal del listar.php
	if(isset($_POST['eliminar_galeria'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		if($eliminar = glob('../../sitio/fotos/' . $tipo . '/a' . $id)) {
			echo removeDir($eliminar[0]);
		}

		echo refresh();
	}

	//Cuando se elimina una foto desde el modal del galeria-de-imagenes.php
	if(isset($_POST['eliminar_foto_galeria'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);
		$nombre = LV($_POST['nombre']);

		if($eliminar = glob('../../sitio/fotos/' . $tipo . '/a' . $id . '/' . $nombre)) {
			unlink($eliminar[0]);
		}

		if($eliminar = glob('../../sitio/fotos/' . $tipo . '/a' . $id . '/ampl/' . $nombre)) {
			unlink($eliminar[0]);
		}

		echo refresh();
	}

	//Cuando se suben fotos desde la galeria de imágenes
	if(isset($_POST['subir_fotos_galeria'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		require('../lib/Simpleimage/SimpleImage.php');

		for($i=0; $i<count($_FILES["foto"]["name"]); $i++) {
			$_FILES['foto']['name'][$i] = LV($_FILES['foto']['name'][$i]);

			if($_FILES['foto']['type'][$i] != 'image/jpeg' AND $_FILES['foto']['type'][$i] != 'image/gif' AND $_FILES['foto']['type'][$i] != 'image/png') {
				$error = TRUE;
			}

			$check = getimagesize($_FILES['foto']['tmp_name'][$i]);

			if($check == FALSE) {
				$error = TRUE;
			}

			if($error == FALSE) {
				if($_FILES['foto']['type'][$i] == 'image/jpeg') {
					$extension_img = '.jpg';
				} elseif($_FILES['foto']['type'][$i] == 'image/gif') {
					$extension_img = '.gif';
				} elseif($_FILES['foto']['type'][$i] == 'image/png') {
					$extension_img = '.png';
				}

				$time = time();

				$directorio_subida = '../../sitio/fotos/' . $tipo . '/a' . $id . '/ampl/';
				$directorio_subida_m = '../../sitio/fotos/' . $tipo . '/a' . $id . '/';
				$sin_punto = explode('.', $_FILES['foto']['name'][$i]);
				copy($_FILES['foto']['tmp_name'][$i],$directorio_subida . $_FILES['foto']['name'][$i]);
				rename($directorio_subida . $_FILES['foto']['name'][$i],$directorio_subida . $time . '-' . amigable($_FILES['foto']['name'][$i], true));

				$modulo_variable_ancho_imagen_galeria_chica = 'modulo_' . $tipo . '_ancho_imagen_galeria_chica';
				$modulo_variable_alto_imagen_galeria_chica = 'modulo_' . $tipo . '_alto_imagen_galeria_chica';
				$modulo_variable_ancho_imagen_galeria_grande = 'modulo_' . $tipo . '_ancho_imagen_galeria_grande';
				$modulo_variable_alto_imagen_galeria_grande = 'modulo_' . $tipo . '_alto_imagen_galeria_grande';
				$modulo_variable_tipo_resize = 'modulo_' . $tipo . '_tipo_resize';
				$modulo_variable_watermark = 'modulo_' . $tipo . '_watermark';
				$modulo_variable_watermark_dir = 'modulo_' . $tipo . '_watermark_dir';

				$img = new \claviska\SimpleImage($directorio_subida . $time . '-' . amigable($_FILES['foto']['name'][$i], true));
				$img->toFile($directorio_subida_m . $time . '-' . amigable($_FILES['foto']['name'][$i], true));

				$img_thumb = new \claviska\SimpleImage($directorio_subida_m . $time . '-' . amigable($_FILES['foto']['name'][$i], true));

				if($$modulo_variable_tipo_resize == 'recortar') { //////////////////////////////////////////////////////////////Si está en modo recorte
					if($$modulo_variable_watermark == 1) { //Verifico si está activa o no la marca de agua
						//Ampliada
						$img
							->bestFit($$modulo_variable_ancho_imagen_galeria_grande, $$modulo_variable_alto_imagen_galeria_grande)
							->overlay($$modulo_variable_watermark_dir, 'center', '1')
							->toFile($directorio_subida . $time . '-' . amigable($_FILES['foto']['name'][$i], true));
						
						//Miniatura
						$img_thumb
							->thumbnail($$modulo_variable_ancho_imagen_galeria_chica, $$modulo_variable_alto_imagen_galeria_chica, 'center')
							->toFile($directorio_subida_m . $time . '-' . amigable($_FILES['foto']['name'][$i], true));

					} else { //Si la marca de agua no está activa, no la pongo...
						//Ampliada
						$img
							->bestFit($$modulo_variable_ancho_imagen_galeria_grande, $$modulo_variable_alto_imagen_galeria_grande)
							->toFile($directorio_subida . $time . '-' . amigable($_FILES['foto']['name'][$i], true));

						//Miniatura
						$img_thumb
							->thumbnail($$modulo_variable_ancho_imagen_galeria_chica, $$modulo_variable_alto_imagen_galeria_chica, 'center')
							->toFile($directorio_subida_m . $time . '-' . amigable($_FILES['foto']['name'][$i], true));
					}
				} else { /////////////////////////////////////////////////////////////////////////////////////////////////////////Si está en modo proporcionar
					if($$modulo_variable_watermark == 1) { //Verifico si está activa o no la marca de agua
						//Ampliada
						$img
							->bestFit($$modulo_variable_ancho_imagen_galeria_grande, $$modulo_variable_alto_imagen_galeria_grande)
							->overlay($$modulo_variable_watermark_dir, 'center', '1')
							->toFile($directorio_subida . $time . '-' . amigable($_FILES['foto']['name'][$i], true));
						
						//Miniatura
						$img_thumb
							->bestFit($$modulo_variable_ancho_imagen_galeria_chica, $$modulo_variable_alto_imagen_galeria_chica, 'center')
							->toFile($directorio_subida_m . $time . '-' . amigable($_FILES['foto']['name'][$i], true));

					} else { //Si la marca de agua no está activa, no la pongo...
						//Ampliada
						$img
							->bestFit($$modulo_variable_ancho_imagen_galeria_grande, $$modulo_variable_alto_imagen_galeria_grande)
							->toFile($directorio_subida . $time . '-' . amigable($_FILES['foto']['name'][$i], true));

						//Miniatura
						$img_thumb
							->bestFit($$modulo_variable_ancho_imagen_galeria_chica, $$modulo_variable_alto_imagen_galeria_chica, 'center')
							->toFile($directorio_subida_m . $time . '-' . amigable($_FILES['foto']['name'][$i], true));
					}
				}
			}
		}

		echo refresh();
	}

	//Cuando se suben archivos desde el repositorio
	if(isset($_POST['subir_archivos_repositorio'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		for($i=0; $i<count($_FILES["archivo"]["name"]); $i++) {
			$_FILES['archivo']['name'][$i] = LV($_FILES['archivo']['name'][$i]);
			//print_r($_FILES['archivo']['type'][$i] . '<br>');

			for($x=0;$x<=count($MIMES_PERMITIDOS_REPOSITORIO);$x++) {
				if($_FILES['archivo']['type'][$i] == $MIMES_PERMITIDOS_REPOSITORIO[$x]) {
					$permitido = true;
					break;
				}
			}

			if($permitido == false) {
				$error = TRUE;
			}

			if($error == FALSE) {
				$directorio_subida = '../../sitio/archivos/r/' . $tipo . '/a' . $id . '/';
				$sin_punto = explode('.', $_FILES['archivo']['name'][$i]);
				copy($_FILES['archivo']['tmp_name'][$i],$directorio_subida . $_FILES['archivo']['name'][$i]);
			}
		}

		echo refresh();
	}

	//Cuando se elimina un archivo desde el modal del repositorio-de-archivos.php
	if(isset($_POST['eliminar_archivo_repositorio'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);
		$nombre = LV($_POST['nombre']);

		if($eliminar = glob('../../sitio/archivos/r/' . $tipo . '/a' . $id . '/' . $nombre)) {
			unlink($eliminar[0]);
		}

		echo refresh();
	}

	//Cuando se elimina un repositorio desde el modal del listar.php
	if(isset($_POST['eliminar_repositorio'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		if($eliminar = glob('../../sitio/archivos/r/' . $tipo . '/a' . $id)) {
			removeDir($eliminar[0]);
		}

		echo refresh();
	}

	//Cuando se elimina un elemento desde el modal del listar.php
	if(isset($_POST['eliminar_elemento'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		eliminarElemento($tipo, $id);

		echo refresh();
	}

	//Cuando se hace click en un "categoria-destacado-0"
	if(isset($_POST['categoria_destacado_0'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);
		$num_cat = LV($_POST['numcat']);

		if($num_cat == '1') {
			$num_cat = '';
			$ncat = '1'; 
		} elseif($num_cat == '2') {
			$num_cat = '2';
			$ncat = '2';
		}

		$sql = 'SELECT cat' . $num_cat . '_' . $tipo . '_id FROM tbl_cat' . $num_cat . '_' . $tipo . ' WHERE cat' . $num_cat . '_' . $tipo . '_id = ' . $id;
		$r = $db->QSRA($sql);

		if(count($r) > 0) {
			$w = 'cat' . $num_cat . '_' . $tipo . '_id = "' . $id . '"';
			$update['cat' . $num_cat . '_' . $tipo . '_destacado'] = '1';
			$upd = $db->UPDATEJ('tbl_cat' . $num_cat . '_' . $tipo, $update, $w);
		}
	}

	//Cuando se hace click en un "categoria-destacado-1"
	if(isset($_POST['categoria_destacado_1'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);
		$num_cat = LV($_POST['numcat']);

		if($num_cat == '1') {
			$num_cat = '';
			$ncat = '1'; 
		} elseif($num_cat == '2') {
			$num_cat = '2';
			$ncat = '2';
		}

		$sql = 'SELECT cat' . $num_cat . '_' . $tipo . '_id FROM tbl_cat' . $num_cat . '_' . $tipo . ' WHERE cat' . $num_cat . '_' . $tipo . '_id = ' . $id;
		$r = $db->QSRA($sql);

		if(count($r) > 0) {
			$w = 'cat' . $num_cat . '_' . $tipo . '_id = "' . $id . '"';
			$update['cat' . $num_cat . '_' . $tipo . '_destacado'] = '00';
			$upd = $db->UPDATEJ('tbl_cat' . $num_cat . '_' . $tipo, $update, $w);
		}
	}

	//Cuando se hace click en un "categoria-estado-0"
	if(isset($_POST['categoria_estado_0'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);
		$num_cat = LV($_POST['numcat']);

		if($num_cat == '1') {
			$num_cat = '';
			$ncat = '1'; 
		} elseif($num_cat == '2') {
			$num_cat = '2';
			$ncat = '2';
		}

		$sql = 'SELECT cat' . $num_cat . '_' . $tipo . '_id FROM tbl_cat' . $num_cat . '_' . $tipo . ' WHERE cat' . $num_cat . '_' . $tipo . '_id = ' . $id;
		$r = $db->QSRA($sql);

		if(count($r) > 0) {
			$w = 'cat' . $num_cat . '_' . $tipo . '_id = "' . $id . '"';
			$update['cat' . $num_cat . '_' . $tipo . '_estado'] = '1';
			$upd = $db->UPDATEJ('tbl_cat' . $num_cat . '_' . $tipo, $update, $w);
		}
	}

	//Cuando se hace click en un "categoria-estado-1"
	if(isset($_POST['categoria_estado_1'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);
		$num_cat = LV($_POST['numcat']);

		if($num_cat == '1') {
			$num_cat = '';
			$ncat = '1'; 
		} elseif($num_cat == '2') {
			$num_cat = '2';
			$ncat = '2';
		}

		$sql = 'SELECT cat' . $num_cat . '_' . $tipo . '_id FROM tbl_cat' . $num_cat . '_' . $tipo . ' WHERE cat' . $num_cat . '_' . $tipo . '_id = ' . $id;
		$r = $db->QSRA($sql);

		if(count($r) > 0) {
			$w = 'cat' . $num_cat . '_' . $tipo . '_id = "' . $id . '"';
			$update['cat' . $num_cat . '_' . $tipo . '_estado'] = '00';
			$upd = $db->UPDATEJ('tbl_cat' . $num_cat . '_' . $tipo, $update, $w);
		}
	}

	//Cuando se elimina una categoria desde el modal del listar-categorias.php
	if(isset($_POST['eliminar_categoria'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);
		$num_cat = LV($_POST['numcat']);

		eliminarCategoria($tipo, $id, $num_cat);

		echo refresh();
	}

	//Cuando se tiene que mostrar una consulta desde el modal del listar-consultas.php
	if(isset($_POST['ver_consulta'])) {
		$id = LV($_POST['id']);
		$tipo = LV($_POST['tipo']);

		traerConsulta($tipo, $id);
	}
?>