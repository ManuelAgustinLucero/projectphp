<?
    include('include/mobile.php');
    $detect = new Mobile_Detect;
?>
<div class="col-sm-3">
    <div class="panel panel-default sidebar-menu">
        <div id="menu">
            <div class="panel list-group">
                <div class="panel-heading">
                    <h3 class="panel-title" data-toggle="collapse" data-target="#sm" data-parent="#menu">
                       Filtrar por Marcas<i class="fa fa-caret-down"></i>
                    </h3>
                </div>
                <div id="sm" class="sublinks collapse">
                    <ul id="filter" class="nav nav-pills nav-stacked category-menu">
                        <li class="active">
                            <a data-filtro="todas">Todas</a>
                        </li>
                        <?
                            $sql = 'SELECT * FROM tbl_cat_productos ORDER BY cat_productos_titulo ASC';
                            $cat_prod = $db->QA($sql);

                            foreach($cat_prod as $c) {
                                $sql = 'SELECT COUNT(*) FROM tbl_productos WHERE productos_categoria = "' . $c['cat_productos_id'] . '" AND productos_estado = "1"';
                                $contar_prod = $db->QSV($sql);

                                if($contar_prod > 0) {
                        ?>
                        <li>
                            <a data-filtro="<?=amigable($c['cat_productos_titulo']);?>"><?=$c['cat_productos_titulo'];?></a>
                        </li>
                        <?
                                }
                            }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function() {
                <?
                    if($detect->isMobile() == FALSE AND $detect->isTablet() == FALSE) {
                ?>
                $('#sm').addClass('in');
                <?
                    }
                ?>
                var navigationFn = {
                    goToSection: function(id) {
                        $('html, body').animate({
                            scrollTop: $(id).offset().top
                        }, 200);
                    }
                }

            <?
                if($cat_titulo != '') {
            ?>
                $('ul#filter a[data-filtro="<?=$cat_titulo;?>"]').css('outline','none');
                $('ul#filter .active').removeClass('active');
                $('ul#filter a[data-filtro="<?=$cat_titulo;?>"]').parent().addClass('active');

                var filterVal = $('ul#filter a[data-filtro="<?=$cat_titulo;?>"]').attr('data-filtro');
                    
                if(filterVal == 'todas') {
                  $('.products>.cont-prod.hidden').fadeIn('slow').removeClass('hidden');
                } else {
                  $('.products>.cont-prod').each(function() {
                    if(!$(this).hasClass(filterVal)) {
                      $(this).fadeOut('normal').addClass('hidden');
                    } else {
                      $(this).fadeIn('slow').removeClass('hidden');
                    }
                  });
                }
            <?
                }
            ?>  
              $('ul#filter a').click(function() {
                $(this).css('outline','none');
                $('ul#filter .active').removeClass('active');
                $(this).parent().addClass('active');
                
                var filterVal = $(this).attr('data-filtro');
                    
                if(filterVal == 'todas') {
                  $('.products>.cont-prod.hidden').fadeIn('slow').removeClass('hidden');
                } else {
                  $('.products>.cont-prod').each(function() {
                    if(!$(this).hasClass(filterVal)) {
                      $(this).fadeOut('normal').addClass('hidden');
                    } else {
                      $(this).fadeIn('slow').removeClass('hidden');
                    }
                  });
                }
                
                //window.location.hash = '#cont-prod';
                navigationFn.goToSection('#cont-prod');
                return false;
              });
            });
        </script>
    </div>
</div>
