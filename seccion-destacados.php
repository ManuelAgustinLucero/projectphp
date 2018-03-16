<?php
    $sql = 'SELECT COUNT(*) FROM tbl_productos WHERE productos_estado = "1" AND productos_home = "1"';
    $contar_prod = $db->QSV($sql);
    if($contar_prod > 0) {
?>

<div class="container">
    <h3>Novedades</h3>
    <div class="row products">
        <div class="owl-carousel2">
        <?
            $sql = 'SELECT tbl_productos.productos_id as producto_id,
                    tbl_productos.productos_codigo as producto_codigo,
                    tbl_productos.productos_titulo as producto_titulo,
                    tbl_productos.productos_fecha_alta as producto_fecha,
                    tbl_productos.productos_cuerpo as producto_cuerpo,
                    tbl_productos.productos_copete as producto_copete,
                    tbl_productos.productos_id as producto_id,
                    tbl_cat_productos.cat_productos_id as cat_id,
                    tbl_cat_productos.cat_productos_titulo as cat_titulo,
                    tbl_cat_productos.cat_productos_titulo_corto as cat_titulocorto
             FROM tbl_productos 
             LEFT JOIN tbl_cat_productos ON tbl_productos.productos_categoria = tbl_cat_productos.cat_productos_id 
             LEFT JOIN tbl_cat2_productos ON tbl_productos.productos_categoria2 = tbl_cat2_productos.cat2_productos_id
             WHERE tbl_productos.productos_home = "1" ORDER BY tbl_productos.productos_id DESC ';
            $r = $db->QA($sql);

            foreach($r as $r) {
        ?>
        <div class="item">
            <div class="col-md-12 col-sm-12 <?=amigable($r['cat_titulo']);?> cont-prod">
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
                            <a href="producto/<? echo $r['producto_id']; ?>/<? echo amigable($r['producto_titulo']); ?>" class="btn btn-default">Ver detalle</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
<?
        }
?>
<script>
$('.owl-carousel2').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    items: 4
    /*responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }*/
});
</script>
        </div>
    </div>
</div>
<?
    } else {
        echo '<div class="container"><div class="row"><div class="col-md-12"><h3>Novedades</h3><div class="alert alert-info">No hay novedades por el momento</div></div></div></div><div style="clear: both"></div>';
    }
?>