@extends('teachers.layouts.app')

@section('page_name')
    Historique des Absences
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
        <div class="panel-heading">Historique des appels effectués</div>
        <div class="panel-wrapper" aria-expanded="true">
            <div class="panel-body">

                @if (count($history))
                    <div class="table-responsive">
                        <table class="table table-striped datatables dataTable no-footer table-hover color-bordered-table muted-bordered-table">
                            <thead>
                            <tr>
                                <th> Classe</th>
                                <th> Absents</th>
                                <th> Retardataires</th>
                                <th> Validé le </th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($history as $call)
                                <tr onclick="document.location = '{{url('teacher/assignments/')}}/{{ $call->id }}'">
                                    <td>{{ $call->classe }}</td>
                                    <td>{{ $call->absences }}</td>
                                    <td>{{ $call->retards }}</td>
                                    <td>{{ $call->date_validation }}</td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                @else
                    <i>Vous n'avez enregistré aucun appel en classe pour le moment.</i>
                @endif
            </div>
        </div>
    </div>

@endsection
