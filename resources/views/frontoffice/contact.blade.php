@extends('frontoffice.layouts.app')

@section('content')

    <style>
        section.header-fix {
            padding: 56px;
        }
    </style>
    <section class="header-fix dark" data-overlay="9"></section>

    <!-- Contact -->
    <section id="contact">
        <div class="container">
            <div class="row title">
                <span class="promo-heading">A votre écoute.</span>
                <h6>Parce que nos clients sont importants à nos yeux.</h6>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <h4>Besoin de nous contacter ? Facile.</h4>
                    <h5>Vous avez juste à remplir le formulaire ci-dessous.</h5>
                    <form class="contact-form" method="post" action="contact.php">
                        <div class="input-field col-sm-12">
                            <div class="form-group">
                                <input id="form-name" name="name" type="text" placeholder="Votre nom" required="required"
                                       data-error="Ce champ est requis">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="input-field col-sm-6">
                            <div class="form-group">
                                <input id="form-email" name="email" type="email" placeholder="Votre adresse mail" required="required"
                                       data-error="Ce champ requis">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="input-field col-sm-6">
                            <div class="form-group">
                                <input id="form-tel" name="tel" type="tel" placeholder="Votre n° de téléphone (facultatif)" data-error="Ce n° de téléphone n'est pas valide.">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="input-field col-sm-12">
                            <div class="form-group">
                                    <textarea id="form-textarea" name="Message" id="" cols="30" rows="5" placeholder="Décrivez succintement les raisons qui vous poussent à nous contacter."
                                              required="required" data-error="N'oubliez pas d'écrire votre message :) !"></textarea>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-sm-12 center">
                            <input type="submit" value="Envoyer">
                            <div class="messages"></div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3 col-md-offset-1">
                    <h5>Nos bureaux</h5>
                    <p>
                        Quelque part à la Défense.<br>
                        Région parisienne.
                    </p>
                    <a href="#map">Nous trouver sur Google Maps &raquo;</a>
                    <hr>
                    <h5>Téléphone</h5>
                    <p>(+33)0 00 00 00 00</p>
                    <hr>
                    <h5>Email</h5>
                    <p>contact@liigem.io</p>
                </div>
            </div>
        </div>
    </section>

    <div class="map-area">
        <div id="map"></div>

            <script src="frontoffice/js/googleMap.js"></script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGdxJUGVa8uDG4wsQp-cmzQI1ijLNqYb4&callback=initMap"
                async defer></script>

    </div>

@endsection
