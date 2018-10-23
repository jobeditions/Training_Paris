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
    @if ($assignment != null)
        <div class="panel panel-inverse">
            <div class="panel-heading">{{ $assignment->name }}</div>
            <div class="panel-wrapper" aria-expanded="true">
                <div class="panel-body">
                    @if($assignment->max_files >0)
                        @if ($assignment->over)
                            <div class="alert alert-danger">La date de remise est dépassée, les élèves ne pourront plus
                                vous remettre de fichiers.
                            </div>
                        @elseif (($assignment->allow_delaying > 0) && ( $assignment->late ) && (!$assignment->over))
                            <div class="alert alert-warning">La date de remise est dépassée, mais les élèves peuvent
                                encore vous remettre des fichiers jusqu'au {{ $assignment->last_due_date }}.
                            </div>
                        @else
                            <div class="alert alert-success">Le devoir est encore actif, les élèves peuvent vous
                                remettre leurs fichiers.
                            </div>
                        @endif
                    @endif
                    <strong>Créé le : </strong> {{ $assignment->created_at }}<br>
                    <strong>A remettre avant le / Pour le : </strong> {{ $assignment->due_date }}<br>
                    <hr>
                    <p>{{ $assignment->content }}</p>
                    @if (isset($assignment->documents) && $assignment->documents->count())
                        <p><strong>Documents associés</strong></p>
                        <ul>
                            @foreach ($assignment->documents as $document)
                                <li><i class="icon-doc"></i>{{ $document->name }}</li>
                            @endforeach
                        </ul>
                    @else
                        <small class="nota-bene">Aucune ressource associée</small>
                    @endif
                </div>
            </div>
        </div>
        @if($assignment->max_files >0)
            @if ($assignment->done)
                <div class="panel panel-info">
                    <div class="panel-heading"
                         onclick="document.location = '{{url('teacher/assignments/'.$assignment->id.'/download')}}'">
                        Télécharger tous
                        les fichiers remis par vos élèves
                    </div>
                </div>
            @else
                <div class="panel panel-warning">
                    <div class="panel-heading">Aucun élève n'a rendu son devoir pour l'instant.</div>
                </div>
            @endif

            <div class="panel panel-success">
                <div class="panel-heading">Fichiers remis par les élèves de : {{ $assignment->classe->name }}</div>
                <div class="panel-wrapper" aria-expanded="true">
                    <div class="panel-body">
                        <table class="datatables table color-table dark-table color-bordered-table dark-bordered-table table-hover">
                            <thead>
                            <tr>
                                <th data-toggle="true"> Nom</th>
                                <th> Prénom</th>
                                <th> Nombre de fichiers rendus</th>
                                <th> Remis le</th>
                                <th> Remarques</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($assignment->classe->students as $student)
                                @php $student->current_assignment = $assignment; @endphp
                                <tr
                                        class="
                                @if (($student->late)&&($assignment->late)&&(!$assignment->over)) warning @endif
                                        @if ((!$student->uploaded)&&($assignment->over)) danger @endif
                                        @if (!$student->late) success @endif
                                                "

                                        onclick="document.location = '{{url('teacher/assignments/')}}/{{ $assignment->id }}'">
                                    <td>{{ $student->last_name }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->uploaded }} @if ($student->uploaded!=0)<a
                                                href="{{url('teacher/assignments/')}}/{{ $assignment->id }}/view/{{ $student->id }}">(voir)</a>@endif
                                    </td>
                                    <td>{{ $student->last_updated }}</td>
                                    <td>
                                        @if (($student->late)&&($assignment->late)&&(!$assignment->over)) <span
                                                class="label label-warning">En retard</span> @endif
                                        @if ((!$student->uploaded)&&($assignment->over)) <span
                                                class="label label-danger">Non rendu</span> @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        @endif
    @else
        <div class="panel panel-danger">
            <div class="panel-heading"> Oups ! Une erreur s'est produite...</div>
            <div class="panel-body">
                Il semblerait que ce devoir n'existe pas.
            </div>
        </div>
    @endif
@endsection
