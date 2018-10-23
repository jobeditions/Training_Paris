@extends('teachers.layouts.app')

@section('page_name')
    Classes sous responsabilité
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

  <div class="row el-element-overlay">

    @if (isset($classes))
      @foreach ($classes as $classe)
        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
          <div class="white-box">
            <div class="el-card-item">
              <div class="el-card-avatar el-overlay-1"> <img src="/teacheroffice/img/classroom.jpg">
                <div class="el-overlay">
                  <ul class="el-info">
                      <li><a class="btn default btn-outline" href="{{url('teacher')}}/classes/{{ $classe->id }}"><i
                                      class="icon-magnifier"></i></a></li>
                    <li>
                        {{ Form::open(['url' => '/teacher/notes/details', 'id' => 'form'.$classe->id ]) }}
                            <input type="hidden" value="{{ $classe->id }}" name="classe_selector" />
                            <a title="Notes de la classe" class="btn default btn-outline" onclick="document.getElementById('form{{ $classe->id }}').submit()"><i class="zmdi zmdi-labels"></i></a>
                        {{ Form::close() }}
                    </li>
                  </ul>
                </div>
              </div>
              <div class="el-card-content">
                <h3 class="box-title">{{ $classe->name }}</h3>
                  <small>{{ $classe->count }} élèves<br/>
                {{ $classe->subject }}</small>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    @endif

  </div>

  <div class="panel panel-info">
      <div class="panel-heading panel-link" onclick="">Rechercher une classe</div>
  </div>

    <!--<div class="panel panel-info">
        <div class="panel-heading" onclick="document.location = '{{url('teacher/classes/create')}}'">Créer une nouvelle classe</div>
    </div>-->

@endsection
