<div class="messages white-box">
    <!-- Intitulé -->
        <h1 class="box-title">
            <i class="icon-speech"></i>Nouveau message
            @if (isset($posted))
                <h2 class="box-sub">Posté sur <a href="/student/assignments/{{ $posted->id }}">{{ $posted->name }}</a></h2>
            @endif
        </h1>
        <hr>
        <div class="wrapper">
    <!-- Messages -->
        @include("students.modules.messages.template", ["message" => $retrieved, "name" => $teacher->name])
        </div>
</div>
