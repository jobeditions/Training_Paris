<!doctype html>
<html lang="en-US">

<head>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TeacherHawk</title>
    <meta name="keywords" content="teacher" />
    <meta name="description" content="TeacherHawk, platforme de relation professeur-élève">
    <meta name="author" content="liigem.io">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,400i|Poppins:300,400,500,600" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="/frontoffice/img/logo-dark.png" type="image/x-icon" />
    <link rel="shortcut icon" href="/frontoffice/favicon.ico" type="image/x-icon" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="/fonts/liigem.css">
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/frontoffice/vendor/reset.css">
    <link rel="stylesheet" href="/frontoffice/vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="/frontoffice/vendor/ion-icons/ionicons.min.css">
    <link rel="stylesheet" href="/frontoffice/vendor/owl-slider/owl.carousel.css">
    <link rel="stylesheet" href="/frontoffice/vendor/slideshow/slideshow.css">
    <link rel="stylesheet" href="/frontoffice/vendor/lightbox/lity.min.css">
    <!-- Theme CSS -->
    <link id="theme" rel="stylesheet" href="/frontoffice/css/theme.css">
    <script src="/frontoffice/vendor/modernizr.js"></script>
</head>

<body>

<!-- Navigation -->
<nav id="light" class="transparent start-light border regular">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="nav-ui n_">
                    <div>
                        <div id="menu-icon"><span></span></div>
                        <a href="/login" class="btn"><span>Se Connecter</span></a>
                    </div>
                </div>
                <div class="logo-holder n_">
                    <div>
                        <a href="/">
                            <img class="logo" src="/frontoffice/img/logo-light.png" alt="" style="height:90px;width:auto;">
                            <img class="logo alt" src="/frontoffice/img/logo-light.png" style="height:90px;width:auto;" alt="">
                        </a>

                    </div>
                </div>

                <div class="nav-content n_">
                    <ul>
                        <li><a href="/#software">TeacherHawk</a></li>
                        <li><a href="/#discover">Fonctionnalités</a> </li>
                        <!-- <li><a href="/#screenshots">Aperçus</a></li> -->
                        <li><a href="/#join">Participer à la bêta</a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
</nav>

<!-- Scroll up -->
<div class="scrollup">
    <i class="ion-ios-arrow-up"></i>
</div>
<!-- Main Container -->
<div class="web-in">

@yield('content')


<footer id="smart" class="dark1">
    <div class="container">
        <div class="row foot-space">
            <div class="col-md-4 col-sm-12">
                <p style="font-family:'Dekar';font-size:20px;">Liigem</p>
                <p>Liigem, la startup parisienne au coeur des transitions
                </p>
                <div class="social">
                    <a href="https://twitter.com/liigemsarl"><i class="ion-social-twitter"></i></a>
                    <a href="https://www.facebook.com/liigem"><i class="ion-social-facebook"></i></a>
                    <a href="https://www.linkedin.com/company/liigem"><i class="ion-social-linkedin-outline"></i></a>
                </div>
            </div>
            <div class="col-md-7 col-md-offset-1">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-12 spacer">
                        <h5 class="foot-title">Liens utiles</h5>
                        <ul>
                            <li><a href="/cookies">Cookies</a></li>
                            <li><a href="/cgu">CGU</a></li>
                            <li><a href="/about">À propos</a></li>

                        </ul>
                    </div>
                    <div class="col-md-4 col-sm-4 col-xs-12 spacer">
                        <h5 class="foot-title">L'entreprise</h5>
                        <ul>
                            <li><a href="https://liigem.io">Liigem</a></li>
                            <li><a href="https://liigem.io/#three">Nous contacter</a></li>
                        </ul>
                    </div>

                    <div class="col-md-4 col-sm-4 col-xs-12 spacer">
                        <h5 class="foot-title">Support</h5>
                        <ul>
                            <li><a href="/faq">FAQ</a></li>
                            <li><a href="/#join">Comment participer</a></li>
                        </ul>

                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <hr>
            </div>
            <div class="col-xs-12 xs-center">
                <p class="footer-text">Copyright &copy; Liigem 2017. Tous droits réservés <a href="/cgu">Conditions
                        d'utilisation</a><a href="http://www.allaboutcookies.org/fr/">Cookies</a></p>
            </div>
        </div>
    </div>
</footer>
</div>

<!-- end of web-in -->
<script src="/frontoffice/vendor/jquery-2.2.1.min.js"></script>
<script src="/frontoffice/vendor/matchHeight-min.js"></script>
<script src="/frontoffice/vendor/contact/validator.js"></script>
<script src="/frontoffice/vendor/contact/contact.js"></script>
<script src="/frontoffice/vendor/pace.min.js"></script>
<script src="/frontoffice/vendor/headroom/headroom.min.js"></script>
<script src="/frontoffice/vendor/owl-slider/owl.carousel.min.js"></script>
<script src="/frontoffice/vendor/slideshow/anime.min.js"></script>
<script src="/frontoffice/vendor/slideshow/imagesloaded.pkgd.min.js"></script>
<script src="/frontoffice/vendor/slideshow/main.js"></script>
<script src="/frontoffice/vendor/parallax/materialize.min.js"></script>
<script src="/frontoffice/vendor/lightbox/lity.min.js"></script>
<script src="/frontoffice/vendor/tabs/jquery.tabslet.min.js"></script>
<script src="/frontoffice/vendor/masonry.pkgd.min.js"></script>
<script src="/frontoffice/js/main.min.js"></script>
<script>

        $(function() {
            //Smooth scroll lorsque l'on clique sur une ancre
                $('a[href*="#"]:not([href="#"])').click(function() {
                    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                        var target = $(this.hash);
                        target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                        if (target.length) {
                            $('html, body').animate({
                                scrollTop: target.offset().top
                            }, 1000);
                            return false;
                        }
                    }
                });
            //Evenement au scoll
                $(window).scroll(function () {
                    //Changement opacité du header
                    $("#light").css("background-color", "rgba(255, 255, 255, " + ($(window).scrollTop() / (0.7 * $(window).height())) + ")");
                    //Fade-in nice
                        $(".slide-transition").each(function () {

                            var pos = $(this).offset().top;

                            var winTop = $(window).scrollTop();
                            if (pos < winTop + 600) {
                                $(this).addClass("slide-transition-done");
                            }
                        });
                });
            //Animation du carousel
                setInterval(function () {
                    //Index actif
                    var i = ($("#screenshots .owl-dot.active").index() + 1) % $("#screenshots .owl-dot").length ;
                    //
                    $("#screenshots .owl-dot:nth-child("+(i+1)+")").click() ;
                }, 2000);

            //Smooth menu
                $("#menu-icon").click(function () {

                        $(".nav-content").css("overflow-y", "hidden").css("padding-top", 0).height(0)
                                .animate({height:"100%", "padding-top":140})

                })
        });
</script>
</body>

</html>
