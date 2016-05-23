<!DOCTYPE html>
<?php
require_once("../aplicacion/modelo/dao/clsConexion.php");
require_once("../aplicacion/modelo/dao/global.php");
include_once '../aplicacion/modelo/dao/prenda.php';
include_once '../aplicacion/modelo/dao/persona.php';
include_once '../aplicacion/modelo/dao/categoria.php';
include_once '../aplicacion/modelo/dao/foto.php';

$obCategoria = new categoria('0');
$obPrenda = new prenda('0', '0');
$obFoto = new foto('0', '0', '0');

$ca_id = $_GET['ca_id'];
$pe_id = $_GET['pe_id'];

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
        <link href="css/myStyle.css" rel="stylesheet" />

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
                                <img src="img/home.png" alt="" class="logo" />
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
                                            //$arrPer=$objPersona->a
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

            <section id="inner-headline">
                <div class="container">
                    <div class="row">
                        <div class="span4">
                            <div class="inner-heading">
                                <h2><strong>
                                        <?php
                                        $script0 = "select * from categoria where ca_id=$ca_id";
                                        $obCategoria->obtenerPagin($script0);
                                        $arrCategoria = $obCategoria->arregloCategoria;
                                        echo utf8_encode($arrCategoria[0]->ca_nombre) . ' Para ';

                                        $obPersona = new persona('0');
                                        $scrip = "select * from persona where pe_id=$pe_id";
                                        $obPersona->obtenerPagin($scrip);
                                        $arrPersona = $obPersona->arregloPersona;
                                        echo utf8_encode($arrPersona[0]->pe_nombre);
                                        ?>                                         
                                    </strong> 
                                </h2>
                            </div>
                        </div>
                    </div>			
                </div>
            </section>

            <section id="content">
                <div class="container">
                    <div class="row">
                        <div class="span12">

                            <?php
                            $query1 = "select * from prenda where ca_id=$ca_id AND pe_id=$pe_id";
                            $obPrenda->obtenerPagin($query1);

                            $arrPrenda = $obPrenda->arregloPrenda;
                            //echo "si: " . count($arrPrenda);
                            ?> 

                            <div class="row">
                                <?php
                                for ($i = 0; $i < count($arrPrenda); $i++) {
                                    $pr_id = $arrPrenda[$i]->pr_id;

                                    $query2 = "select * from foto where pr_id=$pr_id";
                                    $obFoto->obtenerPagin($query2);
                                    $arrFoto = $obFoto->arregloFoto;

                                    if (count($arrPrenda) > 0) {
                                        ?> 
                                        <div class="span3" id="soloborde" style="border-top:transparent solid 23px;">
                                            <div class="box aligncenter">
                                                <div class="aligncenter icon">
                                                    <img src="../aplicacion/controlador/gestion/verImagenFoto.php?fo_id=<?php echo $arrFoto[0]->fo_id ?>" />
                                                </div>
                                                <div class="text">
                                                    <h6>
                                                        <?php
                                                        //echo $ca_id . ' ' . $pe_id . ' ' . $pr_id.'---';
                                                        echo $arrPrenda[$i]->pr_nombre;
                                                        ?>
                                                    </h6>
                                                    <p>
                                                        <?php
                                                        echo $arrPrenda[$i]->pr_material;
                                                        //echo $arrFoto[0]->fo_id;
                                                        ?>
                                                    </p>
                                                    <a style="background: #7cba15;color: white;" class="btn btn-large btn-block " type="button"href="fotos.php?pr_id=<?php echo $pr_id ?>">Ver más</a> 
                                                </div>
                                            </div>
                                        </div> 
                                        <?php
                                    }
                                }
                                ?>  
                            </div>
                            <?php
                            ?>            


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