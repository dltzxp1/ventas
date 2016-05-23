<!DOCTYPE html>
<?php
/* * **************************** */
require_once("../aplicacion/modelo/dao/clsConexion.php");
require_once("../aplicacion/modelo/dao/global.php");
require_once("../aplicacion/modelo/dao/foto.php");

$pr_id = $_REQUEST['pr_id'];
$objFoto = new foto('0', '0', '0');
$query = "SELECT * FROM foto WHERE pr_id=$pr_id";
$objFoto->obtenerPagin($query);
$arrFoto = $objFoto->arregloFoto;
//echo count($arrFoto);
?>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Flattern - Flat and trendy bootstrap site template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <!-- css -->
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/bootstrap-responsive.css" rel="stylesheet" />
        <link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
        <link href="css/jcarousel.css" rel="stylesheet" />
        <link href="css/flexslider.css" rel="stylesheet" />
        <link href="css/slitslider.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />

        <!-- Theme skin -->
        <link id="t-colors" href="skins/default.css" rel="stylesheet" />

        <!-- color picker -->
        <link rel="stylesheet" href="colorpicker/css/colorpicker.css" type="text/css" />
        <!-- boxed bg -->
        <link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png" />
        <link rel="shortcut icon" href="ico/favicon.png" />

    </head>

    <body>
        <!-- options panel -->
        <div id="t_options"> 
            <div class="options_inner">
                <div class="options_toggle_holder"><br />
                    <a href="../index.php"> <img src="img/home.png"></a>

                </div>
            </div>
        </div>
        <!-- end of options panel -->

        <div id="wrapper">
            <!-- toggle top area -->
            <div class="hidden-top">
                <div class="hidden-top-inner container">
                    <div class="row">
                        <div class="span12">
                            <ul>
                                <li><strong>Contactanos:</strong></li>
                                <li>MAIL: maya-inka@hotmail.com </li>
                                <li><i class="icon-phone"></i> TEL/ FAX:(+52 33)1204-9952 /(+52 33) 1578-0660
                                    CEL: 044-333-722-8904 ó 044 331- 326- 4374</li>
                            </ul>
                        </div>
                    </div>
                </div>          
            </div>
            <!-- end toggle top area -->

            <!-- start header -->
            <header>
                <div class="container">
                    <div class="row nomargin">
                        <div class="span12">
                            <div class="headnav">
                                <ul>
                                    <li><a href="../login.php" target="_blank"><img src="img/user.png"> Administración</a></li>
                                </ul>
                            </div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="span4">
                            <div class="logo"> 
                                <a href="../index.php"> <img src="img/logos.png"></a>
                                
                                <h1>Guadalajara - Tlaquepaque (San Pedro)</h1>
                            </div>
                        </div>
                        <div class="span8">
                            <div class="navbar navbar-static-top">

                                <div class="navigation">
                                    <nav>
                                        <ul class="nav topnav">
                                            <li class="dropdown active">
                                                <a href="#">Videos <img src="img/arrow.png"> </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="videos.php">Videos</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown active">
                                                <a href="#">Mapa Geolocalizado <img src="img/arrow.png"></i></a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="geoportal.php">Ubicación geográfica</a></li>
                                                </ul>
                                            </li>

                                            <?php
                                            /*
                                            if (count($arrPer) > 0) {
                                                for ($r = 0; $r < count($arrPer); $r++) {
                                                    ?>  
                                                    <li class="dropdown active">
                                                        <a href="#"> <?php echo utf8_encode($arrPer[$r]->pe_nombre); ?> <img src="img/arrow.png"></i></a>
                                                        <ul class="dropdown-menu">
                                                            <?php
                                                            if (count($arrCat) > 0) {
                                                                for ($i = 0; $i < count($arrCat); $i++) {
                                                                    ?>        
                                                                    <li>
                                                                        <a href="articulos.php?ca_id=<?php echo $arrCat[$i]->ca_id; ?>&pe_id=<?php echo $arrPer[$r]->pe_id; ?>"><?php echo utf8_encode($arrCat[$i]->ca_nombre); ?></a>
                                                                    </li> 
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </ul>
                                                    </li>                                              
                                                    <?php
                                                }
                                            }*/
                                            ?>
                                        </ul>
                                    </nav>
                                </div><!-- end navigation -->	

                            </div> 		   
                        </div>
                    </div>
                </div>
            </header>	
            <!-- end header -->

            <section id="featured">
                <!-- start slider -->
                <div id="slider" class="sl-slider-wrapper demo-2">

                    <div class="container" style="width: 60%;">
                        <div class="bs-docs-example" style="display: block;position: relative;"> 
                            <div id="myCarousel" class="carousel slide">
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <li data-target="#myCarousel" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner" align="center"> 
                                    <div class="item active">
                                        <?php
                                        if (count($arrFoto) == 0) {
                                            echo '<div class="alert alert-error">
                                                <a class="close" data-dismiss="alert"></a>
                                                <strong> <img style="width:30px;height:30px;border:0;" src="../img/error.png" /> Su búsqueda no produjo resultados! </strong>
                                            </div> 
                                            </div><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR />';
                                        }
                                        ?> 
                                        <img src='../aplicacion/controlador/gestion/verFoto.php?pr_id=<?php echo $arrFoto[0]->pr_id; ?>&fo_id=<?php echo $arrFoto[0]->fo_id; ?>'/> 

                                        <div class="carousel-caption">
                                            <h4>
                                                <?php
                                                if (count($arrFoto)>0){
                                                    echo $arrFoto[0]->fo_nombre . '</br>';
                                                }
                                                
                                                ?> </h4>
                                            <p>
                                                <?php
                                                if (count($arrFoto)>0){
                                                    echo $arrFoto[0]->fo_descripcion;
                                                } 
                                                ?>
                                            </p>
                                        </div>
                                    </div>

                                    <?php
                                    for ($r = 1; $r < count($arrFoto); $r++) {
                                        ?>
                                        <div class="item">
                                            <img src='../aplicacion/controlador/gestion/verFoto.php?pr_id=<?php echo $arrFoto[$r]->pr_id; ?>&fo_id=<?php echo $arrFoto[$r]->fo_id; ?>'/>

                                            <div class="carousel-caption" style="border-top:white solid 2px;height: 60px;">
                                                <h4>
                                                    <?php
                                                    echo $arrFoto[$r]->fo_nombre . '</br>';
                                                    ?> </h4>
                                                <p>
                                                    <?php
                                                    echo $arrFoto[$r]->fo_descripcion;
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
                                <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
                            </div>
                        </div>
                    </div>

                </div><!-- /slider-wrapper -->
                <!-- end slider -->	
            </section>

            <section class="callaction">
                <div class="container">
                    <div class="row">
                        <div class="span12">
                            <div class="big-cta">
                                <div class="cta-text">
                                    <h3>Aplicación Movil  <span class="highlight"><strong>google play </strong></span> Descargar el App!<img src="img/google-play.png"></h3>
                                </div>
                                <div class="cta floatright">
                                </div>				
                            </div>				
                        </div>			
                    </div>	
                </div>
            </section>

            <section id="content">
                <div class="container"> 


                    <!-- divider -->
                    <div class="row">
                        <div class="span12">
                            <div class="solidline"></div>
                        </div>
                    </div>
                    <!-- end divider -->

                    <!-- Portfolio Projects -->

                    <!-- End Portfolio Projects -->

                    <!-- divider -->
                    <div class="row">
                        <div class="span12">
                            <div class="solidline"></div>
                        </div>
                    </div>
                    <!-- end divider -->

                </div>
            </section> 
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="span3">
                            <div class="widget">
                                <h5 class="widgetheading">Artesanias</h5>							
                                <ul class="link-list"> 
                                </ul>
                            </div>
                        </div>
                        <div class="span3">
                            <div class="widget">		
                                <h5 class="widgetheading">Categorias</h5>					
                                <ul class="link-list">
                                    <li><a href="#">Blusas</a></li>
                                    <li><a href="#">Clalinas</a></li>
                                </ul>					

                            </div>		
                        </div>
                        <div class="span3">
                            <div class="widget">
                                <h5 class="widgetheading">www.mayainka.com</h5>
                                <div class="flickr_badge">	

                                </div>
                                <div class="clear"></div>
                            </div>	
                        </div>
                        <div class="span3">
                            <div class="widget">
                                <h5 class="widgetheading">Mexico Guadalajara  Tlaquepaque (San Pedro) </h5>
                                <address>
                                    <strong>Contactos </strong><br>
                                    <img src="img/telephone.png"> TEL/ FAX:(+52 33)1204-9952 /(+52 33) 1578-0660<br>
                                </address>				
                                <p>
                                    <img src="img/telephone.png"> </i> CEL: 044-333-722-8904 ó 044 331- 326- 4374<br>
                                    <img src="img/mail.png"> </i> maya-inka@hotmail.com
                                </p>
                            </div>
                        </div>						
                    </div>
                </div>
                <div id="sub-footer">
                    <div class="container">
                        <div class="row">
                            <div class="span6">
                                <div class="copyright">
                                    <p><span>&copy; Todos los derechos Reservador MAYA-INKA</span> 2012-2013</p>
                                </div>

                            </div>

                            <div class="span6">					
                                <ul class="social-network">
                                    <li><a href="#" data-placement="bottom" title="Facebook"><i class="icon-facebook icon-square"></i></a></li>
                                    <li><a href="#" data-placement="bottom" title="Twitter"><i class="icon-twitter icon-square"></i></a></li>
                                    <li><a href="#" data-placement="bottom" title="Linkedin"><i class="icon-linkedin icon-square"></i></a></li>
                                    <li><a href="#" data-placement="bottom" title="Pinterest"><i class="icon-pinterest icon-square"></i></a></li>
                                    <li><a href="#" data-placement="bottom" title="Google plus"><i class="icon-google-plus icon-square"></i></a></li>
                                </ul>	

                            </div>	
                        </div>
                    </div>
                </div>			
            </footer>
        </div>
        <a href="#" class="scrollup"><img src="img/up.png" ></i></a> 

        <!-- javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/jquery.easing.1.3.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/jcarousel/jquery.jcarousel.min.js"></script> 	
        <script src="js/jquery.fancybox.pack.js"></script> 
        <script src="js/jquery.fancybox-media.js"></script> 
        <script src="js/google-code-prettify/prettify.js"></script>		

        <script src="js/portfolio/jquery.quicksand.js"></script> 
        <script src="js/portfolio/setting.js"></script> 	
        <script src="js/tweet/jquery.tweet.js"></script> 
        <script src="js/jquery.flexslider.js"></script> 
        <script src="js/jquery.nivo.slider.js"></script>
        <script src="js/modernizr.custom.79639.js"></script>
        <script src="js/jquery.ba-cond.min.js"></script>
        <script src="js/jquery.slitslider.js"></script>
        <script src="js/animate.js"></script>
        <script src="js/custom.js"></script>

        <script src="js/jquery.cookie.js"></script>
        <script src="colorpicker/js/colorpicker.js"></script>
        <script src="js/optionspanel.js"></script>

    </body>

</html>