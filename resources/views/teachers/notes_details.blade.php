@extends('teachers.layouts.app')

@section('page_name')
    Notes de la classe "{{ $classe->name }}"
@endsection

@section('css')
    <link href="/bower_components/footable/css/footable.core.css" rel="stylesheet">
    <link href="/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet"/>
    <link href="/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet"/>

@endsection
@section('javascript')
    <script src="/bower_components/footable/js/footable.all.min.js"></script>
    <script src="/bower_components/bootstrap-select/bootstrap-select.min.js"
            type="text/javascript"></script>
    <script src="/js/footable-init.js"></script>
    <script src="/bower_components/toast-master/js/jquery.toast.js" type="text/javascript"></script>
    <script src="/js/toastr.js" type="text/javascript"></script>
    <script>
        $('.noteEditable').blur(function() {
            // alert("Note éditée, avec l'id " + $(this).attr('id'));
        });
    </script>
@endsection

@section('content')

<div class="panel panel-info">
    <div class="panel-heading panel-link" onclick="document.location = '{{url('teacher/notes/create')}}/{{ $classe->id }}'">Ajouter une nouvelle note</div>
</div>

<div class="panel panel-success">
    <div class="panel-heading panel-link" onclick="document.location = '{{url('teacher/notes/graphics')}}'">Graphiques et courbes</div>
</div>

<div class="panel panel-inverse">
    <div class="panel-heading">Notes de la classe "{{ $classe->name }}"</div>
    <div class="panel-wrapper" aria-expanded="true">
        <div class="panel-body">

              <ul class="nav nav-pills m-b-30 pull-right">
                @foreach ($periods as $p)
                  <li class="@if(strtotime($p->start_date) < time() && strtotime($p->end_date) > time()) active @endif"><a href="#tab-{{ $p->id }}" data-toggle="tab">{{ $p->name }}</a></li>
                @endforeach
              </ul>
              <div class="tab-content br-n pn">
                @foreach ($periods as $p)
                  <div id="tab-{{ $p->id }}" class="tab-pane @if(strtotime($p->start_date) < time() && strtotime($p->end_date) > time()) active @endif">
                    <br />

                    @if(strtotime($p->end_date) < time())
                      <div class="alert alert-warning"><i class="fa fa-warning"></i> <b>Attention !</b> Vous ne pouvez plus saisir ou modifier les notes pour cette période.</div>
                    @else
                      <p align="justify">Cliquez sur une note pour la modifier.</p>
                    @endif
                      
                    <table class="table table-bordered no-footer table-hover" role="grid">
                        <tr>
                          <th class="text-center">NOM Prénom</th>
                          <th class="text-center">Moyenne</th>
                      @foreach ($notes as $note)
                        @if ($note->period == $p->id)
                          <th class="text-center">
                            {{ $note->title }}<br />
                            Coefficient : {{ $note->coefficient }}<br />
                            Barème : {{ $note->bareme }}<br />
                          </th>
                        @endif
                      @endforeach
                        </tr>

                        <tr>
                          <th class="text-center"></th>
                          <th class="text-center"></th>
                        @foreach ($notes as $note)
                          @if ($note->period == $p->id)
                            <th class="text-center">
                                <a href="{{url('teacher/notes/edit/'.$note->id)}}" title="Modifier"><i class="fa fa-pencil"></i></a>&nbsp;
                              <!-- Si le corrigé existe ->"" Modifier le corrigé joint // sinon, joindre -->
                              <a href="#" title="Joindre un corrigé"><i class="fa fa-paperclip"></i></a>&nbsp;
                              <a href="{{url('teacher/notes/delete/'.$note->id)}}" title="Supprimer"><i class="fa fa-times"></i></a>&nbsp;
                            </th>
                          @endif
                        @endforeach
                        </tr>
                      </thead>

                      <tbody>
                        <tr>
                          <th>CLASSE</th>
                          <th class="text-center">
                            @if ( isset ( $notes->avgGet_classe ) )
                              {{ $notes->avgGet_classe }}
                            @else
                              -
                            @endif
                          </th>
                          @foreach ($notes as $note)
                            @if ($note->period == $p->id)
                              <th class="text-center">{{ $note->avgClasse }}</th>
                            @endif
                          @endforeach
                        </tr>

                      @foreach ($classe->students as $student)
                        <tr>
                          <td>{{ strtoupper($student->last_name) }} {{ $student->name }}</td>
                          <td class="text-center">
                              @if (!empty( $students_avg[$student->student_id] ))
                                  {{ $students_avg[$student->student_id] }}
                              @else
                                  -
                              @endif
                          </td>
                          @foreach ($notes as $note)
                           @if ($note->period == $p->id)
                            @if ( isset( $note->students_notes[$student->student_id] ) )
                              <td class="text-center"><div contenteditable class="noteEditable" id="note{{ $student->student_id."_".$note->id }}">{{ $note->students_notes[$student->student_id] }}</div></td>
                            @else
                              <td class="text-center"><div contenteditable class="noteEditable" id="note{{ $student->student_id."_".$note->id }}"> - </div></td>
                            @endif
                           @endif
                          @endforeach
                        </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                @endforeach
              </div>

        </div>
    </div>
</div>
@endsection
