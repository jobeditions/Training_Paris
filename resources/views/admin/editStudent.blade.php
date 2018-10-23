@extends('admin.layouts.app')

@section('page_name')
    Mise à jour d'un élève
@endsection

@section('content')

    <form method="POST" action="{{ url('/admin/user/'.$student->id.'/edit') }}">


        <div class="form-group">
            <label for="last_name"> Nom</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{  $student->name }}" required>
        </div>

        <div class="form-group">
            <label for="name"> Prenom</label>
            <input type="text" class="form-control" id="name" name="name" value="{{  $student->last_name }}" required>
        </div>

        <div class="form-group">
            <label for="email"> Email </label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $student->email }}" required>
        </div>

        <div class="form-group">
            <label for="password"> Mot de passe</label>
            <input type="password" class="form-control" id="password" name="password" value="">
        </div>

        <div class="form-group">
            <label for="password_confirmation">Mot de passe de confirmation</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <input type="hidden" name="id" value="{{ $student->id }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-lg">Valider</button>
        </div>

    </form>

@endsection
