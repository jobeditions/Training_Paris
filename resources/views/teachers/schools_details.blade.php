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
        <div class="panel @if (isset($school)) panel-inverse @else panel-danger @endif">
            <div class="panel-heading"> @if (isset($school)){{ $school->name }} @else Oups ! Une erreur s'est produite... @endif </div>
            <div class="panel-wrapper" aria-expanded="true">
                @if (isset($school))
                    <ul class="nav customtab nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#informations" aria-controls="informations" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="fa-info-circle"></i></span><span class="hidden-xs"> Informations</span></a></li>
                        @if ($school->belongs)
                            <li role="presentation" class=""><a href="#teachers-list" aria-controls="teachers-list" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa-user"></i></span> <span class="hidden-xs"> Professeurs</span></a></li>
                            <li role="presentation"><a href="#students-list" aria-controls="students-list" role="tab" data-toggle="tab"><span class="visible-xs"><i class="fa-users"></i></span> <span class="hidden-xs"> Elèves</span></a></li>
                        @endif
                    </ul>
                    <div class="panel-body">
                        <div class="tab-content m-t-0">
                            <div role="tabpanel" class="tab-pane fade active in" id="informations">
                                <strong>Ville :</strong> {{ $school->city_name }} <br>
                                <strong>Administrateur TeacherHawk :</strong> {{ $school->headmaster_name }} <br>
                                <br>
                                <p>
                                    Aucune description
                                </p>
                                @if (!$school->belongs)
                                {{ Form::open(array('url' => '/teacher/schools', "class" => "form-horizontal")) }}
                                    <input type="hidden" value="{{ $school->id }}">
                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Ajouter cette école</button>
                                    <span class="help-block"><small>L'administrateur de cette école peut mettre un certain temps à confirmer votre ajout.</small></span>
                                {{ Form::close() }}
                                @endif
                            </div>
                            @if ($school->belongs)
                                <div role="tabpanel" class="tab-pane fade in" id="teachers-list">
                                    @if (isset($school->teachers))
                                        <div class="table-responsive">
                                            <table class="datatables table color-table dark-table color-bordered-table dark-bordered-table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Adresse email</th>
                                                        <th>Nom</th>
                                                        <th>Prénom</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($school->teachers as $teacher)
                                                        <tr>
                                                            <td>{{ $teacher->email }}</td>
                                                            <td>{{ $teacher->last_name }}</td>
                                                            <td>{{ $teacher->name }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                                <div role="tabpanel" class="tab-pane fade in" id="students-list">
                                    @if (isset($school->students))
                                        <div class="table-responsive">
                                            <table class="datatables table color-table dark-table color-bordered-table dark-bordered-table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Adresse email</th>
                                                        <th>Nom</th>
                                                        <th>Prénom</th>
                                                        <th>Situation</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($school->students as $student)
                                                        <tr>
                                                            <td>{{ $student->email }}</td>
                                                            <td>{{ $student->last_name }}</td>
                                                            <td>{{ $student->name }}</td>
                                                            <td><span class="label label-success">Interne</span></td>
                                                        </tr>
                                                    @endforeach
                                                    @foreach ($school->students_ext as $student)
                                                        <tr>
                                                            <td>{{ $student->email }}</td>
                                                            <td>{{ $student->last_name }}</td>
                                                            <td>{{ $student->name }}</td>
                                                            <td><span class="label label-info">Externe</span></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                @else
                    <div class="panel-body">
                        Il semblerait que cette école n'existe pas.
                    </div>
                @endif
            </div>
        </div>
@endsection
