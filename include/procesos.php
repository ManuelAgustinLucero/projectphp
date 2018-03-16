<?
	/*error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
	date_default_timezone_set("America/Argentina/Buenos_Aires");
	//error_reporting(0);
	include_once("config.php");
	include_once("mysql.class.php");
	include_once("functions.php");
    include('../../menu/config.php');*/

	function traerCarrito($session) {
		global $db;
		$cantidad_items = count($session);
		$total_carro = 0.00;
		for($i=0;$i<count($session);$i++) {
			$total_carro = ($session[$i]['carrito_precio'] * $session[$i]['carrito_cantidad']) + $total_carro;
		}
?>
	<div class="panel panel-default sidebar-menu">
        <div class="panel-heading">
            <h3 class="panel-title">Carro de compras</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
            	<?
            		if(count($session) > 0) {
            	?>
                <table class="table" style="margin-bottom: 0;">
                    <tr>
                        <td>Producto</td>
                        <td>Cant.</td>
                        <th>Subtotal</th>
                        <td></td>
                    </tr>
                    <?
						for($i=0;$i<count($session);$i++) {
                    ?>
                    <tr>
                        <td><?=$session[$i]['carrito_nombre'];?></td>
                        <td>x<?=$session[$i]['carrito_cantidad'];?></td>
                        <th>$<?=number_format($session[$i]['carrito_precio'] * $session[$i]['carrito_cantidad'], '2', '.', '');?></th>
                        <td><i style="cursor: pointer; color: red;" data-id="<?=$session[$i]['carrito_id'];?>" data-tipo="<?=$session[$i]['carrito_tipo'];?>" class="eliminar-producto fa fa-times"></i></td>
                    </tr>
                    <?
                    	}
                    ?>
                    <tr>
                    	<td></td>
                        <th class="text-right">Total:</th>
                        <th>$<?=number_format($total_carro, '2', '.', '');?></th>
                        <td></td>
                    </tr>
                </table>
                <script>
					$(document).ready(function() {
						$(".eliminar-producto").click(function(e){
							var id = $(this).attr('data-id');
							var tipo = $(this).attr('data-tipo');
							var eliminar_carrito = 'eliminar_carrito';

							$.post('include/ajax.php',{
								carrito_id: id,
								carrito_tipo: tipo,
								eliminar_carrito: eliminar_carrito
							},function(e){
								$(".msg-respuesta").html(e);

				                $.notify("Agregando producto", {
				                    position: "bottom right",
				                    className: "success"
				                });
							});
						});
					});
				</script>
				<div class="msg-respuesta"></div>
				<?
						if($_SESSION['cliente_id'] != '' AND $_SESSION['cliente_logeado'] == TRUE) {
							$contar = $db->CountRows('temp_detalle_pedidos', 'identificador = "' . $_SESSION['cliente_id'] . '"');

							if($contar > 0) {
				?>
                <a class="cargar-pedido btn btn-default text-center" style="width: 100%; cursor:pointer"><i class="fa fa-cloud-download"></i> Cargar pedido</a>
				<?
							}
				?>
                <a class="guardar-pedido btn btn-default text-center" style="width: 100%; cursor:pointer"><i class="fa fa-save"></i> Guardar pedido</a>
                <?
                		}
                ?>
                <a href="finalizar-pedido" class="btn btn-primary-theme text-center" style="width: 100%;"><i class="fa fa-shopping-cart"></i> Finalizar pedido</a>
                <?
                	} else {
                ?>
                <p>No hay productos cargados aún</p>
                <?
                	$contar = $db->CountRows('temp_detalle_pedidos', 'identificador = "' . $_SESSION['cliente_id'] . '"');

							if($contar > 0) {
				?>
                <a class="cargar-pedido btn btn-default text-center" style="width: 100%; cursor:pointer"><i class="fa fa-cloud-download"></i> Cargar pedido</a>
				<?
						}
                	}
                ?>
            </div>
			<?
				if($_SESSION['cliente_id'] != '' AND $_SESSION['cliente_logeado'] == TRUE) {
			?>
			<script>
				$(document).ready(function() {
					$(".guardar-pedido").click(function(e){
						var guardar_pedido = 'guardar_pedido';

						$.post('include/ajax.php',{
							guardar_pedido: guardar_pedido
						},function(e){
							$(".msg-respuesta").html(e);

			                $.notify("Pedido guardado correctamente", {
			                    position: "bottom right",
			                    className: "success"
			                });
						});
					});
				});
			</script>
			<?
					if($contar > 0) {
			?>
			<script>
				$(document).ready(function() {
					$(".cargar-pedido").click(function(e){
						var cargar_pedido = 'cargar_pedido';

						$.post('include/ajax.php',{
							cargar_pedido: cargar_pedido
						},function(e){
							$(".msg-respuesta").html(e);

			                $.notify("Pedido cargado correctamente", {
			                    position: "bottom right",
			                    className: "success"
			                });
						});
					});
				});
			</script>
			<?
					}
				}
			?>
        </div>
    </div>
<?
	}

	function agregarCarrito($producto_id, $producto_tipo) {
		global $db;
		global $db2;
		global $porcentaje_IVA;
		$contar = $db->CountRows('productos', 'id = "' . $producto_id . '"');

		if($contar > 0) {
			if(isset($_SESSION['carrito'])) {
				$ar = $_SESSION['carrito'];
			} else {
				$ar = array();
			}

			//Verifico si el id ya existe dentro de la sesión (si el producto ya fue añadido al carro o no)
			for($i=0;$i<count($ar);$i++) {
				if($ar[$i]['carrito_id'] == $producto_id AND $ar[$i]['carrito_tipo'] == $producto_tipo) {
					$existente = TRUE;
					$posicion = $i;
				}
			}

			//Si el producto fue añadido, controlo el stock, si es posible le sumo +1, de lo contrario muestro el error
			if($existente == TRUE) {
				$ar[$posicion]['carrito_cantidad'] = $ar[$posicion]['carrito_cantidad'] + 1; 
				$_SESSION['carrito'] = $ar;

			//Si el producto no fue agregado aún, lo hacemos
			} else {
				$sql = 'SELECT * FROM productos WHERE id = "' . $producto_id . '"';
				$r = $db->QSRA($sql,MYSQL_ASSOC);

				$sql = 'SELECT precio2, precio3, id_presentacion FROM productos WHERE codigo = "' . $r['codigo'] . '"';
				$r2 = $db2->QSRA($sql,MYSQL_ASSOC);

				$producto_nombre = utf8_encode($r['titulo']);
				if($producto_tipo == 'caja') {
					$producto_nombre = $producto_nombre . ' (CAJA x' . $r2['id_presentacion'] . ')';
				}
				$producto_codigo = $r['codigo'];
				if($producto_tipo == 'unidad') {
					$producto_precio = $r2['precio2'] * $porcentaje_IVA;
				} elseif($producto_tipo == 'caja') {
					$producto_precio = $r2['precio3'] * $porcentaje_IVA * $r2['id_presentacion'];
				}

				$ar_nuevo = array(
					'carrito_id' => $producto_id,
					'carrito_tipo' => $producto_tipo,
					'carrito_nombre' => $producto_nombre,
					'carrito_codigo' => $producto_codigo,
					'carrito_precio' => $producto_precio,
					'carrito_cantidad' => '1');

				array_push($ar, $ar_nuevo);
				$_SESSION['carrito'] = $ar;
			}
		}
	}

	function eliminarCarrito($carrito_id, $carrito_tipo) {
		$ar = $_SESSION['carrito'];

		for($i=0;$i<count($ar);$i++) {
			if($ar[$i]['carrito_id'] != $carrito_id OR ($ar[$i]['carrito_id'] == $carrito_id AND $ar[$i]['carrito_tipo'] != $carrito_tipo)) {
				$carrito_nuevo[] = array(
							'carrito_id' => $ar[$i]['carrito_id'],
							'carrito_tipo' => $ar[$i]['carrito_tipo'],
							'carrito_nombre' => $ar[$i]['carrito_nombre'],
							'carrito_codigo' => $ar[$i]['carrito_codigo'],
							'carrito_precio' => $ar[$i]['carrito_precio'],
							'carrito_cantidad' => $ar[$i]['carrito_cantidad']);
			}

			if(isset($carrito_nuevo)) {
				$_SESSION['carrito'] = $carrito_nuevo;
			} else {
				unset($_SESSION['carrito']);
			}
		}
	}

	function modificarCarrito($carrito_id, $carrito_cantidad, $carrito_tipo) {
		$ar = $_SESSION['carrito'];

		for($i=0;$i<count($ar);$i++) {
			if($ar[$i]['carrito_id'] == $carrito_id AND $ar[$i]['carrito_tipo'] == $carrito_tipo) {
				$posicion = $i;
			}
		}
		
		$ar[$posicion]['carrito_cantidad'] = $carrito_cantidad;

		$subtotal = $ar[$posicion]['carrito_cantidad'] * $ar[$posicion]['carrito_precio'];
		$total = 0;
		for($i=0;$i<count($ar);$i++) {
			$total = ($ar[$i]['carrito_precio'] * $ar[$i]['carrito_cantidad']) + $total; 
		}

		$_SESSION['carrito'] = $ar;

		echo '<script>
		$( document ).ready(function() { $("#total").text("$' . number_format($total, '2', '.', '') . '"); 
		$(".producto' . $carrito_id . '-' . $carrito_tipo . '").find(".subtotal").text("$' . number_format($subtotal, '2', '.', '') . '"); });
		</script>';
	}

	function guardarPedido($session) {
		global $_SESSION;
		global $db;
		if($_SESSION['cliente_id'] != '' AND $_SESSION['cliente_logeado'] == TRUE) {
			$w['identificador'] = KSQLT($_SESSION['cliente_id']);
			$sqlDelete = MYSQL::BuildSQLDelete('temp_detalle_pedidos',$w);
			$r = $db->query($sqlDelete);

			for($i=0;$i<count($session);$i++) {
				$insert['id'] = KSQLT('');
				$insert['identificador'] = KSQLT($_SESSION['cliente_id']);
                $insert['codigo'] = KSQLT($session[$i]['carrito_codigo']);
                $insert['titulo'] = KSQLT($session[$i]['carrito_nombre']);
                $insert['cantidad'] = KSQLT($session[$i]['carrito_cantidad']);
                $insert['precio'] = KSQLT($session[$i]['carrito_precio']);
                $insert['obs'] = KSQLT($session[$i]['carrito_tipo']);
                $insert['descuento'] = KSQLT($session[$i]['carrito_id']);
                $sqlInsert = MYSQL::BuildSQLInsert('temp_detalle_pedidos',$insert);
                $r = $db->query($sqlInsert);
			}
		}
	} 

	function cargarPedido($cliente_id) {
		global $_SESSION;
		global $db;
		global $db2;
		global $porcentaje_IVA;
		if($_SESSION['cliente_id'] != '' AND $_SESSION['cliente_logeado'] == TRUE) {
			$contar = $db->CountRows('temp_detalle_pedidos', 'identificador = "' . $cliente_id . '"');

			if($contar > 0) {
				$sql = 'SELECT * FROM temp_detalle_pedidos WHERE identificador = "' . $cliente_id . '"';
				$r = $db->QA($sql);

				$i = 0;
				unset($_SESSION['carrito']);
				$_SESSION['carrito'] = array();

				foreach($r as $r) {
					$contar = $db2->CountRows('productos', 'codigo = "' . $r['codigo'] . '"');
					if($contar > 0) {
						$sql = 'SELECT precio2, precio3, id_presentacion FROM productos WHERE codigo = "' . $r['codigo'] . '"';
						$p = $db2->QSRA($sql);

						if($r['obs'] == 'unidad') {
							$precio = number_format($p['precio2'] * $porcentaje_IVA, '2', '.', '');
						} else {
							$precio = number_format($p['precio3'] * $porcentaje_IVA * $p['id_presentacion'], '2', '.', '');
						}

						$ar['carrito_id'] = $r['descuento'];
						$ar['carrito_tipo'] = $r['obs'];
						$ar['carrito_nombre'] = $r['titulo'];
						$ar['carrito_codigo'] = $r['codigo'];
						$ar['carrito_cantidad'] = $r['cantidad'];
						$ar['carrito_precio'] = $precio;

						array_push($_SESSION['carrito'], $ar);

						$i++;
					}
				}
			}
		}
	} 

	function traerPedido($pedido_id) {
		global $_SESSION;
		global $db;

		$contar = $db->CountRows('pedidos', 'cliente = "' . $_SESSION['cliente_id'] . '" AND id = "' . $pedido_id . '"');

		if($contar > 0) {
			$sql = 'SELECT * FROM detalle_pedidos WHERE nro_pedido = "' . $pedido_id . '"';
			$r = $db->QA($sql,MYSQL_ASSOC);
			$total = 0;
		?>
		<table class="table">
			<tr>
				<th>Producto</th>
				<th>Cantidad</th>
				<th>Precio u.</th>
			</tr>
		<?
			foreach($r as $r) {
		?>
			<tr>
				<td><?=$r['titulo'];?></td>
				<td><?=$r['cantidad'];?></td>
				<td>$<?=number_format($r['precio'], '2', '.', '');?></td>
			</tr>
		<?
				$total = ($r['cantidad'] * $r['precio']) + $total;
			}
		?>
			<tr>
				<th colspan="2" class="text-right">Total:</th>
				<th>$<?=$total;?></th>
			</tr>
		<?
		}
	}
?>