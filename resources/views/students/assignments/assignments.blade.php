@extends('students.layouts.app')

@section('pagename')
    Mes devoirs
@endsection

@section("content")
    <!-- Liste des devoirs -->
        <div class="container assignments">
            <!-- Intitulé -->
                @include("students.common.banner", ["type" => "black", "name" => "Vos devoirs", "icon" => "notebook"])

            <!-- Menu -->
                <div class="btn-group btn-group-justified activity-visibility">
                    <div class="btn btn-primary" data-value="0">Devoirs actifs</div>
                    <div class="btn btn-primary" data-value="1">Tous les devoirs</div>
                </div>

            <!-- Devoirs -->
                <div class="row">
                    @foreach ($assignments as $assignment)
                        <div class="col-xs-12">
                            @include("students.assignments.components.assignment", ["exam" => false, "assignment" => $assignment])
                        </div>
                    @endforeach
                </div>
        </div>

    <!-- Scripts -->
        <script>
            TeacherHawk.assignments.dates() ;
            TeacherHawk.toogle.init(".assignment-over") ;
        </script>
@endsection
