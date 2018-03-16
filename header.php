<!DOCTYPE html>
    <html lang="es">
        <head>
            <base href="<?php echo $pathSiteHome; ?>">
            <meta charset="utf-8">
            <meta author="Inter-Neg 2017">
            <meta name="robots" content="all,follow">
            <meta name="googlebot" content="index,follow,snippet,archive">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <?
                if($accion == 'noticia') {
                    $noticia_id = LV($parametros[1]);
                    $sql = 'SELECT noticias_titulo FROM tbl_noticias WHERE noticias_id = "' . $noticia_id . '"';
                    $titulo_pag = $db->QSV($sql);
                    $titulo_pag = $titulo_pag;
                } 

                if($accion == 'seccion') {
                    $seccion_id = LV($parametros[1]);
                    $sql = 'SELECT secciones_titulo FROM tbl_secciones WHERE secciones_id = "' . $seccion_id . '"';
                    $titulo_pag = $db->QSV($sql);
                    $titulo_pag = $titulo_pag;
                }

                if($accion == 'producto') {
                    $producto_id = LV($parametros[1]);
                    $sql = 'SELECT productos_titulo, productos_id FROM tbl_productos WHERE productos_id = "' . $producto_id . '"';
                    $prod = $db->QSRA($sql);
                    $titulo_pag = $prod['productos_titulo'];
                    $titulo_pag = $titulo_pag;
                    $img = $prod['productos_id'] . '.jpg';
                    echo '<meta property="og:image" content="' . $pathSiteHome . 'sitio/fotos/productos/' . $img . '"/>';
                } 
            ?>
            <title><?php echo $titulo_pag; ?> - <?php echo $info_titulo; ?></title>
            <meta property="og:title" content="<?php echo $titulo_pag; ?> - <?php echo $info_titulo; ?>"/>
            <meta property="og:description" content="Perfumería y Distribuidora de Rosario"/>
            <meta name="description" content="Perfumería y Distribuidora de Rosario">
            <meta name="keywords" content="">

            <?
                include('css/css.php');
                include('js/js-footer.php');
            ?>
            <script src='https://www.google.com/recaptcha/api.js'></script>

            <!-- Responsivity for older IE -->
            <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

            <!-- Favicon and apple touch icons-->
            <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
            <link rel="apple-touch-icon" href="img/apple-touch-icon.png" />
            <link rel="apple-touch-icon" sizes="57x57" href="img/apple-touch-icon-57x57.png" />
            <link rel="apple-touch-icon" sizes="72x72" href="img/apple-touch-icon-72x72.png" />
            <link rel="apple-touch-icon" sizes="76x76" href="img/apple-touch-icon-76x76.png" />
            <link rel="apple-touch-icon" sizes="114x114" href="img/apple-touch-icon-114x114.png" />
            <link rel="apple-touch-icon" sizes="120x120" href="img/apple-touch-icon-120x120.png" />
            <link rel="apple-touch-icon" sizes="144x144" href="img/apple-touch-icon-144x144.png" />
            <link rel="apple-touch-icon" sizes="152x152" href="img/apple-touch-icon-152x152.png" />
            <!-- owl carousel css -->

            <link href="css/owl.carousel.css" rel="stylesheet">
            <link href="css/owl.theme.css" rel="stylesheet">
            <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P7K3C2T');</script>
<!-- End Google Tag Manager -->
        </head>
        <body>
        <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P7K3C2T"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

            <div id="all">
                <header>
                    <?php
                        include('header-top.php');
                        include('header-navbar.php');
                    ?>
                </header>