<!-- Upload de fichier -->
    @if ($action == "up_success")
        @include("students.common.banner", ["type" => "green", "icon" => "check",
            "name" => "Votre fichier a bien été enregistré sur nos serveurs.",
            "content" => "Celui-ci va subir le test anti-plagiat."
        ])
    @endif

    @if ($action == "up_disabled")
        @include("students.common.banner", ["type" => "red", "icon" => "close",
            "name" => "La remise des devoirs en ligne n'est pas activée",
        ])
    @endif

    @if ($action == "up_max_files")
        @include("students.common.banner", ["type" => "red", "icon" => "close",
            "name" => "Votre fichier n'a pas pu être enregistré sur nos serveurs.",
            "content" => "Limite maximale de fichiers atteinte"
        ])
    @endif

    @if ($action == "up_no_file")
        @include("students.common.banner", ["type" => "red", "icon" => "close",
            "name" => "Votre fichier n'a pas pu être enregistré sur nos serveurs.",
            "content" => "Il semblerait que vous n'ayez soumis aucun fichier"
        ])
    @endif

    @if ($action == "up_upload")
        @include("students.common.banner", ["type" => "red", "icon" => "close",
            "name" => "Votre fichier n'a pas pu être enregistré sur nos serveurs.",
            "content" => "Une erreur s'est produite lors de l'envoi à nos serveurs"
        ])
    @endif

<!-- Suppression -->
    @if ($action == "rm_success")
        @include("students.common.banner", ["type" => "green", "icon" => "check",
            "name" => "Votre fichier a bien été supprimé de nos serveurs."
        ])
    @endif

    @if ($action == "rm_err_no_file")
        @include("students.common.banner", ["type" => "red", "icon" => "close",
            "name" => "Votre fichier n'a pas pu être enregistré sur nos serveurs.",
            "content" => "Nous n'avons trouvé pas trouvé ce fichier sur nos serveurs."
        ])
    @endif

    @if ($action == "rm_no_data")
        @include("students.common.banner", ["type" => "red", "icon" => "close",
            "name" => "Votre fichier n'a pas pu être enregistré sur nos serveurs.",
            "content" => "Une erreur s'est produite lors de l'envoi à nos serveurs"
        ])
    @endif

<!-- Marqueurs -->
    @if ($action == "mk_success")
        @include("students.common.banner", ["type" => "green", "icon" => "check",
            "name" => "L'état de votre devoir a été mis à jour",
        ])
    @endif

    @if ($action == "mk_fail")
        @include("students.common.banner", ["type" => "red", "icon" => "close",
            "name" => "L'état de votre devoir n'a pas pu être mis à jour",
        ])
    @endif

<!-- Archivé -->
    @if ($action == "archived" && !isset($exam))
        @include("students.common.banner", ["type" => "blue", "icon" => "info",
            "name" => "Ce devoir est archivé.",
            "content" => "Vous ne pouvez pas modifier les fichiers rendus."
        ])
    @endif

    @if ($action == "no_assignment" && !isset($exam))
        @include("students.common.banner", ["type" => "blue", "icon" => "info",
            "name" => "Oups ! Ce devoir n'existe pas.",
            "content" => "Alors, on essaie de faire du zèle :P ?"
        ])
    @endif

    @if ($action == "archived" && isset($exam))
        @include("students.common.banner", ["type" => "blue", "icon" => "info",
            "name" => "Cette interrigation est archivée."
        ])
    @endif

    @if ($action == "no_assignment" && isset($exam))
        @include("students.common.banner", ["type" => "blue", "icon" => "info",
            "name" => "Oups ! Cette interrogation n'existe pas.",
            "content" => "Alors, on essaie de faire du zèle :P ?"
        ])
    @endif
