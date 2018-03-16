<?php
    $seccion_id = LV($parametros[1]);
    $seccion = LV($parametros[2]);

    $sql = 'SELECT * FROM tbl_secciones WHERE secciones_id = "' . $seccion_id . '"';
    $r = $db->QSRA($sql);
    //$r = array_map('utf8_encode', $r);
?>

<script>$('.nav-<?=$seccion;?>').addClass('active');</script>

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 style="color: #C8536E;"><?php echo $r['secciones_titulo']; ?></h1>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <?
            if(strlen(trim($r['secciones_copete'])) > 1 AND trim($r['secciones_copete']) != '<br>') {
        ?>
        <section class="no-mb">
            <div class="row">
                <div class="col-md-12">
                    <p class="lead"><?php echo $r['secciones_copete']; ?></p>
                </div>
            </div>
        </section>
        <?
            }
            if(file_exists('sitio/fotos/secciones/' . $r['secciones_id'] . '.jpg')) {
        ?>
        <section>
            <div class="item">
                <img style="width: 100%;" src="sitio/fotos/secciones/ampl/<? echo $r['secciones_id']; ?>.jpg" alt="" class="img-responsive">
            </div>
        </section>
        <?php
            }
        ?>
        <section>
            <div class="row portfolio-project">
                <div class="col-md-12">
                    <p><?php echo $r['secciones_cuerpo']; ?></p>
                </div>  
            </div>
        </section>


    </div>
    <!-- /.container -->
</div>