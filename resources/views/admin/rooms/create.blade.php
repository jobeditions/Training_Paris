@extends('admin.layouts.app')

@section('page_name')
    Ajout d'une salle
@endsection

@section('content')

  <form action="" method="POST">

    <input type="hidden" name="_token" value="{{ csrf_token() }}" />

    <div class="form-group">
      <label>Nom de la salle</label>
      <input type="text" name="name" class="form-control" required />
    </div>

    <div class="form-group">
      <label>Numéro de la salle</label>
      <input type="text" name="numero" class="form-control" required />
    </div>

    <div class="form-group">
      <button type="submit" name="submit" class="btn btn-success"><i class="fa fa-plus"></i> Ajouter une salle</button>
    </div>

  </form>

@endsection
