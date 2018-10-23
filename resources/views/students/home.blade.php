@extends('students.layouts.app')

@section('pagename')
    Tableau de bord
@endsection

<?php
/*
<div class="panel panel-info">
    <div class="panel-heading">
        <span>Nouveau devoir à rendre<br>Test</span>
        <span class="pull-right">Test</span>
    </div>

    <div class="panel-body">

    </div>
</div>


echo Route::getCurrentRoute()->getActionName();


@include('students.teachers')
@include('students.submit_assignement')
*/
?>

@section('css')
    <link href="/css/edt.css" rel="stylesheet">
@endsection

@section("content")

 <div class="container">

    <div class="row">

        <div class="col-xs-12 col-md-8">
        <div class="white-box black-box">
          <h1 class="box-title">
            <i class="icon-speech"></i>
            Actualités
          </h1>
        </div>
            <div class="white-box white-box-content">
                <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <small>Nathanaël Langlois, CEO</small>
                </blockquote>
        </div>

            @include("students.common.banner", ["name" => "Activité récente", "icon" => "info", "type" => "blue"])
            <div class="white-box white-box-content">

               @if($absences->nbUnjustified > 0)

                <big>{{ $absences->nbUnjustified }} @if($absences->nbUnjustified < 2) absence non justifiée @else absences non justifiées @endif</big>
                <ul>
                  @foreach ($absences as $abs)
                    <li>Du {{ $abs->absence_start }} au {{ $abs->absence_end }}</li>
                  @endforeach
                </ul>

               @else

               <div class="alert alert-info">Aucune absence injustifiée n'a été enregistrée.</div>

               @endif

               <div class="row">
                 <div class="col-md-6"></div>
                 <div class="col-md-6">
                   <a href="#" class="btn btn-block btn-info">Historique des absences/retards</a>
                 </div>
               </div>


            </div>

        </div>

        <div class="col-xs-12 col-md-4">
            @include("students.common.banner", ["name" => "Aujourd'hui", "icon" => "calender", "type" => "red"])
            @include("edt.daily")
        </div>



    </div>

 </div>
 @endsection
