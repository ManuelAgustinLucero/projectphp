            <div id="loader"></div>
            <footer id="footer">
                <div class="container">
                    <div class="col-md-3 col-sm-6">
                        <img class="img-responsive" src="img/logofooter.png" style="margin-bottom: 20px;">
                        
                    </div>
                    <div class="col-md-3">
                        <!--<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3348.529729240774!2d-60.65293368481396!3d-32.93702098092402!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95b7ab3813be4c37%3A0xf3b2385fc43f517e!2sSalta+2115%2C+S2000AIU+Rosario%2C+Santa+Fe!5e0!3m2!1ses-419!2sar!4v1501747991487" width="100%" height="200" frameborder="0" style="border:0"  allowfullscreen></iframe> -->
                        <ul class="nav-footer" style="padding-left: 50px;">
                            <li><a href="inicio">Inicio</a></li>
                            <li><a href="seccion/2/quienes-somos">Quienes Somos</a> </li>
                            <li><a href="seccion/3/productos">Productos </a>   </li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                    <ul class="nav-footer">
                            <li><a href="seccion/4/servicios">Servicios </a></li>
                            <li><a href="seccion/5/ubiacion">Ubicacion </a> </li>
                            <li><a href="contacto">Contacto</a></li>
                        </ul>
                    </div>
                    <div class="col-md-3">
                        <?php
                            $sql = 'SELECT * FROM tbl_secciones WHERE secciones_id = "21" AND secciones_estado = "1"';
                            $r = $db->QSRA($sql,MYSQL_ASSOC);
                            echo $r['secciones_cuerpo'];
                        ?>
                    </div>
                </div>
            </footer>
            <div id="copyright">
                <div class="container">
                    <div class="col-md-12">
                        <p class="pull-left">&copy; 2017. Inter-Neg - Marketing por Internet</p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>