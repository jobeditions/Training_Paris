@extends('students.layouts.app')

@section('pagename')
    Mes interrogations
@endsection

<!-- Liste des devoirs -->

@section("content")
    <div class="container assignments">
        @include("students.common.banner", ["name" => "Prochaines évaluations", "icon" => "calender", "type" => "black"])

            <div class="btn-group btn-group-justified activity-visibility">
                <div class="btn btn-primary" data-value="0">Prochaines évaluations</div>
                <div class="btn btn-primary" data-value="1">Toutes les évaluations</div>
            </div>

            @if ($exams->count())
                @foreach ($exams as $exam)
                    @include("students.exams.exam", ["exam" => $exam])
                @endforeach
            @else
                <div class="white-box">
                    <small class="nota-bene">Aucune évaluation de prévue pour le moment</small>
                </div>
            @endif

    <script>TeacherHawk.assignments.dates() ; window.TeacherHawk.toogle.init(".assignment-over") ;</script>
@endsection
