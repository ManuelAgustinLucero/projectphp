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
    }

    if($cat_titulo != 'todas' AND ($cat_titulo != '' AND $cat != '')) {
        $sql = 'SELECT id, titulo FROM cat_productos WHERE id = "' . $cat . '" AND estado = "1"';
        $contar = $db->QSRA($sql);

        if(count($contar) > 0) {
            if(amigable($contar['titulo']) == $cat_titulo) {
                $w.= ' productos.categoria = "' . $cat . '" AND';    
                $existe_cat = TRUE;
            }
        }
    } 

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

    $contar_prod = $db->CountRows('productos LEFT JOIN cat_productos ON productos.categoria = cat_productos.id 
             LEFT JOIN cat_2productos ON productos.categoria2 = cat_2productos.id', $w . ' productos.estado = "1"');

    $sql = 'SELECT productos.id as producto_id,
                    productos.codigo as producto_codigo,
                    productos.titulo as producto_titulo,
                    productos.fechaalta as producto_fecha,
                    productos.cuerpo as producto_cuerpo,
                    productos.copete as producto_copete,
                    productos.id as producto_id,
                    cat_productos.id as cat_id,
                    cat_productos.titulo as cat_titulo,
                    cat_productos.titulo_corto as cat_titulocorto,
                    cat_productos.categoria as cat_categoria,
                    cat_2productos.id as cat_2id,
                    cat_2productos.titulo as cat_2titulo,
                    cat_2productos.titulo_corto as cat_2titulocorto
             FROM productos 
             LEFT JOIN cat_productos ON productos.categoria = cat_productos.id 
             LEFT JOIN cat_2productos ON productos.categoria2 = cat_2productos.id
             WHERE ' . $w . ' productos.estado = "1" AND productos.home = "1" ORDER BY productos.' . $modulo_front_productos_ordenamiento_1 . ' ' . $modulo_front_productos_sentido_ordenamiento_1;
    $r = $db->QA($sql);
    //$r = array_map('utf8_encode', $r);

    /*$sql = 'SELECT id, titulo FROM cat_2productos WHERE id = ANY (SELECT categoria2 FROM productos WHERE ' . $w . ' productos.estado = "1")';
    $bodegas = $db->QA($sql,MYSQL_ASSOC);*/

    $sql = 'SELECT id, titulo FROM cat_productos WHERE categoria = "0" AND estado = "1"';
    $padres = $db->QA($sql,MYSQL_ASSOC);
?>

<script>$('.nav-productos').addClass('active');</script>

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1>Productos</h1>
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
                <p class="text-muted lead">Arme su propio pedido a gusto con los mejores precios que puede encontrar.</p>
                <div class="row products">
                    <?php
                        if($contar_prod > 0) {
                            foreach($r as $r) {
                                $sql = 'SELECT id, titulo FROM cat_productos WHERE id = "' . $r['cat_categoria'] . '"';
                                $cat_padre = $db->QSRA($sql,MYSQL_ASSOC);
                    ?>
                    <div class="col-md-4 col-sm-6 <?=amigable(utf8_encode($cat_padre['titulo']));?> cont-prod">
                        <div class="product">
                            <div class="image">
                                <a href="producto/<? echo $r['producto_id']; ?>/<? echo amigable(utf8_encode($r['producto_titulo'])); ?>">
                                    <?php
                                        if(file_exists('fotos/productos/' . $r['producto_id'] . '.jpg')) {
                                    ?>
                                    <img src="fotos/productos/<?php echo $r['producto_id']; ?>.jpg" class="img-responsive" alt="<? echo utf8_encode($r['producto_titulo']); ?>">
                                    <?php
                                        } else {
                                    ?>
                                    <img src="fotos/productos/default.jpg" class="img-responsive" alt="<? echo utf8_encode($r['producto_titulo']);?>">
                                    <?php
                                        }
                                    ?>
                                </a>
                            </div>
                            <div class="text">
                                <h3><a href="producto/<? echo $r['producto_id']; ?>/<? echo amigable(utf8_encode($r['producto_titulo'])); ?>"><? echo utf8_encode($r['producto_titulo']); ?></a></h3>
                                <!-- <p class="price">$143.00</p> -->
                                <p class="buttons">
                                    <?
                                        $sql = 'SELECT id_presentacion as presentacion, info_promo, precio2*' . $porcentaje_IVA . ' AS precio_unidad, precio3*' . $porcentaje_IVA . '*id_presentacion AS precio_caja FROM productos WHERE codigo = "' . $r['producto_codigo'] . '"';
                                        $p = $db2->QSRA($sql,MYSQL_ASSOC);
                                        $p['precio_unidad'] = number_format($p['precio_unidad'], '2', '.', '');
                                        $p['precio_caja'] = number_format($p['precio_caja'], '2', '.', '');
                                    ?>
                                    <a data-id="<?=$r['producto_id'];?>" data-tipo="unidad" class="btn-cart btn btn-template-main" style="cursor: pointer;"><i class="fa fa-shopping-cart"></i>Añadir botella ($<?=$p['precio_unidad'];?>)</a>
                                    <a data-id="<?=$r['producto_id'];?>" data-tipo="caja" class="btn-cart btn btn-template-main" style="cursor: pointer; margin-bottom: 10px"><i class="fa fa-shopping-cart"></i>Añadir caja x<?=$p['presentacion'];?> ($<?=$p['precio_caja'];?>)</a>
                                    <a href="producto/<? echo $r['producto_id']; ?>/<? echo amigable(utf8_encode($r['producto_titulo'])); ?>" class="btn btn-default">Ver detalle</a>
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
<script>
    $(document).ready(function() {
        $(".btn-cart").click(function(e){/*
            $.LoadingOverlay("show", {
                color: "rgba(0,0,0,.6)",
                image: "",
                fontawesome: "fa fa-circle-o-notch fa-spin"
            });  */
            var id = $(this).attr('data-id'); 
            var tipo = $(this).attr('data-tipo');
            var agregar_carrito = 'agregar_carrito';

            $.post('include/ajax.php',{
                producto_id: id,
                producto_tipo: tipo,
                agregar_carrito: agregar_carrito
            },function(e){
                $(".msg-respuesta-carrito").html(e);

                $.notify("Producto agregado", {
                    position: "bottom right",
                    className: "success"
                });
            });
        });
    })
</script>