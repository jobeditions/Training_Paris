
<div class="resources white-box">
    <!-- Intitulé -->
        <h1 class="box-title">
            <i class="icon-docs"></i>Ressources
        </h1>
        <hr>
    <!-- Resources disponibles -->
        <ul>
            @if (isset($assignment->documents) && $assignment->documents->count())
                @foreach ($assignment->documents as $document)
                    <li><i class="icon-doc"></i><a href="/student/documents/{{ $document->id }}">{{ $document->name }}</a></li>
                @endforeach
            @else
                <li><small class="nota-bene">Aucune ressource</small></li>
            @endif
        </ul>
</div>
