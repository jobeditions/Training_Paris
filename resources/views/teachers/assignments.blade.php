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
        <div class="panel-heading"> Liste des devoirs remis à vos élèves
            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a></div>
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
                @if (count($assignments))
                    <div class="table-responsive">
                        <table class="table table-striped datatables dataTable no-footer table-hover color-bordered-table muted-bordered-table">
                            <thead>
                            <tr>
                                <th data-toggle="true"> Classe</th>
                                <th> Intitulé</th>
                                <th> Devoirs rendus</th>
                                <th> Echéance</th>
                                <th> Remis le</th>
                                <th> Etat</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($assignments as $assignment)
                                <tr onclick="document.location = '{{url('teacher/assignments/')}}/{{ $assignment->id }}'">
                                    <td>{{ $assignment->classe_name }}</td>
                                    <td>{{ $assignment->name }}</td>
                                    <td>@if($assignment->max_files > 0){{ $assignment->done }}
                                        / {{ count($assignment->classe->students)*$assignment->max_files }}
                                        @else
                                            N/A
                                        @endif</td>
                                    <td>{{ $assignment->due_date }}</td>
                                    <td>{{ $assignment->created_at }}</td>
                                    <td>
                                        @if ((!$assignment->late)&&(!$assignment->over)) <span class="label label-info">En cours</span> @endif
                                        @if (($assignment->late)&&(!$assignment->over)) <span
                                                class="label label-warning">En attente des retardataires</span> @endif
                                        @if ($assignment->over) <span class="label label-success">Clôturé</span> @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    Vous n'avez pas créé de devoir pour le moment.
                @endif
            </div>
        </div>
    </div>

    <div class="panel panel-inverse">
        <div class="panel-heading"> Liste des examens planifiés
            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a></div>
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
                @if (count($exams))
                    <div class="table-responsive">
                        <table class="table table-striped datatables dataTable no-footer table-hover color-bordered-table muted-bordered-table">
                            <thead>
                            <tr>
                                <th data-toggle="true">Classe</th>
                                <th>Intitulé</th>
                                <th>Date</th>
                                <th>Etat</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($exams as $exam)
                                <tr onclick="document.location = '{{url('teacher/exams/')}}/{{ $exam->id }}'">
                                    <td>{{ $exam->classe_name }}</td>
                                    <td>{{ $exam->name }}</td>
                                    <td>{{  Carbon\Carbon::parse($assignment->due_date)->formatLocalized('%d %B %Y') }} @if($exam->surprise)
                                            <span class="label label-success">Surprise</span>  @endif</td>
                                    <td>
                                        @if (!$exam->over) <span class="label label-info">A venir</span> @endif
                                        @if ($exam->over) <span class="label label-success">Clôturé</span> @endif
                                    </td>
                                    <td class="text-center">
                                        @if (!$exam->over) <a href="#"
                                                              class="btn btn-info btn-outline">Modifier</a> @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    Vous n'avez pas créé d'examens pour le moment.
                @endif
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <div class="panel-heading panel-link" onclick="document.location = '{{url('teacher/assignments/create')}}'">
            Ajouter
            un nouveau devoir
            ou examen
        </div>
    </div>

@endsection
