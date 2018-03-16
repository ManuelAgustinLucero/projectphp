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
                <h1><?php echo $r['secciones_titulo']; ?></h1>
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
                <div class="col-md-12" style="font-size: 17pt !important;">
                    <p><?php echo $r['secciones_cuerpo']; ?></p>
                </div>  
            </div>
        </section>
        <section>
            <div class="row portfolio">
                <?
                    $id = 'a' . $r['secciones_id'];
                    if($dir = glob('sitio/fotos/secciones/' . $id . '/*.jpg')) {

                        if(count($dir) > 0) {
                ?>
                <div class="col-md-12">
                    <div class="heading">
                        <h3>Galería de imagenes</h3>
                    </div>
                </div>
                <?
                            foreach($dir as $d) { 
                ?>
                <div class="col-sm-6 col-md-3">
                    <div class="box-image">
                        <div class="image" style="overflow: hidden; height: 250px;">
                            <img src="sitio/fotos/secciones/<?php echo $id; ?>/<?php echo basename($d); ?>" class="img-responsive" style="min-width: 100%; min-height: 100%;">
                        </div>
                        <div class="bg"></div>
                        <div class="text">
                            <p class="buttons">
                                <a href="sitio/fotos/secciones/<?php echo $id; ?>/ampl/<?php echo basename($d); ?>" class="lightview btn btn-template-transparent-primary" data-lightview-group="galeria">Ver</a>
                            </p>
                        </div>
                    </div>
                    <!-- /.box-image -->
                </div>
                <?
                            }
                        }
                    }
                ?>
                
            </div>
        <?
            if($r['secciones_categoria'] == '123') {
                echo '<a href="contacto" class="btn btn-primary btn-lg"> Consultar</a>';
            }
        ?>
        </section>

    </div>
    <!-- /.container -->
</div>