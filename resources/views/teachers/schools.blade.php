@extends('teachers.layouts.app')

@section('page_name')
    Écoles
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

    @if (isset($t_school))
        @foreach ($t_school as $school)
            <div class="panel panel-inverse">
                <div class="panel-heading">{{ $school->name }}</div>
                <div class="panel-wrapper" aria-expanded="true">
                        <div class="panel-body">
                            <strong>Ville :</strong> {{ $school->city_name }} <br>
                            <strong>Administrateur TeacherHawk :</strong> {{ $school->headmaster_name }} <br>
                            <button class="btn btn-info m-t-10" onclick="document.location = '/teacher/schools/{{ $school->id }}'">Plus d'informations</button>
                        </div>
                </div>
            </div>
        @endforeach
    @endif

    <div class="panel panel-info">

        <a href="#" data-perform="panel-collapse">
            <div class="panel-heading"> Rechercher une école
                <div class="pull-right"><i class="ti-plus"></i></div>
        </div>
        </a>
        <div class="panel-wrapper collapse">
            <div class="panel-body">
                <p>
                        Vous pouvez ajouter les écoles dans les lesquelles vous travaillez afin d'avoir accès à la liste de tous les professeurs, événements et élèves de celles-ci.<br>
                        Si vous ne pouvez pas trouver votre école, pas de panique, vous pouvez toujours la référencer dans l'onglet juste en dessous !
                </p>
                <div class="table-responsive">
                    <table class="datatables table color-table dark-table color-bordered-table dark-bordered-table table-hover">
                        <thead>
                            <tr>
                                <th>Etablissement</th>
                                <th>Ville</th>
                                <th>Administrateur TH</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schools as $school)
                                <tr onclick="document.location = '/teacher/schools/{{ $school->id }}'" class="@if ($school->belongs) info @endif">
                                    <td>{{ $school->name }}</td>
                                    <td>{{ $school->city_name }}</td>
                                    <td>{{ $school->headmaster_name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <a href="#" data-perform="panel-collapse">
        <div class="panel-heading"> Référencer une école
            <div class="pull-right"><i class="ti-plus"></i></div>
        </div>
        </a>
        <div class="panel-wrapper collapse">
            <div class="panel-body">
                @if (!$info["created"])

                    @if (isset($response))
                        <div class="alert alert-danger">Une erreur s'est produite...</div>
                    @endif

                    <p>
                        Vérifiez bien que votre école n'est pas déjà référencé dans l'onglet ci-dessus avant de la créer.<br>
                        Votre compte vous permet d'être administateur de 1 établissement.
                    </p>

                    {{ Form::open(array('url' => '/teacher/schools', "class" => "form-horizontal")) }}
                        <div class="form-group">
                            <label class="col-md-12">Nom de l'établissement</label>
                            <div class="col-md-12">
                                <input name="school_name" type="text" class="form-control" placeholder="Requis">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-12">Ville de l'établissement</label>
                            <div class="col-md-12">
                                <input name="school_city" type="text" class="form-control" placeholder="Requis" list="citys-list">
                                <datalist id="citys-list">
                                    @foreach ($info["citys"] as $city)
                                        <option value="{{ $city->city_name }}">
                                    @endforeach
                                </datalist>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox checkbox-success">
                                <input name="headmaster_pays" type="checkbox">
                                <label for="headmaster_pays"> Payer l'abonnement de toute votre école </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">Créer une nouvelle école</button>

                    {{ Form::close() }}
                @else
                    <div class="alert alert-danger">Vous êtes déjà administrateur de {{ $info["created"] }} établissement{{ $info["created"] > 1 ? "s" : "" }}.</div>
                @endif

            </div>
        </div>
    </div>

@endsection
