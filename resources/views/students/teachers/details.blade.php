@extends('students.layouts.app')

@section('pagename')
    {{ $teacher->fname }}
@endsection

@section("content")
    <div class="container-fluid teacher-page">
        <!-- Prof inexistant -->
        @if (is_null($teacher))
            <div class="container">
                @include("students.teachers.details.null")
            </div>
        @else
            <div class="jumbotron">
                <h1><img src="{{ $teacher->avatar }}" height="150" class="img-circle"/>&nbsp;{{ $teacher->fname }}</h1>
            </div>

            <!-- Liste des actualités -->
            <div class="container">
                <div class="btn-group btn-group-justified activity-visibility">
                    <div class="btn btn-primary" data-value="0">Votre classe</div>
                    <div class="btn btn-primary" data-value="1">Toute l'activité</div>
                </div>

                @foreach ($news as $nnew)

                    @if ($nnew->type == "assignments")
                        @include("students.assignments.components.assignment", ["assignment" => $nnew->data])
                    @endif

                @endforeach
            </div>
        @endif
    </div>


    <script>TeacherHawk.assignments.dates() ; window.TeacherHawk.toogle.init(".not-yours") ; </script>
@endsection
