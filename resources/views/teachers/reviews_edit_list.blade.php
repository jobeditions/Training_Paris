@extends('teachers.layouts.app')

@section('page_name')
    Appréciations de la classe {{ $classe->name }}
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
@endsection

@section('content')

<div class="panel panel-inverse">
    <div class="panel-heading">Appréciations de la classe {{ $classe->name }}</div>
    <div class="panel-wrapper" aria-expanded="true">
        <div class="panel-body">

        <ul class="nav nav-tabs">
          @foreach ($periods as $p)
            <li class="@if(strtotime($p->start_date) < time() && strtotime($p->end_date) > time()) active @endif"><a href="#tab-{{ $p->id }}" data-toggle="tab">{{ $p->name }}</a></li>
          @endforeach
        </ul>

        <div class="tab-content br-n pn">
          @foreach ($periods as $p)
            <div id="tab-{{ $p->id }}" class="tab-pane @if(strtotime($p->start_date) < time() && strtotime($p->end_date) > time()) active @endif">
              <br />

              @if(strtotime($p->end_date) < time())
                <div class="alert alert-danger"><i class="fa fa-warning"></i> <b>Attention !</b> Vous ne pouvez plus saisir ou modifier les appréciations pour cette période.</div>
              @else
                <p align="justify">Cliquez sur une note pour la modifier.</p>
              @endif

              <table class="table table-primary table-responsive table-hover table-bordered" id="reviewsteacher">
                <thead>
                  <tr>
                    
                    <th text-align="center"><i class="fa fa-picture-o" aria-hidden="true"></i> Image</th>
                    <th align="center"><i class="icon_document_alt"></i> NOM Prénom</th>
                    
                    <th align="center"><i class="fa fa-star-half-o" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i><i class="fa fa-star-half-o" aria-hidden="true"></i> Moyenne </th>
                    <th align="center">Appréciation</th>
                  </tr>
                </thead>

                <tbody>
                
                @foreach($classe->students as $i => $student)

              
                  <tr>


                    
                    <td style="border-image: 2px solid grey"><a href="{{route('single.posting',['id'=>$student->student_id,'class'=>$classe->id])}}"><img src="{{$student->avatar}}" width="200px" height="120px"/></a>
                    </td>
                    <td style="vertical-align:middle;">{{ $student->last_name }} {{ $student->name }}</td>
                    
                    <td style="vertical-align:middle;" class="text-center">00.00</td>
                    <td style="vertical-align:middle;">
                     <textarea class="form-control" name="review{{ $student->student_id }}" placeholder="Saisissez votre appréciation" @if(strtotime($p->end_date) < time()) disabled @endif autofocus data-index="{{ $i }}"></textarea> 

                    </td>
                  </tr>
                  

                @endforeach
                </tbody>
              </table>

              <button type="submit" class="btn btn-success pull-right">Enregistrer</button>

            </div>
          @endforeach
        </div>

        </div>
    </div>
</div>
@endsection
