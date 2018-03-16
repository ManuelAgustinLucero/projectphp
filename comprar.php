    <?php
    require('lib/PHPMailer/class.phpmailer.php');
    require('lib/PHPMailer/PHPMailerAutoload.php');

    $producto_id = LV($parametros[1]);
    $producto_titulo = LV($parametros[2]);

    $sql = 'SELECT tbl_productos.productos_id as producto_id,
                    tbl_productos.productos_titulo as producto_titulo,
                    tbl_productos.productos_fecha_alta as producto_fecha,
                    tbl_productos.productos_codigo as producto_codigo,
                    tbl_productos.productos_id as producto_id,
                    tbl_productos.productos_precio as producto_precio,
                    tbl_cat_productos.cat_productos_id as cat_id,
                    tbl_cat_productos.cat_productos_titulo as cat_titulo,
                    tbl_cat_productos.cat_productos_titulo_corto as cat_titulocorto
             FROM tbl_productos LEFT JOIN tbl_cat_productos ON tbl_productos.productos_categoria = tbl_cat_productos.cat_productos_id WHERE tbl_productos.productos_id = "' . $producto_id . '" AND tbl_productos.productos_estado = "1"';
    $p_s = $db->QSRA($sql);

    if(isset($_POST['realizar_pedido'])) {
        function post_captcha($user_response) {
            global $captcha_secret;
            $fields_string = '';
            $fields = array(
                'secret' => $captcha_secret,
                'response' => $user_response
            );
            foreach($fields as $key=>$value)
            $fields_string .= $key . '=' . $value . '&';
            $fields_string = rtrim($fields_string, '&');

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($ch, CURLOPT_POST, count($fields));
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);

            $result = curl_exec($ch);
            curl_close($ch);

            return json_decode($result, true);
        }

        $pedido_producto = LV($p_s['producto_titulo']);
        $pedido_cantidad = LV($_POST['pedido_cantidad']);
        $pedido_nombre = LV($_POST['pedido_nombre']);
        $pedido_apellido = LV($_POST['pedido_apellido']);
        $pedido_telefono = LV($_POST['pedido_telefono']);
        $pedido_email = LV($_POST['pedido_email']);
        $pedido_ciudad = LV($_POST['pedido_ciudad']);
        $pedido_direccion = LV($_POST['pedido_direccion']);
        $pedido_provincia = LV($_POST['pedido_provincia']);
        $cliente_clave = LV($_POST['cliente_clave']);
        $res_captcha = post_captcha($_POST['g-recaptcha-response']);

        if(!$res_captcha['success']) {
            $error = TRUE;
            $msg = 'Por favor, verifique que no es un robot';
        }

        if($pedido_cantidad == '' OR $pedido_nombre == '' OR $pedido_apellido == '' OR $pedido_telefono == '' OR $pedido_email == '' OR $pedido_ciudad == '' OR $pedido_direccion == '') {
            $error = TRUE;
            $msg = 'Por favor complete los campos vacíos';
        }

        /*$contar = $db->CountRows('provincia', 'cod_prov = "' . $pedido_provincia . '"');
        if($contar == 0) {
            $error = TRUE;
            $msg = 'Seleccione una provincia existente';
        }*/

        $sql = 'SELECT provincias_provincia FROM tbl_provincias WHERE provincias_cod_prov = "' . $pedido_provincia . '"';
        $pedido_prov = $db->QSV($sql);

        if($pedido_prov == '') {
            $error = TRUE;
            $msg = 'Provincia incorrecta';
        } else {
            $pedido_provincia = $pedido_prov;
        }

        if(validarEmail($pedido_email) == FALSE) {
            $error = TRUE;
            $msg = 'Por favor ingrese un email válido';
        }

        if($error == FALSE) {
            /*$insert['id'] = KSQLT('');
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
            }*/

            $email = new PHPMailer;
            $email->CharSet = 'UTF-8';
            $mensaje = '<strong>' . $pedido_nombre . ' ' . $pedido_apellido . ':</strong><br>Su consulta está siendo procesada, gracias. Nos pondremos en contacto con usted a la brevedad.';
            $email->ClearAddresses();
            $email->addAddress($pedido_email, $pedido_nombre . ' ' . $pedido_apellido);
            $email->setFrom('info@amurrioperfumerias.com.ar', 'Amurrio Perfumerías');
            $email->Body = $mensaje;
            $email->AltBody = $mensaje;
            $email->Subject = 'Su pedido está siendo procesado';
            if (!$email->send()) {
                echo "<script>alert('Hubo un error: " . $email->ErrorInfo . "');</script>";
            }

            $mensaje_guardar = 'Nuevo pedido de: <strong>' . $pedido_nombre . ' ' . $pedido_apellido . '</strong>.<br>';
            $mensaje_guardar.= 'Producto: ' . $p_s['producto_titulo'] . '<br>';
            if($modulo_productos_muestra_precio == 1) {
                    $mensaje_guardar.= 'Precio: $' . $p_s['producto_precio'] . '<br>';
            }
            $mensaje_guardar.= 'Cantidad: ' . $pedido_cantidad . '<br>';
            if($modulo_productos_muestra_precio == 1) {
                $mensaje_guardar.= '<strong>Total: $' . $p_s['producto_precio'] * $pedido_cantidad . '</strong><br><br>';
            } else {
                echo '<br>';
            }

            $mensaje = $mensaje_guardar;
            $mensaje.= 'Teléfono: ' . $pedido_telefono . '<br>';
            $mensaje.= 'Email: ' . $pedido_email . '<br>';
            $mensaje.= 'Provincia: ' . $pedido_provincia . '<br>';
            $mensaje.= 'Ciudad: ' . $pedido_ciudad . '<br>';
            $mensaje.= 'Dirección: ' . $pedido_direccion . '<br>';
            $email->ClearAddresses();
            $email->addAddress($contacto_destinatario1);
            //$email->addAddress('juliannnwb@gmail.com');
            $email->setFrom('info@amurrioperfumerias.com.ar', 'Amurrio Perfumerías');
            $email->Body = $mensaje;
            $email->AltBody = $mensaje;
            $email->Subject = 'Nuevo pedido realizado';
            if (!$email->send()) {
                echo "<script>alert('Hubo un error: " . $email->ErrorInfo . "');</script>";
            }

            $insert['consultas_nombre'] = $pedido_nombre . ' ' . $pedido_apellido;
            $insert['consultas_telefono'] = $pedido_telefono;
            $insert['consultas_email'] = $pedido_email;
            $insert['consultas_empresa'] = $pedido_empresa;
            $insert['consultas_pais'] = $pedido_pais;
            $insert['consultas_provincia'] = $pedido_provincia;
            $insert['consultas_codigo_postal'] = $pedido_cpostal;
            $insert['consultas_direccion'] = $pedido_direccion;
            $insert['consultas_asunto'] = 'Consulta sobre el producto ' . $p_s['producto_titulo'];
            $insert['consultas_consulta'] = $mensaje_guardar;
            $insert['consultas_fecha'] = date('Y-m-d H:i:s');
            $insert['consultas_estado'] = '1';
            if($enviook == TRUE) {
                $insert['consultas_enviado'] = '1';
            } else {
                $insert['consultas_enviado'] = '0';
            }
            $i = $db->INSERTJ('tbl_consultas', $insert);

            $msg = 'Gracias. Su pedido fue guardado correctamente y será procesado en breve. Nos pondremos en contacto con usted';
        }
    }
?>
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Consultar artículo</h1>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?
                        if(!isset($_POST['realizar_pedido']) OR (isset($_POST['realizar_pedido']) AND $error == TRUE)) {
                            if($error == TRUE) {
                                echo alertBS($msg);
                            }
                ?> 
                <p class="text-muted lead">Está a punto de consultar el producto "<strong><?=$p_s['producto_titulo'];?></strong>" <? if($modulo_productos_muestra_precio == 1) { ?> ($<?=$p_s['producto_precio']?> x u.) <? } ?></p>
                <div id="basket">
                    <div class="box">
                        <form method="post" action="">
                            <div id="checkout">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pedido_nombre">Cantidad*</label>
                                            <input class="form-control" name="pedido_cantidad" type="number" value="<? if(isset($_POST['realizar_pedido'])) { echo $pedido_cantidad; } else { echo '1'; } ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pedido_nombre">Nombre*</label>
                                            <input class="form-control" name="pedido_nombre" type="text" value="<? if(isset($_POST['realizar_pedido'])) { echo $pedido_nombre; } else { echo $c['cliente_nombre']; } ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pedido_apellido">Apellido*</label>
                                            <input class="form-control" name="pedido_apellido" type="text" value="<? if(isset($_POST['realizar_pedido'])) { echo $pedido_apellido; } else { echo $c['cliente_apellido']; } ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pedido_telefono">Teléfono*</label>
                                            <input class="form-control" name="pedido_telefono" type="text" value="<? if(isset($_POST['realizar_pedido'])) { echo $pedido_telefono; } else { echo $c['cliente_telefono']; } ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pedido_email">Email*</label>
                                            <input type="email" class="form-control" name="pedido_email" value="<? if(isset($_POST['realizar_pedido'])) { echo $pedido_email; } else { echo $c['cliente_email']; } ?>" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pedido_ciudad">Ciudad*</label>
                                            <input class="form-control" name="pedido_ciudad" type="text" value="<? if(isset($_POST['realizar_pedido'])) { echo $pedido_ciudad; } else { echo $c['cliente_localidad']; } ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pedido_direccion">Dirección*</label>
                                            <input class="form-control" name="pedido_direccion" type="text" value="<? if(isset($_POST['realizar_pedido'])) { echo $pedido_direccion; } else { echo $c['cliente_domicilio']; } ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="pedido_provincia">Provincia*</label>
                                            <select class="form-control" name="pedido_provincia" required>
                                                <?
                                                    $sql = 'SELECT * FROM tbl_provincias';
                                                    $provincias = $db->QA($sql,MYSQL_ASSOC);

                                                    foreach($provincias as $p) {
                                                        if(isset($_POST['realizar_pedido'])) {
                                                            if($p['provincias_cod_prov'] == $pedido_provincia) {
                                                                $selected = 'selected';
                                                            } else {
                                                                $selected = '';
                                                            }
                                                        } else {
                                                            if($p['provincias_cod_prov'] == $c['cliente_provincia']) {
                                                                $selected = 'selected';
                                                            } else {
                                                                $selected = '';
                                                            }
                                                        }
                                                ?>
                                                <option value="<?=$p['provincias_cod_prov'];?>" <?=$selected;?>><?=$p['provincias_provincia'];?></option>
                                                <?
                                                    }
                                                ?> 
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <p>Todos los campos son obligatorios</p>
                            <div class="box-footer">
                                <div class="pull-left">
                                    <div class="g-recaptcha" data-sitekey="<?php echo $captcha_sitekey; ?>" style="text-align: center;"></div>
                                </div>
                                <div class="pull-right">
                                    <button type="submit" name="realizar_pedido" class="btn btn-template-main">Realizar consulta <i class="fa fa-chevron-right"></i>
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
                ?>
            </div>
        </div>
    </div>
</div>