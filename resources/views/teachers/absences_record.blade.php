@extends('teachers.layouts.app')

@section('page_name')
    Faire l'appel en {{ $classe-> name }}
@endsection

@section('css')
    <link href="/bower_components/footable/css/footable.core.css" rel="stylesheet">
    <link href="/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet"/>
    <style>
        .check {
            opacity: 0.8;
        }

        .label-check {
            background: #e00;
        }

        .pic-check {
            width: 100%;
            padding: 0;
        }

    </style>
@endsection
@section('javascript')
    <script src="/bower_components/footable/js/footable.all.min.js"></script>
    <script src="/bower_components/bootstrap-select/bootstrap-select.min.js"
            type="text/javascript"></script>
    <script src="/js/footable-init.js"></script>
    <script>
        $(document).ready(function (e) {
            $(".img-check").click(function () {
                var student_id = this.id.match(/\d+/);
                $(this).toggleClass("check");
                $(this).closest('label').toggleClass("label-check");

                if($("#item" + student_id).val() == 1) {
                    $("#item" + student_id).val(0);
                }else{
                    $("#item" + student_id).val(1);
                }

                $("#miss" + student_id).toggleClass("hidden");
            });
        });
    </script>
@endsection

@section('content')



    {{ Form::open(array('url' => '/teacher/absences/record/'.$id, 'method' => 'post')) }}

  <!-- <input type="checkbox" name="chk0" class="hidden" id="item0" value="1" checked> -->

    <div class="row">
        @foreach ($classe->students as $student)

            <div class="col-md-3 col-sm-4 col-xs-6" style="margin-bottom: 10px;">
                <div class="card" style="width: 100%;">
                    <label class="btn btn-default pic-check">
                        <img src="{{ url('storage/avatars/'.$student->avatar) }}" class="card-img-top img-check" width="100%" id="avatar{{ $student->student_id }}">
                        <input type="hidden" name="chk{{ $student->student_id }}" id="item{{ $student->student_id }}" value="0">
                    </label>
                    <div class="card-block">
                        <h4 class="card-title">{{ $student->name }} {{ $student->last_name }}&nbsp;<span class="label label-danger hidden" id="miss{{ $student->student_id }}">Absent</span></h4>
                    </div>
                </div>
            </div>

        @endforeach
    </div>

    <br/>

    <button type="submit" class="btn btn-success btn-block">Enregistrer l'appel en classe</button>

    {{ Form::close() }}

@endsection
