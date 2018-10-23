@extends('admin.layouts.app')

@section('page_name')
  Ajout d'une actualité
@endsection

@section('content')

  <form action="" method="POST">

    <div class="form-group">
      <label>Titre</label>
      <input type="text" name="title" placeholder="Titre" class="form-control" />
    </div>

    <div class="form-group">
      <label>Contenu</label>
      <textarea name="content" placeholder="Contenu du l'article" class="form-control"></textarea>
    </div>

    <div class="row">

      <div class="col-md-6">
        <div class="form-group">
          <label>Début d'affichage</label>
          <input type="date" name="start_date" class="form-control" />
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label>Fin d'affichage</label>
          <input type="date" name="end_date" class="form-control" />
        </div>
      </div>

    </div>

    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Ajouter</button>
    </div>

  </form>

@endsection
