<?php

    if($_SESSION['cliente_id'] != '' AND $_SESSION['cliente_logeado'] == TRUE) {
        $sql = 'SELECT * FROM tbl_secciones WHERE secciones_categoria = "9" AND secciones_estado = "1"';
        $r = $db->QA($sql);
    }
    //$r = array_map('utf8_encode', $r);
?>

<script>$('.nav-<?=$seccion;?>').addClass('active');</script>

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 style="color: #C8536E;">Descargas</h1>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
                <?php
                    if($_SESSION['cliente_id'] != '' AND $_SESSION['cliente_logeado'] == TRUE) {
                        foreach($r as $r) {
                ?>
                <div class="col-md-4" style="margin-bottom: 30px;">
                    <div class="box-simple">
                        <h3><?php echo $r['secciones_titulo'];?></h3>
                        <?
                            $archivo = glob('sitio/archivos/r/secciones/a' . $r['secciones_id'] . '/*.*');
                        ?>
                        <a target="_blank" download href="<?=$archivo[0];?>"><div class="icon">
                            <i class="fa fa-download"></i>
                        </div></a>
                    </div>
                </div>
                <?php
                        }
                    } else {
                        echo alertBS('error', 'Debe iniciar sesión para ver esta sección');
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- /.container -->
</div>