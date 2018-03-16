<?php
    
    //Busco categoría
    $i = 0;
    foreach($parametros as $key => $value) {
        if (strpos($value, 'cat:') !== false) {
           $indice_cat = $i;
        }

        $i++;
    }

    //Busco página
    /*$i = 0;
    foreach($parametros as $key => $value) {
        if (strpos($value, 'pagina:') !== false) {
           $indice_pagina = $i;
        }

        $i++;
    }*/

    $w = ' 1 = "1" AND'; 

    if($indice_cat != '') {
        $cat = LV(str_replace('cat:', '', $parametros[$indice_cat]));
        $cat_titulo = LV($parametros[$indice_cat + 1]);
        print_r($cat_titulo);
    }

    /*if($cat_titulo != 'todas' AND ($cat_titulo != '' AND $cat != '')) {
        $sql = 'SELECT cat_productos_id, cat_productos_titulo FROM tbl_cat_productos WHERE cat_productos_id = "' . $cat . '" AND cat_productos_estado = "1"';
        $contar = $db->QSRA($sql);

        if(count($contar) > 0) {
            if(amigable($contar['cat_productos_titulo']) == $cat_titulo) {
                $w.= ' tbl_productos.productos_categoria = "' . $cat . '" AND';    
                $existe_cat = TRUE;
            }
        }
    }*/

    /*$contar = $db->CountRows('productos', $w . ' productos.estado = "1"');
    $total_paginas = ceil($contar / $modulo_front_productos_items_x_pag);

    //$indice_pagina = array_search('pagina:2', $parametros, false);
    $i = 0;
    foreach($parametros as $key => $value) {
        if (strpos($value, 'pagina:') !== false) {
           $indice_pagina = $i;
        }

        $i++;
    }

    if($indice_pagina != '') {
        $pagina_actual = explode('-', $parametros[$indice_pagina]);
        $pagina_actual = $pagina_actual[1];
        $inicio = ($pagina_actual - 1) * $modulo_front_productos_items_x_pag;
        
        if($inicio <= 0) {
            $inicio = 0;
        }
    } else {
        $pagina_actual = 1;
        $inicio = 0;
    }

    $link_next = $_SERVER['REQUEST_URI'];
    $link_next = str_replace('/pagina:' . $pagina_actual . '/', '', $link_next);
    $link_next = str_replace('/pagina:' . $pagina_actual, '', $link_next);
    $link_next = $link_next . '/pagina:' . ($pagina_actual + 1);

    $link_ant = $_SERVER['REQUEST_URI'];
    $link_ant = str_replace('/pagina:' . $pagina_actual . '/', '', $link_ant);
    $link_ant = str_replace('/pagina:' . $pagina_actual, '', $link_ant);
    $link_ant = $link_ant . '/pagina:' . ($pagina_actual - 1);*/

    $sql = 'SELECT COUNT(*) FROM tbl_productos LEFT JOIN tbl_cat_productos ON tbl_productos.productos_categoria = tbl_cat_productos.cat_productos_id WHERE ' . $w . ' tbl_productos.productos_estado = "1"';
    $contar_prod = $db->QSV($sql);

    $sql = 'SELECT tbl_productos.productos_id as producto_id,
                    tbl_productos.productos_codigo as producto_codigo,
                    tbl_productos.productos_titulo as producto_titulo,
                    tbl_productos.productos_fecha_alta as producto_fecha,
                    tbl_productos.productos_cuerpo as producto_cuerpo,
                    tbl_productos.productos_copete as producto_copete,
                    tbl_productos.productos_id as producto_id,
                    tbl_productos.productos_precio as producto_precio,
                    tbl_cat_productos.cat_productos_id as cat_id,
                    tbl_cat_productos.cat_productos_titulo as cat_titulo,
                    tbl_cat_productos.cat_productos_titulo_corto as cat_titulocorto
             FROM tbl_productos 
             LEFT JOIN tbl_cat_productos ON tbl_productos.productos_categoria = tbl_cat_productos.cat_productos_id 
             WHERE ' . $w . ' tbl_productos.productos_estado = "1" ORDER BY tbl_productos.' . $modulo_front_productos_ordenamiento_1 . ' ' . $modulo_front_productos_sentido_ordenamiento_1;
    $r = $db->QA($sql);
    //$r = array_map('utf8_encode', $r);
?>

<script>$('.nav-productos').addClass('active');</script>

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 style="color: #C8536E;">Productos</h1>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <?
                include('menu-categorias.php');
            ?>
            <div id="cont-prod" class="col-sm-9">
                <p class="text-muted lead">Seleccione el producto que desea.</p>
                <div class="row products">
                    <?php
                        if($contar_prod > 0) {
                            foreach($r as $r) {
                    ?>
                    <div class="col-md-4 col-sm-6 <?=amigable($r['cat_titulo']);?> cont-prod">
                        <div class="product">
                            <div class="image">
                                <a href="producto/<? echo $r['producto_id']; ?>/<? echo amigable($r['producto_titulo']); ?>">
                                    <?php
                                        if($img = glob('sitio/fotos/productos/ampl/' . $r['producto_id'] . '.*')) {
                                    ?>
                                    <img src="<?=$img[0];?>" class="img-responsive" alt="<? echo $r['producto_titulo']; ?>">
                                    <?php
                                        } else {
                                    ?>
                                    <img src="sitio/fotos/productos/default.jpg" class="img-responsive" alt="<? echo $r['producto_titulo'];?>">
                                    <?php
                                        }
                                    ?>
                                </a>
                            </div>
                            <div class="text">
                                <h3><a href="producto/<? echo $r['producto_id']; ?>/<? echo amigable($r['producto_titulo']); ?>"><? echo $r['producto_titulo']; ?></a></h3>
                                <!-- <p class="price">$143.00</p> -->
                                <p class="buttons">
                                    <!-- <?
                                        if($modulo_productos_muestra_precio == 1) {
                                    ?>
                                    <a href="comprar/<?=$r['producto_id'];?>" class="btn-cart btn btn-template-main" style="cursor: pointer;"><i class="fa fa-shopping-cart"></i>Consultar: $<?=number_format($r['producto_precio'], '2', '.', '');?></a><br>
                                    <?    
                                        } else {
                                    ?>
                                    <a href="comprar/<?=$r['producto_id'];?>" class="btn-cart btn btn-template-main" style="cursor: pointer;"><i class="fa fa-shopping-cart"></i>Consultar</a><br>
                                    <?
                                        }
                                    ?> -->
                                    <a href="producto/<? echo $r['producto_id']; ?>/<? echo amigable($r['producto_titulo']); ?>" class="btn btn-default">Ver detalle</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?
                            }
                        } else {
                            echo '<div class="alert alert-info">No hay productos para esta categoría</div>';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="msg-respuesta-carrito"></div>