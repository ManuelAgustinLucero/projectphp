    <div class="navbar navbar-default yamm" role="navigation" id="navbar">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand home" href="inicio">
                    <img src="img/logo.png" alt="Entre Petalos " class="hidden-xs hidden-sm">
                    <img src="img/logo-small.png" alt="Entre Petalos" class="visible-xs visible-sm"><span class="sr-only">Entre Petalos - ir al home</span>
                </a>
                <div class="navbar-buttons">
                    <button type="button" class="navbar-toggle btn-template-main" data-toggle="collapse" data-target="#navigation">
                        <span class="sr-only">Toggle navigation</span>
                        <i class="fa fa-align-justify"></i>
                    </button>
                </div>
            </div>
            <!--/.navbar-header -->

            <div class="navbar-collapse collapse" id="navigation">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown nav-inicio">
                        <a href="inicio">Inicioaasdas </a>                     
                    </li>
                    <li class="nav-quienes-somos">
                        <a href="seccion/2/quienes-somos">Quienes Somos</a>                     
                    </li>
  <?
                                $sql = 'SELECT * FROM tbl_secciones WHERE secciones_categoria = "50" AND secciones_estado = "1"';
                                $p = $db->QA($sql);

                                foreach($p as $p) {
                                    echo '<li><a href="seccion/' . $p['secciones_id'] . '/' . amigable($p['secciones_titulo']) . '">' . $p['secciones_titulo'] . '</a></li>';
                                }
                            ?>                    <li class="dropdown nav-contacto">
                        <a href="contacto">Contacto </a>
                    </li>
                    <li class="dropdown nav-entrar">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i><b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?
                                if($_SESSION['cliente_email'] != '' AND $_SESSION['cliente_logeado'] == TRUE) {
                            ?>
                            <li><a href="descargas">Descargas</a></li>
                            <li><a href="<?=$pathSiteHome;?>salir.php">Salir</a></li>
                            <?
                                } else {
                            ?>
                            <li><a href="entrar">Iniciar sesión</a></li>
                            <li><a href="entrar">Registrarme</a></li>
                            <?
                                }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <!--/.nav-collapse -->
            <div class="collapse clearfix" id="search">
                <form class="navbar-form" role="search">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-template-main"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </form>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
    <!-- /#navbar -->