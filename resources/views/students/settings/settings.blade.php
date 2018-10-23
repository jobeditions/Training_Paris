@extends('students.layouts.app')

@section('pagename')
    Paramètres
@endsection

@section("content")

    <div class="container">

        <div class="white-box black-box">
            <h1 class="box-title">
                Informations
            </h1>
        </div>

        <div class="white-box white-box-content">

            {{ Form::open(array('url' => '#')) }}

            <div class="form-group">
                <label for="name">Nom/Prénom</label>
                <input type="text" name="name" id="name" class="form-control" value="Jean Dupont" disabled/>
            </div>

            <div class="form-group">
                <label for="naissance">Date de naissance</label>
                <input type="date" name="naissance" id="naissance" class="form-control" value="2000-05-12" disabled/>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Enregistrer les modifications</button>

            {{ Form::close() }}

        </div>

        <div class="white-box black-box">
            <h1 class="box-title">
                Préférences
            </h1>
        </div>

        <div class="white-box white-box-content">

            {{ Form::open(array('url' => '#')) }}

            <div class="form-group">
                <label for="name">Nom/Prénom</label>
                <input type="text" name="name" id="name" class="form-control" value="Jean Dupont" disabled/>
            </div>

            <div class="form-group">
                <label for="naissance">Date de naissance</label>
                <input type="date" name="naissance" id="naissance" class="form-control" value="2000-05-12" disabled/>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Enregistrer les modifications</button>

            {{ Form::close() }}

        </div>

    </div>
@endsection
