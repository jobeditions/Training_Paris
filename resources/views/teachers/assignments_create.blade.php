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

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="panel panel-info">
    <div class="panel-heading"> Ajouter un nouvau devoir ou examen</div>
    <div class="panel-wrapper">
        <ul class="nav customtab nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#create-assignment" aria-controls="create-assignment" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="fa-file-text"></i></span><span class="hidden-xs"> Devoir</span></a></li>
            <li role="presentation" class=""><a href="#create-exams" aria-controls="create-exams" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="fa-calendar"></i></span> <span class="hidden-xs"> Examen</span></a></li>
        </ul>
        <div class="panel-body">
            <div class="tab-content m-t-0">
                <div role="tabpanel" class="tab-pane fade active in" id="create-assignment">
                    <!-- Formulaire d'ajout de document -->
                        {{ Form::open(['url' => '/teacher/assignments']) }}
                                <!-- Liste des classes -->
                                    <input name="type" type="hidden" value="assignment">

                                    <div class="form-group">
                                        <label for="classe_id">Choix de la classe</label>
                                        <select name="classe_id" class="form-control">
                                            @foreach ($classes as $classe)
                                                <option value="{{ $classe->id }}">{{ $classe->name }} - {{ $classe->subject }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Intitulé du devoir</label><br>
                                        <input name="name" class="form-control" type="text" placeholder="">
                                    </div>

                                    <div class="form-group">
                                        <label for="content">Description du devoir</label>
                                        <textarea name="content" class="form-control" rows="5"></textarea>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group">
                                                <center>
                                                    <input type="text" name="due_date" class="hidden">
                                                    <div class="set-datepicker-inline" data-edit="due_date"></div>
                                                </center>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group">
                                                <div class="checkbox checkbox-success">
                                                    <input name="optional" type="checkbox">
                                                    <label for="optional"> Facultatif </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="checkbox checkbox-success">
                                                    <input name="allow_uploading" onclick="toggleUploadingAl()"
                                                           type="checkbox">
                                                    <label for="allow_uploading"> Autoriser la remise de fichier </label>
                                                </div>
                                            </div>
                                            <script type="text/javascript">
                                                function toggleUploadingAl() {
                                                    if (document.getElementById("max_files_form").style.display == 'inline') {
                                                        document.getElementById("max_files_form").style.display = 'none';
                                                        document.getElementById("allow_late_form").style.display = 'none';
                                                    }
                                                    else {
                                                        document.getElementById("max_files_form").style.display = 'inline';
                                                        document.getElementById("allow_late_form").style.display = 'inline';
                                                    }
                                                }
                                                function toggleNumDaysLate() {
                                                    if (document.getElementById("num_late_form").style.display == 'inline')
                                                        document.getElementById("num_late_form").style.display = 'none';
                                                    else
                                                        document.getElementById("num_late_form").style.display = 'inline';
                                                }
                                            </script>

                                            <div class="form-group" id="max_files_form" style="display:none;">
                                                <label for="max_files">Nombre maximal de fichiers par élève (aucune
                                                    limite : -1)</label>
                                                <input name="max_files" class="form-control" type="number">
                                            </div>

                                            <div class="form-group" id="allow_late_form" style="display:none;">
                                                <div class="checkbox checkbox-success">
                                                    <input id="allow_delaying_enable" type="checkbox"
                                                           onclick="toggleNumDaysLate()">
                                                    <label for="allow_delaying_enable">  Autoriser la remise de fichier en retard<br><small>Si un étudiant vous rend son devoir en retard, cela vous sera précisé.</small></label>
                                                </div>
                                            </div>
                                            <div class="form-group" id="num_late_form" style="display:none;">
                                                <label for="allow_delaying">Nombre de jours de retard autorisés (aucune
                                                    limite : -1)</label>
                                                <input name="allow_delaying" class="form-control" type="number"
                                                       value="0">
                                            </div>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10 pull-right">Valider</button>
                        {{ Form::close() }}
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="create-exams">
                        <!-- Formulaire d'ajout de document -->
                        {{ Form::open(['url' => '/teacher/assignments']) }}
                                <!-- Liste des classes -->
                                    <input name="type" type="hidden" value="exam">

                                    <div class="form-group">
                                        <label for="classe_id">Choix de la classe</label>
                                        <select name="classe_id" class="form-control">
                                            @foreach ($classes as $classe)
                                                <option value="{{ $classe->id }}">{{ $classe->name }} - {{ $classe->subject }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Sujet de l'examen</label><br>
                                        <input name="name" class="form-control" type="text" placeholder=""></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="content">Description de l'examen</label>
                                        <textarea name="content" class="form-control" rows="5"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <div class="checkbox checkbox-success">
                                            <input name="surprise" type="checkbox">
                                            <label for="surprise">  Surprise<br><small>Les étudiants ne pourront pas savoir exactement la date de l'examen mais seront prévenus de son existence.</small></label>
                                        </div>
                                    </div>

                                    <center>
                                        <input type="text" name="due_date" class="hidden">
                                        <div class="set-datepicker-inline" data-edit="due_date"></div>
                                    </center>

                                    <button type="submit" class="btn btn-success waves-effect waves-light m-r-10 pull-right">Valider</button>
                        {{ Form::close() }}
                        </div>
                </div>
        </div>
    </div>
</div>

@endsection
