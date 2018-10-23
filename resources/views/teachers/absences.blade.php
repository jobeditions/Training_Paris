@extends('teachers.layouts.app')

@section('page_name')
    Absences / Retards
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
    <script>
        $('#doCall').click(function(){
            var classe = $('#classe').val();
            $(location).attr('href', '{{url('teacher/absences/record')}}/' + classe);
        });
    </script>
@endsection

@section('content')

    @if (session('call_ok'))

        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            L'appel que vous venez d'effectuer a bien été enregistré.
        </div>

    @endif

{{--<div class="panel panel-primary">
    <div class="panel-heading panel-link" onclick="document.location = '{{url('teacher/absences/record/5')}}'">Faire l'appel pour la classe <i>Terminale S2</i></div>
</div>--}}

    <div class="form-group">
        <label for="classe">Sélectionnez une classe : </label>
        <select name="classe" class="form-control input-lg" id="classe">
            @foreach ($classes as $classe)
                <option value="{{ $classe->id }}">{{ $classe->name }}</option>
            @endforeach
        </select>
    </div>

<div class="panel panel-info">
    <div class="panel-heading panel-link" id="doCall">Faire l'appel dans cette classe</div>
</div>

    <hr />

<div class="panel panel-danger">
    <div class="panel-heading panel-link" onclick="document.location = '{{url('teacher/absences/history')}}'">Historique</div>
</div>

@endsection
