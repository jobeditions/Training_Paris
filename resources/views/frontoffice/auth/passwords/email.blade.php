@extends('frontoffice.layouts.app')

<!-- Main Content -->
@section('content')
    <!-- Header -->
    <header id="sp3" class="dark1" style="background-image:url(img/headers/subpage.jpg)"
            data-overlay="9">
        <div class="header-in">
            <div class="caption2">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 page-title">
                            <h1 class="h3">Tentative de connexion</h1></div>
                        <div class="col-xs-6 right breadcrumbs hidden-xs">
                            <a href="#">Accueil</a> <i class="ion-chevron-right"></i><a href="#">Oubli de mot de
                                passe</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Contact -->
    <section id="c_contact">
        <div class="container">
            <div class="row">
                <h2 class="panel panel-default">
                    <h3>Envoi d'un email pour la réinitialisation du mot de passe</h3>
                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">Adresse Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-12 center">
                                <input type="submit" value="Je reconnais être tête en l'air">
                                <div class="messages"></div>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </section>
@endsection
