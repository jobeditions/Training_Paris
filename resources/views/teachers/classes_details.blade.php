@extends('teachers.layouts.app')

@section('page_name')
    Elèves de {{ $classe->name }}
@endsection

@section('css')
    <link href="/bower_components/footable/css/footable.core.css" rel="stylesheet">
    <link href="/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet"/>
    <link href="/bower_components/bootstrap-switch/bootstrap-switch.css" rel="stylesheet"/>

    <style>
        .pic-check {
            width: 100%;
            padding: 0;
        }

    </style>
@endsection
@section('javascript')
    <script src="/bower_components/footable/js/footable.all.min.js"></script>
    <script src="/bower_components/bootstrap-select/bootstrap-select.min.js"
            type="text/javascript"></script>
    <script src="/js/footable-init.js"></script>
    <script type="text/javascript" src="/bower_components/bootstrap-switch/bootstrap-switch.js"></script>
    <script>
        $(".unselected_students").bootstrapSwitch();
    </script>
@endsection

@section('content')
    <div class="panel panel-inverse">
        <div class="panel-heading">Elèves inscrits en {{ $classe->name }}</div>
        <div class="panel-wrapper" aria-expanded="true">
            <div class="panel-body">

                <!-- Suppression de classe (s'active via js avec le bouton situé plus bas )-->
                    {{ Form::open(array('url' => '/teacher/classes/'.$classe->id, 'method' => 'DELETE', 'id' => "delete_class")) }}
                    {{ Form::close() }}

                    {{ Form::open(array('url' => '/teacher/classes/'.$classe->id, 'method' => 'PUT')) }}

                                <div class="row">

                                    <!-- Liste des étudiants -->
                                        @foreach ($classe->students as $student)
                                            <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6" style="margin-bottom:15px;">
                                                <div class="card" style="width: 100%;">
                                                    <label class="btn btn-default pic-check">
                                                        <img src="/images/{{ $student->avatar }}" class="card-img-top" width="100%">
                                                    </label>
                                                    <div class="card-block">
                                                        <h4 class="card-title">
                                                            {{ $student->name }} {{ $student->last_name }}&nbsp;
                                                        </h4>
                                                        <small>{{ $student->email }}</small>
                                                        <div class="text-right pull-right">
                                                            <input type="checkbox" data-size="small" data-on-text="I" data-off-text="O" class="unselected_students pull-right" value="{{ $student->id }}" name="unselected_students[]" checked>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    @endforeach

                                </div>

                             <br />

                            <div class="form-group">
                                <label for="add_per_email">Ajouter un élève via son adresse e-mail</label>
                                <input type="email" name="add_per_mail" id="add_per_email" placeholder="Adresse mail" class="form-control">
                            </div>


                            <div class="row">
                                <div class="col-lg-8 col-sm-4 col-xs-12"></div>
                                <div class="col-lg-2 col-sm-4 col-xs-12">
                                    <button class="btn btn-block btn-danger waves-effect" onclick="document.getElementById('delete_class').submit();" type="button">Supprimer
                                    </button>
                                </div>
                                <div class="col-lg-2 col-sm-4 col-xs-12">
                                    <button class="btn btn-block btn-info waves-effect" onclick="window.TeacherHawk.table.invert()" type="submit">Mettre à jour
                                    </button>
                                </div>
                            </div>
                    {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
