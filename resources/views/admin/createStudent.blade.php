@extends('admin.layouts.app')

@section('page_name')
    Ajout d'un nouvel élève
@endsection

@section('content')

    <form method="POST" action=" {{ url('admin/createstudent') }}">


        <div class="form-group">
            <label for="last_name"> Nom</label>
            <input type="text" class="form-control" id="last_name" name="last_name"  required>
        </div>

        <div class="form-group">
            <label for="name"> Prenom</label>
            <input type="text" class="form-control" id="name" name="name"  required>
        </div>

        <div class="form-group">
            <label for="email"> Email </label>
            <input type="email" class="form-control" id="email" name="email"  required>
        </div>

        <div class="form-group">
            <label for="password"> Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" >
        </div>

        <div class="form-group">
            <label for="password_confirmation">Mot de passe de confirmation</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg">Valider</button>
        </div>

    </form>

@endsection
