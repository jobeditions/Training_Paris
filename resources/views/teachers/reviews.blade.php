@extends('teachers.layouts.app')

@section('page_name')
    Saisie des appréciations
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

<div class="panel panel-success">
    <div class="panel-heading panel-link" onclick="document.location = '{{url('teacher/reviews/edit')}}'">Saisir/modifier les appréciations</div>
</div>

<div class="panel panel-inverse">
    <div class="panel-heading">Saisie des appréciations</div>
    <div class="panel-wrapper" aria-expanded="true">
        <div class="panel-body">
          <div class="alert alert-danger"><i class="fa fa-times-circle"></i> Il manque des appréciations pour le bulletin du 1er trimestre</div>

          <table class="table table-hover table-bordered">
            <thead>
              <tr>
                <th>Classe</th>
                <th class="text-center">Trimestre 1</th>
                <th class="text-center">Trimestre 2</th>
                <th class="text-center">Trimestre 3</th>
              </tr>
            </thead>

            <tbody>
              @foreach ($classes as $classe)
                <tr>
                  <td>{{ $classe->name }}</td>
                  <td class="text-center"><i class="fa fa-check text-success"></i></td>
                  <td class="text-center"><i class="fa fa-warning text-warning"></i></td>
                  <td class="text-center"><i class="fa fa-times text-danger"></i></td>
                </tr>
              @endforeach
            </tbody>
          </table>

        </div>
    </div>
</div>
@endsection
