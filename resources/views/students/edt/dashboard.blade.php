@extends('students.layouts.app')

@section('pagename')
    Emploi du temps
@endsection

@section('css')
    <link href="/css/edt.css" rel="stylesheet">
@endsection

@section("content")

    <div class="container">

        @include("edt.weekly")

    </div>
@endsection
