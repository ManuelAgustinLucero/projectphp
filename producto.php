<?php
    $producto_id = LV($parametros[1]);
    $producto_titulo = LV($parametros[2]);

    $sql = 'SELECT tbl_productos.productos_id as producto_id,
                    tbl_productos.productos_titulo as producto_titulo,
                    tbl_productos.productos_fecha_alta as producto_fecha,
                    tbl_productos.productos_cuerpo as producto_cuerpo,
                    tbl_productos.productos_codigo as producto_codigo,
                    tbl_productos.productos_id as producto_id,
                    tbl_productos.productos_precio as producto_precio,
                    tbl_cat_productos.cat_productos_id as cat_id,
                    tbl_cat_productos.cat_productos_titulo as cat_titulo,
                    tbl_cat_productos.cat_productos_titulo_corto as cat_titulocorto
             FROM tbl_productos LEFT JOIN tbl_cat_productos ON tbl_productos.productos_categoria = tbl_cat_productos.cat_productos_id WHERE tbl_productos.productos_id = "' . $producto_id . '" AND tbl_productos.productos_estado = "1"';
    $r = $db->QSRA($sql);
?>

<script>$('.nav-productos').addClass('active');</script>

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1><?php echo $r['producto_titulo']; ?></h1>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <?
               // include('menu-categorias.php');
            ?>
            <div class="col-md-12">
                <div class="row" id="productMain">
                    <div class="col-sm-6">
                        <div id="mainImage">
                            <?php
                                if($img = glob('sitio/fotos/productos/' . $r['producto_id'] . '.*')) {
                                    $img2 = glob('sitio/fotos/productos/ampl/' . $r['producto_id'] . '.*')
                            ?>
                            <img id="zoom_01" src="<?=$img2[0];?>" class="img-responsive" alt="<? echo $r['producto_titulo']; ?>" data-zoom-image="<?=$img2[0];?>">
                            <script>
                                $("#zoom_01").elevateZoom({
                                    zoomWindowWidth:400,
                                    zoomWindowHeight:400
                                });
                            </script>
                            <?php
                                } else {
                            ?>
                            <img src="sitio/fotos/productos/default.jpg" class="img-responsive" alt="<? echo $r['producto_titulo'];?>">
                            <?php
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="box">
                            <form>
                                <p style="text-align: center;"><i class="fa fa-tags"></i> Marca: <a href="productos/cat:<?=$r['cat_id'];?>/<?=amigable($r['cat_titulo']);?>"><?=$r['cat_titulo'];?></a></p>

                                <p></i><?=$r['producto_cuerpo'];?></p>
                                <?
                                    if($modulo_productos_muestra_precio == 1) {
                                ?>
                                <p class="price" style="margin-bottom: 5px; margin-top: 0;"><span style="font-size: 14pt">Precio:</span><br> $<?=$r['producto_precio'];?></p>
                                <?
                                    }
                                ?>
                                <p class="text-center">
                                    <a href="comprar/<?=$r['producto_id'];?>" class="btn-cart btn btn-template-main" style="cursor: pointer; margin-bottom: 10px; width: 100%;"><i class="fa fa-shopping-cart"></i>Consultar</a>
                                </p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box social" id="product-social">
        <h4>Compartir</h4>
        <p>
            <a href="http://www.facebook.com/sharer.php?u=<?=dameURL(); ?>" target="popup" onClick="window.open(this.href, this.target, 'width=500,height=380'); return false;" class="facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
            <a href="https://plus.google.com/share?url=<?=dameURL() ?>" onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;" class="gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
            <a href="http://twitter.com/share?text=<?=urlencode($r['producto_titulo']); ?>" target="popup" onClick="window.open(this.href, this.target, 'width=500,height=380'); return false;" class="twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
        </p>
    </div>
    <div class="msg-respuesta-carrito"></div>
</div>