@extends('teachers.layouts.app')

@section('page_name')
    Modifier un devoir
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
<div class="panel-heading"> Modifier le devoir "{{ $assignment->name }}"</div>
<div class="panel-wrapper">
    <div class="panel-body">
                <!-- Formulaire d'ajout de document -->
                    {{ Form::open(['url' => '/teacher/assignments/'.$assignment->id.'/edit']) }}
                            <!-- Liste des classes -->
                                <input name="type" type="hidden" value="assignment">

                                <div class="form-group">
                                    <label for="classe_id">Choix de la classe</label>
                                    <select name="classe_id" class="form-control">
                                        @foreach ($classes as $classe)
                                            <option value="{{ $classe->id }}" @if($assignment->classe_id == $classe->id) selected @endif </option> {{ $classe->name }} - {{ $classe->long_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="name">Intitulé du devoir</label><br>
                                    <input name="name" class="form-control" type="text" placeholder="" value="{{ $assignment->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="content">Description du devoir</label>
                                    <textarea name="content" class="form-control" rows="5">{{ $assignment->content }}</textarea>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <center>
                                                <input type="text" name="due_date" class="hidden" value="{{ date('Y-m-d', strtotime($assignment->due_date)) }}">
                                                <div class="set-datepicker-inline" id="date_picker" data-edit="due_date"></div>
                                            </center>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group">
                                            <div class="checkbox checkbox-success">
                                                <input value="1" name="optional" type="checkbox" @if($assignment->optional == 1) checked @endif >
                                                <label for="optional"> Facultatif </label>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="checkbox checkbox-success">
                                                <input name="allow_uploading" onclick="toggleUploadingAl()"
                                                       type="checkbox"  @if($assignment->max_files != 0) checked @endif>
                                                <label for="allow_uploading"> Autoriser la remise de fichier </label>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                            function toggleUploadingAl() {
                                                if (document.getElementById("max_files_form").style.display == 'none') {
                                                    document.getElementById("max_files_form").style.display = 'inline';
                                                    document.getElementById("allow_late_form").style.display = 'inline';
                                                }
                                                else {
                                                    document.getElementById("max_files_form").style.display = 'none';
                                                    document.getElementById("allow_late_form").style.display = 'none';
                                                }
                                            }
                                            function toggleNumDaysLate() {
                                                if (document.getElementById("num_late_form").style.display == 'none')
                                                    document.getElementById("num_late_form").style.display = 'inline';
                                                else
                                                    document.getElementById("num_late_form").style.display = 'none';
                                            }
                                        </script>

                                        <div class="form-group" id="max_files_form"  @if($assignment->max_files == 0) style="display:none;" @endif>
                                            <label for="max_files">Nombre maximal de fichiers par élève (aucune
                                                limite : -1)</label>
                                            <input name="max_files" class="form-control" type="number" value="{{ $assignment->max_files }}">
                                        </div>

                                        <div class="form-group" id="allow_late_form"  @if($assignment->max_files == 0) style="display:none;" @endif>
                                            <div class="checkbox checkbox-success">
                                                <input id="allow_delaying_enable" type="checkbox"
                                                       onclick="toggleNumDaysLate()"  @if($assignment->allow_delaying != 0) checked @endif>
                                                <label for="allow_delaying_enable">  Autoriser la remise de fichier en retard<br><small>Si un étudiant vous rend son devoir en retard, cela vous sera précisé.</small></label>
                                            </div>
                                        </div>
                                        <div class="form-group" id="num_late_form"  @if($assignment->allow_delaying == 0) style="display:none;" @endif>
                                            <label for="allow_delaying">Nombre de jours de retard autorisés (aucune
                                                limite : -1)</label>
                                            <input name="allow_delaying" class="form-control" type="number"
                                                    value="{{ $assignment->allow_delaying }}">
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success waves-effect waves-light m-r-10 pull-right">Enregistrer les modifications</button>
                    {{ Form::close() }}

    </div>
  </div>
</div>
@endsection
