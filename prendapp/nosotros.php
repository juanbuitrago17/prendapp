<?php
session_start();
$usuario = $_SESSION['usuario'];
$rol = $_SESSION["rol"];

if(empty($usuario) || empty($rol)){
    header('Location:login.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>Nosotros PRENDAPP</title>
  
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">
 
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
   

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css" />
   <link rel="stylesheet" href="css/Unti.css">
   <link rel="stylesheet" href="estilis.css">
   <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style.css">
   

    <script>
        var renderPage = true;

        if (navigator.userAgent.indexOf('MSIE') !== -1
            || navigator.appVersion.indexOf('Trident/') > 0) {
        
            alert("Please view this in a modern browser such as Chrome or Microsoft Edge.");
            renderPage = false;
        }
    </script>

</head>

<body>
    <header>
        <div class="ancho">
        <div class="logo">
            <img src="img/Prendapp-1.png" alt="Logo Empresa">
            <h1 class="hh" style="color: #11294d;">PRENDAPP</h1>
            <h2 class="hh" style="margin-left: 1400px; word-spacing: normal;" style="color: #11294d;">COMPRA AQUI</h2>
        </div>
            <ul>
                <li><a href="#contacto">Contacto</a></li>
                <li style="float:right"><a class="active" href="cerrarSesion.php">Cerrar Sesion</a></li>
                
                <li style="float:right"><a class="activo" href="paginaClientes.php">Regresar</a></li>
            </ul>
        </div>
    </header>
    <br><br>
         
     

         
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <div class="container">
        <section class="tm-section-head" id="top">
            <small id="header" class="text-center tm-text-gray">
                <h1 style="color: #11294d;">PRENDAPP</h1>
                <p style="color: #11294d;"> Compra y Vende <br>con <br>nosotros</p>
            </small>

           


        <section class="row" id="tm-section-1">
            <div class="col-lg-12 tm-slider-col">
                <div class="tm-img-slider">
                    <div class="tm-img-slider-item">
                        <p class="tm-slider-caption"></p>
                        <img src="img/blanco.jpg" alt="Image" class="tm-slider-img">
                    </div>
                    <div class="tm-img-slider-item">
                        <p class="tm-slider-caption"></p>
                        <img src="img/negro.jpg" alt="Image" class="tm-slider-img">
                    </div>
                    <div class="tm-img-slider-item">
                        <p class="tm-slider-caption"></p>
                        <img src="img/ropa.jpg.jpg" alt="Image" class="tm-slider-img">
                    </div>
                    <div class="tm-img-slider-item">
                        <p class="tm-slider-caption"></p>
                        <img src="img/ropas.jpg" alt="Image" class="tm-slider-img">
                    </div>
                </div>
            </div>
        </section>

        <section class="tm-section-2 tm-section-mb" id="tm-section-2">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6 mb-lg-0 mb-md-5 mb-5 pr-md-5">
                    <header class="text-center">
                        <i class="fa fa-4x fa-power-off pl-5 pb-5 pr-5 pt-2"></i>
                    </header>

                    <h2 style="color: #11294d;">Quienes somos?</h2>
                    <p style="color: #11294d;">Somos un grupo conformado por tres personas
                        con intereses comunes en ayudar a las personas
                    que compran y venden productos por interner </p>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 mb-lg-0 mb-md-5 mb-5 pr-md-5">
                    <header class="text-center">
                        <i class="fa fa-4x fa-eye pl-5 pb-5 pr-5 pt-2"></i>
                    </header>
                    <h2 style="color: #11294d;">Nuestra Vision</h2>
                    <p style="color: #11294d;"> Como visión, tenemos claro que lo que queremos es ofrecer ropa de calidad que inspire a las personas 
                        a sentirse seguras y seguras de sí mismas con lo que adquieran en nuestro sitio.
                    </p>
                </div>

                <div class="col-xl-4 col-lg-4 col-md-12">
                    <h2 style="color: #11294d;">Nuestros Valores</h2>
                    <p style="color: #11294d;"> En nuestra tienda online, la seguridad y la confianza de nuestros clientes son nuestra prioridad.
                         Trabajamos incansablemente para brindar una experiencia de compra segura y proteger la privacidad 
                         de su información personal. Con nosotros, puede comprar con tranquilidad, sabiendo que su satisfacción 
                         y seguridad son fundamentales para nuestro negocio."</p>
                    
                    <p style="color: #11294d;">+ tus datos personales estan seguros con nosotros</p>
                    <p style="color: #11294d;">+ Garantizamos la autenticidad y calidad de nuestros productos, 
                        brindando una experiencia de compra libre de preocupaciones.</p>
                    <p style="color: #11294d;">+ Mostramos claramente información sobre precios, políticas de proteccion 
                        y términos de servicio para que pueda tomar decisiones informadas.</p>

                </div>
            </div>
        </section>

        <section class="tm-section-3 tm-section-mb" >
            <div class="row">
                <div class="col-md-6 tm-mb-sm-4 tm-2col-l">
                    <div class="image">
                        <img src="img/ropasi.jpeg" class="img-fluid" />
                    </div>
                    <div class="tm-box-3" >
                        <h2 style="color: aliceblue;">Un poco de nuestro trabajo</h2>
                        <p style="color: aliceblue;">Nuestro enfoque de trabajo se basa en la transparencia, la eficiencia 
                            y la atención al detalle, nos comprometemos a ofrecer un servicio ágil y confiable, 
                            respaldado por un equipo comprometido con su satisfacción</p>
                    </div>
                </div>
                <div class="col-md-6 tm-mb-sm-4 tm-2col-r">
                    <div class="image">
                        <img src="img/cha.jpg" class="img-fluid" style="height:361px; width: 800px;" />
                    </div>
                    <div class="tm-box-3">
                        <h2 style="color: aliceblue;">Nuestro Sitio</h2>
                        <p style="color: aliceblue;">nos enorgullecemos de ser un equipo dedicado a satisfacer
                            las necesidades de nuestros clientes. Buscamos superar expectativas 
                            y construir relaciones sólidas basadas en la confianza y la integridad.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="tm-section-4 tm-section-mb" id="tm-section-4">
            <div class="row">

            </div>
        </section>
    </div>
    <div>


<br><br>    
        <footer id="contacto" style="background-color: #0E242F;  min-height: 30vh; 
        left: 0;
        bottom: 0;
        width: 100%;">
            <h2 style="color: aliceblue;  margin-left: 25px;">PRENDAPP</h2>
            <br>
            <p class="pt" style="line-height: 1.8em;
            word-spacing: 135px;
            letter-spacing: 0.05em;
            font-style: italic;
            font-size: 13px;
            font-weight: 400%;
            text-align: center;
            color: white;">
            <img style="height: 100px; width: 200px; float: right; margin: 0px 0px 85px 100px;" class="img-t" src="img/Prendapp-1.png" alt="Descripción de la imagen">
            &nbsp;
            Bogota-Colombia
            310546986-3124596564&
            PRENDAPP@gmail.com
            </p>
            <br><br>
           <h5 style="color: aliceblue; margin-left: 25px;">Siguenos en Redes sociales</h5>
           
           
            <a href="https://www.facebook.com" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.twitter.com" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://api.whatsapp.com/send?phone=1234567890" class="social-icon" target="_blank"><i class="fab fa-whatsapp"></i></a>
            <p class="py" style="text-align: center; font-size: 8px; color: aliceblue;" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Copyright ©2023 My Website. Todos los derechos reservados a PRENDAPP.</p>
        </footer>
    </div>
   
    <script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>


    <script>
        function setCarousel() {
            var slider = $('.tm-img-slider');

            if (slider.hasClass('slick-initialized')) {
                slider.slick('destroy');
            }

            if ($(window).width() > 991) {
                slider.slick({
                    autoplay: true,
                    fade: true,
                    speed: 800,
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1
                });
            } else {
                slider.slick({
                    autoplay: true,
                    fade: true,
                    speed: 800,
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1
                });
            }
        }

        $(document).ready(function () {
            if (renderPage) {
                $('body').addClass('loaded');
            }

            setCarousel();

            $(window).resize(function () {
                setCarousel();
            });
            $('.nav-link').click(function () {
                $('#mainNav').removeClass('show');
            });

          
            
            $('a[href*="#"]')
                
                .not('[href="#"]')
                .not('[href="#0"]')
                .click(function (event) {
                    if (
                        location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '')
                        &&
                        location.hostname == this.hostname
                    ) {
                        
                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                        
                        
                        if (target.length) {
                          
                            event.preventDefault();
                            $('html, body').animate({
                                scrollTop: target.offset().top + 1
                            }, 1000, function () {
                                
                                var $target = $(target);
                                $target.focus();
                                if ($target.is(":focus")) { 
                                    return false;
                                } else {
                                    $target.attr('tabindex', '-1'); 
                                    $target.focus();
                                };
                            });
                        }
                    }
                });
        });
    </script>
    <script src="java.js"></script>

</body>

</html>