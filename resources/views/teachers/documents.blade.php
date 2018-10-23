@extends('teachers.layouts.app')

@section('page_name')
    Documents
@endsection

@section('css')
    <link rel="stylesheet" href="/bower_components/dropify/dist/css/dropify.min.css">
@endsection

@section('javascript')
    <script src="/bower_components/dropify/dist/js/dropify.min.js"></script>
    <script>
        $(document).ready(function () {
            // Basic
            $('.dropify').dropify();

            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez',
                    replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                    remove: 'Supprimer',
                    error: 'Désolé, le fichier trop volumineux'
                }
            });

            // Used events
            var drEvent = $('#input-file-events').dropify();

            drEvent.on('dropify.beforeClear', function (event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });

            drEvent.on('dropify.afterClear', function (event, element) {
                alert('File deleted');
            });

            drEvent.on('dropify.errors', function (event, element) {
                console.log('Has Errors');
            });

            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify');
            $('#toggleDropify').on('click', function (e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                } else {
                    drDestroy.init();
                }
            })
        });
    </script>
@endsection

@section('content')
    <div class="panel panel-inverse">
        <div class="panel-heading">Ressources en ligne</div>
        <div class="panel-wrapper" aria-expanded="true">
            <div class="panel-body">
                <!-- Affichages des documents -->
                    @if ($documents->count())
                        <div class="table-responsive">
                            <table class="datatables table color-table dark-table color-bordered-table dark-bordered-table table-hover">
                                <thead><tr>
                                    <th data-toggle="true"> Nom</th>
                                    <th> Classe</th>
                                    <th> Devoir</th>
                                    <th> Action</th>
                                </tr></thead><tbody>
                                    @foreach ($documents as $document)
                                        <tr>
                                            <td>{{ $document->name }}</td>
                                            <td>{{ $document->classe_name }}</td>
                                            <td>{{ $document->assignment != null ? $document->assignment->name : "Non lié"}}</td>
                                            <td>{{ Form::open(['method' => 'DELETE', 'route' => ['documents.destroy', $document->id]]) }}
                                                {{ Form::submit('Supprimer', ['class' => 'btn btn-danger']) }}
                                                {{ Form::close() }}</td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                <!-- Aucun documents -->
                    @else
                        Vous n'avez pas mis en ligne de ressources pour le moment.
                    @endif
            </div>
        </div>
    </div>

    <div class="panel panel-info">
        <a href="#" data-perform="panel-collapse">
        <div class="panel-heading"> Ajouter une nouvelle ressource en ligne
            <div class="pull-right"><i class="ti-plus"></i></div>
        </div>
        </a>
        <div class="panel-wrapper collapse">
            <div class="panel-body">
                <!-- Formulaire d'ajout de document -->
                    {{ Form::open(['url' => '/teacher/documents', 'files' => true]) }}
                            <!-- Liste des classes -->
                                <label for="class-select">Choix de la classe</label><br>
                                    <select id="class-select" name="forClass" class="form-control">
                                        @foreach ($classes as $classe)
                                            <option value="{{ $classe->id }}">{{ $classe->name }} - {{ $classe->subject }}</option>
                                        @endforeach
                                    </select><br>
                                <br>

                            <!-- Liste des devoirs -->
                                <label for="assignment-select">Choix du devoir</label><br>
                                    <select id="assignment-select" name="forAssignment" class="form-control">
                                            <option value="null">Ne pas lier à un devoir</option>
                                        @foreach ($teacher->assignments as $assignment)
                                            <option value="{{ $assignment->id }}" data-class="{{ $assignment->class_id }}">{{ $assignment->name }}</option>
                                        @endforeach
                                    </select><br>
                                <br>

                            <!-- Fichier -->
                                <label for="input-file-now">Choix du fichier</label><br>
                                <input type="file" id="input-file-now" name="fileUpload" class="dropify"/>

                            <!-- Soumission -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Uploader
                                    </button>
                                </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
@endsection
