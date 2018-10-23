@extends('students.layouts.app')

@section("content")
    <!-- Détails du devoir -->
        <div class="container">
            <!-- Intitulé -->
                @include("students.common.banner", ["type" => "black", "name" => $document->name, "icon" => "notebook"])

            <div class="white-box">
                <h1 class="box-title">
                    <!-- Informations générales -->
                        <small class="pull-right m-t-10">Auteur : {{ $document->author }}</small>
                        <i class="icon-book-open"></i>{{ $document->name }} ({{ $document->type }})
                </h1>
                <hr>
                <strong>Mis en ligne le : </strong> {{ $document->created_at }}<br>
                @if ($document->assignment)
                    Ce document est lié au devoir suivant : <a href="/student/assignments/{{$document->assignment->id}}">{{ $document->assignment->name }}</a><br>
                @endif
                <hr>
                <button type="submit" class="btn btn-success" onclick="document.location = '{{url('student/documents/'.$document->id.'/download')}}'">
                    Télécharger le document
                </button>
            </div>

        </div>
@endsection
