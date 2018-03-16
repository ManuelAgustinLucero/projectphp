<?php
	if($contacto_muestra_captcha == 1) {
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
	}

    if(isset($_POST['contacto_enviar'])) {
    	$contacto_nombre = LV($_POST['contacto_nombre']);
    	$contacto_telefono = LV($_POST['contacto_telefono']);
    	$contacto_email = LV($_POST['contacto_email']);
    	$contacto_empresa = LV($_POST['contacto_empresa']);
    	$contacto_pais = LV($_POST['contacto_pais']);
    	$contacto_provincia = LV($_POST['contacto_provincia']);
    	$contacto_cpostal = LV($_POST['contacto_cpostal']);
    	$contacto_direccion = LV($_POST['contacto_direccion']);
    	$contacto_asunto = LV($_POST['contacto_asunto']);
    	$contacto_mensaje = LV($_POST['contacto_mensaje']);
    	if($contacto_muestra_captcha == 1) {
    		$res_captcha = post_captcha($_POST['g-recaptcha-response']);
    	}

		if($contacto_muestra_captcha == 1) {
	    	if(!$res_captcha['success']) {
	    		$error = TRUE;
	    		$msg = 'Por favor, verifique que no es un robot';
	    	}
	    }

	    if($contacto_muestra_provincia == 1) {
		    //$contar = $db->CountRows('tbl_provincias', 'provincias_cod_prov = "' . $contacto_provincia . '"');

		    $sql = 'SELECT COUNT(*) FROM tbl_provincias WHERE provincias_cod_prov = "' . $contacto_provincia . '"';
		    $contar = $db->QSV($sql);

		    if($contar == 0) {
		    	$error = TRUE;
		    	$msg = 'Seleccione una provincia correcta';
		    } else {
		    	$sql = 'SELECT provincias_provincia FROM tbl_provincias WHERE provincias_cod_prov = "' . $contacto_provincia . '"';
		    	$provincia_nombre = $db->QSV($sql,MYSQL_ASSOC);
		    }
	    }

    	if($error == FALSE) {
    		require('lib/PHPMailer/class.phpmailer.php');
            require('lib/PHPMailer/PHPMailerAutoload.php');

            if(trim($contacto_nombre) == '') {
            	$contacto_nombre = '-';
            }

            if(trim($contacto_email) == '') {
            	$contacto_email = '-';
            }

            if(trim($contacto_empresa) == '') {
            	$contacto_empresa = '-';
            }

            if(trim($contacto_pais) == '') {
            	$contacto_pais = '-';
            }

            if(trim($contacto_provincia) == '') {
            	$contacto_provincia = '-';
            }

            if(trim($contacto_cpostal) == '') {
            	$contacto_cpostal = '-';
            }

            if(trim($contacto_direccion) == '') {
            	$contacto_direccion = '-';
            }

            if(trim($contacto_asunto) == '') {
            	$contacto_asunto = '-';
            }

            if(trim($contacto_mensaje) == '') {
            	$contacto_mensaje = '-';
            }

            if($contacto_muestra_nombre == 1) {
            	$mensaje.= '<span style="font-weight: bold;">Nombre:</span> ' . $contacto_nombre . '<br>';
           	}

            if($contacto_muestra_telefono == 1) {
            	$mensaje.= '<span style="font-weight: bold;">Teléfono:</span> ' . $contacto_telefono . '<br>';
        	}

            if($contacto_muestra_email == 1) {
            	$mensaje.= '<span style="font-weight: bold;">Email:</span> ' . $contacto_email . '<br>';
        	}

            if($contacto_muestra_empresa == 1) {
            	$mensaje.= '<span style="font-weight: bold;">Empresa:</span> ' . $contacto_empresa . '<br>';
        	}

            if($contacto_muestra_pais == 1) {
            	$mensaje.= '<span style="font-weight: bold;">País:</span> ' . $contacto_pais . '<br>';
        	}

            if($contacto_muestra_provincia == 1) {
            	$mensaje.= '<span style="font-weight: bold;">Provincia:</span> ' . $provincia_nombre . '<br>';
        	}

            if($contacto_muestra_cpostal == 1) {
            	$mensaje.= '<span style="font-weight: bold;">Código postal:</span> ' . $contacto_cpostal . '<br>';
        	}

            if($contacto_muestra_direccion == 1) {
            	$mensaje.= '<span style="font-weight: bold;">Direccion:</span> ' . $contacto_direccion . '<br>';
        	}

            if($contacto_muestra_asunto == 1) {
            	$mensaje.= '<span style="font-weight: bold;">Asunto:</span> ' . $contacto_asunto . '<br>';
        	}
            $mensaje.= $contacto_mensaje;
            $mensaje = str_replace('\r', '', $mensaje);

            $email = new PHPMailer;
            $email->CharSet = 'UTF-8';
            $email->setFrom($contacto_email);
            $email->addAddress($contacto_destinatario1);
            //$email->addAddress('juliannnwb@gmail.com');
            $email->Body = str_replace('\n', '<br>', $mensaje);
            $email->IsHTML(true);
            $email->AltBody = $mensaje;
            $email->Subject = 'Contacto web - Amurrio Perfumerías';
            if (!$email->send()) {
                echo "<script>alert('Hubo un error: " . $email->ErrorInfo . "');</script>";
                $enviook = FALSE;
            } else {
            	$enviook = TRUE;
            }

	    	/*$insert['consultas_nombre'] = KSQLT($contacto_nombre);
	    	$insert['consultas_telefono'] = KSQLT($contacto_telefono);
	    	$insert['consultas_email'] = KSQLT($contacto_email);
	    	$insert['consultas_empresa'] = KSQLT($contacto_empresa);
	    	$insert['consultas_pais'] = KSQLT($contacto_pais);
	    	$insert['consultas_provincia'] = KSQLT($contacto_provincia);
	    	$insert['consultas_codigo_postal'] = KSQLT($contacto_cpostal);
	    	$insert['consultas_direccion'] = KSQLT($contacto_direccion);
	    	$insert['consultas_asunto'] = KSQLT($contacto_asunto);
	    	$insert['consultas_consulta'] = KSQLT($contacto_mensaje);
	    	$insert['consultas_fecha'] = KSQLT(date('Y-m-d H:i:s'));
	    	$insert['consultas_estado'] = KSQLT('1');
	    	if($enviook == TRUE) {
	    		$insert['consultas_enviado'] = KSQLT('1');
	    	} else {
	    		$insert['consultas_enviado'] = KSQLT('0');
	    	}
	    	$sqlInsert = MYSQL::BuildSQLInsert('tbl_consultas',$insert);
			$i = $db->query($sqlInsert);*/

			$insert['consultas_nombre'] = $contacto_nombre;
	    	$insert['consultas_telefono'] = $contacto_telefono;
	    	$insert['consultas_email'] = $contacto_email;
	    	$insert['consultas_empresa'] = $contacto_empresa;
	    	$insert['consultas_pais'] = $contacto_pais;
	    	$insert['consultas_provincia'] = $contacto_provincia;
	    	$insert['consultas_codigo_postal'] = $contacto_cpostal;
	    	$insert['consultas_direccion'] = $contacto_direccion;
	    	$insert['consultas_asunto'] = $contacto_asunto;
	    	$insert['consultas_consulta'] = $contacto_mensaje;
	    	$insert['consultas_fecha'] = date('Y-m-d H:i:s');
	    	$insert['consultas_estado'] = '1';
	    	if($enviook == TRUE) {
	    		$insert['consultas_enviado'] = '1';
	    	} else {
	    		$insert['consultas_enviado'] = '0';
	    	}
	    	$i = $db->INSERTJ('tbl_consultas', $insert);
    	}
    }
?>

<div class="col-md-12">
    <form method="POST" action="">
        <div class="row">
	        <?
	            if(isset($_POST['contacto_enviar']) AND $error == FALSE) {
	            	echo '<div class="col-md-12"><div class="alert alert-success">Gracias por ponerte en contacto con nosotros. Responderemos a la brevedad</div></div>';
	            } else {
	        ?>
		        <?
	                if($contacto_muestra_nombre == 1) {
	                    if($contacto_requiere_nombre == 1) {
	                        $requerido_nombre = '(*)';
	                        $required_nombre = 'required';
	                    }
	            ?>
	            <div class="col-sm-6">
	                <div class="form-group">
	                    <label for="firstname">Nombre <?php echo $requerido_nombre; ?></label>
	                    <input class="form-control" name="contacto_nombre" type="text" <?php echo $required_nombre; ?>>
	                </div>
	            </div>
	            <?php
	                }

	                if($contacto_muestra_telefono == 1) {
	                    if($contacto_requiere_telefono == 1) {
	                        $requerido_telefono = '(*)';
	                        $required_telefono = 'required';
	                    }
	            ?>
	            <div class="col-sm-6">
	                <div class="form-group">
	                    <label for="firstname">Teléfono <?php echo $requerido_telefono; ?></label>
	                    <input class="form-control" name="contacto_telefono" type="text" <?php echo $required_telefono; ?>>
	                </div>
	            </div>
	            <?php
	                }

	                if($contacto_muestra_email == 1) {
	                    if($contacto_requiere_email == 1) {
	                        $requerido_email = '(*)';
	                        $required_email = 'required';
	                    }
	            ?>
	            <div class="col-sm-6">
	                <div class="form-group">
	                    <label for="firstname">Email <?php echo $requerido_email; ?></label>
	                    <input class="form-control" name="contacto_email" type="email" <?php echo $required_email; ?>>
	                </div>
	            </div>
	            <?php
	                }

	                if($contacto_muestra_empresa == 1) {
	                    if($contacto_requiere_empresa == 1) {
	                        $requerido_empresa = '(*)';
	                        $required_empresa = 'required';
	                    }
	            ?>
	            <div class="col-sm-6">
	                <div class="form-group">
	                    <label for="firstname">Empresa <?php echo $requerido_empresa; ?></label>
	                    <input class="form-control" name="contacto_empresa" type="text" <?php echo $required_empresa; ?>>
	                </div>
	            </div>
	            <?php
	                }

	                if($contacto_muestra_pais == 1) {
	                    if($contacto_requiere_pais == 1) {
	                        $requerido_pais = '(*)';
	                        $required_pais = 'required';
	                    }
	            ?>
	            <div class="col-sm-6">
	                <div class="form-group">
	                    <label for="firstname">País <?php echo $requerido_pais; ?></label>
	                    <input class="form-control" name="contacto_pais" type="text" <?php echo $required_pais; ?>>
	                </div>
	            </div>
	            <?php
	                }

	                if($contacto_muestra_provincia == 1) {
	                    if($contacto_requiere_provincia == 1) {
	                        $requerido_provincia = '(*)';
	                        $required_provincia = 'required';
	                    }
	                    $sql = 'SELECT * FROM tbl_provincias';
	                    $provincias = $db->QA($sql);
	            ?>
	            <div class="col-sm-6">
	                <div class="form-group">
	                    <label for="firstname">Provincia <?php echo $requerido_provincia; ?></label>
	                    <select class="form-control" name="contacto_provincia" <?php echo $required_provincia; ?>>
	                    	<option disabled>Seleccionar</option>
	                        <?
	                            foreach($provincias as $p) {
	                                if($contacto_provincia == $p['provincias_cod_prov']) {
	                                    $selected = ' selected';
	                                } else {
	                                	$selected = '';

	                                	if($p['provincias_cod_prov'] == '21') {
	                                		$selected = ' selected';
	                                	} else {
	                                		$selected = '';
	                                	}
	                                }
	                                echo '<option value="' . $p['provincias_cod_prov'] . '" ' . $selected . '>' . $p['provincias_provincia'] . '</option>';
	                            }
	                        ?>
	                    </select>
	                </div>
	            </div>
	            <?php
	                }

	                if($contacto_muestra_cpostal == 1) {
	                    if($contacto_requiere_cpostal == 1) {
	                        $requerido_cpostal = '(*)';
	                        $required_cpostal = 'required';
	                    }
	            ?>
	            <div class="col-sm-6">
	                <div class="form-group">
	                    <label for="firstname">Código postal <?php echo $requerido_cpostal; ?></label>
	                    <input class="form-control" name="contacto_cpostal" type="text" <?php echo $required_cpostal; ?>>
	                </div>
	            </div>
	            <?php
	                }

	                if($contacto_muestra_direccion == 1) {
	                    if($contacto_requiere_direccion == 1) {
	                        $requerido_direccion = '(*)';
	                        $required_direccion = 'required';
	                    }
	            ?>
	            <div class="col-sm-6">
	                <div class="form-group">
	                    <label for="firstname">Dirección <?php echo $requerido_direccion; ?></label>
	                    <input class="form-control" name="contacto_direccion" type="text" <?php echo $required_direccion; ?>>
	                </div>
	            </div>
	            <?php
	                }

	                if($contacto_muestra_asunto == 1) {
	                    if($contacto_requiere_asunto == 1) {
	                        $requerido_asunto = '(*)';
	                        $required_asunto = 'required';
	                    }
	            ?>
	            <div class="col-sm-6">
	                <div class="form-group">
	                    <label for="firstname">Asunto <?php echo $requerido_asunto; ?></label>
	                    <input class="form-control" name="contacto_asunto" type="text" <?php echo $required_asunto; ?>>
	                </div>
	            </div>
	            <?php
	                }
	            ?>
	            <div class="col-sm-12">
	                <div class="form-group">
	                    <label for="message">Mensaje (*)</label>
	                    <textarea id="message" class="form-control" name="contacto_mensaje" required></textarea>
	                </div>
	            </div>
	            <?php
	            	if($error == TRUE) {
	            		echo '<div class="col-md-12"><div class="alert alert-danger"><strong>Error</strong> ' . $msg . '</div></div>';
	            	}

	            	if($contacto_muestra_captcha == 1) {
	            ?>
	            <div class="col-sm-6 text-center">
	                <div class="g-recaptcha" data-sitekey="<?php echo $captcha_sitekey; ?>" style="text-align: center;"></div>
	            </div>
	            <?php
	            	}
	            ?>
	            <input name="contacto_enviar" type="hidden">
	            <div class="col-sm-6 text-right pull-right">
	                <button type="submit" class="btn btn-template-main"><i class="fa fa-envelope-o"></i> Enviar mensaje</button>
	            </div>
            <?
            	}
            ?>
        </div>
    </form>
</div>