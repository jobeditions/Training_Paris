@extends('admin.layouts.app')

@section('page_name')
    Salles de cours
@endsection

@section('content')

  @if(session('status'))

    <div class="alert alert-success">
      {{ session('status') }}
    </div>

  @endif

  <table class="table table-reponsive table-bordered full-color-table full-white-table">

    <thead>
      <tr>
        <th class="text-center">#</th>
        <th>Nom</th>
        <th>Description</th>
        <th></th>
      </tr>
    </thead>

    <tbody>
      @foreach($rooms as $room)
        <tr>
          <td class="text-center">{{ $room->id }}</td>
          <td>{{ $room->name }}</td>
          <td>{{ $room->numero }}</td>
          <td class="text-center">
            {{ Form::open(['route' => ['admin-rooms-delete', $room->id], 'method' => 'delete']) }}
              <button type="submit" class="btn btn-danger"><i class="fa fa-times"></i></button>
            {{ Form::close() }}
          </td>
        </tr>
      @endforeach
    </tbody>

  </table>

  <div class="panel panel-info">
      <div class="panel-heading panel-link" onclick="document.location = '{{route('admin-rooms-add')}}'">Ajouter une salle</div>
  </div>

@endsection
