@extends('admin.layouts.app')

@section('page_name')
  Gestion des élèves - {{ $classe->name }}
@endsection

@section('content')

  <table class="table table-reponsive table-bordered full-color-table full-white-table">

    <thead>
      <tr>
        <th class="text-center">#</th>
        <th>Nom</th>
        <th>Email</th>
        <th>Dernière connexion</th>
        <th></th>
      </tr>
    </thead>

    <tbody>
      @foreach($classe->students as $student)
        <tr>
          <td class="text-center">{{ $student->user->id }}</td>
          <td>{{ $student->user->name }} {{ $student->user->last_name }}</td>
          <td>{{ $student->user->email }}</td>
          <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($student->user->updated_at))->diffForHumans() }}</td>
          <td class="text-center">
              <a href="{{ route('user-edit-admin', $student->user->id) }}" class="btn btn-info" title="Modifier"><i class="fa fa-pencil"></i></a>
              <button type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>
          </td>
        </tr>
      @endforeach
    </tbody>

  </table>

  <div class="panel panel-info">
      <div class="panel-heading panel-link" onclick="document.location = '{{route('user-create-admin')}}'">Ajouter un élève</div>
  </div>

@endsection
