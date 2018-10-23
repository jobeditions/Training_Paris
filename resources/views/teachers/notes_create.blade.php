@extends('teachers.layouts.app')

@section('page_name')
    Ajouter une note
@endsection

@section('javascript')
<script type="text/javascript">
  $('.note-input').keydown(function (e) {
    if (e.which === 13) {
        var index = $('.note-input').index(this) + 1;
        $('.note-input').eq(index).focus();
    }
  });

  $('#prev-button').click(function(e){
    $('#note_saisie').hide();
    $('#note_infos').show();
  });

  $('#next-button').click(function(e){
    $('#note_saisie').show();
    $('#note_infos').hide();
  });

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
    <div class="panel-heading">Ajouter une note</div>
    <div class="panel-wrapper" aria-expanded="true">
        <div class="panel-body">

          {{ Form::open(['url' => '/teacher/notes/create/']) }}

          <div id="note_infos">

            <div class="form-group">
              <label for="title">Libellé</label>
              <input type="text" name="title" id="title" class="form-control" placeholder="Libellé de la note" />
            </div>

            <div class="row">

              <div class="col-xs-6 col-md-4">
                <div class="form-group">
                  <label for="coeff">Coefficient</label>
                  <input type="number" name="coeff" id="coeff" class="form-control" placeholder="Coefficient" value="1" required />
                </div>
              </div>

              <div class="col-xs-6 col-md-4">
                <div class="form-group">
                  <label for="bareme">Notation sur</label>
                  <input type="number" name="bareme" id="bareme" class="form-control" placeholder="Barème" value="20" required />
                </div>
              </div>

              <div class="col-xs-12 col-md-4">
                <div class="form-group">
                  <label for="type">Type de note</label>
                  <select name="type" id="type" class="form-control">
                    <option value="oral">Oral</option>
                    <option value="interro">Interrogation</option>
                    <option value="dst">DST</option>
                    <option value="examblanc">Examen Blanc</option>
                    <option value="tp">Travaux Pratiques</option>
                    <option value="td">Travaux Dirigés</option>
                    <option value="other" selected>Autre</option>
                  </select>
                </div>
              </div>

            </div>

            <!--Si la classe est passée en paramètre, présélectionnée-->
            <div class="form-group">
              <label for="classe">Classe</label>
              <input type="text" disabled class="form-control" value="{{ $classe->name }}" />
            </div>

              <input type="hidden" name="classe_id" value="{{ $classe->id }}" />

            <div class="form-group">
              <label for="correction">Correction</label>
              <input type="file" name="correction" id="correction" class="form-control">
            </div>

            <div class="row">

              <div class="col-xs-6">
                <div class="form-group">
                  <label for="period">Période</label>
                  <select name="period" id="period" class="form-control">
                    @foreach($periods as $p)
                    <option value="{{ $p->id }}">{{ $p->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="col-xs-6">
                <div class="form-group">
                  <label for="show_date">Date de publication de la note</label>
                  <div class="input-group">
                    <input type="date" id="show_date" name="show_date" class="form-control" value="{{ date('Y-m-d') }}" />
                    <div class="input-group-addon bg-success" id="date_addon"><i class="fa fa-eye"></i></div>
                  </div>
                    <span class="help-block text-success" id="info_date_pub">La note sera visible aux les élèves <b>dès l'ajout</b>.</span>
                </div>
              </div>

            </div>

            <div class="text-right">
              <button class="btn btn-info waves-effect" type="button" id="next-button">Saisir les notes
              </button>
            </div>

          </div>

          <!-- Ajax : récupération de la liste des élèves, affichage du tableau -->

          <div id="note_saisie" style="display:none;">

            <table class="table table-primary table-responsive table-hover table-bordered">
              <thead>
                <tr>
                  <th>NOM Prénom</th>
                  <th>Note obtenue</th>
                </tr>
              </thead>

              <tbody>

              @foreach($classe->students as $i => $student)

                <tr>
                  <td>{{ $student->last_name }} {{ $student->name }}</td>
                  <td><input type="text" class="form-control note-input" name="note{{ $student->student_id }}" placeholder="Non noté" autofocus data-index="{{ $i }}" /></td>
                </tr>

              @endforeach
              </tbody>
            </table>

            <br />

            <div class="row">
              <div class="col-xs-6 col-md-3">
                <button class="btn btn-block btn-info waves-effect" type="button" id="prev-button">Modifier les informations
                </button>
              </div>

              <div class="col-xs-6 col-md-offset-6 col-md-3">
                <button class="btn btn-block btn-success waves-effect" type="submit">Valider la saisie
                </button>
              </div>
            </div>

          </div>

          {{ Form::close() }}

        </div>
    </div>
</div>
@endsection
