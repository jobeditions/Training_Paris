@extends('students.layouts.app')

@section('pagename')
    Mes professeurs
@endsection

@section("content")
<div class="container">
    @include("students.common.banner", ["name" => "Mes professeurs", "type" => "black", "icon" => "user"])
    <div class="row">
        <!-- Liste des progresseurs -->
            @foreach ($teachers as $teacher)
            <div class="col-xs-12">
                @include("students.teachers.teacher", ["teacher" => $teacher])
            </div>
            @endforeach
    </div>
</div>
    <script>TeacherHawk.assignments.dates() ;</script>
@endsection
