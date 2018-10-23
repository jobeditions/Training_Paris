@extends('admin.layouts.app')

@section('page_name')
  Gestion des classes
@endsection

@section('content')

  @foreach($schools as $school)
    {{var_dump($school)}}
  @endforeach

@endsection
