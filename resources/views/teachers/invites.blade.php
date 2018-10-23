@extends('teachers.layouts.app')

@section('page_name')
    Invitations
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="panel panel-primary block6">
                <div class="panel-heading">Invitations</div>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <p>TeacherHawk est actuellement en bêta. Nous cherchons à augmenter notre nombre d'utilisateur pour
                            avoir un maximum de retours et améliorer un maximum notre outil pour qu'il réponde le mieux
                            possible à vos besoins. C'est pour cette raison que nous vous offrons des invitations à utiliser
                            nos services gratuitement pendant 3 mois. Enjoy!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /row -->
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="white-box">
                <h3 class="box-title">Invitations</h3>
                <p class="text-muted">Invitations envoyées. Il vous reste {{ $remainingInvites }} invitation{{ ($remainingInvites) > 0 ? "s" : "" }} disponible{{ ($remainingInvites) > 0 ? "s" : "" }}.</p>
                @if($remainingInvites > 0)
                    <button class="btn btn-block btn-info waves-effect" data-toggle="modal"
                            data-target="#newInviteModal">Inviter
                    </button>

                @endif

                @if (count($invites) > 0)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Envoyée le</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @for ($i = 0; $i < count($invites); $i++)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $invites[$i]->email }}</td>
                                    <td>{{ $invites[$i]->created_at }}</td>
                                    <td>
                                        @if($invites[$i]->status =='pending')
                                            <span class="label label-warning">en attente</span>
                                        @else
                                            <span class="label label-success">acceptée</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($invites[$i]->status =='pending')

                                        <a href="{{ url('/teacher/invites/remove') }}"
                                           onclick="event.preventDefault();
                                                   document.getElementById('removeinvite-form-{{ $i }}').submit();">
                                            Supprimer <i
                                                    class="fa fa-close text-danger"></i></a>
                                            <form id="removeinvite-form-{{ $i  }}"
                                                  action="{{ url('/teacher/invites/remove') }}"
                                                  method="POST" style="display: none;">
                                            <input type="email" id="email" name="email"
                                                   value="{{ $invites[$i]->email }}">
                                            {{ csrf_field() }}
                                        </form>
                                        @else
                                            Aucune. Merci !
                                        @endif

                                    </td>
                                </tr>
                            @endfor
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="modal fade" id="newInviteModal" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="post" action="{{url('/teacher/invites')}}">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="exampleModalLabel1">Nouvelle invitation</h4></div>
                                    <div class="modal-body">
                                        {{ csrf_field() }}
                                        <div class="form-group">
                                            <label for="email" class="control-label">Email</label>
                                            <input type="email" class="form-control" name="email" id="email">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Annuler
                                        </button>
                                        <button type="submit" class="btn btn-info">Valider</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div></div>


            </div>
        </div>
    </div>
    <!-- /.row -->
@endsection
