<?php
    $noticias_id = LV($parametros[1]);
    $noticias_titulo = LV($parametros[2]);

    $sql = 'SELECT tbl_noticias.noticias_id as noticias_id,
                    tbl_noticias.noticias_titulo as noticias_titulo,
                    tbl_noticias.noticias_fecha_alta as noticias_fecha,
                    tbl_noticias.noticias_cuerpo as noticias_cuerpo,
                    tbl_noticias.noticias_copete as noticias_copete,
                    tbl_noticias.noticias_id as noticias_id,
                    tbl_cat_noticias.cat_noticias_id as cat_id,
                    tbl_cat_noticias.cat_noticias_titulo as cat_titulo,
                    tbl_cat_noticias.cat_noticias_titulo_corto as cat_titulocorto
             FROM tbl_noticias LEFT JOIN tbl_cat_noticias ON tbl_noticias.noticias_categoria = tbl_cat_noticias.cat_noticias_id WHERE tbl_noticias.noticias_id = "' . $noticias_id . '" AND tbl_noticias.noticias_estado = "1"';
    $r = $db->QSRA($sql);
    //$r = array_map('utf8_encode', $r);

    if($r['noticias_id'] <= 4889) {
        $r['noticias_titulo'] = utf8_decode($r['noticias_titulo']);
        $r['noticias_copete'] = utf8_decode($r['noticias_copete']);
        $r['noticias_cuerpo'] = utf8_decode($r['noticias_cuerpo']);
        $r['noticias_titulocorto'] = utf8_decode($r['noticias_titulocorto']);
    }
?>

<script>$('.nav-notas').addClass('active');</script>

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 style="color: #C8536E;"><?php echo $r['noticias_titulo']; ?></h1>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <!-- *** LEFT COLUMN ***
     _________________________________________________________ -->
            <div class="col-md-12" id="blog-post">
            	<div class="col-md-12" style="padding-left: 0px;">
            	<div class="col-md-6" style="padding-left: 0px;">
            		<p class="text-muted text-uppercase mb-small"><a href="notas/<? echo $r['cat_id']; ?>/<? echo amigable($r['cat_titulo']); ?>" style="text-decoration: none; color: #555555;"><strong><?php echo $r['cat_titulo']; ?></strong></a></span>
            	</div>
            	<div class="col-md-6">
                	<p class="text-muted text-uppercase mb-small text-right"><i class="fa fa-calendar" style="color: #DA4D4D;"></i> <?php echo fechaEspExacta($r['noticias_fecha']); ?></p>
                </div>
                </div>
                <?
                    if($img = glob('sitio/fotos/banners/ampl/1.*')) {
                        $sql = 'SELECT banners_titulo_corto FROM tbl_banners WHERE banners_id = "1"';
                        $url = $db->QSV($sql);
                ?>
                <a href="<?=$url;?>" target="_blank"><img class="img-responsive banner-publicitario" src="<?=$img[0]?>"></a>
                <?
                    }
                ?>
                <?
                    if($img = glob('sitio/fotos/noticias/ampl/' . $r['noticias_id'] . '.*')) {
                ?>
                <img class="img-responsive" style="width: 100%;" src="<?=$img[0];?>">
                <?
                    }
                ?>
                <p class="lead"><?php echo $r['noticias_copete']; ?></p>

                <div id="post-content">
                    <?php echo $r['noticias_cuerpo']; ?>
                </div>
                <?
                    if($img = glob('sitio/fotos/banners/ampl/2.*')) {
                        $sql = 'SELECT banners_titulo_corto FROM tbl_banners WHERE banners_id = "2"';
                        $url = $db->QSV($sql);
                ?>
                <a href="<?=$url;?>" target="_blank"><img class="img-responsive banner-publicitario" src="<?=$img[0]?>"></a>
                <?
                    }
                ?>
                <!-- /#post-content -->
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>