@extends('admin.layouts.app')

@section('page_name')
  Gestion des actualités
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
        <th>Titre</th>
        <th>Aperçu</th>
        <th>Diffusion</th>
        <th class="text-center">Etat</th>
        <th></th>
      </tr>
    </thead>

    <tbody>
      @foreach($actus as $actu)
        <tr>
          <td>{{ $actu->title }}</td>
          <td>{{ str_limit($actu->content, $limit = 150, $end = '...') }}</td>
          <td>{{ date('d/m/Y', strtotime($actu->start_date)) }} au {{ date('d/m/Y', strtotime($actu->end_date)) }}</td>
          <td class="text-center">
            @if($actu->visible == 1)
              <i class="text-success fa fa-circle fa-fw"></i> Actif
            @else
              <i class="text-danger fa fa-circle fa-fw"></i> Inactif
            @endif
          </td>
          <td class="text-center">
              <a href="{{ route('admin-actus-edit', $actu->id) }}" class="btn btn-info" title="Modifier"><i class="fa fa-pencil"></i></a>
              @if($actu->visible == 1)
                <a href="{{ route('admin-actus-toggle', $actu->id) }}" class="btn-outline btn btn-danger" title="Désactiver"><i class="fa fa-times"></i></a>
              @else
                <a href="{{ route('admin-actus-toggle', $actu->id) }}" class="btn-outline btn btn-success" title="Activer"><i class="fa fa-check"></i></a>
              @endif
                <a href="{{ route('admin-actus-delete', $actu->id) }}" class="btn btn-danger" title="Supprimer"><i class="fa fa-trash"></i></a>
          </td>
        </tr>
      @endforeach
    </tbody>

  </table>

  <div class="panel panel-info">
      <div class="panel-heading panel-link" onclick="document.location = '{{route('admin-actus-add')}}'">Ajouter une actualité</div>
  </div>

@endsection
