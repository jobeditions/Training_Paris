@extends('teachers.layouts.app')

@section('page_name')
    Classes
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
    <div class="panel panel-inverse">
        <div class="panel-heading">Ajout d'une nouvelle classe</div>
        <div class="panel-wrapper" aria-expanded="true">
                <div class="panel-body">
                    {{ Form::open(array('url' => '/teacher/classes')) }}
                        <!-- Informations sur la classe (Nom, matière ...)-->
                            Nom de la classe :<br>
                            <input type="text" name="class-name" placeholder="Classe" pattern=".{1,}" value="Classe"><br>
                            <small>Il s'agit du nom de la classe tel qu'il apparaîtra dans l'onglet "Mes classes"</small><br>
                            <br>
                            Intitulé du cours :<br>
                                <!-- Sélection du sujet -->
                                    <select name="class-subject">
                                        @foreach ($subjects as $subject)
                                            <option value="{{$subject->subject}}">{{ $subject->subject }}</option>
                                        @endforeach
                                            <option value="">Autre (précisez)</option>
                                    </select>
                                <input name="add_subject" type="text"><br>

                            <small>Indiquez la matière du cours afin de permettre à vos élèves de savoir ce que vous étudierez en classe.</small><br>

                            <br><br>
                            Liste des étudiants inscrits :<br>
                            <small id="nb_students"></small><br>

                        <!-- Liste des étudiants -->
                            <table class="datatables table color-table dark-table color-bordered-table dark-bordered-table table-hover table-editable">
                                <!-- En-tête du tableau -->
                                    <thead>
                                        <tr>
                                            <th data-toggle="true"> Email</th>
                                            <th data-toggle="true"> Nom </th>
                                            <th data-toggle="true"> Prénom</th>
                                            <th data-toggle="true"> Participe</th>
                                        </tr>
                                    </thead>
                                <!-- Corps du tableau -->
                                    <tbody>
                                    <!-- Affichage de la liste des étudiants concernées -->
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>{{ $student->email }}</td>
                                                <td>{{ $student->last_name }}</td>
                                                <td>{{ $student->name }}</td>
                                                <td><input type="checkbox" name="selected_students[]" value="{{ $student->id }}" checked></td>
                                            </tr>
                                        @endforeach
                                    <!-- Rajout d'étudiants -->
                                    </tbody>
                                    <tfoot>
                                        <!-- Ajout par adresse mail -->
                                            <tr>
                                                <th><input type="text" name="add_per_mail" placeholder="Adresse mail"></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                    </tfoot>
                            </table>

                        <!-- Bouton de validation -->
                            <div class="row">
                                <div class="col-lg-10 col-sm-8 col-xs-12"></div>
                                <div class="col-lg-2 col-sm-4 col-xs-12">
                                    <button class="btn btn-block btn-success waves-effect" type="submit">Valider
                                    </button>
                                </div>
                            </div>
                        {{ Form::close() }}
                </div>
        </div>
    </div>
@endsection
