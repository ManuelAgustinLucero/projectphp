<?php
    $w = ' 1 = "1" AND'; 

    if(isset($parametros[1])) {
        $cat = LV($parametros[1]);
        $cat_titulo = LV($parametros[2]);
    }

    if($cat_titulo != 'todas' AND ($cat_titulo != '' AND $cat != '')) {
        $sql = 'SELECT cat_noticias_id, cat_noticias_titulo FROM tbl_cat_noticias WHERE cat_noticias_id = "' . $cat . '" AND cat_noticias_estado = "1"';
        $contar = $db->QSRA($sql);
        $nombre_categoria = $contar['cat_noticias_titulo'];

        if(count($contar) > 0) {
            if(amigable($contar['cat_noticias_titulo']) == $cat_titulo) {
                $w.= ' tbl_noticias.noticias_categoria = "' . $cat . '" AND';    
                $existe_cat = TRUE;
            }
        }
    }

    //$contar = $db->CountRows('tbl_noticias', $w . ' tbl_noticias.noticias_estado = "1"');
    $sql = 'SELECT COUNT(*) FROM tbl_noticias WHERE ' . $w . ' tbl_noticias.noticias_estado = "1"';
    $contar = $db->QSV($sql);
    $total_paginas = ceil($contar / $modulo_front_noticias_items_x_pag);

    //$indice = array_search('pagina-2', $parametros, false);
    $i = 0;
    foreach($parametros as $key => $value) {
        if (strpos($value, 'pagina-') !== false) {
           $indice = $i;
        }

        $i++;
    }

    if($indice != '') {
        $pagina_actual = explode('-', $parametros[$indice]);
        $pagina_actual = $pagina_actual[1];
        $inicio = ($pagina_actual - 1) * $modulo_front_noticias_items_x_pag;
        
        if($inicio <= 0) {
            $inicio = 0;
        }
    } else {
        $pagina_actual = 1;
        $inicio = 0;
    }

    $link_next = $_SERVER['REQUEST_URI'];
    $link_next = str_replace('/pagina-' . $pagina_actual . '/', '', $link_next);
    $link_next = str_replace('/pagina-' . $pagina_actual, '', $link_next);
    $link_next = $link_next . '/pagina-' . ($pagina_actual + 1);

    $link_ant = $_SERVER['REQUEST_URI'];
    $link_ant = str_replace('/pagina-' . $pagina_actual . '/', '', $link_ant);
    $link_ant = str_replace('/pagina-' . $pagina_actual, '', $link_ant);
    $link_ant = $link_ant . '/pagina-' . ($pagina_actual - 1);

    $sql = 'SELECT tbl_noticias.noticias_id as noticia_id,
                    tbl_noticias.noticias_titulo as noticia_titulo,
                    tbl_noticias.noticias_fecha_alta as noticia_fecha,
                    tbl_noticias.noticias_cuerpo as noticia_cuerpo,
                    tbl_noticias.noticias_copete as noticia_copete,
                    tbl_cat_noticias.cat_noticias_id as cat_id,
                    tbl_cat_noticias.cat_noticias_titulo as cat_titulo,
                    tbl_cat_noticias.cat_noticias_titulo_corto as cat_titulocorto
             FROM tbl_noticias LEFT JOIN tbl_cat_noticias ON tbl_noticias.noticias_categoria = tbl_cat_noticias.cat_noticias_id WHERE ' . $w . ' tbl_noticias.noticias_estado = "1" ORDER BY tbl_noticias.' . $modulo_front_noticias_ordenamiento_1 . ' ' . $modulo_front_noticias_sentido_ordenamiento_1 . ' LIMIT ' . $inicio . ', ' . $modulo_front_noticias_items_x_pag;
    $r = $db->QA($sql);
    //$r = array_map('utf8_encode', $r);
?>
<script>$('.nav-noticias').addClass('active');</script>

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 style="color: #C8536E;"><?=$titulo_pag;?> <? if($nombre_categoria != '') { ?>> <?=$nombre_categoria;?> <? } ?></h1>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <div class="col-md-8" id="blog-listing-medium">
                <?php
                    foreach($r as $r) {
                ?>
                <section class="post">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="image" style="height: 197px;">
                                <a href="noticia/<? echo $r['noticia_id']; ?>/<? echo amigable($r['noticia_titulo']); ?>">
                                    <?php
                                        if($img = glob('sitio/fotos/noticias/' . $r['noticia_id'] . '.*')) {
                                    ?>
                                    <img src="<?=$img[0];?>" class="img-responsive" alt="<? echo $r['noticia_titulo']; ?>">
                                    <?php
                                        } else {
                                            if($nombre_categoria == 'Agenda') {
                                    ?>
                                    <img src="img/calendar2.png" class="img-responsive" alt="<? echo $r['noticia_titulo']; ?>">
                                    <?php
                                            } else {
                                    ?>
                                    <img src="sitio/fotos/noticias/pizarra.png" class="img-responsive" alt="<? echo $r['noticia_titulo']; ?>">
                                    <?
                                            }
                                        }
                                    ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <h2><a href="noticia/<? echo $r['noticia_id']; ?>/<? echo amigable($r['noticia_titulo']); ?>"><? echo $r['noticia_titulo']; ?></a></h2>
                            <div class="clearfix">
                                <p class="author-category"><a href="notas/<? echo $r['cat_id']; ?>/<? echo amigable($r['cat_titulo']); ?>"><? echo $r['cat_titulo']; ?></a>
                                </p>
                                <p class="date-comments">
                                    <a href="noticia/<? echo $r['noticia_id']; ?>/<? echo amigable($r['noticia_titulo']); ?>"><i class="fa fa-calendar-o"></i> <?php echo fechaEspExacta($r['noticia_fecha']); ?></a>
                                </p>
                            </div>
                            <p class="intro"><?php echo $r['noticia_copete']; ?></p>
                            <p class="read-more"><a href="noticia/<? echo $r['noticia_id']; ?>/<? echo amigable($r['noticia_titulo']); ?>" class="btn btn-template-main">Continuar leyendo</a>
                            </p>
                        </div>
                    </div>
                </section>
                <?
                    }
                ?>

                <ul class="pager">
                    <?php
                        if($pagina_actual > 1) {
                    ?> 
                    <li class="previous">
                        <a href="<?php echo $link_ant; ?>">← Nuevas</a>
                    </li>
                    <?php
                        } else {
                    ?>
                    <li class="previous disabled">
                        <a href="#">← Nuevas</a>
                    </li>
                    <?php
                        }
                    ?>


                    <?php
                        if($pagina_actual < $total_paginas) {
                    ?> 
                    <li class="next">
                        <a href="<?php echo $link_next; ?>">Antiguas →</a>
                    </li>
                    <?php
                        } else {
                    ?>
                    <li class="next disabled">
                        <a href="#">Antiguas →</a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>



            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>