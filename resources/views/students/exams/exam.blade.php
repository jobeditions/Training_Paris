<div class="white-box @if($exam->over) assignment-over @endif">
    <!-- En-tête -->
        <h1 class="box-title">
            <small class="pull-right m-t-10">Remis par <a href="/student/teachers/{{ $exam->teacher_id }}">{{ $exam->author }}</a></small>
            <i class="icon-book-open"></i>{{ $exam->name }}
        </h1>
    <!-- Dates -->
        <div class="dates">
            <!-- Dates -->
                @if ($exam->over)
                    <small>Cette évaluation a déjà eu lieu (Réalisée le <span class="hidden created-date">{{ $exam->due_date }}</span><span class="created-date-formatted"></span>).</small><br>
                @else
                    @if (!$exam->surprise)
                        <small>Prévue le <span class="hidden created-date">{{ $exam->due_date }}</span><span class="created-date-formatted"></span></small><br>
                    @endif
                @endif
        </div>
        <hr>
    <!-- Contenu -->
        <p>{{ $exam->content }}</p>
        <!-- Bouton -->
            <hr>
            <div class="text-right">
                @if ($exam->over)
                    <a href="/student/exams/{{ $exam->id }}"><button class="btn btn-info">Afficher plus de détails</button></a>
                @else
                    <a href="/student/exams/{{ $exam->id }}"><button class="btn btn-primary">Afficher plus de détails</button></a>
                @endif
            </div>
</div>
