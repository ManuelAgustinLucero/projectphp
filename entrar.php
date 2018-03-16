<?php
    require('lib/PHPMailer/class.phpmailer.php');
    require('lib/PHPMailer/PHPMailerAutoload.php');

    if(isset($_POST['entrar'])) {
        $cliente_email = LV($_POST['cliente_email']);
        $cliente_clave = md5(LV($_POST['cliente_clave']));

        $sql = 'SELECT COUNT(*) FROM tbl_clientes WHERE clientes_clave = "' . $cliente_clave . '" AND clientes_email = "' . $cliente_email . '" AND clientes_estado = "1"';
        $contar = $db->QSV($sql);
        //$contar = $db->CountRows('tbl_clientes', 'clientes_clave = "' . $cliente_clave . '" AND clientes_email = "' . $cliente_email . '" AND clientes_estado = "1"');
        
        if($contar > 0) {
            $sql = 'SELECT * FROM tbl_clientes WHERE clientes_clave = "' . $cliente_clave . '" AND clientes_email = "' . $cliente_email . '" AND clientes_estado = "1"';
            $r = $db->QSRA($sql,MYSQL_ASSOC);

            $_SESSION['cliente_id'] = $r['clientes_id'];
            $_SESSION['cliente_email'] = $r['clientes_email'];
            $_SESSION['cliente_nombre'] = $r['clientes_nombre'];
            $_SESSION['cliente_apellido'] = $r['clientes_apellido'];
            $_SESSION['cliente_logeado'] = TRUE;

            $msg = 'Ya puede ver la sección de descargas. Será redireccionado en breve';

            if($redireccion_al_entrar != '') {
                echo redirect($pathSiteHome . $redireccion_al_entrar, 1);
            }
        } else {
            $error = TRUE;
            $msg = 'Email o clave incorrectos';
        }
    }

    if(isset($_POST['registro'])) {
        $cliente_nombre = LV($_POST['cliente_nombre']);
        $cliente_apellido = LV($_POST['cliente_apellido']);
        $cliente_telefono = LV($_POST['cliente_telefono']);
        $cliente_domicilio = LV($_POST['cliente_domicilio']);
        $cliente_email = LV($_POST['cliente_email']);
        $cliente_clave = LV($_POST['cliente_clave']);

        if($cliente_nombre == '' OR $cliente_apellido == '' OR $cliente_telefono == '' OR $cliente_email == '' OR $cliente_clave == '') {
            $error = TRUE;
            $msg = 'Por favor complete los campos obligatorios (*)';
        }

        if(validarEmail($cliente_email) == FALSE) {
            $error = TRUE;
            $msg = 'Por favor ingrese un email válido';
        }

        $sql = 'SELECT COUNT(*) FROM tbl_clientes WHERE clientes_email = "' . $cliente_email . '"';
        $contar = $db->QSV($sql);
        //$contar = $db->CountRows('clientes', 'email = "' . $cliente_email . '"');
        if($contar > 0) {
            $error = TRUE;
            $msg = 'El email ingresado está en uso';
        }

        if(trim($cliente_clave) == '' OR strlen(trim($cliente_clave)) < 6) {
            $error = TRUE;
            $msg = 'La clave debe contener al menos 6 carácteres';
        }

        if($error == FALSE) {
            $insert['clientes_id'] = '';
            $insert['clientes_nombre'] = $cliente_nombre;
            $insert['clientes_apellido'] = $cliente_apellido;
            $insert['clientes_telefono'] = $cliente_telefono;
            $insert['clientes_domicilio'] = $cliente_domicilio;
            $insert['clientes_email'] = $cliente_email;
            $insert['clientes_clave'] = md5($cliente_clave);
            $insert['clientes_fecha_alta'] = date('Y-m-d');
            $r = $db->INSERTJ('tbl_clientes', $insert);
            /*$sqlInsert = MYSQL::BuildSQLInsert('clientes',$insert);
            $r = $db->query($sqlInsert);*/

            $msg = 'Ya puede iniciar sesión con su cuenta';

            //echo refresh();

            $email = new PHPMailer;
            $email->CharSet = 'UTF-8';
            $mensaje = 'Gracias por registrarte en Amurrio Perfumerías. Tu cuenta está lista para ser usada, ya podés iniciar sesión y ver nuestra sección de descargas!';
            $email->ClearAddresses();
            $email->setFrom($contacto_destinatario1);
            $email->addAddress($cliente_email, $cliente_nombre . ', ' . $cliente_apellido);
            $email->Body = str_replace("\n", "<br />", $mensaje);
            $email->AltBody = $mensaje;
            $email->Subject = 'Gracias por registrarte - Amurrio Perfumerías';
            if (!$email->send()) {
                echo "<script>alert('Hubo un error: " . $email->ErrorInfo . "');</script>";
            }
        }
    }
?>
<script>$('.nav-entrar').addClass('active');</script>
<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Entrar</h1>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="box">
                    <h2 class="text-uppercase">Iniciar sesión</h2>
                    <p class="lead">¿Ya tiene una cuenta?</p>
                    <p>Si ya tiene su cuenta inicie sesión para comenzar a realizar pedidos</p>
                    <hr>
                    <?
                        if(!isset($_POST['entrar']) OR (isset($_POST['entrar']) AND $error == TRUE)) {
                            if(isset($_POST['entrar']) AND $error == TRUE) {
                                echo alertBS($msg);
                            }
                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="cliente_email">Email*</label>
                            <input class="form-control" id="cliente_email" name="cliente_email" type="email" required>
                        </div>
                        <div class="form-group">
                            <label for="cliente_clave">Clave*</label>
                            <input class="form-control" id="cliente_clave" name="cliente_clave" type="password" required>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12 text-center" style="margin-bottom: 10px">
                            <a href="olvide-clave">¿Olvidaste tu clave?</a>
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12"  style="margin-bottom: 10px">
                            <div class="text-center">
                                <button type="submit" name="entrar" class="btn btn-template-main"><i class="fa fa-sign-in"></i> Entrar</button>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                    </form>
                    <?
                        } elseif(isset($_POST['entrar']) AND $error == FALSE) {
                            echo alertBS($msg, 'success');
                        }
                    ?>
                </div>
            </div>
            <div class="col-md-6">
                <div class="box">
                    <h2 class="text-uppercase">Nueva cuenta</h2>
                    <p class="lead">¿Aún no está registrado?</p>
                    <p>No deje de perderse las novedades que tenemos para usted, y no olvides que es necesario tener una cuenta para ver la sección de descargas, registrarse es fácil y rápido</p>
                    <hr>
                    <?
                        if(!isset($_POST['registro']) OR (isset($_POST['registro']) AND $error == TRUE)) {
                            if(isset($_POST['registro']) AND $error == TRUE) {
                                echo alertBS($msg);
                            }
                    ?>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="cliente_nombre">Nombre*</label>
                            <input class="form-control" id="cliente_nombre" name="cliente_nombre" type="text" value="<?=$cliente_nombre?>" required>
                        </div>
                        <div class="form-group">
                            <label for="cliente_apellido">Apellido*</label>
                            <input class="form-control" id="cliente_apellido" name="cliente_apellido" type="text" value="<?=$cliente_apellido?>" required>
                        </div>
                        <div class="form-group">
                            <label for="cliente_telefono">Teléfono*</label>
                            <input class="form-control" id="cliente_telefono" name="cliente_telefono" type="text" value="<?=$cliente_telefono?>" required>
                        </div>
                        <div class="form-group">
                            <label for="cliente_domicilio">Domicilio</label>
                            <input class="form-control" id="cliente_domicilio" name="cliente_domicilio" type="text" value="<?=$cliente_domicilio?>">
                        </div>
                        <div class="form-group">
                            <label for="cliente_email">Email*</label>
                            <input class="form-control" id="cliente_email" name="cliente_email" type="email" value="<?=$cliente_email?>" required>
                        </div>
                        <div class="form-group">
                            <label for="cliente_clave">Clave*</label>
                            <input class="form-control" id="cliente_clave" name="cliente_clave" type="password" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" name="registro" class="btn btn-template-main"><i class="fa fa-user"></i> Registrar</button>
                        </div>
                    </form>
                    <?
                        } elseif(isset($_POST['registro']) AND $error == FALSE) {
                            echo alertBS($msg, 'success');
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>