<?php
    require('lib/PHPMailer/class.phpmailer.php');
    require('lib/PHPMailer/PHPMailerAutoload.php');

    if(isset($_POST['olvide_enviar'])) {
        $olvide_email = LV($_POST['olvide_email']);
        //$contar = $db->CountRows('clientes', 'email = "' . $olvide_email . '"');

        $sql = 'SELECT COUNT(*) FROM tbl_clientes WHERE clientes_email = "' . $olvide_email . '"';
        $contar = $db->QSV($sql);

        if($contar > 0) {
            $sql = 'SELECT * FROM tbl_clientes WHERE clientes_email = "' . $olvide_email . '"';
            $r = $db->QSRA($sql);

            $clave_nueva = generateRandomString(10);
            $w = 'clientes_email = "' . $olvide_email . '"';
            $update['clientes_clave'] = md5($clave_nueva);
            $q = $db->UPDATEJ('tbl_clientes', $update, $w);
            
            /*$sqlUpdate = MYSQL::BuildSQLUpdate('tbl_clientes',$update,$w);
            $q = $db->query($sqlUpdate);*/

            $email = new PHPMailer;
            $email->CharSet = 'UTF-8';
            $mensaje = 'Hola <strong>' . $r['nombre'] . ' ' . $r['apellido'] . '</strong><br>';
            /*$mensaje.= 'Para cambiar su clave, ingrese al siguiente enlace: <a href="' . $pathSiteHome . 'olvide-clave/' . $codigo . '">RECUPERAR CLAVE</a><br>';
            $mensaje.= 'Si usted no solicitó el cambio de clave, por favor ignore este mensaje';*/
            $mensaje = 'Usted solicitó un cambio de clave en nuestro sitio.<br><br>';
            $mensaje.= '<span style="font-weight: bold;">Nueva clave:</span> ' . $clave_nueva;
            $email->ClearAddresses();
            $email->addAddress($olvide_email, $r['nombre'] . ', ' . $r['apellido']);
            $email->setFrom('info@amurrioperfumerias.com.ar', 'Amurrio Perfumerias');
            $email->Body = str_replace("\n", "<br />", $mensaje);
            $email->AltBody = $mensaje;
            $email->Subject = 'Cambio de clave';
            if (!$email->send()) {
                echo "<script>alert('Hubo un error: " . $email->ErrorInfo . "');</script>";
            }
        } else {
            $error = TRUE;
            $msg = 'Email incorrecto';
        }
    }
?>

<script>$('.nav-entrar').addClass('active');</script>

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1><?=$titulo_pag;?></h1>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <?
                if($_SESSION['cliente_id'] == '' OR $_SESSION['cliente_logeado'] == FALSE) {
                    if($parametros[1] == '') {
                        if(!isset($_POST['olvide_enviar']) OR (isset($_POST['olvide_enviar']) AND $error == TRUE)) {
            ?>
            <h3>Recuperar clave</h3>
            Para obtener una nueva clave ingrese su email.
            <?
                if($error == TRUE) {
                    echo alertBS($msg);
                }
            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Email</label>
                    <input class="form-control" type="email" name="olvide_email">
                </div>
                <button type="submit" name="olvide_enviar" class="btn btn-primary-theme">Recuperar clave</button> 
                <div style="clear: both; margin-bottom: 20px;"></div>
            </form>
            <?
                        } else {
                            echo alertBS('Revisa tu casilla de email! No olvides revisar la bandeja de spam', 'success');
                        }
                    } elseif($parametros[1] != '' AND $codigook == TRUE) {
            ?>
            <form action="" method="POST">
                <div class="form-group">
                    <label>Nueva clave</label>
                    <input class="form-control" type="email" name="olvide_email">
                </div>
                <button type="submit" name="olvide_enviar" class="btn btn-primary-theme">Recuperar clave</button> 
                <div style="clear: both; margin-bottom: 20px;"></div>
            </form>
            <?
                    }
                } else {
                    echo alertBS('Usted ya está logeado');
                }
            ?>
        </div>
    </div>
</div>