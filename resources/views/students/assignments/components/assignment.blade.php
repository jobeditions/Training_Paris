<!-- Informations sur le devoir -->
    <div class="white-box @if(!$assignment->todo) not-yours @endif @if($assignment->over && !isset($details)) assignment-over @endif" data-id="{{ $assignment->id }}">
        <!-- En-tête -->
            <h1 class="box-title">
                <!-- Informations générales -->

                <small class="pull-right m-t-10">Remis par <a
                            href="/student/teachers/{{ $assignment->teacher_id }}">{{ $assignment->teacher->data->name." ".$assignment->teacher->data->last_name }}</a>
                </small>
                    <i class="icon-book-open"></i>{{ $assignment->name }}
            </h1>
            <!-- Facultatif -->
                @if (isset($assignment->optional) && $assignment->optional)
                    <h2 class="box-sub">Facultatif</h2>
                @endif
            <hr>
        <!-- Contenu (ne s'affiche que si l'option détails est active) -->
            @if (isset($details))
                <p>{{ $assignment->content }}</p>
                <hr>
            @endif

        <!-- Dates de rendu -->
            <div class="dates">
                <div class="media">
                <!-- Dates -->
                    <div class="media-body">
                        <!-- Date de création -->
                            @if (isset($details))
                                <small>Remis le <span class="hidden created-date">{{ $assignment->created_at }}</span><span class="created-date-formatted"></span></small><br>
                            @endif
                        <!-- Informations supplémentaire sur la date de rendu si le devoir est à réaliser -->
                            @if (!isset($exam) && $assignment->todo)
                                <!-- Devoir terminé -->
                                    @if ($assignment->over)
                                        <span>Ce devoir est archivé : il n'est plus possible de remettre des documents au professeur l'ayant créé.</span>
                                <!-- Devoir à terminer -->
                                    @else
                                        A réaliser avant le <span class="hidden due-date">{{ $assignment->due_date }}</span><span class="due-date-formatted"></span><br>
                                        <span class="time-left"></span>
                                    @endif
                            @elseif (!isset($exam))
                                <span class="text-red">Ce devoir n'est pas à réaliser par votre classe</span>
                            @endif

                            @if (isset($exam) && $assignment->todo)
                                <!-- Devoir terminé -->
                                    @if ($assignment->over)
                                        <span>Cette évaluation a déjà eu lieu</span>
                                <!-- Devoir à terminer -->
                                    @else
                                        Cette évaluation aura lieu le <span class="hidden due-date">{{ $assignment->due_date }}</span><span class="due-date-formatted"></span>
                                    @endif
                            @elseif (isset($exam))
                                <span class="text-red">Cette interro n'est pas à destinée à votre classe</span>
                            @endif
                        </div>
                <!-- Boutons -->
                    <div class="media-right media-bottom text-right">
                        <!-- Modification de l'état du devoir -->
                            @if (isset($details))
                                @if (!$assignment->over && !isset($exam))
                                    {!! Form::open(["url" => "student/assignments/".$assignment->id, "method" => "PUT"]) !!}
                                        <!-- Mise à jour du marqueur -->
                                            <input type="hidden" name="action" value="marker_update">
                                            @if (isset($assignment->done) && $assignment->done)
                                                <input type="hidden" name="marker" value="progress">
                                                <button type="submit" class="btn btn-warning">Marquer comme en cours</button>
                                            @else
                                                <input type="hidden" name="marker" value="done">
                                                <button type="submit" class="btn btn-success">Marquer comme terminé</button>
                                            @endif
                                    {!! Form::close() !!}
                                @endif
                            @else
                        <!-- Bouton pour afficher plus de détails s'il s'agit de l'aperçu rapide -->
                            <div class="labels">
                                <!-- Devoir en retard -->
                                    @if (($assignment->late)&&(!$assignment->over)&&(!$assignment->done))
                                        <span class="label label-warning">En retard !</span>
                                    @endif
                                <!-- Etat du devoir -->
                                    @if ($assignment->done_by_student)
                                        <span class="label label-success">Marqué comme terminé</span>
                                    @endif
                            </div>
                                <!-- Bouton -->
                                    @if ($assignment->over)
                                        <a href="/student/assignments/{{ $assignment->id }}"><button class="btn btn-info">Afficher plus de détails</button></a>
                                    @else
                                        <a href="/student/assignments/{{ $assignment->id }}"><button class="btn btn-primary">Afficher plus de détails</button></a>
                                    @endif
                        @endif
                    </div>
                </div>
                <!-- Progressions -->
                    @if (!isset($exam) && $assignment->todo && isset($details))
                        @if (!$assignment->over)
                            <!-- Barre de temps-->
                                <div class="progress">
                                    <div class="progress-bar" role="progressbar"> <span class="sr-only"></span></div>
                                </div>
                            <!-- Jours de retards -->
                                @if ($assignment->allow_delaying)
                                    <small class="nota-bene">Ce devoir peut être rendu {{ $assignment->allow_delaying }}
                                        @if ($assignment->allow_delaying == 1) {{ "jour" }}
                                        @else {{ "jours" }}
                                        @endif
                                        en retard mais cela sera précisé au professeur.
                                    </small>
                                @endif
                        @endif
                    @endif
            </div>
    </div>
