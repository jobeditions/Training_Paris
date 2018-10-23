@extends('frontoffice.layouts.app')

@section('content')
        <!-- Header -->
        <header id="sp3" class="dark1" style="background-image:url(img/headers/subpage.jpg)"
                data-overlay="9">
            <div class="header-in">
                <div class="caption2">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6 page-title">
                                <h1 class="h3">Connexion</h1></div>
                            <div class="col-xs-6 right breadcrumbs hidden-xs">
                                <a href="#">Accueil</a> <i class="ion-chevron-right"></i><a href="#">Connexion</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Form -->
        <section id="c_contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 title">
                        <h2>Veuillez entrer vos identifiants</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Adresse email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Mot de passe</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Se souvenir de moi
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-12 center">
                                <input type="submit" value="Connexion">
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">
                                    <span>Mot de passe oublié ?</span></a>
                                <div class="messages"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

@endsection
