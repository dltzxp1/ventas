<!DOCTYPE html>
<?php
require_once("../aplicacion/modelo/dao/clsConexion.php");
require_once("../aplicacion/modelo/dao/global.php");
require_once("../aplicacion/modelo/dao/categoria.php");
require_once("../aplicacion/modelo/dao/persona.php");

$obCat = new categoria('0');
$arrCat = $obCat->arregloCategoria;

$obPer = new persona('0');
$arrPer = $obPer->arregloPersona;
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Artesanias- maya-inka</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="" />
        <meta name="author" content="" /> 
        <!-- css -->
        <link href="css/bootstrap.css" rel="stylesheet" />
        <link href="css/bootstrap-responsive.css" rel="stylesheet" />
        <link href="css/fancybox/jquery.fancybox.css" rel="stylesheet">
        <link href="css/jcarousel.css" rel="stylesheet" />
        <link href="css/flexslider.css" rel="stylesheet" />
        <link href="css/style.css" rel="stylesheet" />

        <!-- Theme skin -->
        <link id="t-colors" href="skins/default.css" rel="stylesheet" />

        <!-- color picker -->
        <link rel="stylesheet" href="colorpicker/css/colorpicker.css" type="text/css" />
        <!-- boxed bg -->
        <link id="bodybg" href="bodybg/bg1.css" rel="stylesheet" type="text/css" />

        <!-- Fav and touch icons -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="ico/apple-touch-icon-144-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="ico/apple-touch-icon-114-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="ico/apple-touch-icon-72-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" href="ico/apple-touch-icon-57-precomposed.png" />
        <link rel="shortcut icon" href="ico/favicon.png" />


        <script src="../aplicacion/vista/js/OpenLayers/OpenLayers.js"></script>
        <script src="../aplicacion/vista/js/jsRuta.js"></script>
        <script src="../aplicacion/vista/js/install.js"></script>
        <script src="http://maps.google.com/maps/api/js?sensor=false&v=3.2"></script>
        <link rel="stylesheet" type="text/css" href="../aplicacion/librerias/jquery.js" />

        <style>
            #featured{
                background: white;
            }
            #map{
                display: block; 
                height: 550px;
                left: 10%;
                width:80%;
                position: relative;
                padding: 4px;
            }

        </style>
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
                                <img src="img/logos.png" alt="" class="logo" />
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
                                            }
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
                <div id="map">

                </div>

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
  

                </div>
            </section>
            
            <section id="bottom">
                <div class="container">
                    <div class="row">
                        <div class="span12">
                            <div class="aligncenter">

                                <div id="twitter-wrapper">
                                    <div id="twitter"></div>
                                </div>
                            </div>
                        </div>	
                    </div>
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
                          

                            </div>	
                        </div>
                    </div>
                </div>			
            </footer>
        </div>
        <a href="#" class="scrollup"><img src="img/up.png" ></i></a> 


        <!---Mapas -->


        <!---FIN Mapas -->

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