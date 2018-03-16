<?
	error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	date_default_timezone_set("America/Argentina/Buenos_Aires");
	//error_reporting(0);
	include_once("start.php");
	include_once("mysql.class.php");
	include_once("config.php");
	include_once("functions.php");
	include_once("procesos.php");
    include('../../menu/config.php');

	if(isset($_POST['agregar_carrito'])) {
		$producto_id = LV($_POST['producto_id']);
		$producto_tipo = LV($_POST['producto_tipo']);

		agregarCarrito($producto_id, $producto_tipo);
		echo refresh();
	}

	if(isset($_POST['eliminar_carrito'])) {
		$carrito_id = LV($_POST['carrito_id']);
		$carrito_tipo = LV($_POST['carrito_tipo']);

		eliminarCarrito($carrito_id, $carrito_tipo);
		echo refresh();
	}

	if(isset($_POST['modificar_carrito'])) {
		$carrito_id = LV($_POST['carrito_id']);
		$carrito_tipo = LV($_POST['carrito_tipo']);
		$carrito_cantidad = LV($_POST['carrito_cantidad']);

		modificarCarrito($carrito_id, $carrito_cantidad, $carrito_tipo);
	}

	if(isset($_POST['guardar_pedido'])) {
		guardarPedido($_SESSION['carrito']);
		echo refresh();
	}

	if(isset($_POST['cargar_pedido'])) {
		cargarPedido($_SESSION['cliente_id']);
		echo refresh();
	}

	if(isset($_POST['ver_pedido'])) {
		$pedido_id = LV($_POST['pedido_id']);
		traerPedido($pedido_id);
	}
?>