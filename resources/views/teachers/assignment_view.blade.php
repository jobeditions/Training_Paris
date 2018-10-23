@extends('teachers.layouts.app')

@section('page_name')
    Devoir élève
@endsection

@section('content')
    @foreach($paths as $path)
        <iframe src="{{ $path }}" width="100%" height="600"></iframe>
    @endforeach
    <div class="modal-content">
        <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Meyenii</h4></div>
            <div class="modal-body">
                @if ($meyenii)
                    @if ($meyenii->status == "success")
                        @foreach ($meyenii->tests as $name => $content)
                            <h3>{{ $name }}</h3>
                            <hr>
                            @foreach ($content as $key => $value)
                                {{ $key }} :
                                @if (is_array($value))
                                    {{ implode($value, ",") }}
                                @else
                                    {{ $value }}
                                @endif
                                <br>
                            @endforeach
                        @endforeach
                    @endif

                @else
                    Analyse de Meyenii prochainement disponible
                @endif
            </div>
    </div><br>

    <div class="modal-content">
        <form method="post" action="{{url('/teacher/assignments')}}">

            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel1">Commentaire & note</h4></div>
            <div class="modal-body">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="note" class="control-label">Note</label>
                    <input type="number" class="form-control" name="note" id="note">
                </div>
                <div class="form-group">
                    <label for="comment" class="control-label">Commentaire</label><br/>
                    <textarea name="comment" id="comment" cols="120" rows="12"></textarea></div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-info">Ajouter</button>
            </div>

        </form>

    </div>

@endsection
