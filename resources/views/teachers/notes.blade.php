@extends('teachers.layouts.app')

@section('page_name')
    Notes
@endsection

@section('css')
    <link href="/bower_components/footable/css/footable.core.css" rel="stylesheet">
    <link href="/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet"/>
@endsection
@section('javascript')
    <script src="/bower_components/footable/js/footable.all.min.js"></script>
    <script src="/bower_components/bootstrap-select/bootstrap-select.min.js"
            type="text/javascript"></script>
    <script src="/js/footable-init.js"></script>
@endsection

@section('content')

    @if (session('call_ok'))

        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            La note que vous venez d'ajouter a bien été enregistrée.
        </div>
    @elseif (session('delete_ok'))

        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            La note a bien été supprimée.
        </div>

    @endif

  {{ Form::open(array('url' => '/teacher/notes/details', 'method' => 'post')) }}

  <div class="form-group">
    <label for="classe_selector">Choisissez une classe :</label>
    <select name="classe_selector" class="form-control input-lg" id="classe_selector">
      <!-- Boucle pour afficher les classes du prof -->
    @foreach ($classes as $classe)
      <option value="{{ $classe->id }}">{{ $classe->name }}</option>
    @endforeach
    </select>
  </div>

  <!--<div class="form-group">
    <label for="periode_selector">Choisissez une période :</label>
    <select name="periode_selector" class="form-control" id="periode_selector">
      <option value="1" selected>1er Trimestre</option>
      <option value="2">2ème Trimestre</option>
      <option value="3">3ème Trimestre</option>
    </select>
  </div>-->

  <div class="row">
      <div class="col-lg-10 col-sm-8 col-xs-12"></div>
      <div class="col-lg-2 col-sm-4 col-xs-12">
          <button class="btn btn-block btn-info waves-effect" type="submit"><i class="fa fa-search"></i> Rechercher
          </button>
      </div>
  </div>

  {{ Form::close() }}

@endsection
