@extends('admin.layouts.app')

@section('page_name')
  Edition d'une actualité
@endsection

@section('content')

  <form action="" method="POST">

    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <div class="form-group">
      <label>Titre</label>
      <input type="text" name="title" placeholder="Titre" class="form-control" value="{{ $actu->title }}" />
    </div>

    <div class="form-group">
      <label>Contenu</label>
      <textarea name="content" placeholder="Contenu du l'article" class="form-control">{!! $actu->content !!}</textarea>
    </div>

    <div class="row">

      <div class="col-md-6">
        <div class="form-group">
          <label>Début d'affichage</label>
          <input type="date" name="start_date" class="form-control" value="{{ date('Y-m-d', strtotime($actu->start_date)) }}" />
        </div>
      </div>

      <div class="col-md-6">
        <div class="form-group">
          <label>Fin d'affichage</label>
          <input type="date" name="end_date" class="form-control" value="{{ date('Y-m-d', strtotime($actu->end_date)) }}" />
        </div>
      </div>

    </div>

    <div class="form-group">
      <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
    </div>

  </form>

@endsection
