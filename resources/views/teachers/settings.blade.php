@extends('teachers.layouts.app')

@section('page_name')
    Paramètres
@endsection

@section('content')
    @if(Session::has('success'))
        <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span>{!! session('success') !!}</div>
    @endif
    <div class="panel panel-inverse">
        <div class="panel-heading">Mes établissements scolaires
            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a></div>
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
		  <div class="panel-body">
            @if (isset($t_school) && count($t_school))
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Etablissement</th>
                            <th>Ville</th>
                            <th>Responsable</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($t_school as $school)
                            <tr onclick="document.location = '/teacher/schools/{{ $school->id }}'">
                                <td>{{ $school->name }}</td>
                                <td>{{ $school->city_name }}</td>
                                <td>{{ $school->headmaster_name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr><td colspan="3" class="text-right"><button onclick="document.location = '{{url('teacher/schools')}}'" class="btn btn-info m-t-10">Gérer mes établissements scolaires</button></td></tr>
                    </tfoot>
                </table>
            @else
                <p>Il semble que vous n'appartenez à aucun établissement scolaire pour le moment.</p>
                <button onclick="document.location = '{{url('teacher/schools')}}'" class="btn btn-info m-t-10">Gérer mes écoles</button>
            @endif
		  </div>
        </div>
    </div>

    <div class="panel panel-inverse">
        <div class="panel-heading">Paramètres de compte
            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a></div>
        </div>
        <div class="panel-wrapper collapse in" aria-expanded="true">
            <div class="panel-body">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="post" action="{{ url('teacher/settings') }}" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="name">Prénom</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="First name"
                               value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Nom</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last name"
                               value="{{ Auth::user()->last_name }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                               value="{{ Auth::user()->email }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Mot de passe</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nouveau mot de passe">
                    </div>

                    <div class="form-group">
                        <label for="avatar">Avatar</label> <br/>
                        <img src="{{ url('storage/avatars/'.Auth::user()->avatar) }}" style="height:90px;"/>
                        <input type="file" name="avatar" id="avatar"/>
                    </div>

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="submit" class="btn btn-success">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
@endsection
