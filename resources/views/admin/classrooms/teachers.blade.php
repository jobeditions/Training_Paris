@extends('admin.layouts.app')

@section('page_name')
  Gestion des professeurs - {{ $classe->name }}
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
      @foreach($classe->teachers as $teacher)
        <tr>
          <td class="text-center">{{ $teacher->data->id }}</td>
          <td>{{ $teacher->data->name }} {{ $teacher->data->last_name }}</td>
          <td>{{ $teacher->data->email }}</td>
          <td>{{ \Carbon\Carbon::createFromTimeStamp(strtotime($teacher->data->updated_at))->diffForHumans() }}</td>
          <td class="text-center">
              <a href="#" class="btn btn-info" title="Modifier"><i class="fa fa-pencil"></i></a>
              <button type="button" class="btn btn-danger"><i class="fa fa-times"></i></button>
          </td>
        </tr>
      @endforeach
    </tbody>

  </table>

@endsection
