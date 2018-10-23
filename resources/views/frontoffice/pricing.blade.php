@extends('frontoffice.layouts.app')

@section('content')

    <style>
        section.header-fix {
            padding: 56px;
        }
        .price-section {
            cursor: pointer;
            transition: ease-in 0.2s;
        }

        .price-section[data-selected="selected"] a.btn span {
            color: #FFF !important;
        }
        
        .price-section[data-selected="selected"] a.btn::after {
            width: 100% !important;
            opacity: 1 !important;
        }
    </style>

    <section class="header-fix dark" data-overlay="9"></section>


    <!-- Pricing -->
    <section id="pricing" class="center grey">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 title">
                    <h2>Des services adpatés à vos besoins</h2>
                    <h4>A chacun son pack</h4>
                </div>
            </div>
            <div class="row m-space">
                <div class="col-md-3 col-sm-6">
                    <div class="free-pack price-section mh">
                        <h5>Gratuit</h5>
                        <h2 class="bigger">0<b>€</b></h2>
                        <p>Le moins cher !</p>
                        <hr>
                        <ul class="list">
                            <li>Truc cool !</li>
                            <li>Machin cool !</li>
                            <li>Chose cool !</li>
                        </ul>
                        <a href="#" class="btn"><span>Choisir cette offre</span></a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="price-section mh">
                        <h5>Pro</h5>
                        <h2 class="bigger">X<b>€</b></h2>
                        <hr>
                        <ul class="list">
                            <li>Truc cool !</li>
                            <li>Machin cool !</li>
                            <li>Chose cool !</li>
                        </ul>
                        <a href="#" class="btn"><span>Choisir cette offre</span></a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="price-section mh">
                        <h5>Premium</h5>
                        <h2 class="bigger">X<b>€</b></h2>
                        <hr>
                        <ul class="list">
                            <li>Truc cool !</li>
                            <li>Machin cool !</li>
                            <li>Chose cool !</li>
                        </ul>
                        <a href="#" class="btn"><span>Choisir cette offre</span></a>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="price-section mh">
                        <h5>La totale</h5>
                        <h2 class="bigger">X<b>€</b></h2>
                        <hr>
                        <ul class="list">
                            <li>Truc cool !</li>
                            <li>Machin cool !</li>
                            <li>Chose cool !</li>
                        </ul>
                        <a href="#" class="btn"><span>Choisir cette offre</span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Test -->
    <section class="iconblock center">
        <div class="container">
            <div class="row">
                <div class="col col-md-6 col-md-offset-3 title">
                    <h2>Trucs à décrire</h2>
                    <h4>Wow</h4>
                </div>
            </div>
            <div class="row m-space">
                <div class="col-sm-6 col-md-4">
                    <i class="ion-ionic"></i>
                    <h3>Front End Dev</h3>
                    <p>Lorem ipsum dolor amet consectetuer adipiscing dolut nonummy
                        adpiscing
                    </p>
                </div>
                <div class="col-sm-6 col-md-4">
                    <i class="ion-ionic"></i>
                    <h3>User Experience</h3>
                    <p>Lorem ipsum dolor amet consectetuer adipiscing dolut nonummy
                        adpiscing
                    </p>
                </div>
                <div class="col-sm-6 col-md-4">
                    <i class="ion-ionic"></i>
                    <h3>Search Marketing</h3>
                    <p>Lorem ipsum dolor amet consectetuer adipiscing dolut nonummy
                        adpiscing
                    </p>
                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="frontoffice/js/jquery-3.1.1.min.js"></script>
    <script>
        $(".price-section").hover(
                function () { $(this).addClass("highlight") ; },
                function () { $(this).attr("data-selected") == "selected" ? null : $(this).removeClass("highlight") ; }
        ).click(
                function () {
                    $(".price-section").attr("data-selected", "").removeClass("highlight").find("a.btn").find("span").text("Choisir cette offre") ;
                    $(this).attr("data-selected", "selected").addClass("highlight").find("a.btn").find("span").text("Offre selectionnée") ;
                }
        ).find("a.btn").click(
                function (e) {
                    e.preventDefault();
                }
        )
    </script>

@endsection
