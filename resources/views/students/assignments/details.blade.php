@extends('students.layouts.app')

@section("content")
    <!-- Détails du devoir -->
        <div class="container assignments">
            <!-- Vérification que le devoir existe -->
                @if (isset($assignment))
                    <!-- Intitulé -->
                        @include("students.common.banner", ["type" => "black", "name" => $assignment->name, "icon" => "notebook"])

                    <!-- Résumé du devoir -->
                        @if (!$assignment->todo)
                            @if (isset($exam))
                                @include("students.common.banner", ["type" => "blue", "icon" => "info",
                                    "name" => "Ceci est l'interrogation d'une autre classe"
                                ])
                            @else
                                @include("students.common.banner", ["type" => "blue", "icon" => "info",
                                    "name" => "Ceci est le devoir d'une autre classe"
                                ])
                            @endif
                        @endif

                    <!-- Actions -->
                        @if (isset($action))
                            @include("students.assignments.components.messages", ["action" => $action])
                        @endif

                    <!-- Détails du devoir -->
                        <div class="row">
                            <div class="col-xs-12">
                                @include("students.assignments.components.assignment", ["assignment" => $assignment, "details" => true])
                            </div>
                        </div>

                    <!-- Modules concernant les messages et la liste des resources -->
                        <div class="row">
                            <div class="col-xs-12 col-md-8 fixed-size">
                                    @include("students.modules.messages.messages")
                            </div>
                            <div class="col-xs-12 col-md-4 fixed-size">
                                    @include("students.documents.view", ["assignment" => $assignment])
                            </div>
                        </div>

                    <!-- Formulaire -->
                        @include("students.assignments.components.form", ["assignment" => $assignment])

                @else
                    @include("students.common.banner", ["type" => "red", "icon" => "close",
                        "name" => "Oups ! Ce devoir n'existe pas.",
                        "content" => "Alors, on essaie de faire du zèle :P ?"
                    ])
                @endif
        </div>

    <!-- Scripts -->
        <script>
            TeacherHawk.assignments.dates() ;
            TeacherHawk.toogle.init(".assignment-over") ;
            TeacherHawk.dropify() ;
        </script>
@endsection
