@extends('teachers.layouts.app')

@section('page_name')
    Modifier les paramètres du devoir du {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $note->add_date)->format('d/m/Y') }}
@endsection

@section('javascript')
    <script type="text/javascript">
        $('#show_date').change(function (e) {
            var startDate = new Date( $(this).val() );
            var endDate = new Date("{{ date('Y-m-d') }}");

            if(startDate > endDate){
                var diff = Math.round((startDate-endDate)/(1000*60*60*24));
                if(diff < 2)
                    $("#info_date_pub").html('La note sera visible aux élèves <b>dès demain</b>.');
                else
                    $("#info_date_pub").html('La note sera visible aux élèves <b>dans ' + diff + ' jours</b>.');

                $("#date_addon").removeClass('bg-success').addClass('bg-warning').html('<i class="fa fa-eye-slash"></i>');
                $("#info_date_pub").removeClass('text-success').addClass('text-warning');
            }else{

                $("#info_date_pub").html('La note sera visible aux élèves <b>dès l\'ajout</b>.');
                $("#date_addon").removeClass('bg-warning').addClass('bg-success').html('<i class="fa fa-eye"></i>');
                $("#info_date_pub").removeClass('text-warning').addClass('text-success');

            }
        });
    </script>
@endsection

@section('content')
    <div class="panel panel-inverse">
        <div class="panel-heading">Modifier une note</div>
        <div class="panel-wrapper" aria-expanded="true">
            <div class="panel-body">

                {{ Form::open(['url' => '/teacher/notes/edit/'.$note->id]) }}

                <div id="note_infos">

                    <div class="form-group">
                        <label for="label">Libellé</label>
                        <input type="text" name="label" id="label" class="form-control" placeholder="Libellé de la note" value="{{ $note->title }}" required />
                    </div>

                    <div class="row">

                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label for="coeff">Coefficient</label>
                                <input type="number" name="coeff" id="coeff" class="form-control" placeholder="Coefficient" value="{{ $note->coefficient }}" required />
                            </div>
                        </div>

                        <div class="col-xs-6 col-md-4">
                            <div class="form-group">
                                <label for="bareme">Notation sur</label>
                                <input type="number" name="bareme" id="bareme" class="form-control" placeholder="Barème" value="{{ $note->bareme }}" required />
                            </div>
                        </div>

                        <div class="col-xs-12 col-md-4">
                            <div class="form-group">
                                <label for="type">Type de note</label>
                                <select name="type" id="type" class="form-control">
                                    <option value="oral" @if($note->type == "oral") selected @endif>Oral</option>
                                    <option value="interro" @if($note->type == "interro") selected @endif>Interrogation</option>
                                    <option value="dst" @if($note->type == "dst") selected @endif>DST</option>
                                    <option value="examblanc" @if($note->type == "examblanc") selected @endif>Examen Blanc</option>
                                    <option value="tp" @if($note->type == "tp") selected @endif>Travaux Pratiques</option>
                                    <option value="td" @if($note->type == "td") selected @endif>Travaux Dirigés</option>
                                    <option value="other" @if($note->type == "other") selected @endif>Autre</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    @if( isset($note->correction) && $note->correction )
                        <div class="alert alert-warning">Un fichier de correction a déjà été ajouté sur ce devoir.</div>
                    @else
                        <div class="form-group">
                            <label for="correction">Correction</label>
                            <input type="file" name="correction" id="correction" class="form-control">
                        </div>
                    @endif

                    <div class="row">

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="period">Période</label>
                                <select name="period" id="period" class="form-control">
                                    <option value="1" @if($note->period == 1) selected @endif>1er trimestre</option>
                                    <option value="2" @if($note->period == 2) selected @endif>2ème trimestre</option>
                                    <option value="3" @if($note->period == 3) selected @endif>3ème trimestre</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xs-6">
                            <div class="form-group">
                                <label for="show_date">Date de publication de la note</label>
                                <div class="input-group">
                                    <input type="date" id="show_date" name="show_date" class="form-control" value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $note->publish_date)->format('Y-m-d') }}" />
                                    <div class="input-group-addon bg-success" id="date_addon"><i class="fa fa-eye"></i></div>
                                </div>
                                <span class="help-block text-success" id="info_date_pub">La note sera visible aux les élèves <b>dès l'ajout</b>.</span>
                            </div>
                        </div>

                    </div>

                    <div class="text-right">
                        <button class="btn btn-success waves-effect" type="submit">Enregistrer les modifications
                        </button>
                    </div>

                </div>

                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection
