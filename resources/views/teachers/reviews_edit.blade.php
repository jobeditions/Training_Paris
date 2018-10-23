@extends('teachers.layouts.app')

@section('page_name')
    Saisie/édition des appréciations
@endsection

@section('css')
    <link href="/bower_components/footable/css/footable.core.css" rel="stylesheet">
    <link href="/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet"/>
    <link href="/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet"/>

@endsection
@section('javascript')
    <script src="/bower_components/footable/js/footable.all.min.js"></script>
    <script src="/bower_components/bootstrap-select/bootstrap-select.min.js"
            type="text/javascript"></script>
    <script src="/js/footable-init.js"></script>
@endsection

@section('content')

<div class="panel panel-inverse">
    <div class="panel-heading">Saisie des appréciations</div>
    <div class="panel-wrapper" aria-expanded="true">
        <div class="panel-body">

        {{ Form::open(array('url' => '/teacher/reviews/edit', 'method' => 'post')) }}

          <div class="form-group">
            <label for="methode">Méthode de saisie</label>
            <select name="methode" class="form-control">
              <option value="0" selected>Saisie sur une page (liste des élèves)</option>
              <option value="1">Saisie assistée (élève par élève)</option>
            </select>
          </div>

          <div class="form-group">
            <label for="classe">Classe</label>
            <select name="classe" class="form-control">
              @foreach ($classes as $classe)
                <option value="{{ $classe->id }}">{{ $classe->name }}</option>
              @endforeach
            </select>
          </div>

          <button type="submit" class="btn btn-success pull-right">Saisir !</button>

        {{ Form::close() }}

        </div>
    </div>
</div>
@endsection
