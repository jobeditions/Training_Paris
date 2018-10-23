<?php
//Récupération des messages en rapport avec le devoir
    $messages = DB::table("teachers_messages")->where([["teacher_id", "=", $assignment->teacher_id], ["assignment_id", "=", $assignment->id]])->get() ;
?>

<!-- Module affichant la liste des discussions en rapport avec le devoir -->
    <div class="messages white-box">
        <!-- Intitulé -->
            <h1 class="box-title">
                <i class="icon-speech"></i>Discussions
            </h1>
            <hr>
            <div class="wrapper">
        <!-- Messages -->
            @if ($messages->count())
                @foreach ($messages as $message)
                    <?php
                        //Récupération des noms des professeurs (transformation d'id)
                            $id = DB::table("teachers")->where("id", $assignment->teacher_id)->first()->user_id ;
                            $name = DB::table("users")->where("id", $id)->first()->name[0].". ".DB::table("users")->where("id", $id)->first()->last_name ;
                    ?>
                    @include("students.modules.messages.template", ["message" => $message, "name" => $name])
                @endforeach
            @else
                <small class="nota-bene">Aucune discussion</small>
            @endif
            </div>
    </div>
