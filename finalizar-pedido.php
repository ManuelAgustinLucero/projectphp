<?php
    require('lib/PHPMailer/class.phpmailer.php');
    require('lib/PHPMailer/PHPMailerAutoload.php');

    if(isset($_POST['realizar_pedido']) AND count($_SESSION['carrito']) > 0) {
        $pedido_nombre = LV($_POST['pedido_nombre']);
        $pedido_apellido = LV($_POST['pedido_apellido']);
        $pedido_telefono = LV($_POST['pedido_telefono']);
        $pedido_email = LV($_POST['pedido_email']);
        $pedido_ciudad = LV($_POST['pedido_ciudad']);
        $pedido_direccion = LV($_POST['pedido_direccion']);
        $pedido_provincia = LV($_POST['pedido_provincia']);
        $cliente_clave = LV($_POST['cliente_clave']);

        if($pedido_nombre == '' OR $pedido_apellido == '' OR $pedido_telefono == '' OR $pedido_email == '' OR $pedido_ciudad == '' OR $pedido_direccion == '') {
            $error = TRUE;
            $msg = 'Por favor complete los campos vacíos';
        }

        /*$contar = $db->CountRows('provincia', 'cod_prov = "' . $pedido_provincia . '"');
        if($contar == 0) {
            $error = TRUE;
            $msg = 'Seleccione una provincia existente';
        }*/

        if(validarEmail($pedido_email) == FALSE) {
            $error = TRUE;
            $msg = 'Por favor ingrese un email válido';
        }

        if(($_SESSION['cliente_id'] == '' OR !$_SESSION['cliente_logeado'] == TRUE) AND !$error == TRUE) {
            $contar = $db->CountRows('clientes', 'email = "' . $pedido_email . '"');
            if($contar > 0) {
                $error = TRUE;
                $msg = 'El email ingresado está en uso';
            }

            if(trim($cliente_clave) == '' OR strlen(trim($cliente_clave)) < 6) {
                $error = TRUE;
                $msg = 'La clave debe contener al menos 6 carácteres';
            }

            if($error == FALSE) {
                $insert['id'] = KSQLT('');
                $insert['nombre'] = KSQLT($pedido_nombre);
                $insert['apellido'] = KSQLT($pedido_apellido);
                $insert['telefono'] = KSQLT($pedido_telefono);
                $insert['email'] = KSQLT($pedido_email);
                $insert['localidad'] = KSQLT($pedido_ciudad);
                $insert['domicilio'] = KSQLT($pedido_direccion);
                $insert['provincia'] = KSQLT($pedido_provincia);
                $insert['clave'] = KSQLT(md5($cliente_clave));
                $insert['fechaalta'] = KSQLT(date('Y-m-d'));
                $sqlInsert = MYSQL::BuildSQLInsert('clientes',$insert);
                $r = $db->query($sqlInsert);
                unset($insert);
                
                $sql = 'SELECT id FROM clientes ORDER BY id DESC LIMIT 1';
                $cliente_id = $db->QSV($sql,MYSQL_ASSOC);
                $_SESSION['cliente_id'] = $cliente_id;
                $_SESSION['cliente_email'] = $pedido_email;
                $_SESSION['cliente_logeado'] = TRUE;

                $email = new PHPMailer;
                $email->CharSet = 'UTF-8';
                $mensaje = 'Gracias <strong>' . $pedido_nombre . ' ' . $pedido_apellido . '</strong> por registrarte en Al vino vino. Tu cuenta está lista para ser usada, ya podés comenzar a comprar!';
                $email->ClearAddresses();
                $email->addAddress($pedido_email, $pedido_nombre . ', ' . $pedido_apellido);
                $email->setFrom('info@elvinovino.com', 'Al vino vino');
                $email->Body = eregi_replace("\n", "<br />", $mensaje);
                $email->AltBody = $mensaje;
                $email->Subject = 'Gracias por registrarte - Al vino vino';
                if (!$email->send()) {
                    echo "<script>alert('Hubo un error: " . $email->ErrorInfo . "');</script>";
                }
            }
        }

        $datos = 'Nombre:' . $pedido_nombre . '|Apellido:' . $pedido_apellido . '|Teléfono:' . $pedido_telefono . '|Email:' . $pedido_email . '|Localidad:' . $pedido_ciudad . '|Domicilio:' . $pedido_direccion . '|Provincia:' . $pedido_provincia;

        if($error == FALSE) {
            $insert['id'] = KSQLT('');
            $insert['cliente'] = KSQLT($_SESSION['cliente_id']);
            $insert['obs'] = KSQLT($datos);
            $insert['fecha'] = KSQLT(date('Y-m-d H:i:s'));
            $sqlInsert = MYSQL::BuildSQLInsert('pedidos',$insert);
            $r = $db->query($sqlInsert);
            
            $sql = 'SELECT id FROM pedidos ORDER BY id DESC LIMIT 1';
            $pedido_id = $db->QSV($sql,MYSQL_ASSOC);
            unset($insert);

            for($i=0;$i<count($_SESSION['carrito']);$i++) {
                $insert['id'] = KSQLT('');
                $insert['codigo'] = KSQLT($_SESSION['carrito'][$i]['carrito_codigo']);
                $insert['titulo'] = KSQLT($_SESSION['carrito'][$i]['carrito_nombre']);
                $insert['cantidad'] = KSQLT($_SESSION['carrito'][$i]['carrito_cantidad']);
                $insert['precio'] = KSQLT($_SESSION['carrito'][$i]['carrito_precio']);
                $insert['obs'] = KSQLT($_SESSION['carrito'][$i]['carrito_tipo']);
                $insert['nro_pedido'] = KSQLT($pedido_id);
                $sqlInsert = MYSQL::BuildSQLInsert('detalle_pedidos',$insert);
                $r = $db->query($sqlInsert);
            }

            $email = new PHPMailer;
            $email->CharSet = 'UTF-8';
            $mensaje = '<strong>' . $pedido_nombre . ' ' . $pedido_apellido . ':</strong><br>Su pedido está siendo procesado, gracias. Nos pondremos en contacto con usted a la brevedad.';
            $email->ClearAddresses();
            $email->addAddress($pedido_email, $pedido_nombre . ', ' . $pedido_apellido);
            $email->setFrom('info@elvinovino.com', 'Al vino vino');
            $email->Body = eregi_replace("\n", "<br />", $mensaje);
            $email->AltBody = $mensaje;
            $email->Subject = 'Su pedido está siendo procesado';
            if (!$email->send()) {
                echo "<script>alert('Hubo un error: " . $email->ErrorInfo . "');</script>";
            }

            unset($_SESSION['carrito']);
            $msg = 'Gracias. Su pedido fue guardado correctamente y será procesado en breve. Nos pondremos en contacto con usted';
        }
    }
?>
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Finalizar pedido</h1>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?
                    if(count($_SESSION['carrito']) > 0) {
                        if(!isset($_POST['realizar_pedido']) OR (isset($_POST['realizar_pedido']) AND $error == TRUE)) {
                            if($error == TRUE) {
                                echo alertBS($msg);
                            }
                ?> 
                <p class="text-muted lead">Está por cerrar su pedido con <?=count($_SESSION['carrito']);?> producto/s en su carrito</p>
                <div id="basket">
                    <div class="box">
                        <form method="post" action="">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Producto</th>
                                            <th>Cantidad</th>
                                            <th>P. unitario</th>
                                            <th>Subtotal</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?
                                            $total_carro = 0;
                                            for($i=0;$i<count($_SESSION['carrito'][$i]);$i++) {
                                                $subtotal = number_format($_SESSION['carrito'][$i]['carrito_precio'] * $_SESSION['carrito'][$i]['carrito_cantidad'], '2', '.', '');
                                        ?>
                                        <tr class="producto<?=$_SESSION['carrito'][$i]['carrito_id'] . '-' . $_SESSION['carrito'][$i]['carrito_tipo']; ?>">
                                            <td>
                                                <a href="#">
                                                    <?php
                                                        if(file_exists('fotos/productos/' . $_SESSION['carrito'][$i]['carrito_id'] . '.jpg')) {
                                                    ?>
                                                    <img src="fotos/productos/<?=$_SESSION['carrito'][$i]['carrito_id']; ?>.jpg" class="img-responsive" alt="<?=$_SESSION['carrito'][$i]['carrito_nombre'];?>">
                                                    <?php
                                                        } else {
                                                    ?>
                                                    <img src="fotos/productos/default.jpg" class="img-responsive" alt="<?=utf8_encode($_SESSION['carrito'][$i]['carrito_nombre']);?>">
                                                    <?php
                                                        }
                                                    ?>
                                                </a>
                                            </td>
                                            <td><a href="producto/<?=$_SESSION['carrito'][$i]['carrito_id']?>/<?=amigable($_SESSION['carrito'][$i]['carrito_nombre']);?>"><?=$_SESSION['carrito'][$i]['carrito_nombre'];?></a>
                                            </td>
                                            <td>
                                                <input style="width: 80px; text-align: left; line-height: 25px; display: inline-block;" class="cantidad form-control" type="number" value="<?=$_SESSION['carrito'][$i]['carrito_cantidad']?>" data-id="<?=$_SESSION['carrito'][$i]['carrito_id']?>" data-tipo="<?=$_SESSION['carrito'][$i]['carrito_tipo']?>">&nbsp;&nbsp;&nbsp;&nbsp;<i style="line-height: 25px; display: inline-block;" class="fa fa-refresh recargar"></i>
                                            </td>
                                            <td>$<?=number_format($_SESSION['carrito'][$i]['carrito_precio'], '2', '.', '');?></td>
                                            <td class="subtotal">$<?=number_format($_SESSION['carrito'][$i]['carrito_precio'] * $_SESSION['carrito'][$i]['carrito_cantidad'], '2', '.', '');?></td>
                                            <td><a style="cursor: pointer;"><i data-id="<?=$_SESSION['carrito'][$i]['carrito_id'];?>" data-tipo="<?=$_SESSION['carrito'][$i]['carrito_tipo'];?>" class="eliminar-producto fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                        <?
                                                $total_carro = number_format($subtotal + $total_carro, '2', '.', '');
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-right" colspan="4">Total</th>
                                            <th id="total" colspan="2">$<?=$total_carro?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                                <script>
                                    $(document).ready(function() {
                                        $('.cantidad').keypress(function(a){   
                                            if(a.which == 13){   
                                                a.preventDefault();   
                                                if($(this).val() > '0') {
                                                    var id = $(this).attr('data-id');
                                                    var tipo = $(this).attr('data-tipo');
                                                    var cantidad = $(this).val();
                                                    var modificar_carrito = 'modificar_carrito'

                                                    $.post('include/ajax.php',{
                                                        carrito_id: id,
                                                        carrito_tipo: tipo,
                                                        carrito_cantidad: cantidad,
                                                        modificar_carrito: modificar_carrito
                                                    },function(e){
                                                        $(".msg-respuesta").html(e);
                                                    });     
                                                }
                                            }   
                                        }); 

                                        $(".cantidad").blur(function() {
                                            var e = jQuery.Event("keydown");
                                            e.which = 13; // Enter
                                            $(".cantidad").trigger(e);
                                        });

                                        $(".cantidad").keydown(function (e) {
                                            if(e.which == 13){  
                                                if($(this).val() > '0') {
                                                    var id = $(this).attr('data-id');
                                                    var tipo = $(this).attr('data-tipo');
                                                    var cantidad = $(this).val();
                                                    var modificar_carrito = 'modificar_carrito'

                                                    $.post('include/ajax.php',{
                                                        carrito_id: id,
                                                        carrito_tipo: tipo,
                                                        carrito_cantidad: cantidad,
                                                        modificar_carrito: modificar_carrito
                                                    },function(es){
                                                        $(".msg-respuesta").html(es);
                                                    });     
                                                }
                                            } 
                                        });

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
                                            });
                                        });
                                        function goBack() {
                                            window.history.back();
                                        }
                                    });
                                </script>
                                <div class="msg-respuesta"></div>
                            </div>
                            <div class="box-footer" style="margin-bottom: 30px;">
                                <div class="pull-left">
                                    <a style="cursor: pointer" onclick="goBack()" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continuar comprando</a>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div id="checkout">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pedido_nombre">Nombre*</label>
                                            <input class="form-control" name="pedido_nombre" type="text" value="<? if(isset($_POST['realizar_pedido'])) { echo $pedido_nombre; } else { echo $c['cliente_nombre']; } ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pedido_apellido">Apellido*</label>
                                            <input class="form-control" name="pedido_apellido" type="text" value="<? if(isset($_POST['realizar_pedido'])) { echo $pedido_apellido; } else { echo $c['cliente_apellido']; } ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pedido_telefono">Teléfono*</label>
                                            <input class="form-control" name="pedido_telefono" type="text" value="<? if(isset($_POST['realizar_pedido'])) { echo $pedido_telefono; } else { echo $c['cliente_telefono']; } ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pedido_email">Email*</label>
                                            <input type="email" class="form-control" name="pedido_email" value="<? if(isset($_POST['realizar_pedido'])) { echo $pedido_email; } else { echo $c['cliente_email']; } ?>" type="text" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pedido_ciudad">Ciudad*</label>
                                            <input class="form-control" name="pedido_ciudad" type="text" value="<? if(isset($_POST['realizar_pedido'])) { echo $pedido_ciudad; } else { echo $c['cliente_localidad']; } ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pedido_direccion">Dirección*</label>
                                            <input class="form-control" name="pedido_direccion" type="text" value="<? if(isset($_POST['realizar_pedido'])) { echo $pedido_direccion; } else { echo $c['cliente_domicilio']; } ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="pedido_provincia">Provincia*</label>
                                            <select class="form-control" name="pedido_provincia" required>
                                                <?
                                                    $sql = 'SELECT * FROM provincia';
                                                    $provincias = $db->QA($sql,MYSQL_ASSOC);

                                                    foreach($provincias as $p) {
                                                        if(isset($_POST['realizar_pedido'])) {
                                                            if($p['cod_prov'] == $pedido_provincia) {
                                                                $selected = 'selected';
                                                            } else {
                                                                $selected = '';
                                                            }
                                                        } else {
                                                            if($p['cod_prov'] == $c['cliente_provincia']) {
                                                                $selected = 'selected';
                                                            } else {
                                                                $selected = '';
                                                            }
                                                        }
                                                ?>
                                                <option value="<?=$p['cod_prov'];?>" <?=$selected;?>><?=$p['provincia'];?></option>
                                                <?
                                                    }
                                                ?> 
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p>Todos los campos son obligatorios</p>
                            <?
                                if($_SESSION['cliente_id'] == '' OR !$_SESSION['cliente_logeado'] == TRUE) {
                            ?>
                            <div class="alert alert-info">Es necesario tener una cuenta para realizar el pedido, por favor, ingrese una clave y será registrado en el sistema sin pasos adicionales</div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="pedido_ciudad">Clave*</label>
                                        <input class="form-control" name="cliente_clave" type="password" required>
                                    </div>
                                </div>
                            </div>
                            <?
                                }
                            ?>
                            <div class="box-footer">
                                <div class="pull-right">
                                    <button type="submit" name="realizar_pedido" class="btn btn-template-main">Realizar pedido <i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?
                        } else {
                            echo alertBS($msg, 'success');
                        }
                    } else {
                        echo '<div class="alert alert-danger">Debe agregar un producto para finalizar el pedido</div>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>