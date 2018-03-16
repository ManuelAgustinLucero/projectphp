<?
	function generateRandomString($length = 10) {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
	
	//Limpia un stirng de tildes, ñ y espacios (similar a url_encode)	
	function amigable($string) {
	    $string = trim($string);
	    $string = strtolower($string);
	    $string = str_replace(
	        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
	        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
	        $string
	    );
	    $string = str_replace(
	        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
	        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
	        $string
	    );
	    $string = str_replace(
	        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
	        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
	        $string
	    );
	    $string = str_replace(
	        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
	        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
	        $string
	    );
	    $string = str_replace(
	        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
	        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
	        $string
	    );
	    $string = str_replace(
	        array('ñ', 'Ñ', 'ç', 'Ç'),
	        array('n', 'N', 'c', 'C'),
	        $string
	    );
	    $string = str_replace(
	        array(' '),
	        array('-'),
	        $string
	    );
	    //Esta parte se encarga de eliminar cualquier caracter extraño
	    $string = str_replace(
	        array("\\", "¨", "º", "~",
	             "#", "@", "|", "!", "\"",
	             "·", "$", "%", "&", "/",
	             "(", ")", "?", "'", "¡",
	             "¿", "[", "^", "`", "]",
	             "+", "}", "{", "¨", "´",
	             ">", "< ", ";", ",", ":",
	             "."),
	        '',
	        $string
	    );
	    return $string;
	}

	//Devuelve la URL actual
	function dameURL(){
		$url= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		return $url;
	}

	//Une el array separando los valores por el separador que se le indique
	function unirArray($miArray, $sep) {
	    return implode($sep, $miArray);
	}

	//Ingresa una fecha y devuelve una edad en años
	function calcularEdad($fecha) {
		$dias = explode('/', $fecha, 3);
		$dias = mktime(0, 0, 0, $dias[1], $dias[0], $dias[2]);
		$edad = (int)((time()-$dias)/31556926);
		return $edad;
	}

	//Crea un <select> a partir de un array multidimensional
	function crearCombo($n,$v=null,$a,$c='') {
		$out = '<select name="' . $n . '" class="' . $c . '">';
		foreach($a as $s){
			$out.= "<option value='{$s[0]}'";
			$out.= $s[0] == $v ? " selected " : "";
			$out.= ">{$s[1]}</option>";
		}
		$out.= '</select>';
		return $out;
	}

	//Crea un alert de Bootstrap 3
	function alertBS($msj, $tipo = 'danger', $dis = 0) {		
		switch($tipo) {
			case 'danger':
				$clase = 'danger';
				$titulo = 'Error';
				break;
			case 'success':
				$clase = 'success';
				$titulo = '¡Éxito!';
				break;
			case 'warning':
				$clase = 'warning';
				$titulo = 'Cuidado';
				break;
			case 'info':
				$clase = 'info';
				$titulo = 'Info:';
				break;
			default:
				$clase = 'danger';
				$titulo = 'Error';
		}

		if($dis == 1) {
			$equis = ' alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
		} else {
			$equis = '">';
		}

		$res = '<div class="alert alert-' . $clase . $equis . $msj . '</div>';
		return $res;
	}

	//Carga loader {
	function loader() {
		?><script>$("#loader").fadeIn('slow');</script><?
	}

	//Simplemente recarga la página
	function refresh($segundos = 0) {
		$segundos = $segundos * 1000;
		$refresh = '<script>setTimeout(function(){ window.location.reload(1); }, ' . $segundos . ');</script>';
		return $refresh;
	}

	//Hace una redirección con js
	function redirect($url, $segundos = 0) {
		$segundos = $segundos * 1000;
		$redirect = '<script>setTimeout(function(){ window.location.href = "' . $url . '"; }, ' . $segundos . ');</script>';
		return $redirect;
	}

	//Ingresa los valores 00(dias) 00(horas) 00(minutos) 00(segundos) y devuelve segundos
	function timeToSec($dias, $horas, $minutos, $segundos) {
		$dias_seg = $dias * 86400;
		$horas_seg = $horas * 3600;
		$minutos_seg = $minutos * 60;

		$total = $dias_seg + $horas_seg + $minutos_seg + $segundos;

		return $total;
	}

	//Ingresa un valor en segundos y devuelve dias minutos horas
	function secToTime($seg) {
		$D = floor($seg / 86400);
		$H = floor(($seg - ($D * 86400)) / 3600);
		$M = floor(($seg - ($D * 86400) - ($H * 3600)) / 60);
		$S = floor($seg % 60);

		$total = $D . ' ' . $H . ' ' . $M . ' ' . $S;

		return $total;
	}

	//Formatea el 00 00 00 00
	function formatTime($string) {
		$string = explode(' ', $string);
		$dias = $string[0];
		$horas = $string[1];
		$minutos = $string[2];
		$segundos = $string[3];

		$res = '';

		if($dias > 0) {
			$res.= $dias . 'd. ';
		}

		if($horas > 0) {
			if($horas == 1) {
				$res.= $horas . 'h. ';
			} else {
				$res.= $horas . 'hs. ';
			}
		}

		if($minutos > 0) {
			$res.= $minutos . 'min. ';
		}

		if($dias == 0 AND $horas == 0 AND $minutos >= 0) {
			$res.= $segundos. 'seg.';
		}

		return $res;
	}

	////FECHA

	//Convierte una fecha en inglés (aaaa-mm-dd) a esp (dd/mm/aaaa)
	function fechaEsp($f){
		$f = substr($f, 0, 10);
		$cut = explode('-', $f);
		if(count($cut) == 3){
			$day = strlen($cut[2]) == 2 ? $cut[2] : (strlen($cut[2]) == 1 ? '0'.$cut[2] : '01');
			$month = strlen($cut[1]) == 2 ? $cut[1] : (strlen($cut[1]) == 1 ? '0'.$cut[1] : '01');
			$year = strlen($cut[0]) == 4 ? $cut[0] : (strlen($cut[0]) == 2 ? '20'.$cut[0] : '2000');
			return $day . '/' . $month . '/' . $year;
		}
	}

	//Convierte una fecha en esp (dd/mm/aaaa) a inglés (aaaa-mm-dd)
	function fechaIng($f){
		$f = substr($f, 0, 10);
		$cut = explode('/',$f);
		if(count($cut) == 3){
			$day = strlen($cut[0]) == 2 ? $cut[0] : (strlen($cut[0]) == 1 ? '0'.$cut[0] : '01');
			$month = strlen($cut[1]) == 2 ? $cut[1] : (strlen($cut[1]) == 1 ? '0'.$cut[1] : '01');
			$year = strlen($cut[2]) == 4 ? $cut[2] : (strlen($cut[2]) == 2 ? '20'.$cut[2] : '2000');

			return $year . '-' . $month . '-' . $day;
		}
	}

	//Convierte un datatime en ingles a español en formato "d/m/Y H:i:s"
	function fechaEspHora($f){
		$cut = explode('-',$f);
		if(count($cut) == 3){
			$tmpCut = explode(' ',$cut[2]);
			$cut[2] = $tmpCut[0];
			$time = $tmpCut[1];
			$day = strlen($cut[2]) == 2 ? $cut[2] : (strlen($cut[2]) == 1 ? '0'.$cut[2] : '01');
			$month = strlen($cut[1]) == 2 ? $cut[1] : (strlen($cut[1]) == 1 ? '0'.$cut[1] : '01');
			$year = strlen($cut[0]) == 4 ? $cut[0] : (strlen($cut[0]) == 2 ? '20'.$cut[0] : '2000');
			return $day . '/' . $month . '/' . $year . ' ' . $time;
		}
	}

	//Recibe una fecha en inglés y devuelve la fecha en formato "Lunes 21 de Febrero de 2016"
	function fechaEspExacta($f) {
		$f = explode(' ', $f);
		$dias = array('Error fecha', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado', 'Domingo');
		$meses = array('Error fecha','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		$dia = $dias[date('N', strtotime($f[0]))];
		$mes = $meses[date('n', strtotime($f[0]))];
		$fecha_nums = explode('-', $f[0]);
		$dia_numero = $fecha_nums[2];
		$anio = $fecha_nums[0];

		$cadena = $dia . ' ' . $dia_numero . ' de ' . $mes . ' de ' . $anio;

		return $cadena; 
	}

	//Recibe una fecha en inglés y devuelve la fecha en formato "Lunes 21 de Febrero de 2016 a las 00:02"
	function fechaEspExactaHora($f) {
		$f = explode(' ', $f);
		$dias = array('Error fecha', 'Lunes','Martes','Miercoles','Jueves','Viernes','Sabado', 'Domingo');
		$meses = array('Error fecha','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
		$dia = $dias[date('N', strtotime($f[0]))];
		$mes = $meses[date('n', strtotime($f[0]))];
		$fecha_nums = explode('-', $f[0]);
		$dia_numero = $fecha_nums[2];
		$anio = $fecha_nums[0];

		$cadena = $dia . ' ' . $dia_numero . ' de ' . $mes . ' de ' . $anio . ' a las ' . $f[1];

		return $cadena; 
	}

	define("SECOND", 1);
    define("MINUTE", 60 * SECOND);
    define("HOUR", 60 * MINUTE);
    define("DAY", 24 * HOUR);
    define("MONTH", 30 * DAY);
    
	//"Humaniza" una fecha, ej: "Hace 3 minutos", "El mes pasado"
    function timeAgo($time) {
	    $delta = time() - $time;

	    if ($delta < 1 * MINUTE) {
	        return $delta == 1 ? "en este momento" : "hace " . $delta . " segundos ";
	    } if ($delta < 2 * MINUTE) {
	        return "hace un minuto";
	    } if ($delta < 45 * MINUTE) {
	        return "hace " . floor($delta / MINUTE) . " minutos";
	    } if ($delta < 90 * MINUTE) {
	        return "hace una hora";
	    } if ($delta < 24 * HOUR) {
	        return "hace " . floor($delta / HOUR) . " horas";
	    } if ($delta < 48 * HOUR){
	        return "ayer";
	    } if ($delta < 30 * DAY) {
	        return "hace " . floor($delta / DAY) . " dias";
	    } if ($delta < 12 * MONTH) {
	        $months = floor($delta / DAY / 30);
	        return $months <= 1 ? "el mes pasado" : "hace " . $months . " meses";
	    } else {
	        $years = floor($delta / DAY / 365);
	        return $years <= 1 ? "el a&ntilde;o pasado" : "hace " . $years . " a&ntilde;os";
	    }
    }

	////VALIDACIONES

	//Valida una fecha en formato dd/mm/aaaa
	function validarFecha($fecha){
		if (ereg('(0[1-9]|[12][0-9]|3[01])[/](0[1-9]|1[012])[/](19|20)[0-9]{2}', $fecha)) {
			return true;
		} else {
			return false;
		}
	}

	//Recibe una dirección de email y verifica que sea correcta
	function validarEmail($direccion) {
		$sintaxis = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
		if(preg_match($sintaxis,$direccion)) {
	    	return true;
		} else {
	    	return false;
		}
	}

	//Recibe una variable o un array y verifica que nada esté vacío
	function valVacio($f){
		if(is_array($f)){
			foreach($f as $ef) {
				if(strlen(trim($ef)) == 0) {
					return false;
				}
			}
		} else { 
			if(strlen(trim($f)) == 0) {
				return false;
			}
		}
		return true;
	}

	//// DATOS
	function KSQLT($t){
		return MYSQL::SQLValue($t,MYSQL::SQLVALUE_TEXT);
	}

	//Limpiar Variable
	function LV($param,$html='s') {
		global $db;
		$param = trim($param);
		if($html == 's') {
			$param = strip_tags($param);
			$param = str_ireplace("'", "", $param);
			$param = str_ireplace("\"", "", $param);
		}
		$param = mysqli_real_escape_string($db->Mysqli(), $param);
		return $param;
	}

	//Limpiar Array
	function LA($a=array()) {
		foreach($a as $i){
			$o[$i] = LV($_REQUEST[$i]);
		}
		return $o;
	}
?>
