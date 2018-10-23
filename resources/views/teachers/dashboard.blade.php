@extends('teachers.layouts.app')

@section('page_name')
    Accueil
@endsection

@section('content')
    <!-- .row -->
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Devoirs</h3>
                <ul class="list-inline two-part">
                <li>
                    <div id="sparklinedash"></div>
                </li>
                    <li class="text-right"><i class="ti-arrow-up text-success"></i> <span
                                class="counter text-success">{{ $info['assignments'] }}</span></li>
            </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Examens</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash2"></div>
                </li>
                    <li class="text-right"><i class="ti-arrow-up text-purple"></i> <span
                                class="counter text-purple">{{ $info['exams'] }}</span></li>
                </ul>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">&Eacute;lèves</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash3">{{ $info['students'] }}</div>
                </li>
                    <li class="text-right"><i class="ti-arrow-up text-info"></i> <span
                                class="counter text-info"></span></li>
            </ul>
        </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12">
            <div class="white-box analytics-info">
                <h3 class="box-title">Invitations restantes</h3>
                <ul class="list-inline two-part">
                    <li>
                        <div id="sparklinedash4"></div>
                </li>
                    <li class="text-right"><i class="ti-arrow-down text-danger"></i> <span
                                class="text-danger">{{ $info['remaining_invites'] }}</span>
                </li>
            </ul>
        </div>
    </div>
    </div>
    <!--/.row -->
    <!-- .row -->
    <div class="row">
        <div class="col-md-6 col-md-push-6">
          <div class="panel panel-inverse">

              <div class="panel-heading"> <i class="icon-info"></i> Actualités
                  <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a></div>
              </div>

              <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">

                      @foreach ($news as $data)
                          <blockquote>
                              @if (!empty($data->title))
                                  <strong>{{ $data->title }}</strong>
                              @endif
                              <p>{{ $data->content }}</p>
                              @if (!empty($data->author))
                                  <small>{{ $data->author }}</small>
                              @endif
                          </blockquote>
                      @endforeach

                  </div>
              </div>

            <div class="panel-footer text-right">
                <a href="#" data-toggle="modal" data-target="#newActuModal"><i class="icon-plus"></i> Ajouter une
                    actualité</a>
            </div>

          </div>
        </div>

        <div class="col-md-6 col-md-pull-6">
            <div class="white-box">
                <div id="calendar"></div>

                  <script>
                    $(function () {window.TeacherHawk.calendar.prepared = [] ;
                    @foreach ($calendar as $data)
                      window.TeacherHawk.calendar.prepared.push({
                         url:"{{url('teacher/'.$data->type)}}/{{ $data->id }}",
                         title:"{{ $data->name }}\n{{ $data->classe_name }}",
                         start:"{{ $data->due_date }}".split(" ")[0]
                    });
                    @endforeach
                    window.TeacherHawk.calendar() ;
                    })
                  </script>

              </div>
        </div>
    </div>
    <!--/.row -->

    <div class="modal fade" id="newActuModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                {{ Form::open(['url' => '/teacher/actuality/create/']) }}

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><i class="icon-plus"></i> Ajouter une actualité</h4>
                </div>

                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Titre
                            <small><i>(optionnel)</i></small>
                        </label>
                        <input type="text" name="title" id="title" class="form-control"/>
                    </div>

                    <div class="form-group">
                        <label for="content">Contenu</label>
                        <textarea name="content" id="content" class="form-control"></textarea>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-info">Valider</button>
                </div>

                {{ Form::close() }}
            </div>


        </div>
    </div>
@endsection
