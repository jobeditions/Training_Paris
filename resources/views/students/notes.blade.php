@extends('students.layouts.app')

@section('pagename')
    Mes notes
@endsection

@section('css')
    <link href="/css/notes.css" rel="stylesheet">
@endsection

@section('javascript')
@endsection

@section("content")

    <div class="container">

        <div class="alert alert-info">Permettre à l'élève de choisir la période : trimestre, semestre, etc ... Pour
            chaque période, si disponible, permettre l'impression du bulletin.
        </div>

        <!-- Menu -->
        <div class="btn-group btn-group-justified activity-visibility" data-toggle="periods">
            @foreach ($periods as $period)
                <a class="btn btn-default @if($period->start_date < Carbon\Carbon::now() && $period->end_date > Carbon\Carbon::now()) active @endif"
                   href="#p{{ $period->id }}" data-toggle="tab">{{ $period->name }}</a>
            @endforeach
        </div>

        <div class="tab-content">
            @foreach ($periods as $period)

                <div class="tab-pane @if($period->start_date < Carbon\Carbon::now() && $period->end_date > Carbon\Carbon::now()) active @endif"
                     id="p{{ $period->id }}">

                    @foreach ($matieres as $matiere)

        <div class="white-box black-box">
            <h1 class="box-title">
            <div class="row">
                <div class="col-xs-6">
                <span class="text-danger">
                  <i class="icon-arrow-up-circle"></i>
                </span>
                    {{ $matiere->details->name }}
                </div>
                <div class="text-right col-xs-6">
                    Moyenne :
                    @if($moyennes[$period->id][$matiere->matiere_id])
                        {{ $moyennes[$period->id][$matiere->matiere_id] }}/20
                    @else
                        -
                    @endif
                </div>
            </div>
            </h1>
        </div>

                        <div class="white-box white-box-content" data-id="{{ $matiere->id }}">
                            <div class="row">
                                <?php $count = 0; ?>
                                @foreach ($notes as $note)
                                    @if ($note->devoir->matiere == $matiere->matiere_id && $note->devoir->period == $period->id)
                                        <?php $count++; ?>
                                        <div class="col-md-3 col-sm-4 col-xs-6">

                                            <div class="info-card">
                                                <div class="front">
                                                    <div class="note note-blue">
                                                        <div class="type">{{ $note->devoir->type }}</div>
                                                        <div class="result">{{ $note->note }}<span
                                                                    class="bareme">/{{ $note->devoir->bareme }}</span>
                                                        </div>
                                                        <div class="libelle">{{ $note->devoir->title }}</div>
                                                    </div>
                                                </div>

                                                <div class="back back-blue">
                                                    <h4>Détails</h4>
                                                    <p>Coefficient : {{ $note->devoir->coefficient }}</p>
                                                    <p>Moyenne de la classe : {{ $note->devoir->avgClasse }}
                                                        /{{ $note->devoir->bareme }}</p>
                                                    <a href="#" class="btn btn-primary btn-block btn-footer">Plus
                                                        d'infos </a>
                                                </div>
                    </div>
                </div>
                                    @endif
                                @endforeach

                                @if ($count == 0)
                                    <blockquote>
                                        <p>Aucune note n'a été enregistrée dans cette matière pour le moment.</p>
                                    </blockquote>
                                @endif

                            </div>
        </div>
                    @endforeach

                </div>

            @endforeach
        </div>


    </div>

    <script>
        $('[data-toggle="periods"] .btn').on('click', function () {
            var $this = $(this);
            $this.parent().find('.active').removeClass('active');
            $this.addClass('active');
        });
    </script>
@endsection
