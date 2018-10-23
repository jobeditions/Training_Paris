@extends('frontoffice.layouts.app')

@section('content')

        <!-- Header -->
        <header id="software" class="dark1 center" style="background-image:url('/frontoffice/img/kids.jpg');"
                data-overlay="9">
            <div class="header-in">
                <div class="caption">
                    <h1 class="h2">Tout commence</h1>
                    <h6>Avec un logiciel qui répond à vos besoins</h6>
                    <a href="#discover" class="btn"><span>Découvrir</span></a>
                </div>
            </div>
            <div class="macbook">
                <img src="/frontoffice/img/Rye Neck Teachers.png" alt="">
            </div>
        </header>

        <!-- Info - About 1 -->
        <section class="slide-transition">
            <div class="container border">
                <div class="row">
                    <div class="col-md-4">
                        <h6>Chez Liigem, nous oeuvrons chaque jour à la création d'outils modernes et adaptés aux besoins actuels</h6>
                        <h5>Nathanaël Langlois, CEO</h5>
                    </div>
                    <div class="col-md-4">
                        <p>TeacherHawk est une solution Cloud-based proposant
                            aux écoles un système dans lequel les professeurs peuvent
                            intéragir avec leurs élèves.</p>
                    </div>
                    <div class="col-md-4">
                        <p> Devoirs, cours, documents externes
                            TeacherHawk offre un vaste choix de partages
                            pour rendre la vie de tous plus simple</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="discover" class="halfarea dark1">
            <div class="col-md-5 col-sm-2 imagearea-over">
                <img src="/frontoffice/macbookair13_front.png" alt="">
            </div>
            <div class="container border slide-transition">
                <div class="row">
                    <div class="col-md-5 col-sm-8 col-md-offset-7 col-sm-offset-4">
                        <h5>TeacherHawk</h5>
                        <h2>Un outil puissant</h2>
                        <p>L'éducation est un des secteurs prenant le plus de temps à l'apparition de
                            nouvelles technologies
                            Avec TeacherHawk, c'est une décade entière de rattrapage
                            que nous proposons aux établissements scolaires.</p>
                        <ul class='list2'>
                            <li>10 gigas de stockage par professeur</li>
                            <li>Gestion exhaustive des devoirs</li>
                            <li>Possibilité de mise en ligne et de partage de cours</li>
                        </ul>
                        <a href="#join" class="btn"><span>N'attendez plus</span></a>
                    </div>
                </div>
            </div>
        </section>

        <section class="halfarea dark1">
            <div class="col-md-5 col-sm-2 imagearea-over col-md-offset-7 col-sm-offset-10 rightside">
                <img src="/frontoffice/img/preview2.jpg" alt="">
            </div>
            <div class="container slide-transition">
                <div class="row">
                    <div class="col-md-5 col-sm-8">
                        <h5>TeacherHawk</h5>
                        <h2>Des fonctionnalités en avance et indispensables</h2>
                        <p>Dans une ère où la préservation des ressources est clé,
                        TeacherHawk propose aux professeurs une fonctionnalité
                        permettant de récupérer les devoirs, 100% en ligne !</p>
                        <ul class='list2'>
                            <li>Mise en ligne de devoirs</li>
                            <li>Filtre anti-plagiat</li>
                            <li>Projets en groupe</li>
                            <li>Visualisation & notation en ligne des travaux rendus</li>
                            <li>Notifications pour les élèves</li>
                        </ul>
                        <p>Vous ne pourrez bientôt plus vous en passer</p>
                        <a href="#join" class="btn"><span>N'attendez plus</span></a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gallery
        <section id="screenshots" class="gallery no-lr-pad parallax-container dark" data-overlay="9">
            <div class="parallax"><img src="/frontoffice/img/headers/subpage.jpg" alt=""></div>
            <div class="container-fluid no-max no-pad slide-transition">
                <div class="row">
                    <div class="col col-md-6 col-md-offset-3 title">
                        <h2>Aperçus</h2>
                        <h4>Quelques aperçus d'une platforme bientôt disponible à tous</h4>
                    </div>
                </div>
                <div class="row m-space">
                    <div class="col-md-12">
                        <div class="center-loop-fade">
                            <div>
                                <a href="/frontoffice/img/software/pic1.jpg" data-lity>
                                    <img src="/frontoffice/img/software/pic1.jpg" alt="">
                                </a>
                            </div>
                            <div>
                                <a href="/frontoffice/img/software/pic1.jpg" data-lity>
                                    <img src="/frontoffice/img/software/pic1.jpg" alt="">
                                </a>
                            </div>
                            <div>
                                <a href="/frontoffice/img/software/pic1.jpg" data-lity>
                                    <img src="/frontoffice/img/software/pic1.jpg" alt="">
                                </a>
                            </div>
                            <div>
                                <a href="/frontoffice/img/software/pic2.jpg" data-lity>
                                    <img src="/frontoffice/img/software/pic2.jpg" alt="">
                                </a>
                            </div>
                            <div>
                                <a href="/frontoffice/img/software/pic3.jpg" data-lity>
                                    <img src="/frontoffice/img/software/pic3.jpg" alt="">
                                </a>
                            </div>
                            <div>
                                <a href="/frontoffice/img/software/pic4.jpg" data-lity>
                                    <img src="/frontoffice/img/software/pic4.jpg" alt="">
                                </a>
                            </div>
                            <div>
                                <a href="/frontoffice/img/software/pic5.jpg" data-lity>
                                    <img src="/frontoffice/img/software/pic5.jpg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>-->

        <!-- Get registered -->
        <section id="join" class="center extra-pad">
            <div class="container">
                <div class="row title">
                    <span class="promo-heading">Interessé(e) ?</span>
                    <h6>Contactez beta@liigem.io pour avoir accès à la bêta</h6>
                </div>

            </div>
        </section>

@endsection
