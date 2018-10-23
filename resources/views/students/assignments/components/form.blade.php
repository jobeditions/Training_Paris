<!-- Formulaire -->
@if (isset($assignment->max_files) && $assignment->max_files > 0)
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
    <div class="row">
        <div class="col-xs-12">
            <div class="white-box">
                <!-- Intitulé -->
                <h1 class="box-title">
                    @if ($assignment->over)
                        Travail remis
                    @else
                        Remettre votre travail
                    @endif
                </h1>

                <!-- Envoi de fichier -->
                @php $student->current_assignment = $assignment; @endphp
                @if (!$assignment->over)
                    <hr>
                    <!-- Nombre max de fichiers atteints -->
                    @if ($student->uploaded >= $assignment->max_files)
                        Vous avez atteint la limite maximale de fichiers que vous pouvez soumettre.<br>
                        Supprimez-en avant d'en ajouter de nouveaux.
                        <!-- Soummettre des fichiers -->
                    @else
                        {!! Form::open(["url" => "student/assignments/".$assignment->id, "method" => "PUT", "files" => true]) !!}
                        <div class="form-group">
                            <input type="hidden" name="action" value="upload">
                            <label for="input-file-now">Ajouter un nouveau fichier :</label>
                            <input type="file" id="input-file-now" name="fileUpload" class="dropify"/>
                            <small>
                                Vous pouvez envoyez jusqu'à {{ $assignment->max_files }}
                                fichier{{ $assignment->max_files > 1 ? "s" : "" }}.
                                Un fichier ne peut excéder la taille de 2 Mb.
                            </small>
                        </div>
                        <button type="submit" class="btn btn-default">Envoyer votre travail</button>
                        {!! Form::close() !!}
                    @endif
                @endif
            <!-- Résultats de l'analyse de fichier -->
                @if ($student->uploaded > 0)
                    <hr>
                    <div class="table-responsive">
                        <table class="table files">
                            <thead>
                            <tr>
                                <th>Nom du fichier</th>
                                <th>Taille du fichier</th>
                                <th>Date de remise</th>
                                <th>Indice de plagiat</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($student->uploadedDocuments->get() as $file)
                                <tr class="success">
                                    <td><a href="{{ url('storage/students/'.$file->path) }}">{{ $file->name }}</a></td>
                                    <td>{{ $file->fsize }}o</td>
                                    <td class="date-format">{{ $file->uploaded_at }}</td>
                                    <td>
                                        @if ($file->meneyii && $file->meneyii->status == "success")
                                            {{ json_decode($file->meneyii)->tests->levenshtein->score }}
                                            <small class="text-muted">/100</small>
                                        @else
                                            Analyse Meyenii prochainement disponible... revenez dans quelques minutes
                                        @endif
                                    </td>
                                    <td>
                                        @if (!$assignment->over)
                                            {!! Form::open(["url" => "student/assignments/".$assignment->id, "method" => "PUT"]) !!}
                                            <input type="hidden" name="action" value="delete">
                                            <input type="hidden" name="delete" value="{{ $file->id }}">
                                            <button type="submit" class="btn btn-danger">X</button>
                                            {!! Form::close() !!}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @else

                    @if ($assignment->todo)
                        Vous n'avez pas remis @if(!$assignment->over) encore @endif votre travail.
                    @else
                        Vous ne pouvez pas soumettre votre travail car il ne s'agit pas d'un devoir ayant été attribué à
                        votre classe.<br>
                        Vous pouvez néanmoins consulter les consignes et les ressources disponibles et réaliser ce
                        travail chez vous à titre personnel :)
                    @endif


                @endif
            </div>
        </div>
    </div>
@else
    <p>Le(la) professeur(e) n'accepte pas la remise en ligne de documents sur ce devoir.</p>
@endif
