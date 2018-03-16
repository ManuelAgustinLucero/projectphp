<?php
    
?>

<script>$('.nav-entrar').addClass('active');</script>

<div id="heading-breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1><?=$titulo_pag;?></h1>
            </div>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <div class="row">
            <?
                if($_SESSION['cliente_id'] != '' AND $_SESSION['cliente_logeado'] == TRUE) {
            ?>
            <!-- <h3>Mis pedidos</h3>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Pedido nro</th>
                        <th>Fecha de pedido</th>
                        <th>Ver</th>
                    </tr>
                <?
                    $sql = 'SELECT pedidos.fecha as pedido_fecha, pedidos.id as pedido_id, pedidos.obs as pedido_datos FROM pedidos WHERE cliente = "' . $_SESSION['cliente_id'] . '"';
                    $r = $db->QA($sql,MYSQL_ASSOC);

                    foreach($r as $r) {
                ?>
                    <tr>
                        <td><?=$r['pedido_id'];?></td>
                        <td><?=fechaEspExactaHora($r['pedido_fecha']);?></td>
                        <td><i data-toggle="modal" data-target="#modal-pedido" style="color: #b50032; cursor: pointer;" class="ver-pedido fa fa-eye" data-id="<?=$r['pedido_id'];?>"></i></td>
                    </tr>
                <?
                    }
                ?>
                </table>
            </div>
            <div class="modal fade" id="modal-pedido" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Ver pedido</h4>
                        </div>
                        <div class="modal-body">
                            <div class="msg-respuesta-pedido"></div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                $(document).ready(function() {
                    $(".ver-pedido").click(function(e){
                        var id = $(this).attr('data-id');
                        var ver_pedido = 'ver_pedido';

                        $.post('include/ajax.php',{
                            pedido_id: id,
                            ver_pedido: ver_pedido
                        },function(e){
                            $(".msg-respuesta-pedido").html(e);
                        });
                    });
                    function goBack() {
                        window.history.back();
                    }
                });
            </script> -->
            <?
                } else {
                    echo alertBS('Para acceder a esta sección debe <a href="entrar">iniciar sesión</a>');
                }
            ?>
        </div>
    </div>
</div>